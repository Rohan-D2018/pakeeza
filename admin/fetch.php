<?php

include('config.php');

if(isset($_POST["product_id"]))
{
	$sql ="SELECT product_id,product_name,product_type,price,product_code,discount,material,gender,product_description FROM tbl_products WHERE product_id = '".$_POST["product_id"]."'";
	$result = mysqli_query($conn,$sql);
	$row = mysqli_fetch_array($result);
	echo json_encode($row);
}


if(isset($_POST["collection_id"]))
{
	$sql ="SELECT collection_id,collection_name,collection_description FROM tbl_collections WHERE collection_id = '".$_POST["collection_id"]."'";
	$result = mysqli_query($conn,$sql);
	$row = mysqli_fetch_array($result);
	echo json_encode($row);
}
?>

