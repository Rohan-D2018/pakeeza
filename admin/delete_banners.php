<?php

require 'config.php';
if(isset($_GET['delete_id']))
{

	$sql = "DELETE FROM tbl_banners WHERE banner_id =" .$_GET['delete_id'];
	$result = mysqli_query($conn,$sql);

	header('Location:banners.php');
	exit();
}

?>