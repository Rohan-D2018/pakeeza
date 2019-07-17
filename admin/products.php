<?php 
$page = 'product';
include('header.php');
require 'config.php';
?>



<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.13/js/bootstrap-multiselect.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.13/css/bootstrap-multiselect.css" />    


<div class="container-fluid">
    <ul class="nav nav-tabs nav-justified">
        <li class="nav-item">
            <a class="nav-link" href="show_products.php">Show Products</a>
        </li>
        <li class="nav-item">
            <a class="nav-link active" href="products.php">Add Product</a>
        </li>
    </ul>
    <div class="row" style="margin-top: 1%;">
    </div>
    <form action="admin_product.php" method="POST" enctype="multipart/form-data">
        <div class="row text-center">
            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                <div id="gallery" class="row">
                    <!-- <img id="default" src="http://www.stleos.uq.edu.au/wp-content/uploads/2016/08/image-placeholder-350x350.png" data-image="http://www.stleos.uq.edu.au/wp-content/uploads/2016/08/image-placeholder-350x350.png"> -->
                </div>
                <div class="row clearfix" style="margin-left: 3%;margin-right: 1%;">
                    <img class="img-fluid" id="default" src="http://via.placeholder.com/400x550">
                    <input type="file" name= "files[]" id="profile-img" style="margin-top: 3%" multiple>
                    <input type="button" id="removeImage1" value="x" class="btn-rmv1 btn btn-success" style="margin-top: 3%;margin-left:5%"/>
                    <!-- <img src="" id="profile-img-tag" width="350px" height="350px" /> -->
                </div>
                <div class="row clearfix" style="margin-left: 3%">
                    <a href="show_products.php"><button type ="button" value="Show Products" id="show_products" value="Show Products" name="show_products" class="btn btn-primary" style="float:right">View Products</button></a>
                </div>    
            </div>
       
            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
            <!-- <form action="admin_product.php" method="POST"> -->
                <div class="row">
                    <b class="clearfix">Product Name:</b>
                    <input type="text" class="form-control clearfix" name="product_name" required>
                </div>

                <div class="row">
                    <b class="clearfix">Product Description:</b>
                    <textarea class="form-control clearfix" cols=10 rows=5 name="product_description" required></textarea>
                </div>

                <div class="row">
                    <b class="clearfix">Product Collection:</b>
                    <select class="browser-default custom-select" id="collection_name" name="collection_name">
                      <option selected>Select Collection</option>
                      <?php
                         $sql = "SELECT DISTINCT(collection_name) FROM tbl_collections WHERE delete_status=0";
                      
                          $result = mysqli_query($conn, $sql);
                          while($row = mysqli_fetch_array($result))
                         {
                          echo '<option value="' . $row["collection_name"] . '">' . $row["collection_name"] . '</option>'; 
                         }
                          if (!$result)
                           {
                              die ('SQL Error: ' . mysqli_error($conn));
                           }
                      ?>
                    </select>
                </div>

                <div class="row">
                    <b class="clearfix">Product Sub-Branch:</b>
                    <select class="browser-default custom-select" id="sub_branch_name" name="sub_branch_name">
                      <option selected>Select Sub-branch</option>
                      <?php
                         $sql = "SELECT DISTINCT(sub_branch_name) FROM tbl_sub_branch";
                      
                          $result = mysqli_query($conn, $sql);
                          while($row = mysqli_fetch_array($result))
                         {
                          echo '<option value="' . $row["sub_branch_name"] . '">' . $row["sub_branch_name"] . '</option>'; 
                         }
                          if (!$result)
                           {
                              die ('SQL Error: ' . mysqli_error($conn));
                           }
                      ?>
                    </select>
                </div>


                <div class="row">
                    <b class="clearfix">Product Price:</b>
                    <input type="number" class="form-control clearfix" name="product_price" step=".01" required>
                </div>

                <div class="row">    
                    <b class="clearfix">Product Discount:</b>
                    <input type="number" class="form-control clearfix" name="discount" step=".01" value="0" required>
                </div>    
                

                <div class="row">
                    <b class="clearfix">Product Type:</b>
                    <input type="text" class="form-control clearfix" name="product_type" required>
                </div>

                <div class="row">
                    <b class="clearfix">Product Material:</b>
                    <input type="text" class="form-control clearfix" name="material" required>
                </div>

               <div class="row">
                    <b class="clearfix">Product Color:</b>
                    <select class="browser-default custom-select" id="color_name" name="color_name" required>
                      <option selected>Select color</option>
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
                </div>

                <div class="row clearfix">
                    <input type="submit" value="Add Product" class="btn btn-success" style="margin-bottom: 10px;">
                </div>
            </div>

            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                <div class="row" style="margin-left: 3%; margin-right: 3%">
                    <b class="clearfix">Product Code:</b>
                    <input type="text" class="form-control clearfix" name="product_code" required>
                </div>

                <div class="row" style="margin-left: 3%; margin-right: 3%">
                    <b class="clearfix">Gender:</b>
                    <select class="browser-default custom-select" id="gender" name="gender" required>
                        <option selected value="male">Male</option> 
                        <option value="female">Female</option> 
                        <option value="kids">Kids</option> 
                    </select>
                </div>

               <!--  <div class="row" style="margin-left: 3%; margin-right: 3%">
                    <b class="clearfix">Keywords:</b>
                    <input type="text" class="form-control clearfix" name="product_keywords" required>
                </div> -->

                <div class="row" style="margin-left: 3%; margin-right: 3%">
                    <b class="clearfix">Keywords:</b>
                    <select class="browser-default custom-select" id="framework" name="product_keywords[]" multiple>
                      <?php
                         $sql = "SELECT DISTINCT(keyword) FROM tbl_keywords";
                      
                          $result = mysqli_query($conn, $sql);
                          while($row = mysqli_fetch_array($result))
                         {
                          echo '<option value="' . $row["keyword"] . '">' . $row["keyword"] . '</option>'; 
                         }
                          if (!$result)
                           {
                              die ('SQL Error: ' . mysqli_error($conn));
                           }
                      ?>
                    </select>
                </div>


                <div class="row"  style="margin-left: 3%; margin-right: 3%; margin-top: 2%">  
                    <table class="table" id="sizes" style="border: none;">
                        <thead class="thead-dark" style=" padding-top:2px;padding-bottom:5px;">
                            <tr>                   
                                <th width="50%" style="text-align: left;">Size</th>   
                                <th width="50%" style="text-align: left;">Quantity</th>   
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                                $sql = "SELECT size,size_id FROM tbl_product_size";
                    
                                $result = mysqli_query($conn, $sql);
                                // print_r($result);
                                while($row = mysqli_fetch_array($result))
                                {     
                                    // echo $row['group_name']; 
                                    echo '<tr>
                                            <td><input type="checkbox" name="size_list[]" id="'.$row['size'].'" value="'.$row['size'].'" style="float:left"><label style="font-weight: normal; float: left;margin-left:10px;">'.$row['size'].'</label></td>
                                            <td><input type="number" class="form-control clearfix" name="quantity_list[]"></td>
                                          </tr>';   
                                }
                                if (!$result)
                                {
                                    die ('SQL Error: ' . mysqli_error($conn));
                                }
                            ?>   
                        </tbody>
                    </table>              
                </div>
            </div>   
        </div>
    </form>     
</div>



<script>
$(document).ready(function(){
  $('#framework').multiselect({
    nonSelectedText: 'Select Keywords',
    enableFiltering: true,
    enableCaseInsensitiveFiltering: true,
    buttonWidth:'400px'
  });
});
</script>



<script type="text/javascript">
    function readURL(input) {
        var total_file = document.getElementById("profile-img").files.length;
        // alert(total_file);
        for(var i = 0;i < total_file; i++)
        {
            $('#gallery').append("<div class='col-lg-5 col-md-5 col-sm-5 col-xs-5'><img src='"+URL.createObjectURL(event.target.files[i])+"' class='img-fluid'></div>");
        }
        $('#default').remove();
        // $("#gallery").unitegallery({
        //     gallery_width:1000,							//gallery width		
        //     gallery_height:1364,
        // });
    }
    $("#profile-img").change(function(){
        readURL(this);
    });
    // document.getElementById(removeImage1).style.display = 'block';
    $("#removeImage1").click(function(e) {
        e.preventDefault();
        $("#profile-img").val("");
        $("#profile-img-tag").attr("src", "");
        // $('.preview1').removeClass('it');
        // $('.btn-rmv1').removeClass('rmv');
    });

    $(function() {
        $("#gallery").sortable();
        $("#gallery").disableSelection();
    });
</script>


<?php
include('footer.php');
?>