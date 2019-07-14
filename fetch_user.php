<?php

include('admin/config.php');

if(isset($_POST["user_id"]))
{
	$sql = "select * from tbl_users_credentials where user_id = '".$_POST['user_id']."'";

	$result = mysqli_query($conn,$sql);
	// $row = mysqli_fetch_array($result);

	$output = array();
	while ($row = mysqli_fetch_assoc($result))
    {

    	array_push($output, $row);
    } 
	echo json_encode($output);
}

?>
