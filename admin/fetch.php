<?php

include('config.php');

if(isset($_POST["product_id"]))
{
	$sql ="SELECT tbl_products.product_id,tbl_products.product_name,tbl_products.product_type,tbl_products.price,tbl_products.product_code,tbl_products.discount,tbl_products.product_description,tbl_products.material,tbl_products.gender,tbl_products.product_keywords, tbl_collections.collection_name, tbl_product_color.color_name
		FROM tbl_products 
		INNER JOIN tbl_collections ON tbl_products.collection_id = tbl_collections.collection_id
		INNER JOIN tbl_product_color_mapping ON tbl_products.product_id = tbl_product_color_mapping.product_id
		INNER JOIN tbl_product_color ON tbl_product_color_mapping.color_id = tbl_product_color.color_id
		WHERE tbl_products.product_id = '".$_POST["product_id"]."'";

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


if(isset($_POST["size_id"]))
{
	$sql ="SELECT size_id,size FROM tbl_product_size WHERE size_id = '".$_POST["size_id"]."'";
	$result = mysqli_query($conn,$sql);
	$row = mysqli_fetch_array($result);
	echo json_encode($row);
}



if(isset($_POST["color_id"]))
{
	$sql ="SELECT color_id,color_name,product_color_hex FROM tbl_product_color WHERE color_id = '".$_POST["color_id"]."'";
	$result = mysqli_query($conn,$sql);
	$row = mysqli_fetch_array($result);
	echo json_encode($row);
}



if(isset($_POST["order_id"]))
{
	$order_id = $_POST["order_id"];
	$sql ="SELECT tbl_order_details.order_id, tbl_order_details.price, tbl_order_details.size,tbl_order_details.color, tbl_order_details.quantity, tbl_products.product_name,tbl_users_credentials.user_email
            FROM tbl_order_details
            INNER JOIN tbl_products ON tbl_order_details.product_id = tbl_products.product_id
            INNER JOIN tbl_orders ON tbl_order_details.order_id = tbl_orders.order_id
            INNER JOIN tbl_users_credentials ON tbl_orders.user_id = tbl_users_credentials.user_id
		    WHERE tbl_orders.order_id = '".$order_id."'";

	$result = mysqli_query($conn,$sql);
	$row = mysqli_fetch_array($result);
	echo json_encode($row);
}
?>

