<?php
require 'config.php';
function add_products()
{    
    require 'config.php';

        if(isset($_POST["product_name"])){
            $product_name = $_POST["product_name"];
        }
        else{
            $product_name = "";
        }
        if(isset($_POST["product_description"])){
            $product_desp = mysqli_real_escape_string($conn, $_POST["product_description"]);   
        }
        else{
            $product_desp = "";
        }
        if(isset($_POST["product_price"])){
            $product_price = $_POST["product_price"];
        }
        else{
            $product_price = 1;
        }
        if(isset($_POST["collection_name"])){
            $collection_name = $_POST["collection_name"];

            $sql = "SELECT collection_id FROM tbl_collections WHERE collection_name='".$collection_name."'";
            $result = mysqli_query($conn, $sql);
            while ($row = mysqli_fetch_array($result)){
                $collection_id = $row['collection_id'];
            }
        }
        else{
            $collection_name = "";
        }


        if(isset($_POST["sub_branch_name"])){
            $sub_branch_name = $_POST["sub_branch_name"];

            $sql = "SELECT sub_branch_id FROM tbl_sub_branch WHERE sub_branch_name='".$sub_branch_name."'";
            $result = mysqli_query($conn, $sql);
            while ($row = mysqli_fetch_array($result)){
                $sub_branch_id = $row['sub_branch_id'];
            }
        }
        else{
            $sub_branch_name = "";
        }


        if(isset($_POST["product_type"])){
            $product_type = $_POST["product_type"];
        }
        else{
            $product_type = "";
        }
        
        if(isset($_POST["material"])){
            $product_material = $_POST["material"];
        }
        else{
            $product_material = "";
        }
        
        if(isset($_POST["discount"])){
            $product_discount = $_POST["discount"];
        }
        else{
            $product_discount = 1;
        }
        
        if(isset($_POST["product_code"])){
            $product_code = $_POST["product_code"];
        }
        else{
            $product_code = "";
        }
        
        if(isset($_POST["color_name"])){
            $product_color = $_POST["color_name"];
        }
        else{
            $product_color = "";
        }
        
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
        
        if(isset($_POST["picture_list"])){
            $picture_list = $_POST["picture_list"];
        }
        else{
            $picture_list = "";
        }
        if(isset($_POST["gender"])){
            $gender = $_POST["gender"];
        }
        else{
            $gender = "";
        }


        // if(isset($_POST["product_keywords"])){
        //     $product_keywords = $_POST["product_keywords"];
        // }
        // else{
        //     $product_keywords = "NA";
        // }


        if(isset($_POST["product_keywords"])){
            $product_keywords = mysqli_real_escape_string($conn, $_POST["product_keywords"]);
        }
        else{
            $product_keywords = "NA";
        }
        
        $product_keywords_array = '';
        foreach($_POST["product_keywords"] as $row)
        {
            $product_keywords_array .= $row . ', ';
        }
        $product_keywords_array = substr($product_keywords, 0, -2);


     
        // Removing the empty elements from array of quantity list
        foreach($quantity_list as $key => $value)          
        if(empty($value)){
            unset($quantity_list[$key]); 
        }
       
        // Making the array indexes starts from 0
        $quantity_list = array_values($quantity_list);    
        print_r($quantity_list);

        
        // insert records in product table
        $sql ="INSERT INTO tbl_products (product_name,product_type,price,product_code,material,discount,product_description,gender,product_keywords,collection_id,sub_branch_id) VALUES ('$product_name','$product_type','$product_price','$product_code','$product_material','$product_discount','$product_desp','$gender','$product_keywords_array','$collection_id','$sub_branch_id')";
        
        echo $sql;
        $result = mysqli_query($conn,$sql);
        // selecting the product id that recently added in the table
        $sql = "SELECT MAX(product_id) as product_id FROM tbl_products";
                                
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_array($result);
        $product_id = $row['product_id'];


        // insert images into tbl_pictures
        // File upload configuration
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
       
        // insert collection into product table
        $sql ="SELECT DISTINCT(collection_id) from tbl_collections WHERE collection_name = '$collection_name' LIMIT 1";
        $result = mysqli_query($conn,$sql);
        $row = mysqli_fetch_array($result);
        $collection_id = $row['collection_id'];
        $sql ="UPDATE tbl_product SET collection_id = '$collection_id' WHERE product_id ='$product_id'";
        $result = mysqli_query($conn,$sql);



        // insert color into product_color_mapping
        $sql ="SELECT DISTINCT(color_id) from tbl_product_color WHERE color_name = '$product_color' LIMIT 1";
        $result = mysqli_query($conn,$sql);
        $row = mysqli_fetch_array($result);
        $color_id = $row['color_id'];
        $sql ="INSERT INTO tbl_product_color_mapping (color_id,product_id) VALUES ('$color_id','$product_id')";
        $result = mysqli_query($conn,$sql);


        // insert size array into product size mapping
        if(!empty($_POST['size_list'])) 
        {
           
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


        // insert size array into product size mapping
        // if(!empty($_POST['product_keywords'])) 
        // {
           
        //     $product_keywords = $_POST['product_keywords'];
        //     // $sizes= $size_list;
           
        //     foreach ($product_keywords as $keyword)
        //     {
                
        //         $sql = "SELECT DISTINCT(keyword_id) from tbl_keywords WHERE keyword = '$keyword'";
        //         $result = mysqli_query($conn,$sql);
        //         $row = mysqli_fetch_array($result);
        //         $keyword_id = $row['keyword_id'];
                  
        //         $sql ="INSERT INTO tbl_product_keyword_mapping (product_id,keyword_id) VALUES ($product_quantity,$keyword_id)";
        //         $result = mysqli_query($conn,$sql);
               
        //     }
        // }

        if(!empty($_POST['product_keywords'])) 
        {
        
            $product_keywords = $_POST['product_keywords'];
            // $sizes= $size_list;
        
            foreach ($product_keywords as $keyword)
            {
                
                $sql = "SELECT DISTINCT(keyword_id) from tbl_keywords WHERE keyword = '$keyword'";
                $result = mysqli_query($conn,$sql);
                $row = mysqli_fetch_array($result);
                $keyword_id = $row['keyword_id'];
                
                $sql ="INSERT INTO tbl_product_keyword_mapping (product_id,keyword_id) VALUES ($product_id,$keyword_id)";
                $result = mysqli_query($conn,$sql);
            
            }
        }
}
add_products();
header("Location: products.php");
?>