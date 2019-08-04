<?php

include('admin/config.php');

if(isset($_POST["action"])){
    $sql = "DELETE FROM tbl_cart WHERE product_id=".$_POST['product_id']." AND user_id=".$_POST['user_id'];
    $result = mysqli_query($conn, $sql);
    $return_output = array();
    array_push($return_output, 'done');
    echo json_encode($return_output);
}
?>