<?php

require 'config.php';

if(isset($_POST["btn_edit_products"]))
{
    $product_id = $_POST['product_id2'];
    $product_name = $_POST['product_name2'];
    $collection_name = $_POST['product_collection2'];
    $product_type = $_POST['product_type2'];
    $product_description =  $_POST['product_description2'];
    $product_price =  $_POST['product_price2'];
    $product_discount =  $_POST['product_discount2'];
    $product_material =  $_POST['product_material2'];
    $product_gender =  $_POST['product_gender2'];
    $product_code =  $_POST['product_code2'];
    $product_color =  $_POST['product_color2'];
    $product_keywords =  $_POST['product_keywords2'];


    if(isset($_POST["size_list"])){
        $size_list = $_POST["size_list"];
    }
    else{
        $size_list = "";
    }
    if(isset($_POST["quantity_list"])){
        $quantity_list = $_POST["quantity_list"];
    }
    else{
        $quantity_list = "NA";
    }

    foreach($quantity_list as $key => $value)          
        if(empty($value))
        {
            unset($quantity_list[$key]); 
        }
       
    // Making the array indexes starts from 0
    $quantity_list = array_values($quantity_list);    
    // print_r($quantity_list);






    $sql ="UPDATE tbl_products SET product_name = '$product_name', product_type = '$product_type', price='$product_price' , product_description = '$product_description',material = '$product_material',gender = '$product_gender',product_code = '$product_code', discount = '$product_discount',product_keywords = '$product_keywords'  WHERE product_id = '$product_id'";
    $result = mysqli_query($conn,$sql);

    echo $collection_name;

    $sql_1 ="SELECT DISTINCT(collection_id) from tbl_collections WHERE collection_name = '$collection_name' LIMIT 1";
    $result_1 = mysqli_query($conn,$sql_1);
    $row = mysqli_fetch_array($result_1);
    $collection_id = $row['collection_id'];

    echo $collection_id;

    $sql_2 ="UPDATE tbl_products SET collection_id = '$collection_id' WHERE product_id = '$product_id'";
    $result_2 = mysqli_query($conn,$sql_2);



    $sql_3 ="SELECT DISTINCT(color_id) from tbl_product_color WHERE color_name = '$product_color' LIMIT 1";
    $result_3 = mysqli_query($conn,$sql_3);
    $row = mysqli_fetch_array($result_3);
    $color_id = $row['color_id'];

    echo $color_id;

    $sql_4 ="UPDATE tbl_product_color_mapping SET color_id = '$color_id' WHERE product_id = '$product_id'";
    $result_4 = mysqli_query($conn,$sql_4);

    if($_FILES['files']['error'][0] != 4){
        $sql_5 ="DELETE FROM tbl_pictures WHERE product_id = '$product_id'";
        $result_5 = mysqli_query($conn,$sql_5);

        $targetDir = "uploads/";
        $allowTypes = array('jpg','png','jpeg','gif');
        foreach($_FILES['files']['tmp_name'] as $key => $tmp_name ){
            // File upload path
            $file_name = basename($_FILES['files']['name'][$key]);
            
            $targetFilePath = $targetDir . $file_name;
            // Check whether file type is valid
            $fileType = strtolower(pathinfo($targetFilePath,PATHINFO_EXTENSION));
            if(in_array($fileType, $allowTypes)){
                if(is_dir($targetDir)==false){
                    mkdir($targetDir, 0700);        // Create directory if it does not exist
                }
                
                if(!file_exists($targetFilePath)){
                    if(move_uploaded_file($_FILES["files"]["tmp_name"][$key], $targetFilePath)){
                        $sql = "INSERT INTO tbl_pictures (product_id, picture_url) VALUES ('$product_id', '$file_name')";
                        $result = mysqli_query($conn, $sql);
                    }
                }else{                                  //rename the file if another one exist
                    $path_parts = pathinfo($file_name);
                    $new_file_name = $path_parts["filename"].time().".".$path_parts["extension"];
                    $new_dir = $targetDir.$new_file_name;
                    
                    if(move_uploaded_file($_FILES["files"]["tmp_name"][$key], $new_dir)){
                        $sql = "INSERT INTO tbl_pictures (product_id, picture_url) VALUES ('$product_id', '$new_file_name')";
                        $result = mysqli_query($conn, $sql);
                    }           
                }
            }
        }
    }


    // insert size array into product size mapping
    if(!empty($_POST['size_list'])) 
    {

        
        $sql_2 ="DELETE FROM tbl_product_size_mapping  WHERE product_id = '$product_id'";
        $result_2 = mysqli_query($conn,$sql_2);


        $sizes = $_POST['size_list'];
        // $sizes= $size_list;
        $quantity_counter = 0;
        foreach ($sizes as $size)
        {
            $product_quantity = $quantity_list[$quantity_counter];
            $sql = "SELECT DISTINCT(size_id) from tbl_product_size WHERE size = '$size'";
            $result = mysqli_query($conn,$sql);
            $row = mysqli_fetch_array($result);
            $size_id = $row['size_id'];
              
            $sql ="INSERT INTO tbl_product_size_mapping (size_id,product_id,product_quantity) VALUES ($size_id,$product_id,$product_quantity)";
            $result = mysqli_query($conn,$sql);
            $quantity_counter += 1;
        }
    }

    header('Location: edit_product.php?id='.$product_id);
    exit();

   

}

if(isset($_POST["btn_edit_collections"]))
{
    $collection_id = $_POST['collection_id2'];
    $collection_name = $_POST['collection_name2'];
   
    $collection_description =  $_POST['collection_description2'];
   
   
        
    $sql ="UPDATE tbl_collections SET collection_name = '$collection_name',collection_description = '$collection_description' WHERE collection_id = '$collection_id'";
    $result = mysqli_query($conn,$sql);
    
    header('Location:collection.php');
    exit();

}


if(isset($_POST["btn_edit_size"]))
{
    $size_id = $_POST['size_id2'];
    $size_name = $_POST['product_size2'];
   
       
    $sql ="UPDATE tbl_product_size SET size = '$size_name' WHERE size_id = '$size_id'";
    $result = mysqli_query($conn,$sql);
    
    header('Location:size.php');
    exit();

}

if(isset($_POST["btn_edit_color"]))
{
    $color_id = $_POST['color_id2'];
    $color_name = $_POST['product_color2'];
    $color_hex_code = $_POST['product_color_hex2'];
       
    $sql ="UPDATE tbl_product_color SET color_name = '$color_name',product_color_hex = '$color_hex_code' WHERE color_id = '$color_id'";
    $result = mysqli_query($conn,$sql);
    
    header('Location:color.php');
    exit();

}

?>