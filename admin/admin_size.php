<?php

require 'config.php';
function add_size()
{
	require 'config.php';
	
	if(isset($_POST["product_size"])){
        $product_size = mysqli_real_escape_string($conn, $_POST["product_size"]);
    }
    else{
        $product_size = "";
    }


		$sql ="INSERT INTO tbl_product_size (size) VALUES ('$product_size')";
        $result = mysqli_query($conn,$sql);

	// }
}

add_size();
header("Location: size.php");

?>