<?php

include('header.php');
$sql ="SELECT * FROM tbl_products WHERE delete_status=0";
$products = mysqli_query($conn, $sql);

$sql ="SELECT * FROM tbl_collections WHERE delete_status=0 ORDER BY collection_name";
$collections = mysqli_query($conn, $sql);
?>
    <!-- ##### Breadcumb Area Start ##### -->
    <div class="breadcumb_area bg-img" style="background-image: url(img/bg-img/breadcumb.jpg);">
        <div class="container h-100">
            <div class="row h-100 align-items-center">
                <div class="col-12">
                    <div class="page-title text-center">
                        <h2>dresses</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ##### Breadcumb Area End ##### -->

    <!-- ##### Shop Grid Area Start ##### -->
    <section class="shop_grid_area section-padding-80">
        <div class="container">
            <div class="row">
                <div class="col-12 col-md-4 col-lg-3">
                    <div class="shop_sidebar_area">

                        <!-- ##### Single Widget ##### -->
                        <div class="widget catagory" style="margin-bottom: 30px;">
                            <!-- Widget Title -->
                            <h6 class="widget-title mb-30">Categories</h6>

                            <!--  Catagories  -->
                            <div class="catagories-menu">
                                <ul id="menu-content2" class="menu-content">
                                    <!-- Single Item -->
                                    <li>
                                        <a href="#" class="collapsed" data-toggle="collapse" data-target="#clothing" aria-expanded="false"  aria-controls="clothing">Collections <i class="fa fa-caret-down" aria-hidden="true"></i></a>
                                        <ul class="sub-menu collapse" id="clothing">
                                            <?php
                                                while($row = mysqli_fetch_array($collections)){
                                                    echo "<li><a href='#' id='".$row['collection_id']."' class='collection_filter'>".$row['collection_name']."</a></li>";  
                                                }
                                            ?>
                                        </ul>
                                    </li>
                                </ul>
                            </div>
                        </div>

                        <!-- ##### Single Widget ##### -->
                        <div class="widget price mb-50">
                            <!-- Widget Title -->
                            <h6 class="widget-title mb-30">Filter by</h6>
                            <!-- Widget Title 2 -->
                            <ul id="menu-content2" class="menu-content">
                                <!-- Single Item -->
                                <li>
                                    <a class="widget-title2 mb-30 collapsed" href="#" data-toggle="collapse" data-target="#pricing">Price <i class="fa fa-caret-down" aria-hidden="true"></i></a>
                                    <ul class="sub-menu collapse" id="pricing">
                                        <div class="widget-desc">
                                            <div id="slider-range"></div>
                                            <label for="amount" style="margin-top: 10%">Price range:</label>
                                            <input type="text" id="amount" readonly style="border:0;">
                                        </div>
                                    </ul>
                                </li>
                            </ul>
                        </div>

                        <!-- ##### Single Widget ##### -->
                        <div class="widget color mb-50">
                            <!-- Widget Title 2 -->
                            <p class="widget-title2 mb-30">Color</p>
                            <div class="widget-desc">
                                <ul class="d-flex">
                                    <?php
                                        $sql ="SELECT * FROM tbl_product_color";
                                        $colors = mysqli_query($conn, $sql);
                                        while($row = mysqli_fetch_array($colors)){
                                            echo "<li><a class='color_filter' href='#' id='".$row['product_color_hex']."' style='background-color:".$row['product_color_hex'].";'></a></li>";  
                                        }
                                    ?>
                                    <!-- <li><a href="#" class="color1"></a></li>
                                    <li><a href="#" class="color2"></a></li>
                                    <li><a href="#" class="color3"></a></li>
                                    <li><a href="#" class="color4"></a></li>
                                    <li><a href="#" class="color5"></a></li>
                                    <li><a href="#" class="color6"></a></li>
                                    <li><a href="#" class="color7"></a></li>
                                    <li><a href="#" class="color8"></a></li>
                                    <li><a href="#" class="color9"></a></li>
                                    <li><a href="#" class="color10"></a></li> -->
                                </ul>
                            </div>
                        </div>

                        <!-- ##### Single Widget ##### -->
                        <!-- <div class="widget brands mb-50">
                            <p class="widget-title2 mb-30">Brands</p>
                            <div class="widget-desc">
                                <ul>
                                    <li><a href="#">Asos</a></li>
                                    <li><a href="#">Mango</a></li>
                                    <li><a href="#">River Island</a></li>
                                    <li><a href="#">Topshop</a></li>
                                    <li><a href="#">Zara</a></li>
                                </ul>
                            </div>
                        </div> -->
                    </div>
                </div>

                <div class="col-12 col-md-8 col-lg-9">
                    <div class="shop_grid_product_area">
                        <div class="row">
                            <div class="col-12">
                                <div class="product-topbar d-flex align-items-center justify-content-between">
                                    <!-- Total Products -->
                                    <div class="total-products">
                                        <p><span id="product_count"><?php echo mysqli_num_rows($products); ?></span> products found</p>
                                    </div>
                                    <!-- Sorting -->
                                    <!-- <div class="product-sorting d-flex">
                                        <p>Sort by:</p>
                                        <form action="#" method="get">
                                            <select name="select" id="sortByselect">
                                                <option value="value">Highest Rated</option>
                                                <option value="value">Newest</option>
                                                <option value="value">Price: $$ - $</option>
                                                <option value="value">Price: $ - $$</option>
                                            </select>
                                            <input type="submit" class="d-none" value="">
                                        </form>
                                    </div> -->
                                </div>
                            </div>
                        </div>

                        <div class="row" id="products">
                            <?php while($row = $products->fetch_assoc()){ ?>
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

                                                    <!-- Product Badge -->
                                                    <!-- <div class="product-badge offer-badge">
                                                        <span>-30%</span>
                                                    </div> -->
                                                    <!-- Favourite -->
                                                    <!-- <div class="product-favourite">
                                                        <a href="#" class="favme fa fa-heart"></a>
                                                    </div> -->
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
                                                    <a href="#" class="btn essence-btn">Add to Cart</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                    <!-- Pagination -->
                    <nav aria-label="navigation">
                        <ul class="pagination mt-50 mb-70">
                            <li class="page-item"><a class="page-link" href="#"><i class="fa fa-angle-left"></i></a></li>
                            <li class="page-item"><a class="page-link" href="#">1</a></li>
                            <li class="page-item"><a class="page-link" href="#">2</a></li>
                            <li class="page-item"><a class="page-link" href="#">3</a></li>
                            <li class="page-item"><a class="page-link" href="#">...</a></li>
                            <li class="page-item"><a class="page-link" href="#">21</a></li>
                            <li class="page-item"><a class="page-link" href="#"><i class="fa fa-angle-right"></i></a></li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </section>
    <!-- ##### Shop Grid Area End ##### -->
<?php
    include('footer.php');
?>

<script>
    $(".collection_filter").click(function(){
        var id = $(this).attr("id");
        action = 'fetch_data';
        $.ajax({
            url:"fetch_data.php",
            method:"POST",
            data:{
                action:action,
                collection_id:id
            },
            success: function(data){
                data = JSON.parse(data);
                $("#products").html(data[0]);
                $("#product_count").html(data[1]);
            }
        });
    });

    $(".color_filter").click(function(){
        var id = $(this).attr("id");
        action = 'fetch_data';
        $.ajax({
            url:"fetch_data.php",
            method:"POST",
            data:{
                action:action,
                color_hex:id
            },
            success: function(data){
                data = JSON.parse(data);
                $("#products").html(data[0]);
                $("#product_count").html(data[1]);
            }
        });
    });
</script>

<script>
  $( function() {
    $( "#slider-range" ).slider({
      range: true,
      min: 0,
      max: 10000,
      values: [ 0, 10000 ],
      slide: function( event, ui ) {
        $( "#amount" ).val( "Rs. " + ui.values[ 0 ] + " - Rs. " + ui.values[ 1 ] );
      }
    });
    $( "#amount" ).val( "Rs. " + $( "#slider-range" ).slider( "values", 0 ) +
      " - Rs. " + $( "#slider-range" ).slider( "values", 1 ) );
  } );

    $( "#slider-range" ).on( "slidechange", function( event, ui ) {
        values = ui.values;

        action = 'fetch_data';
        $.ajax({
            url:"fetch_data.php",
            method:"POST",
            data:{
                action:action,
                range:values
            },
            success: function(data){
                data = JSON.parse(data);
                $("#products").html(data[0]);
                $("#product_count").html(data[1]);
            }
        });
    } );
  </script>