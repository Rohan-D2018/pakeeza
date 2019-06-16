<?php

require 'config.php';

if(isset($_POST["btn_edit_products"]))
{
    $product_id = $_POST['product_id2'];
    $product_name = $_POST['product_name2'];
    $product_type = $_POST['product_type2'];
    $product_description =  $_POST['product_description2'];
    $product_price =  $_POST['product_price2'];
    $product_discount =  $_POST['product_discount2'];
    $product_material =  $_POST['product_material2'];
    $product_gender =  $_POST['product_gender2'];
    $product_code =  $_POST['product_code2'];
    

    $sql ="UPDATE tbl_products SET product_name = '$product_name', product_type = '$product_type', price='$product_price' , product_description = '$product_description',material = '$product_material',gender = '$product_gender',product_code = '$product_code' WHERE product_id = '$product_id'";
    $result = mysqli_query($conn,$sql);

    header('Location:show_products.php');
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


?>