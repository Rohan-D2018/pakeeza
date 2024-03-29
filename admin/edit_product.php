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

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.13/js/bootstrap-multiselect.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.13/css/bootstrap-multiselect.css" />    

<style>


    .multiselect {
     
    display: inline-block;
    width: 100%;
   
    background: #fff;
    background-size: 8px 10px;
    border: 1px solid #ced4da;
    border-radius: .25rem;
   
    }

    .selectBox {
      position: relative;
    }

    .selectBox select {
      width: 100%;
      /*font-weight: bold;*/
      height: calc(2.25rem + 2px);
    }

    .overSelect {
      position: absolute;
      left: 0;
      right: 0;
      top: 0;
      bottom: 0;
    }

    #checkboxes {
      display: none;
      border: 1px #dadada solid;

      /*this is for scroll*/
      max-height: 250px;
      overflow-y: scroll;

    }

    #checkboxes label {
      display: block;

    }

    #checkboxes label:hover {
      background-color: #1e90ff;
    }
</style>


<div class="container" style="margin-top: 2%">
    <form method="post" action="update_data.php" enctype="multipart/form-data">
        <div class="row">
            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                <div id="gallery" class="row">
                <!-- </div> -->
                <!-- <div id="pre-imgs" class="row clearfix" style="margin-left: 3%;margin-right: 1%;"> -->
                <?php 
                    while($row = mysqli_fetch_array($product_images)){ 
                        $filename = $row['picture_url'];
                        echo "<div class='col-lg-5 col-md-5 col-sm-5 col-xs-5'>";
                        echo "<img id='image-gallery' name='image-gallery' class='img-fluid' src='uploads/".$filename."' data-image='uploads/".$filename."'>";
                        echo '<input type="hidden" name="image-gallery[]" value="'.$filename.'"/>';
                        echo "</div>";
                    }
                ?>
                </div>
                <input type="file" name= "files[]" id="profile-img" style="margin-top: 3%" multiple>

                <button type="submit" value="submit" id="btn_edit_products" name="btn_edit_products" class="btn btn-primary" style="margin-top: 3%">Update</button>
                <!-- <button type="button" value="button" onclick="location.href='show_products.php';" class="btn btn-danger" style="margin-top: 3%">Back</button> -->
                    
                <button type="button" value="button" onclick="goBack()" class="btn btn-danger" style="margin-top: 3%">Back</button>


            </div>
            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                <div class="form-group">
                    <label for="product_name">Product Id</label>
                    <input type='text' class='form-control ' name='product_id2' id='product_id2' readonly="true">
                </div> 

                <div class="form-group">
                    <label for="product_name">Product Name</label>
                    <input type='text' class='form-control ' name='product_name2' id='product_name2' required>
                </div> 

                <div class="form-group">
                    <label for="product_price"> Price</label> 
                    <input type="number" class="form-control" name="product_price2" id="product_price2" step=".01" required>
                </div>

                <label for="product_collection">Select Collection</label>
                <select class="browser-default custom-select form-group" id="product_collection2" name="product_collection2" required>
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

 
                <label for="product_sub_branch">Select Sub-Branch</label>
                <select class="browser-default custom-select form-group" id="sub_branch_name2" name="sub_branch_name2" required>
                    <!-- <option selected>Select Collection</option> -->
                    <?php
                        $sql = "SELECT DISTINCT(sub_branch_name) FROM tbl_sub_branch";
                    
                        $result = mysqli_query($conn, $sql);
                        while($row = mysqli_fetch_array($result))
                        {
                        echo '<option class="form-control" value="' . $row["sub_branch_name"] . '">' . $row["sub_branch_name"] . '</option>'; 
                        }
                        if (!$result)
                        {
                            die ('SQL Error: ' . mysqli_error($conn));
                        }
                    ?>
                </select>

                <label for="product_name">Color</label>
                <select class="browser-default custom-select form-group" id="product_color2" name="product_color2" required>
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
                    <!-- <textarea class='form-control' name='product_description2' id='product_description2' required></textarea> -->
                    <textarea class="form-control" cols=10 rows=5 id='product_description2' name="product_description2" required></textarea>
                </div> 

                <div class="form-group">
                    <label for="product_material">Material</label>
                    <input type="text" class="form-control" name="product_material2" id="product_material2" required>
                </div>

                <div class="form-group">
                    <label for="product_discount">Discount</label>
                    <input type="number" class="form-control" name="product_discount2" id="product_discount2" step=".01" required>
                </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                
                <div class="form-group">
                    <label for="product_type">Type</label>
                    <input type='text' class='form-control ' name='product_type2' id='product_type2' required>
                </div>

                <div class="form-group">
                    <label for="product_code">Code</label>
                    <input type="text" class="form-control" name="product_code2" id="product_code2" required>
                </div>
                <label for="Gender">Gender</label>
                <select class="browser-default custom-select form-group" id="product_gender2" name="product_gender2">
                    <option value="male">Male</option> 
                    <option value="female">Female</option> 
                    <option value="kids">Kids</option>
                </select>

                <!-- <div class="form-group">
                    <label for="Keywords">Previous Keywords</label>
                    <textarea class='form-control' cols=10 rows=3 name='product_keywords2' id='product_keywords2' required readonly></textarea>
                </div> -->

                <div class="multiselect" style="margin-bottom: 5%;">
                    <div class="selectBox"  onclick="showCheckboxes()">
                    <select class="form-control">
                        <option>Select Keyword</option>
                    </select>
                    <!-- <div class="overSelect"></div> -->
                    </div>
                    <div id="checkboxes">
                        <?php
                            $sql = "SELECT DISTINCT(keyword) FROM tbl_keywords";
                        
                            $result = mysqli_query($conn, $sql);
                            while($row = mysqli_fetch_array($result))
                            {
                            echo '<label for="one"><input type="checkbox" value="'.$row["keyword"].'" id="'.$row["keyword"].'" name = "product_keywords2[]" />'.$row["keyword"].'</label>'; 
                            }
                            if (!$result)
                            {
                                die ('SQL Error: ' . mysqli_error($conn));
                            }
                        ?>
                    </div>
                </div>

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
                                            <td><input type="number"  id="quantity_'.$row['size'].'" class="form-control clearfix" name="quantity_list[]"></td>
                                        </tr>';   
                            }
                            if (!$result)
                            {
                                die ('SQL Error: ' . mysqli_error($conn));
                            }
                        ?>   
                    </tbody>
                </table>

                <!--<button type="submit" value="submit" id="btn_edit_products" name="btn_edit_products" class="btn btn-primary" style="float: right;">Update</button>-->
            </div>
        </div>
    </form>
</div>

<?php
include('footer.php');
?>



<script>
$(document).ready(function(){
  $('#framework').multiselect({
    nonSelectedText: 'Select Keywords',
    enableFiltering: true,
    enableCaseInsensitiveFiltering: true,
    buttonWidth:'350px'
  });
});
</script>





<script type="text/javascript">
    
   $(document).ready(function(){
    var product_id = '<?php echo $product_id; ?>';
    $.ajax({
        url:'fetch_size_quantity.php',
        method:'POST',
        data: {'product_id': product_id},
        dataType:"json",
        success: function(data){
            // console.log("data size and quantity:")
            // console.log(data);
            // console.log(data[0]['size']);
            // console.log(data.length);
            for (index = 0; index < data.length; index++) {
                // console.log("inside :")
                // console.log(data[index]);
                document.getElementById(data[index]['size']).checked = true;

                var s = document.getElementById('quantity_'+data[index]['size']);
                // console.log("quatity")
                // console.log(s);
                s.value =data[index]['product_quantity'];
                // $('#quantity_'+data[index]['size']).val(data[index]['product_quantity']);    
            }
        },

    });
});
</script>




<script type="text/javascript">
    function readURL(input) {
        var total_file = document.getElementById("profile-img").files.length;
        
        $("#pre-imgs").remove();
        $("#gallery img").remove();
        // $("#gallery-wrapper").prepend("<div id='gallery'></div>");

        // alert(total_file);
        for(var i = 0;i < total_file; i++)
        {
            $('#gallery').append("<div class='col-lg-5 col-md-5 col-sm-5 col-xs-5'><img src='"+URL.createObjectURL(event.target.files[i])+"' class='img-fluid'></div>");
        }
        // $("#gallery").unitegallery({
        //     gallery_width:1000,                          //gallery width     
        //     gallery_height:1364,
        // });
    }

    $("#profile-img").change(function(){
        // $("#gallery").remove();
        readURL(this);
    });
    
    $("#removeImage1").click(function(e) {
        e.preventDefault();
        $("#gallery img").remove();
    });
</script>

<script>
$(document).ready(function(){
    // $("#gallery").unitegallery({
    //     gallery_width:1000,                          //gallery width     
    //     gallery_height:1364,
    // });

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
                $('#sub_branch_name2').val(data.sub_branch_name);
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

<script>
$(function() {
    $("#gallery").sortable();
    $("#gallery").disableSelection();
});

$(function() {
    $("#pre-imgs").sortable();
    $("#pre-imgs").disableSelection();
});

$(document).ready(function(){
    $("img").each(function() {
        console.log($(this).attr("src"));
    });
});

</script>

<script>
var expanded = false;

function showCheckboxes() {
  var checkboxes = document.getElementById("checkboxes");
  if (!expanded) {
    checkboxes.style.display = "block";
    expanded = true;
  } else {
    checkboxes.style.display = "none";
    expanded = false;
  }
}
</script>



<script type="text/javascript">
    
   $(document).ready(function(){
    var product_id = '<?php echo $product_id; ?>';
    console.log(product_id)
    $.ajax({
        url:'fetch_keywords.php',
        method:'POST',
        data: {'product_id': product_id},
        dataType:"json",
        success: function(data){
           
            console.log(data);
          
            for (index = 0; index < data.length; index++) {
                // console.log("inside :")
                console.log(data[index]);
                document.getElementById(data[index]['keyword']).checked = true;   
            }
        },

    });
});
</script>

<script>
function goBack() {
  window.history.back();
}
</script>
