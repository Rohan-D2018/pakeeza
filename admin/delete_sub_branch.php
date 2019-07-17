<?php

require 'config.php';
if(isset($_GET['delete_id']))
{

	$sql = "DELETE FROM tbl_sub_branch WHERE sub_branch_id =" .$_GET['delete_id'];
	$result = mysqli_query($conn,$sql);

	header('Location:branch.php');
	exit();
}

?>