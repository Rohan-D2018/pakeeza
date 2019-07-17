<?php

require 'config.php';
function add_banners()
{
	require 'config.php';

		// $collection_pic_url = $_POST["collection_picture_url"];

	if(isset($_POST["banner_title"])){
        $banner_title = mysqli_real_escape_string($conn, $_POST["banner_title"]);
    }
    else{
        $banner_title = "";
    }

    if(isset($_POST["banner_link"])){
        $banner_link = mysqli_real_escape_string($conn, $_POST["banner_link"]);
    }
    else{
        $banner_link = "";
    }

    print_r($_FILES['file']);

    // insert images into tbl_pictures
    // File upload configuration
    $targetDir = "uploads/banners/";
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
                    $sql ="INSERT INTO tbl_banners (banner_title,banner_picture_url,banner_link) VALUES ('$banner_title','$file_name','$banner_link')";
                    $result = mysqli_query($conn,$sql);
                }
            }else{                                  //rename the file if another one exist
                $path_parts = pathinfo($file_name);
                $new_file_name = $path_parts["filename"].time().".".$path_parts["extension"];
                $new_dir = $targetDir.$new_file_name;
                
                if(move_uploaded_file($_FILES["file"]["tmp_name"], $new_dir)){
                    $sql ="INSERT INTO tbl_banners (banner_title,banner_picture_url,banner_link) VALUES ('$banner_title','$new_file_name','$banner_link')";
                    $result = mysqli_query($conn,$sql);
                }           
            }
        }
    // }
}

add_banners();
header("Location: banners.php");

?>