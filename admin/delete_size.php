<?php

require 'config.php';
if(isset($_GET['delete_id']))
{

	$sql = "DELETE FROM tbl_product_size WHERE size_id =" .$_GET['delete_id'];
	$result = mysqli_query($conn,$sql);

	header('Location:size.php');
	exit();
}

?>