<?php
require 'config.php';
function add_user()
{    
    require 'config.php';
   
    if(isset($_POST["admin_username"])){
        $admin_username = $_POST["admin_username"];
    }
    else{
        $admin_username = "";
    }
    if(isset($_POST["admin_password"])){
        $admin_password = $_POST["admin_password"];   
    }
    else{
        $admin_password = "";
    }
    if(isset($_POST["admin_password2"])){
        $admin_password2 = $_POST["admin_password2"];
    }
    else{
        $admin_password2 = "";
    }

    if(isset($_POST["admin_access_role"])){
        $admin_access_role = $_POST["admin_access_role"];
    }
    else{
        $admin_access_role = "";
    }

        
        // insert records in product table
    $sql ="INSERT INTO tbl_admin_panel () VALUES ('$product_name','$product_type','$product_price','$product_code','$product_material','$product_discount','$product_desp',' $gender')";
    
  
    $result = mysqli_query($conn,$sql);
        
}
add_user();
header("Location: manage_users.php");
?>