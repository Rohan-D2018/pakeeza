<?php

require 'config.php';
function add_collection()
{
	require 'config.php';

		// $collection_pic_url = $_POST["collection_picture_url"];

	if(isset($_POST["collection_name"])){
        $collection_name = mysqli_real_escape_string($conn, $_POST["collection_name"]);
    }
    else{
        $collection_name = "";
    }

    if(isset($_POST["collection_description"])){
        $collection_description = mysqli_real_escape_string($conn, $_POST["collection_description"]);
    }
    else{
        $collection_description = "";
    }


    if(isset($_POST["show_on_landing_page"])){
        $show_on_landing_page = $_POST["show_on_landing_page"];
    }
    else{
        $show_on_landing_page = 0;
    }


    print_r($_FILES['file']);

    // insert images into tbl_pictures
    // File upload configuration
    $targetDir = "uploads/collections/";
    $allowTypes = array('jpg','png','jpeg','gif');
    // foreach($_FILES['file']['tmp_name'] as $key => $tmp_name ){
        
        // File upload path
        $file_name = basename($_FILES['file']['name']);
        
        $targetFilePath = $targetDir . $file_name;
        // Check whether file type is valid
        $fileType = strtolower(pathinfo($targetFilePath,PATHINFO_EXTENSION));

        if(in_array($fileType, $allowTypes)){
            if(is_dir($targetDir)==false){
                mkdir($targetDir, 0700);        // Create directory if it does not exist
            }
            
            if(!file_exists($targetFilePath)){
                if(move_uploaded_file($_FILES["file"]["tmp_name"], $targetFilePath)){
                    $sql ="INSERT INTO tbl_collections (collection_name,collection_description,collection_picture_url,show_on_landing_page) VALUES ('$collection_name','$collection_description','$file_name','$show_on_landing_page')";
                    $result = mysqli_query($conn,$sql);
                }
            }else{                                  //rename the file if another one exist
                $path_parts = pathinfo($file_name);
                $new_file_name = $path_parts["filename"].time().".".$path_parts["extension"];
                $new_dir = $targetDir.$new_file_name;
                
                if(move_uploaded_file($_FILES["file"]["tmp_name"], $new_dir)){
                    $sql ="INSERT INTO tbl_collections (collection_name,collection_description,collection_picture_url,show_on_landing_page) VALUES ('$collection_name','$collection_description','$new_file_name','$show_on_landing_page')";
                    $result = mysqli_query($conn,$sql);
                }           
            }
        }
    // }
}

add_collection();
header("Location: collection.php");

?>