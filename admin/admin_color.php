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

	
		// $product_color = "Black";
	$color_picture_url = "../images/collection/123hdgsa_1209_21_12:12:12:42";
		

		$sql ="INSERT INTO tbl_product_color (color_name,color_picture_url) VALUES ('$product_color','$color_picture_url')";
        $result = mysqli_query($conn,$sql);

	// }
}

add_color();
header("Location: color.php");
?>