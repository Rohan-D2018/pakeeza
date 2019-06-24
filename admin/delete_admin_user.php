<?php

require 'config.php';
if(isset($_GET['delete_id']))
{

	$sql = "DELETE FROM tbl_admin_panel WHERE admin_id =" .$_GET['delete_id'];
	$result = mysqli_query($conn,$sql);

	header('Location:manage_users.php');
	exit();
}

?>