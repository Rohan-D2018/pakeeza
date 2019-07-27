<?php

include('admin/config.php');

if(isset($_POST["user_id"]))
{

	$user_id = $_POST["user_id"];

	$sql =	"SELECT * FROM tbl_users_credentials
			WHERE user_id  = '$user_id'";

	$result = mysqli_query($conn,$sql);
	$row = mysqli_fetch_array($result);
	echo json_encode($row);
}

?>