<?php
    include('header.php');

    $product_id   = $_GET['id'];
    $sql          = "SELECT * FROM tbl_products WHERE product_id=".$product_id;
    $product_info = mysqli_query($conn, $sql);
    $product_info = mysqli_fetch_assoc($product_info);
    // print_r($product_info);
?>
    <!-- ##### Single Product Details Area Start ##### -->
    <section class="single_product_details_area d-flex align-items-center">

        <!-- Single Product Thumb -->
        <div class="single_product_thumb clearfix">
            <div class="product_thumbnail_slides owl-carousel">
                <?php
                    $sql = "SELECT * FROM tbl_pictures WHERE product_id=".$product_id;
                                                
                    $images = mysqli_query($conn, $sql);
                    while($row_image = mysqli_fetch_array($images))
                    {
                        echo '<img src="admin/uploads/'.$row_image['picture_url'].'" alt="">';
                    }
                ?>
            </div>
        </div>

        <!-- Single Product Description -->
        <div class="single_product_desc clearfix">
            <?php
                $sql = "SELECT c.collection_name
                        FROM tbl_collections c
                        INNER JOIN tbl_products p ON (p.collection_id=c.collection_id)
                        WHERE p.product_id=".$product_id;
                $collection_name = mysqli_query($conn, $sql);
                $row=mysqli_fetch_assoc($collection_name)
            ?>
            <span><?php echo $row['collection_name']; ?></span>
            <a href="cart.html">
                <h2><?php echo $product_info['product_name']; ?></h2>
            </a>
            <p class="product-price"><!--<span class="old-price">$65.00</span>--> ₹ <?php echo $product_info['price']; ?></p>
            <p class="product-desc"><?php echo $product_info['product_description']; ?></p>

            <!-- Form -->
            <form class="cart-form clearfix" method="post">
                <!-- Select Box -->
                <div class="select-box d-flex mt-50 mb-30">
                    <select name="select" id="productSize" class="mr-5">
                       <?php
                        $sql          = "SELECT ps.size
                                        FROM tbl_product_size ps
                                        INNER JOIN tbl_product_size_mapping psm ON (psm.size_id=ps.size_id)
                                        INNER JOIN tbl_products p ON (p.product_id=psm.product_id)
                                        WHERE p.product_id=".$product_id;
                        $product_info = mysqli_query($conn, $sql);

                        while($row=mysqli_fetch_assoc($product_info)){
                            echo '<option value="value">Size: '.$row['size'].'</option>';
                        }
                       ?>
                    </select>
                    <select name="select" id="productColor">
                        <?php
                        $sql          = "SELECT pc.color_name
                                        FROM tbl_product_color pc
                                        INNER JOIN tbl_product_color_mapping pcm ON (pcm.color_id=pc.color_id)
                                        INNER JOIN tbl_products p ON (p.product_id=pcm.product_id)
                                        WHERE p.product_id=".$product_id;
                        $product_info = mysqli_query($conn, $sql);

                        while($row=mysqli_fetch_assoc($product_info)){
                            echo '<option value="value">Color: '.$row['color_name'].'</option>';
                        }
                       ?>
                    </select>
                </div>
                <!-- Cart & Favourite Box -->
                <div class="cart-fav-box d-flex align-items-center">
                    <!-- Cart -->
                    <button type="submit" name="addtocart" value="5" class="btn essence-btn">Add to cart</button>
                    <!-- Favourite -->
                    <div class="product-favourite ml-4">
                        <a href="#" class="favme fa fa-heart"></a>
                    </div>
                </div>
            </form>
        </div>
    </section>
    <!-- ##### Single Product Details Area End ##### -->
<?php
    include('footer.php');
?>