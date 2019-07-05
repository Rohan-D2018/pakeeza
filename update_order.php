<?php

include('config.php');

if(isset($_POST["btn_edit_order"]))
{
	$sql ="UPDATE tbl_orders set shipping_id=".$_POST['shipping_id']." shippin_date=".$_POST['shipping_date']."transaction_status=".$_POST['transaction_status'];

	$result = mysqli_query($conn,$sql);
	
	if (!$result) 
        {
        	die ('SQL Error: ' . mysqli_error($conn));
        }
	else
	{

		$sql ="UPDATE tbl_order_details set product_id=".$_POST['product_id']." where order_id=".$_POST['product_id']; 

		$result = mysqli_query($conn,$sql);
	
		if (!$result) 
		{
			die ('SQL Error: ' . mysqli_error($conn));
		}
		else
		{
			header("Location: orders.php");
		}
	}
}

?>
