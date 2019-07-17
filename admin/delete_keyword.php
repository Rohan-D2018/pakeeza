<?php

require 'config.php';
if(isset($_GET['delete_id']))
{

	$sql = "DELETE FROM tbl_keywords WHERE keyword_id =" .$_GET['delete_id'];
	$result = mysqli_query($conn,$sql);

	header('Location:keywords.php');
	exit();
}

?>