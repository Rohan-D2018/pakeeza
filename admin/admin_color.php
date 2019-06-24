<?php

require 'config.php';
function add_color()
{
	require 'config.php';

	if(isset($_POST["product_color"])){
        $product_color = $_POST["product_color"];
    }
    else{
        $product_color = "";
    }

    if(isset($_POST["product_color_hex"])){
        $product_color_hex = $_POST["product_color_hex"];
    }
    else{
        $product_color_hex = "";
    }	

		$sql ="INSERT INTO tbl_product_color (color_name,product_color_hex) VALUES ('$product_color','$product_color_hex')";
        $result = mysqli_query($conn,$sql);

	// }
}

add_color();
header("Location: color.php");
?>