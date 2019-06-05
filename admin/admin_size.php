<?php

require 'config.php';
function add_size()
{
	require 'config.php';

	// if(isset($_POST['submit']))
	// {
		// $product_size = $_POST["product_size"];
		
		$product_size = "XXL";
		

		$sql ="INSERT INTO tbl_product_size (size) VALUES ('$product_size')";
        $result = mysqli_query($conn,$sql);

	// }
}

function add_color()
{
	require 'config.php';

	// if(isset($_POST['submit']))
	// {
		// $product_size = $_POST["product_size"];
		// $color_picture_url = $_POST["color_picture_url"];
	
		$product_color = "Black";
		$color_picture_url = "../images/collection/123hdgsa_1209_21_12:12:12:42";
		

		$sql ="INSERT INTO tbl_product_color (color_name,color_picture_url) VALUES ('$product_color','$color_picture_url')";
        $result = mysqli_query($conn,$sql);

	// }
}


function add_collection()
{
	require 'config.php';

	// if(isset($_POST['submit']))
	// {
		// $collection_name = $_POST["product_size"];
		// $collection_desp = $_POST["collection_description"];
		// $collection_pic_url = $_POST["collection_picture_url"];
		
		$collection_name = "Lakhanawi";
		$collection_desp = "Its the best collection !!! in india";
		$collection_pic_url = "../images/collection/123hdgsa_1209_21_12:12:12:42";
		

		$sql ="INSERT INTO tbl_collections (collection_name,collection_description,collection_picture_url) VALUES ('$collection_name','$collection_desp','$collection_pic_url')";
        $result = mysqli_query($conn,$sql);

	// }
}
 
add_size();
add_color();
add_collection();
?>