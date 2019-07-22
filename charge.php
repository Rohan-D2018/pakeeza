<?php
//  require 'admin/config.php';

// $user_id = 1;
    session_start();
    if (!isset($_SESSION['user_id'])){
        header('Location: login/login.php');
    }
    // include('header.php');
    require 'admin/config.php';
    $user_id = $_SESSION['user_id']; 

// echo "<pre>";
// print_r($_POST);

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

if(isset($_POST["shipping_address"])){
    $shipping_address = $_POST["shipping_address"];   
}
else{
    $shipping_address = "";
}

if(isset($_POST["shipping_address2"])){
    $shipping_address2 = $_POST["shipping_address2"];   
}
else{
    $shipping_address2 = "";
}


// echo $radio_selection.' , '.$shipping_address.' ,'.$shipping_address2;


//Inserting into orders

if($radio_selection == 1){
	$final_shipping_address = $shipping_address;
}
else
{
	$final_shipping_address = $shipping_address2;
}


$sql ="INSERT INTO tbl_orders (user_id,order_date,shipping_address,payment_id,payment_date,transaction_status) VALUES ('$user_id', NOW(),'$final_shipping_address','$razorpay_payment_id',NOW(),1)";
$result = mysqli_query($conn,$sql);


// selecting the order id that recently added in the table
$sql = "SELECT MAX(order_id) as order_id FROM tbl_orders";                  
$result = mysqli_query($conn, $sql);

while ($row = mysqli_fetch_array($result))
{
// $row = mysqli_fetch_array($result);

$order_id = $row['order_id'];
}

echo ($order_id);


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



$sql_1 = "INSERT INTO tbl_user_details(user_id,address_1) VALUES ('$user_id', '$final_shipping_address')";    
$result_1 = mysqli_query($conn, $sql_1);

header("Location: index.php");
die;


?>