<?php
session_start();

require 'admin/config.php';

if(isset($_POST['product_id']))
{
	$prod_id = $_POST['product_id'];
	$user_id = $_SESSION['user_id'];
	$product_size = $_POST['size'];
	$product_color = $_POST['color'];
	$sql = "SELECT * FROM tbl_cart WHERE product_id=".$prod_id." AND user_id=".$user_id;
	$result = mysqli_query($conn, $sql);
	$num_rows = mysqli_num_rows($result);
	if ($num_rows > 0) {
		header('Location:shop.php');
	}
	else {
		$sql ="INSERT INTO tbl_cart(user_id,product_id,cart_product_status,size,color) VALUES ('$user_id',$prod_id,0,'$product_size', '$product_color')";
		$result = mysqli_query($conn, $sql);
		header('Location:shop.php');
	}
} 
else
{
	echo 'The product was not able to get added in the cart, Please try again!';
}
?>
