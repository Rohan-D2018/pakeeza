<?php
    include('header.php');

    if(isset($_GET['id'])){
        $sub_branch_id = $_GET['id'];
        $sql = "SELECT * FROM tbl_sub_branch WHERE sub_branch_id=".$sub_branch_id;  //." AND delete_status=0";           
        $sub_branch = mysqli_query($conn, $sql);
        $sub_branch = mysqli_fetch_assoc($sub_branch);
        $sub_branch_name = strtolower($sub_branch['sub_branch_name']);
        if ($sub_branch_name == 'lams'){
            $sub_branch_img = 'img/lams.png';
        }else if($sub_branch_name == 'raqs'){
            $sub_branch_img = 'img/raqs.png';
        }else if($sub_branch_name == 'nawab'){
            $sub_branch_img = 'img/nawab.png';
        }else if($sub_branch_name == 'uns'){
            $sub_branch_img = 'img/uns.png';
        }

        $sql = "SELECT * FROM tbl_products WHERE sub_branch_id=".$sub_branch_id." AND delete_status=0 LIMIT 0,9";
        $products = mysqli_query($conn, $sql);

        $sql = "SELECT * FROM tbl_products WHERE sub_branch_id=".$sub_branch_id." AND delete_status=0 LIMIT 9,18446744073709551615";
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
    <section class="welcome_area bg-img background-overlay" style="background-image: url('<?php echo 'admin/uploads/sub_branch/'.$sub_branch['sub_branch_picture_url']; ?>')">
        <div class="container h-100">
            <div class="row h-100 align-items-center">
                <div class="col-12">
                    <div class="hero-content">
                        
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="row">
        <div class="col-12 text-center jumbotron">
            <h2><?php echo $sub_branch['sub_branch_name']; ?></h2>
            <p style="font-size: 18px;"><?php echo nl2br($sub_branch['sub_branch_description']); ?></p>
        </div>
    </div>

    <div class="container" style="">
        <div class="row">
            <div class="col-lg-4 col-md-3 col-sm-12 col-xs-12">
                <!-- <img src="img/Emblem.png"> -->
            </div>

            <div class="col-lg-4 col-md-6 col-sm-12 col-xs-12">
                <img class="img-fluid" src="<?php echo $sub_branch_img; ?>" height="50">
            </div>
        </div>
    </div>
    
    <!-- ##### Welcome Area End ##### -->

    <!-- ##### New Arrivals Area Start ##### -->
    <section class="new_arrivals_area clearfix">
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
                                        <a href="#" class="btn essence-btn">View Product</a>
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
                                        <a href="#" class="btn essence-btn">View Product</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php } ?>

            </div>
        </div>
    </section>

    <div class="container" style="padding-bottom: 20px;">
        <div class="row">
            <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                <!-- <img src="img/Emblem.png"> -->
            </div>

            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                <img class="img-fluid" src="<?php echo $sub_branch_img; ?>" height="200">
            </div>
        </div>
    </div>


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
