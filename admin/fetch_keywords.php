<?php

include('config.php');

if(isset($_POST["product_id"]))
{
	
	$sql = "SELECT tbl_keywords.keyword, tbl_product_keyword_mapping.keyword_id 
			FROM  tbl_keywords
			INNER JOIN tbl_product_keyword_mapping ON tbl_keywords.keyword_id = tbl_product_keyword_mapping.keyword_id
			WHERE tbl_product_keyword_mapping.product_id = '".$_POST["product_id"]."'";
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