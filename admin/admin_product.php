<?php
require 'config.php';
function add_products()
{   
	require 'config.php';

	// if(isset($_POST['submit']))
	// {
        if(isset($_POST["product_name"])){
            $product_name = $_POST["product_name"];
        }
        else{
            $product_name = "";
        }

        if(isset($_POST["product_description"])){
            $product_desp = $_POST["product_description"];   
        }
        else{
            $product_desp = "";
        }

        if(isset($_POST["price"])){
            $product_price = $_POST["price"];
        }
        else{
            $product_price = 1;
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
            $product_list = $_POST["size_list"];
        }
        else{
            $product_list = "";
        }
        
        if(isset($_POST["picture_list"])){
            $picture_list = $_POST["picture_list"];
        }
        else{
            $picture_list = "";
        }
        

        echo $product_name, $product_desp, $product_price, $product_type, $product_material, $product_discount, $product_code, $product_color, $product_list, $picture_list;
        
        // $product_name = "shoes";
		// $product_desp = "very good shoes";
		// $product_price = 543;
		// $product_type = "footware";
		// $product_material = "lether";
		// $product_discount = 20;
		// $product_code = "AXD231";
		// $product_color = "red";
		// $size_list  = ["L","M","XL"];
		// $picture_list = ["../images/collection/123hdgsa_1209_21_12:12:12:42","../images/collection/123hdgsa_1209_21_12:12:12:44","../images/collection/123hdgsa_1209_21_12:12:12:45"];
		
		//insert records in product table

		$sql ="INSERT INTO tbl_products (product_name,product_type,price,product_code,material,discount,product_description) VALUES ('$product_name','$product_type','$product_price','$product_code','$product_material','$product_discount','$product_desp')";
        
        echo $sql;
        $result = mysqli_query($conn,$sql);


        // selecting the product id that recently added in the table

        $sql = "SELECT MAX(product_id) as product_id FROM tbl_products";
                                
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_array($result);
        $product_id = $row['product_id'];

        // echo($product_id);

        // insert color into product_color_mapping

        $sql ="SELECT DISTINCT(color_id) from tbl_product_color LIMIT 1";
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
           
            foreach ($sizes as $size)
            {
            	$sql = "SELECT DISTINCT(size_id) from tbl_product_size WHERE size = '$size'";
            	$result = mysqli_query($conn,$sql);
		        $row = mysqli_fetch_array($result);
		        $size_id = $row['size_id'];
		       
                $sql ="INSERT INTO tbl_product_size_mapping (size_id,product_id) VALUES ($size_id,$product_id)";
                $result = mysqli_query($conn,$sql);
            }
        }


        // insert images link array into tbl_pictures

        if(!empty($_POST['picture_list'])) 
        {
           
            $pictures = $_POST['picture_list'];
            // $pictures = $picture_list;
           
            foreach ($pictures as $picture)
            { 
            	echo $picture;
                $sql ="INSERT INTO tbl_pictures (product_id,picture_url) VALUES ($product_id,'$picture')";
                $result = mysqli_query($conn,$sql);
            }
        }

	// }
}


add_products();

header("Location: index.php");

?>
