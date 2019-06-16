<?php

include('config.php');

if(isset($_POST["product_id"]))
{
	$sql ="SELECT tbl_product_size_mapping.size_id,tbl_product_size_mapping.product_id,tbl_product_size_mapping.product_quantity,tbl_product_size.size FROM tbl_product_size_mapping
		INNER JOIN tbl_product_size ON tbl_product_size_mapping.size_id = tbl_product_size.size_id
		WHERE tbl_product_size_mapping.product_id =  '".$_POST["product_id"]."'";

	$result = mysqli_query($conn,$sql);
	// $row = mysqli_fetch_array($result);

	$output = array();
	while ($row = mysqli_fetch_array($result))
    {

    	array_push($output, $row);
    } 
	echo json_encode($output);
}



?>