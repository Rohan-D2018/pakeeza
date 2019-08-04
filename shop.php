<?php

include('header.php');
if(isset($_POST["search"]))
{
	//echo $_POST["search"];
	$sql ="SELECT * FROM tbl_products WHERE delete_status=0 and product_name like '%".$_POST["search"]."%' or product_description like '%".$_POST["search"]."%'";
	//echo $sql;
	$products = mysqli_query($conn, $sql);
	if(mysqli_num_rows($products)==0)
	{
		$sql ="SELECT * FROM tbl_products WHERE delete_status=0 and collection_id in (select collection_id from tbl_collections where delete_status=0 and collection_name like '%".$_POST["search"]."%' or collection_description like '%".$_POST["search"]."%') or sub_branch_id in (select sub_branch_id from tbl_sub_branch where delete_status=0 and sub_branch_name like '%".$_POST["search"]."%' or sub_branch_description like '%".$_POST["search"]."%')";
		//echo $sql;
		$products = mysqli_query($conn, $sql);
		if(mysqli_num_rows($products)==0)
		{
			$sql = "select * from tbl_products where product_id in (select product_id from tbl_product_keyword_mapping where keyword_id in (select keyword_id from tbl_keywords where keyword like '%".$_POST["search"]."%'))";
			//echo $sql;
			$products = mysqli_query($conn, $sql);
			if(mysqli_num_rows($products)==0)
			{
				$sql ="SELECT * FROM tbl_products WHERE delete_status=0";
				$products = mysqli_query($conn, $sql);
			}
		}
	}
}
else if(isset($_GET["id"]))
{
	echo $_GET["id"];
	$sql ="SELECT * FROM tbl_products WHERE delete_status=0 and sub_branch_id=".$_GET["id"];
	$products = mysqli_query($conn, $sql);
	if(mysqli_num_rows($products)==0)
	{
		$sql ="SELECT * FROM tbl_products WHERE delete_status=0";
		$products = mysqli_query($conn, $sql);
	}
}
else if(isset($_GET['sort'])){
    if($_GET['sort'] == 'a_to_z'){
        $sql ="SELECT * FROM tbl_products WHERE delete_status=0 ORDER BY product_name";
        $products = mysqli_query($conn, $sql);
    }
    else if($_GET['sort'] == 'z_to_a'){
        $sql ="SELECT * FROM tbl_products WHERE delete_status=0 ORDER BY product_name DESC";
        $products = mysqli_query($conn, $sql);
    }
    else if($_GET['sort'] == 'price_low_to_high'){
        $sql ="SELECT * FROM tbl_products WHERE delete_status=0 ORDER BY price";
        $products = mysqli_query($conn, $sql);
    }
    else if($_GET['sort'] == 'price_high_to_low'){
        $sql ="SELECT * FROM tbl_products WHERE delete_status=0 ORDER BY price DESC";
        $products = mysqli_query($conn, $sql);
    }
}
else
{
	$sql ="SELECT * FROM tbl_products WHERE delete_status=0";
	$products = mysqli_query($conn, $sql);
}

$sql ="SELECT * FROM tbl_collections WHERE delete_status=0 ORDER BY collection_name";
$collections = mysqli_query($conn, $sql);

$sql = "SELECT DISTINCT material FROM tbl_products";
$materials = mysqli_query($conn, $sql);

$sql = "SELECT DISTINCT size FROM tbl_product_size";
$size = mysqli_query($conn, $sql);
?>
    <!-- ##### Breadcumb Area Start ##### -->
    <div class="breadcumb_area bg-img" style="background-image: url(img/skyline.png);">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-12">
                    <div class="page-title text-center">
                        <h2 class="breadcrumb_title">All Products</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ##### Breadcumb Area End ##### -->

    <!-- ##### Shop Grid Area Start ##### -->
    <section class="shop_grid_area" style="margin-left: 3%; margin-right: 1%;">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-4 col-lg-2">
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
                        <div class="widget mb-50">
                            <!-- Widget Title -->
                            <h6 class="widget-title mb-30">Filter by</h6>
                            <!-- Widget Title 2 -->
                            <ul id="menu-content2" class="menu-content" style="margin-bottom: 5%">
                                <!-- Single Item -->
                                <li>
                                    <a class="widget-title2 collapsed" href="#" data-toggle="collapse" data-target="#pricing" style="margin-bottom: 2%;">Price <i class="fa fa-caret-down" aria-hidden="true"></i></a>
                                    <ul class="sub-menu collapse" id="pricing">
                                        <li class="price" low="0" high="2000"><a href="#">0 - 2000</a></li>
                                        <li class="price" low="2000" high="4000"><a href="#">2000 - 4000</a></li>
                                        <li class="price" low="4000" high="6000"><a href="#">4000 - 6000</a></li>
                                        <li class="price" low="6000" high="8000"><a href="#">6000 - 8000</a></li>
                                        <li class="price" low="8000" high="above"><a href="#">8000 - Above</a></li>
                                    </ul>
                                </li>
                            </ul>

                            <ul id="menu-content2" class="menu-content" style="margin-bottom: 5%">
                                <!-- Single Item -->
                                <li>
                                    <a href="#" class="collapsed" data-toggle="collapse" data-target="#material" aria-expanded="false"  aria-controls="material">MATERIAL <i class="fa fa-caret-down" aria-hidden="true"></i></a>
                                    <ul class="sub-menu collapse" id="material">
                                        <?php
                                            while($row = mysqli_fetch_array($materials)){
                                                echo "<li><a href='#' material='".$row['material']."' class='material_filter'>".$row['material']."</a></li>";  
                                            }
                                        ?>
                                    </ul>
                                </li>
                            </ul>

                            <!-- ##### Single Widget ##### -->
                            <ul id="menu-content2" class="menu-content" style="margin-bottom: 5%">
                                <!-- Single Item -->
                                <li>
                                    <a href="#" class="collapsed" data-toggle="collapse" data-target="#size" aria-expanded="false"  aria-controls="size">SIZE <i class="fa fa-caret-down" aria-hidden="true"></i></a>
                                    <ul class="sub-menu collapse" id="size">
                                        <?php
                                            while($row = mysqli_fetch_array($size)){
                                                echo "<li><a href='#' size='".$row['size']."' class='size_filter'>".$row['size']."</a></li>";  
                                            }
                                        ?>
                                    </ul>
                                </li>
                            </ul>

                            <!-- ##### Single Widget ##### -->
                            <ul id="menu-content2" class="menu-content">
                                <!-- Single Item -->
                                <li>
                                    <a class="widget-title2 mb-30 collapsed" href="#" data-toggle="collapse" data-target="#color">Color <i class="fa fa-caret-down" aria-hidden="true"></i></a>
                                    <ul class="sub-menu collapse widget color mb-50" id="color">
                                        <div class="widget-desc">
                                            <ul class="d-flex">
                                                <?php
                                                    $sql ="SELECT * FROM tbl_product_color";
                                                    $colors = mysqli_query($conn, $sql);
                                                    while($row = mysqli_fetch_array($colors)){
                                                        echo "<li><a class='color_filter' href='#' id='".$row['product_color_hex']."' style='background-color:".$row['product_color_hex'].";'></a></li>";  
                                                    }
                                                ?>
                                            </ul>
                                        </div>
                                    </ul>
                                </li>
                            </ul>
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

                    <div class="widget" syle>
                        <!-- Widget Title -->
                        <h6 class="widget-title mb-30">Sort</h6>
                        <!-- Widget Title 2 -->
                        <ul id="menu-content2" class="menu-content" style="margin-bottom: 5%">
                            <!-- Single Item -->
                            <li>
                                <a class="widget-title2 collapsed" href="#" data-toggle="collapse" data-target="#sort" style="margin-bottom: 2%;">Sort By <i class="fa fa-caret-down" aria-hidden="true"></i></a>
                                <ul class="sub-menu collapse" id="sort">
                                    <li><a href="?sort=a_to_z">Alphabetially (A-Z)</a></li>
                                    <li><a href="?sort=z_to_a">Alphabetially (Z-A)</a></li>
                                    <li><a href="?sort=price_low_to_high">Price Low to High</a></li>
                                    <li><a href="?sort=price_high_to_low">Price High to Low</a></li>
                                </ul>
                            </li>
                        </ul>
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
                                                    <img class="lozad" data-src="admin/uploads/'.$image_array[0].'" alt="">
                                                    <!-- Hover Thumb -->
                                                    <img class="hover-img lozad"  data-src="admin/uploads/'.$image_array[1].'" alt="">

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
                                                    <a href="<?php echo 'product_details.php?id='.$row["product_id"]; ?>" class="btn essence-btn">View Product</a>
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

    $(".material_filter").click(function(){
        var id = $(this).attr("material");
        action = 'fetch_data';
        $.ajax({
            url:"fetch_data.php",
            method:"POST",
            data:{
                action:action,
                material:id
            },
            success: function(data){
                data = JSON.parse(data);
                $("#products").html(data[0]);
                $("#product_count").html(data[1]);
            }
        });
    });

    $(".size_filter").click(function(){
        var id = $(this).attr("size");
        action = 'fetch_data';
        $.ajax({
            url:"fetch_data.php",
            method:"POST",
            data:{
                action:action,
                size:id
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

    $( ".price" ).on( "click", function() {
        var values = [$(this).attr("low"), $(this).attr("high")];
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
                console.log(data);
                $("#products").html(data[0]);
                $("#product_count").html(data[1]);
            }
        });
    } );
  </script>