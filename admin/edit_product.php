<?php
$page = 'product';
require 'config.php';
include('header.php');

if(isset($_GET['id'])){
    $product_id = $_GET['id'];
    $sql ="SELECT tbl_products.product_id,tbl_products.product_name,tbl_products.product_type,tbl_products.price,tbl_products.product_code,tbl_products.discount,tbl_products.product_description,tbl_products.material,tbl_products.gender,tbl_products.product_keywords, tbl_collections.collection_name, tbl_product_color.color_name
		FROM tbl_products 
		INNER JOIN tbl_collections ON tbl_products.collection_id = tbl_collections.collection_id
		INNER JOIN tbl_product_color_mapping ON tbl_products.product_id = tbl_product_color_mapping.product_id
		INNER JOIN tbl_product_color ON tbl_product_color_mapping.color_id = tbl_product_color.color_id
		WHERE tbl_products.product_id = '".$product_id."'";

	$result = mysqli_query($conn,$sql);
    $product_details = mysqli_fetch_array($result);

    $sql = "SELECT * FROM tbl_pictures WHERE product_id=".$product_id;

    $product_images = mysqli_query($conn,$sql);
}
?>

<div class="container" style="margin-top: 2%">
    <form method="post" action="update_data.php" enctype="multipart/form-data">
        <div class="row">
            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12" id="gallery-wrapper">
                <div id="gallery"  style="display:none;">
                <?php 
                    while($row = mysqli_fetch_array($product_images)){ 
                        $filename = $row['picture_url'];
                        echo "<img src='uploads/".$filename."' data-image='uploads/".$filename."'>";
                    }
                ?>
                </div>
                <input type="file" name= "files[]" id="profile-img" style="margin-top: 3%" multiple>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                <div class="form-group">
                    <label for="product_name">Product Id</label>
                    <input type='text' class='form-control ' name='product_id2' id='product_id2' readonly="true">
                </div> 

                <div class="form-group">
                    <label for="product_name">Product Name</label>
                    <input type='text' class='form-control ' name='product_name2' id='product_name2'>
                </div> 

                

                <div class="form-group">
                    <label for="product_price"> Price</label>
                    <input type="number" class="form-control" name="product_price2" id="product_price2" step=".01">
                </div>

                <label for="product_name">Select Collection</label>
                <select class="browser-default custom-select form-group" id="product_collection2" name="product_collection2">
                    <!-- <option selected>Select Collection</option> -->
                    <?php
                        $sql = "SELECT DISTINCT(collection_name) FROM tbl_collections";
                    
                        $result = mysqli_query($conn, $sql);
                        while($row = mysqli_fetch_array($result))
                        {
                        echo '<option class="form-control" value="' . $row["collection_name"] . '">' . $row["collection_name"] . '</option>'; 
                        }
                        if (!$result)
                        {
                            die ('SQL Error: ' . mysqli_error($conn));
                        }
                    ?>
                </select>

                <label for="product_name">Color</label>
                <select class="browser-default custom-select form-group" id="product_color2" name="product_color2">
                    <!-- <option selected>Select Collection</option> -->
                    <?php
                        $sql = "SELECT DISTINCT(color_name) FROM tbl_product_color";
                    
                        $result = mysqli_query($conn, $sql);
                        while($row = mysqli_fetch_array($result))
                        {
                        echo '<option value="' . $row["color_name"] . '">' . $row["color_name"] . '</option>'; 
                        }
                        if (!$result)
                        {
                            die ('SQL Error: ' . mysqli_error($conn));
                        }
                    ?>
                </select>

                <div class="form-group">
                    <label for="product_description">Description</label>
                    <textarea class='form-control' name='product_description2' id='product_description2'></textarea>
                </div> 
            </div>
            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                <div class="form-group">
                    <label for="product_material">Material</label>
                    <input type="text" class="form-control" name="product_material2" id="product_material2">
                </div>

                <div class="form-group">
                    <label for="product_discount">Discount</label>
                    <input type="number" class="form-control" name="product_discount2" id="product_discount2" step=".01">
                </div>

                <div class="form-group">
                    <label for="product_code">Code</label>
                    <input type="text" class="form-control" name="product_code2" id="product_code2">
                </div>

                <div class="form-group">
                    <label for="product_type">Type</label>
                    <input type='text' class='form-control ' name='product_type2' id='product_type2'>
                </div>

                <label for="Gender">Gender</label>
                <select class="browser-default custom-select form-group" id="product_gender2" name="product_gender2">
                    <option value="male">Male</option> 
                    <option value="female">Female</option> 
                    <option value="kids">Kids</option>
                </select>

                <div class="form-group">
                    <label for="Keywords">Keywords</label>
                    <textarea class='form-control' name='product_keywords2' id='product_keywords2'></textarea>
                </div>

                <button type="submit" value="submit" id="btn_edit_products" name="btn_edit_products" class="btn btn-primary" style="float: right;">Update</button>
            </div>
        </div>
    </form>
</div>

<?php
include('footer.php');
?>

<script type="text/javascript">
    function readURL(input) {
        var total_file = document.getElementById("profile-img").files.length;

        $("#gallery-wrapper").prepend("<div id='gallery'></div>");

        // alert(total_file);
        for(var i = 0;i < total_file; i++)
        {
            $('#gallery').append("<img src='"+URL.createObjectURL(event.target.files[i])+"' data-image='"+URL.createObjectURL(event.target.files[i])+"'>");
        }
        $("#gallery").unitegallery({
            gallery_width:1000,							//gallery width		
            gallery_height:1364,
        });
    }

    $("#profile-img").change(function(){
        $("#gallery").remove();
        readURL(this);
    });
    
    $("#removeImage1").click(function(e) {
        e.preventDefault();
        $("#gallery img").remove();
    });
</script>

<script>
$(document).ready(function(){
    $("#gallery").unitegallery({
        gallery_width:1000,							//gallery width		
        gallery_height:1364,
    });

    var product_id = <?php echo $product_id; ?>;
    
    $.ajax({
            url:'fetch.php',
            method:'POST',
            data: {'product_id':product_id},
            dataType:"json",
            success: function(data){
                console.log(data);
                $('#product_id2').val(data.product_id);
                $('#product_name2').val(data.product_name);
                $('#product_collection2').val(data.collection_name);
                $('#product_type2').val(data.product_type);
                $('#product_code2').val(data.product_code);
                $('#product_color2').val(data.color_name);
                $('#product_description2').val(data.product_description);
                $('#product_price2').val(data.price);
                $('#product_discount2').val(data.discount);
                $('#product_material2').val(data.material);
                $('#product_gender2').val(data.gender);
                $('#product_keywords2').val(data.product_keywords);
          },

      });
});
</script>