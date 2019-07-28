<?php
include('header.php');
if (!isset($_SESSION['user_id'])){
    header('Location: login/login.php');
}
require 'admin/config.php';
$user_id = $_SESSION['user_id']; 


if(isset($_POST["razorpay_payment_id"])){
    $razorpay_payment_id = $_POST["razorpay_payment_id"];
}
else{
    $razorpay_payment_id = "NA";
}

if(isset($_POST["optradio"])){
    $radio_selection = $_POST["optradio"];
}
else{
    $radio_selection = "";
}

if(isset($_POST["shipping_address_". $radio_selection])){
    $shipping_address = $_POST["shipping_address_". $radio_selection];   
}
else{
    $shipping_address = "";
}

$sql ="INSERT INTO tbl_orders (user_id,order_date,shipping_address,payment_id,payment_date,transaction_status) VALUES ('$user_id', NOW(),'$shipping_address','$razorpay_payment_id',NOW(),1)";
$result = mysqli_query($conn,$sql);

// selecting the order id that recently added in the table
$sql = "SELECT MAX(order_id) as order_id FROM tbl_orders";                  
$result = mysqli_query($conn, $sql);

while ($row = mysqli_fetch_array($result))
{
// $row = mysqli_fetch_array($result);

$order_id = $row['order_id'];
}


$sql = "SELECT tbl_cart.product_id,tbl_cart.size,tbl_cart.color,tbl_products.product_name,tbl_products.price
		FROM tbl_cart
		INNER JOIN tbl_products ON tbl_cart.product_id = tbl_products.product_id
		WHERE tbl_cart.user_id = '$user_id' AND tbl_products.delete_status =0";
      
$result = mysqli_query($conn, $sql);

while ($row = mysqli_fetch_array($result))
{ 
	// print_r($row);
	$product_id = $row['product_id'];
	$price = $row['price'];
	$size = $row['size'];
	$color = $row['color'];

    $sql_1 = "INSERT INTO tbl_order_details(order_id,product_id,price,size,color) VALUES ('$order_id', '$product_id','$price','$size','$color')";    
    $result_1 = mysqli_query($conn, $sql_1);
}


$sql = "SELECT size_id as order_id FROM tbl_product_size LIMIT 1";                  
$result = mysqli_query($conn, $sql);

while ($row = mysqli_fetch_array($result))
{
    $size_id = $row['size_id'];
}

$sql = "SELECT * 
        FROM tbl_user_details
        WHERE address_1='$shipping_address'";

$results = mysqli_query($conn, $sql);

if(mysqli_num_rows($results) >= 1) 
{
	echo "Address already present";
}
else
{
	$sql_1 = "INSERT INTO tbl_user_details(user_id,address_1) VALUES ('$user_id', '$shipping_address')";    
    $result_1 = mysqli_query($conn, $sql_1);
}


$sql = "DELETE FROM tbl_cart
        WHERE user_id = '$user_id'";
$result = mysqli_query($conn, $sql);


//descrement the size of product
$sql = "UPDATE tbl_product_size_mapping  
        SET product_quantity = product_quantity - 1
        WHERE size_id = '$size_id' 
        AND product_id = '$product_id'
        AND product_quantity > 0";

$result = mysqli_query($conn, $sql);


echo "<script>window.location='after_payment.php'</script>";
die;


?>