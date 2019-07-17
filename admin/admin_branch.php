<?php

require 'config.php';
function add_branch()
{
	require 'config.php';

		// $collection_pic_url = $_POST["collection_picture_url"];

	if(isset($_POST["sub_branch_name"])){
        $sub_branch_name = $_POST["sub_branch_name"];
    }
    else{
        $sub_branch_name = "";
    }

    if(isset($_POST["sub_branch_description"])){
        $sub_branch_description = $_POST["sub_branch_description"];
    }
    else{
        $sub_branch_description = "";
    }

    print_r($_FILES['file']);

    // insert images into tbl_pictures
    // File upload configuration
    $targetDir = "uploads/sub_branch/";
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
                    $sql ="INSERT INTO tbl_sub_branch (sub_branch_name,sub_branch_description,sub_branch_picture_url) VALUES ('$sub_branch_name','$sub_branch_description','$file_name')";
                    $result = mysqli_query($conn,$sql);
                }
            }else{                                  //rename the file if another one exist
                $path_parts = pathinfo($file_name);
                $new_file_name = $path_parts["filename"].time().".".$path_parts["extension"];
                $new_dir = $targetDir.$new_file_name;
                
                if(move_uploaded_file($_FILES["file"]["tmp_name"], $new_dir)){
                    $sql ="INSERT INTO tbl_sub_branch (sub_branch_name,sub_branch_description,sub_branch_picture_url) VALUES ('$sub_branch_name','$sub_branch_description','$new_file_name')";
                    $result = mysqli_query($conn,$sql);
                }           
            }
        }
    // }
}

add_branch();
header("Location: branch.php");

?>