<?php

include('config.php');

if(isset($_POST["order_id"]))
{
	$sql =" select * from tbl_orders 
		INNER JOIN tbl_order_details on tbl_orders.order_id=tbl_order_details.order_id
		INNER JOIN tbl_payment on tbl_orders.payment_id = tbl_payment.payment_id";

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
