<?php
    include('header.php');

    if(isset($_GET['id']))
    {
        $collection_id = $_GET['id'];
        $sql = "SELECT * FROM tbl_collections WHERE collection_id=".$collection_id." AND delete_status=0";           
        $collection = mysqli_query($conn, $sql);
        $collection = mysqli_fetch_assoc($collection);

        $sql = "SELECT * FROM tbl_products WHERE collection_id=".$collection_id." AND delete_status=0 LIMIT 0,9";
        $products = mysqli_query($conn, $sql);

        $sql = "SELECT * FROM tbl_products WHERE collection_id=".$collection_id." AND delete_status=0 LIMIT 9,18446744073709551615";
        $remaining_products = mysqli_query($conn, $sql);
        $num_rows = mysqli_num_rows($remaining_products);   
       
    }
?>

    <style type="text/css">
        .more_products {
          display: none;
        }
    </style>
    
    <!-- ##### Welcome Area Start ##### -->
    <section class="welcome_area bg-img background-overlay" style=" opacity: 0.8; background-image: url('<?php echo 'admin/uploads/collections/'.$collection['collection_picture_url']; ?>'), linear-gradient(black, white);">
        <div class="container h-100">
            <div class="row h-100 align-items-center">
                <div class="col-12">
                    <div class="hero-content text-center" style="margin-top: 10%;">
                        <h2><?php echo $collection['collection_name']; ?></h2>
                        <!-- <h6 style="color: white"><?php echo $collection['collection_description']; ?></h6> -->
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ##### Welcome Area End ##### -->

    <div class="row">
        <div class="col-12 text-center jumbotron">
            <p style="font-size: 18px;"><?php echo $collection['collection_description']; ?></p>
        </div>
    </div>

    <!-- ##### New Arrivals Area Start ##### -->
    <section class="new_arrivals_area section-padding-80 clearfix">
        <div class="container">
            <div class="row" style="padding-bottom: 80px;">
                <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                    <!-- <img src="img/Emblem.png"> -->
                </div>

                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 text-center">
                    <img class="img-fluid" src="img/Emblem.png" style="height: 100px;">
                </div>
            </div>
        </div>

        <div class="container"> 
            <div class="row">
                <div class="col-12">
                    <div class="section-heading text-center" style="padding-bottom: 3%">
                        <h2>Popular Products</h2>
                    </div>
                </div>
            </div>
        </div>

        <div class="container">
            <div class="row">
                <?php while($row = $products->fetch_assoc()){?>
                    <!-- Single Product -->
                    <div class="col-12 col-sm-6 col-lg-4">
                        <div class="single-product-wrapper">
                            <!-- Product Image -->
                            <?php
                                $sql = "SELECT * FROM tbl_pictures WHERE product_id=".$row['product_id']." LIMIT 2";
                            
                                $images = mysqli_query($conn, $sql);
                                $image_array = array();
                                while($row_image = mysqli_fetch_array($images))
                                {
                                    array_push($image_array, $row_image['picture_url']);
                                }
                                echo '<div class="product-img">
                                        <img src="admin/uploads/'.$image_array[0].'" alt="">
                                        <!-- Hover Thumb -->
                                        <img class="hover-img" src="admin/uploads/'.$image_array[1].'" alt="">
                                    </div>';
                            ?>

                            <!-- Product Description -->
                            <div class="product-description">
                                <a href="<?php echo 'product_details.php?id='.$row["product_id"]; ?>">
                                    <h6><?php echo $row["product_name"] ?></h6>
                                </a>
                                <p class="product-price"><!-- <span class="old-price"></span> --><?php echo "₹" . $row["price"]; ?></p>

                                <!-- Hover Content -->
                                <div class="hover-content">
                                    <!-- Add to Cart -->
                                    <div class="add-to-cart-btn">
                                        <a href="<?php echo 'product_details.php?id='.$row["product_id"]; ?>" class="btn essence-btn">View Product</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php } ?>

                <div class="col-12 col-sm-6 col-lg-4">
                </div>

                <?php
                    if($num_rows >= 1)
                    {
                        echo   '<div class="col-12 col-sm-6 col-lg-4" style="text-align:center;">
                                    <button type="button" id="myBtn" onclick="myFunction()" class="btn essence-btn">View More</button>
                                </div>';
                    }
                ?>

                <div class="col-12 col-sm-6 col-lg-4">
                </div>

                <?php while($row = $remaining_products->fetch_assoc()){?>
                    <!-- Single Product -->
                    <div class="col-12 col-sm-6 col-lg-4 more_products">
                        <div class="single-product-wrapper">
                            <!-- Product Image -->
                            <?php
                                $sql = "SELECT * FROM tbl_pictures WHERE product_id=".$row['product_id']." LIMIT 2";
                            
                                $images = mysqli_query($conn, $sql);
                                $image_array = array();
                                while($row_image = mysqli_fetch_array($images))
                                {
                                    array_push($image_array, $row_image['picture_url']);
                                }
                                echo '<div class="product-img">
                                        <img src="admin/uploads/'.$image_array[0].'" alt="">
                                        <!-- Hover Thumb -->
                                        <img class="hover-img" src="admin/uploads/'.$image_array[1].'" alt="">
                                    </div>';
                            ?>

                            <!-- Product Description -->
                            <div class="product-description">
                                <a href="<?php echo 'product_details.php?id='.$row["product_id"]; ?>">
                                    <h6><?php echo $row["product_name"] ?></h6>
                                </a>
                                <p class="product-price"><!-- <span class="old-price"></span> --><?php echo "₹" . $row["price"]; ?></p>

                                <!-- Hover Content -->
                                <div class="hover-content">
                                    <!-- Add to Cart -->
                                    <div class="add-to-cart-btn">
                                        <a href="<?php echo 'product_details.php?id='.$row["product_id"]; ?>" class="btn essence-btn">View Product</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </section>

<script>
    function myFunction() {
        // var x = document.getElementById("more_products");
        // var x = document.getElementsByClassName("more_products");
        var btnText = document.getElementById("myBtn");

        var x = document.getElementsByClassName("more_products");
        
        for (var i = 0, len = x.length; i < len; i++) 
        {
            // elements[i].style ...
            console.log(x[i]);
            if(x[i].style.display === "none" || x[i].style.display === '')
            {
                x[i].style.display = "block";
                btnText.style.display = "none";    
            }   
        }  
    }
</script>

<?php
    include('footer.php');
?>