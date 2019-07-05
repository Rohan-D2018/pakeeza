<?php
session_start();

require 'admin/config.php';

if(isset($_POST['product_id']))
{

	echo '<h2>Please Wait...</h2>';
	$prod_id = $_POST['product_id'];
	// $size = $_POST['productSize'];
	//$color = $_POST['productColor'];
	$user_id = $_SESSION['user_id'];

	$sql ="INSERT INTO tbl_cart(user_id,product_id,cart_product_status) VALUES ('$user_id',$prod_id,0)";
	echo $sql;
	$result = mysqli_query($conn,$sql);
	header('Location:shop.php');
} 
else
{
	echo 'The product was not able to get added in the cart, Please try again!';
}
?>
