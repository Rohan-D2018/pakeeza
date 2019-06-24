<?php

require 'config.php';
if(isset($_GET['delete_id']))
{

	$sql = "UPDATE tbl_products SET delete_status = 1, delete_date = NOW() WHERE product_id =" .$_GET['delete_id'];
	$result = mysqli_query($conn,$sql);

	header('Location:show_products.php');
	exit();
}

?>