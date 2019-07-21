<?php
    include('header.php');

    $sql = "SELECT * FROM tbl_collections WHERE delete_status=0";           
    $collections = mysqli_query($conn, $sql);

    $sql ="SELECT * FROM tbl_products WHERE delete_status=0";
    $products = mysqli_query($conn, $sql);
?>
    <!-- ##### Welcome Area Start ##### -->
    <section class="welcome_area bg-img background-overlay" style="background-image: url(img/cover_photos/main2.jpeg);">
        <div class="container h-100">
            <div class="row h-100 align-items-center">
                <div class="col-12">
                    <div class="hero-content">
                        <!-- <h6>asoss</h6> -->
                        <h2>New Collection</h2>
                        <a href="#" class="btn essence-btn">view collection</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ##### Welcome Area End ##### -->

    <!-- ##### Top Catagory Area Start ##### -->
    <div class="top_catagory_area section-padding-80 clearfix">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section-heading text-center">
                        <h2>Our Collections</h2>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <!-- Single Catagory -->
                <?php while($row = mysqli_fetch_assoc($collections)){?>
                <div class="col-lg-4 col-md-4 col-sm-12 col-md-12 text-center" style="padding: 25px;">
                    <a href="<?php echo 'collections.php?id='.$row['collection_id']; ?>">    
                        <img class="img-fluid" src="<?php echo 'admin/uploads/collections/'.$row['collection_picture_url']; ?>" style="opacity: 0.8;">
                        <h3 id="imp-caption" style="margin-top: 2%;"><?php echo $row['collection_name']; ?></h3>
                    </a>
                </div>
                <?php }?>
            </div>
        </div>
    </div>
    <!-- ##### Top Catagory Area End ##### -->

    <!-- ##### CTA Area Start ##### -->
    <!-- <div class="cta-area">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="cta-content bg-img background-overlay" style="background-image: url(img/bg-img/bg-5.jpg);">
                        <div class="h-100 d-flex align-items-center justify-content-end">
                            <div class="cta--text">
                                <h6>-60%</h6>
                                <h2>Global Sale</h2>
                                <a href="#" class="btn essence-btn">Buy Now</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> -->
    <!-- ##### CTA Area End ##### -->

    <div class="container" style="padding-bottom: 40px;">
        <div class="row">
            <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                <!-- <img src="img/Emblem.png"> -->
            </div>

            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 text-center">
                <img class="img-fluid" src="img/Emblem.png" style="height: 100px;">
            </div>
        </div>
    </div>

    <!-- ##### New Arrivals Area Start ##### -->
    <section class="new_arrivals_area clearfix">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section-heading text-center">
                        <h2>New Arrivals</h2>
                    </div>
                </div>
            </div>
        </div>

        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="popular-products-slides owl-carousel">
                    <?php while($row = $products->fetch_assoc()){ ?>
                        <!-- Single Product -->
                        <div class="single-product-wrapper">
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
                                <!-- <span>topshop</span> -->
                                <a href="<?php echo 'product_details.php?id='.$row["product_id"]; ?>">
                                    <h6><?php echo $row["product_name"] ?></h6>
                                </a>
                                <p class="product-price"><?php echo "₹" . $row["price"]; ?></p>

                                <!-- Hover Content -->
                                <div class="hover-content">
                                    <!-- Add to Cart -->
                                    <div class="add-to-cart-btn">
                                        <a href="#" class="btn essence-btn">Add to Cart</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="container" style="padding-bottom: 20px;">
        <div class="row">
            <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                <!-- <img src="img/Emblem.png"> -->
            </div>

            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                <img class="img-fluid" src="img/Emblem.png" height="200">
            </div>
        </div>
    </div>
    <!-- ##### New Arrivals Area End ##### -->

    <!-- ##### Brands Area Start ##### -->
    <!-- <div class="brands-area d-flex align-items-center justify-content-between">
        <div class="single-brands-logo">
            <img src="img/core-img/brand1.png" alt="">
        </div>
        <div class="single-brands-logo">
            <img src="img/core-img/brand2.png" alt="">
        </div>
        <div class="single-brands-logo">
            <img src="img/core-img/brand3.png" alt="">
        </div>
        <div class="single-brands-logo">
            <img src="img/core-img/brand4.png" alt="">
        </div>
        <div class="single-brands-logo">
            <img src="img/core-img/brand5.png" alt="">
        </div>
        <div class="single-brands-logo">
            <img src="img/core-img/brand6.png" alt="">
        </div>
    </div> -->
    <!-- ##### Brands Area End ##### -->
<?php
    include('footer.php');
?>