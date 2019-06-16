<?php

require 'config.php';
function add_collection()
{
	require 'config.php';

		// $collection_pic_url = $_POST["collection_picture_url"];

	if(isset($_POST["collection_name"])){
        $collection_name = $_POST["collection_name"];
    }
    else{
        $collection_name = "";
    }

    if(isset($_POST["collection_description"])){
        $collection_description = $_POST["collection_description"];
    }
    else{
        $collection_description = "";
    }

    
		

	$collection_pic_url = "../images/collection/123hdgsa_1209_21_12:12:12:42";
		

		$sql ="INSERT INTO tbl_collections (collection_name,collection_description,collection_picture_url) VALUES ('$collection_name','$collection_description','$collection_pic_url')";
        $result = mysqli_query($conn,$sql);

	// }
}

add_collection();
header("Location: collection.php");

?>