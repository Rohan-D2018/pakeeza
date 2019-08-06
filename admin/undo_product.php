<?php

include('config.php');

if(isset($_POST["product_id"]))
{
	$sql =	"UPDATE tbl_products SET delete_status = 0 
			WHERE product_id = '".$_POST["product_id"]."'";

	$result = mysqli_query($conn,$sql);
	
	echo "Done";
}

?>