<?php
$page = 'product';
require 'config.php';
include('header.php');

$sql ="SELECT * FROM tbl_product_size";
$product_sizes = mysqli_query($conn, $sql);
// while($row = $product_sizes->fetch_assoc()){
//     print_r($row);
// }
?>

<div class="container-fluid">
    <div class="row" style="margin-top: 1%;">
    </div>
    <div class="row text-center">
        <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
            <img src="http://www.stleos.uq.edu.au/wp-content/uploads/2016/08/image-placeholder-350x350.png">
            <input type="file" style="margin-top: 3%">
        </div>
        <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
            <form action="admin_product.php" method="POST">
                <div class="row">
                    <b class="clearfix">Product Name:</b>
                    <input type="text" class="form-control clearfix" name="product_name">
                </div>

                <div class="row">
                    <b class="clearfix">Product Description:</b>
                    <input type="textbox" class="form-control clearfix" name="product_description">
                </div>

                <div class="row">
                    <b class="clearfix">Product Price:</b>
                    <input type="number" class="form-control clearfix" name="product_price">
                </div>

                <div class="row">
                    <b class="clearfix">Product Type:</b>
                    <input type="text" class="form-control clearfix" name="product_type">
                </div>

                <div class="row">
                    <b class="clearfix">Product Material:</b>
                    <input type="text" class="form-control clearfix" name="material">
                </div>

                <div class="row">
                    <b class="clearfix">Product Colour:</b>
                    <input type="text" class="form-control clearfix">
                </div>

                <div class="row clearfix">
                    <input type="submit" value="Add Product" class="btn btn-success">
                </div>
            </form>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
            <div class="row">
                <b class="clearfix">Product Sizes:</b>
                <?php
                    while($row = $product_sizes->fetch_assoc()){
                        echo $row['size'];
                    }
                ?>
            </div>
        </div>
    </div>
</div>

<?php
include('footer.php');
?>