<?php

require 'config.php';
if(isset($_GET['delete_id']))
{

	$sql = "DELETE FROM tbl_product_color WHERE color_id =" .$_GET['delete_id'];
	$result = mysqli_query($conn,$sql);

	header('Location:color.php');
	exit();
}

?>