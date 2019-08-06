<?php
session_start();
// error_reporting(E_ALL);
// ini_set('display_errors', TRUE);
require 'admin/config.php';
if (!isset($_SESSION['username'])){
    $login = FALSE;
    $details_count = 0;
    $products_cart = null;
    $details_sum = null;
}
else{
    $login = TRUE;
    $sql ="SELECT * FROM tbl_products where delete_status=0 and product_id in (SELECT product_id FROM tbl_cart where user_id='".$_SESSION['user_id']."' and cart_product_status=0)";
    $products_cart = mysqli_query($conn, $sql);
    $sql ="SELECT sum(price) as sum from tbl_products where delete_status=0 and product_id in (SELECT product_id FROM tbl_cart where user_id='".$_SESSION['user_id']."' and cart_product_status=0)";
    $details_sum = mysqli_query($conn, $sql);
    $sql ="SELECT count(cart_id) as count from tbl_cart where cart_product_status=0 and user_id='".$_SESSION['user_id']."'";
    $details_count = mysqli_query($conn, $sql);
    $details_count = mysqli_fetch_array($details_count)["count"];
}
$sql ="SELECT * FROM tbl_collections WHERE delete_status=0 ORDER BY collection_name";
$collections = mysqli_query($conn, $sql);
$sql ="SELECT * FROM tbl_sub_branch ORDER BY sub_branch_id";
$sub_branch = mysqli_query($conn, $sql);
?>
<!DOCTYPE html>
<html lang="en">

<style>
@font-face {
  font-family: 'perpetua';
  src: url('perpetua.ttf') format('truetype'); /* Chrome 4+, Firefox 3.5, Opera 10+, Safari 3—5 */, 
}

h2 {
  font-family: 'perpetua';
}
@font-face {
  font-family: 'goudy';
  src: url('goudos.ttf') format('truetype'); /* Chrome 4+, Firefox 3.5, Opera 10+, Safari 3—5 */, 
}
</style>

<head>
    <?php if(!$page){?>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="content-type" content="text/html; charset=utf-8">

    <!-- Enable responsiveness on mobile devices-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5, shrink-to-fit=no">

    <!-- SEO -->
    <meta name="description" content="Pakeeza strives to revive this Lucknowi elegance of exquisite workmanship, a timeless art form and works closely with various karagirs that create sheer beauty out of a piece of cloth and make it possible for us to bring you the intricate art at your doorstep. ">
    <meta name="keywords" content="keywords">

    <meta name="mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="application-name" content="Pakeeza">
    <meta name="apple-mobile-web-app-title" content="Pakeeza">
    <meta name="theme-color" content="#7a7cec">
    <meta name="msapplication-navbutton-color" content="#7a7cec">
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
    <meta name="msapplication-starturl" content="/">

    <!-- Facebook Cards -->
    <meta property="og:description" content="Pakeeza strives to revive this Lucknowi elegance of exquisite workmanship, a timeless art form and works closely with various karagirs that create sheer beauty out of a piece of cloth and make it possible for us to bring you the intricate art at your doorstep. "/>
    <meta property="og:url" content="http://pakeezachikankari.com"/>
    <meta property="og:image" content="http://pakeezachikankari.com/img/logo.png"/>
    <meta property="og:type" content="website"/>
    <meta property="og:site_name" content="Pakeeza"/>

    <!-- Twitter Cards -->
    <meta name="twitter:card" content="summary">
    <meta name="twitter:site" content="@pakeeza">
    <meta name="twitter:creator" content="Pakeeza">
    <meta name="twitter:title" content= "Pakeeza">
    <meta name="twitter:description" content="Pakeeza strives to revive this Lucknowi elegance of exquisite workmanship, a timeless art form and works closely with various karagirs that create sheer beauty out of a piece of cloth and make it possible for us to bring you the intricate art at your doorstep. ">
    <meta name="twitter:creator" content="Pakeeza">
    <meta name="twitter:image:src" content="http://pakeezachikankari.com/img/logo.png"/>
    <meta name="twitter:domain" content="http://pakeezachikankari.com">
    <?php }?>
    <!-- Title  -->
    <title>Pakeeza</title>

    <!-- Favicon  -->
    <link rel="icon" href="img/core-img/favicon.ico">

    <!-- Core Style CSS -->
    <link rel="stylesheet" href="css/core-style.css">
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="admin/fonts/font-awesome-4.7.0/css/font-awesome.min.css">

    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-144173542-1"></script>
    <script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());
    gtag('config', 'UA-144173542-1');
    </script>
</head>

<body>
    <!-- ##### Header Area Start ##### -->
    <header class="header_area">
        <div class="classy-nav-container breakpoint-off d-flex align-items-center justify-content-between">
            <!-- Classy Menu -->
            <nav class="classy-navbar" id="essenceNav">
                <!-- Logo -->
                <a class="nav-brand" href="index.php"><img src="img/logo.png" alt=""></a>
                <!-- Navbar Toggler -->
                <div class="classy-navbar-toggler">
                    <span class="navbarToggler"><span></span><span></span><span></span></span>
                </div>
                <!-- Menu -->
                <div class="classy-menu">
                    <!-- close btn -->
                    <div class="classycloseIcon">
                        <div class="cross-wrap"><span class="top"></span><span class="bottom"></span></div>
                    </div>
                    <!-- Nav Start -->
                    <div class="classynav">
                        <ul>
                            <li><a href="#" style="font-family: perpetua; color:#4a494a;">Shop</a>
                                <ul class="dropdown" style="height: 25vh !important;">
                                    <?php
                                        while($row = mysqli_fetch_array($sub_branch)){
                                            echo "<li><a href='sub_branch.php?id=".$row["sub_branch_id"]."'>".$row['sub_branch_name']."</a></li>";  
                                        }
                                    ?>
                                    <li><a href="shop.php" style="font-family: perpetua ; color:#4a494a;">All Products</a></li>
                                </ul>
                                <!-- <div class="megamenu">
                                    <ul class="single-mega cn-col-4">
                                        <li class="title">Women's Collection</li>
                                        <li><a href="shop.php">Dresses</a></li>
                                        <li><a href="shop.php">Blouses &amp; Shirts</a></li>
                                        <li><a href="shop.php">T-shirts</a></li>
                                        <li><a href="shop.php">Rompers</a></li>
                                        <li><a href="shop.php">Bras &amp; Panties</a></li>
                                    </ul>
                                    <ul class="single-mega cn-col-4">
                                        <li class="title">Men's Collection</li>
                                        <li><a href="shop.php">T-Shirts</a></li>
                                        <li><a href="shop.php">Polo</a></li>
                                        <li><a href="shop.php">Shirts</a></li>
                                        <li><a href="shop.php">Jackets</a></li>
                                        <li><a href="shop.php">Trench</a></li>
                                    </ul>
                                    <ul class="single-mega cn-col-4">
                                        <li class="title">Kid's Collection</li>
                                        <li><a href="shop.php">Dresses</a></li>
                                        <li><a href="shop.php">Shirts</a></li>
                                        <li><a href="shop.php">T-shirts</a></li>
                                        <li><a href="shop.php">Jackets</a></li>
                                        <li><a href="shop.php">Trench</a></li>
                                    </ul>
                                    <div class="single-mega cn-col-4">
                                        <img src="img/bg-img/bg-6.jpg" alt="">
                                    </div>
                                </div> -->
                            </li>
                            <li><a href="#" style="font-family: perpetua ; color:#4a494a;">Collections</a>
                                <ul class="dropdown">
                                    <?php
                                        while($row = mysqli_fetch_array($collections)){
                                            echo "<li><a href='collections.php?id=".$row["collection_id"]."'>".$row['collection_name']."</a></li>";  
                                        }
                                    ?>
                                    <!-- <li><a href="index.html">Noor</a></li>
                                    <li><a href="shop.php">Gulshan</a></li>
                                    <li><a href="shop.php">Aks</a></li> -->
                                    <!-- <li><a href="blog.html">Blog</a></li>
                                    <li><a href="single-blog.html">Single Blog</a></li>
                                    <li><a href="regular-page.html">Regular Page</a></li> -->
                                    <!-- <li><a href="contact.html">Contact</a></li> -->
                                </ul>
                            </li>
                            <!-- <li><a href="blog.html">Blog</a></li> -->
                            <li><a href="contact.php" style="font-family: perpetua; color:#4a494a;">Contact Us</a></li>
                            <?php if($login){ ?>
                            <li><a href=""><b><?php echo $_SESSION['first_name']; ?></b></a>
                                <ul class="dropdown" style="margin-right: 2%; margin-left: 2%;">
                                    <li><a href="edit_user_details.php">Edit Profile</a></li>
                                    <li><a href="user_orders.php">User Orders</a></li>
                                    <li><a href="logout.php">Logout</a></li>
                                </ul>
                            </li>
                        <?php }?>
                        </ul>
                    </div>
                    <!-- Nav End -->
                </div>
            </nav>

            <!-- Header Meta Data -->
            <div class="header-meta d-flex clearfix justify-content-end">
                <!-- Search Area -->
                <div class="search-area" style="border-right: 1px solid #ebebeb;">
                    <form action="shop.php" method="post">
                        <input type="search" name="search" id="headerSearch" placeholder="Type for search">
                        <button type="submit"><i class="fa fa-search" aria-hidden="true"></i></button>
                    </form>
                </div>
                <!-- Favourite Area -->
                <!-- <div class="favourite-area">
                    <a href="#"><img src="img/core-img/heart.svg" alt=""></a>
                </div> -->
                <!-- User Login Info -->
                <?php if(!$login){ ?>
                    <div class="user-login-info">
                        <a href="login.php"><img src="img/core-img/user.svg" alt=""></a>
                    </div>
                    <!-- <div class="user-login-info">
                        <a href="login.php">Login</a>
                    </div> -->
                <?php }?>
                <!-- Cart Area -->
                <div class="cart-area">
                    <a href="#" id="essenceCartBtn"><img src="img/core-img/bag.svg" alt=""> <span><?php echo $details_count;?></span></a>
                </div>
            </div>

        </div>
    </header>
    <!-- ##### Header Area End ##### -->

    <!-- ##### Right Side Cart Area ##### -->
    <div class="cart-bg-overlay"></div>

    <div class="right-side-cart-area">

        <!-- Cart Button -->
        <div class="cart-button">
            <a href="#" id="rightSideCart"><img src="img/core-img/bag.svg" alt=""> <span><?php echo $row["count"]?></span></a>
        </div>

        <div class="cart-content d-flex">

            <!-- Cart List Area -->
            <div class="cart-list">
        <?php if($products_cart)
              {
                while($row = $products_cart->fetch_assoc()){ 
            $sql = "SELECT * FROM tbl_pictures WHERE product_id=".$row['product_id']." LIMIT 1";
            $product_img = mysqli_query($conn, $sql);
            $product_img = $product_img->fetch_assoc(); 
        ?>
                <!-- Single Cart Item -->
                <div class="single-cart-item">
                    <a href="#" class="product-image">
                        <img src="<?php echo 'admin/uploads/'.$product_img['picture_url']; ?>" class="cart-thumb" alt="">
                        <!-- Cart Item Desc -->
                        <div class="cart-item-desc">
                            <span class="product-remove" id="product-remove" data-id="<?php echo $row['product_id']; ?>"><i class="fa fa-close" aria-hidden="true"></i></span>
                            <!--<span class="badge">Mango</span>-->
                            <h6><?php echo $row["product_name"] ?></h6>
                            <?php $sql = "select * from tbl_cart where product_id=".$row["product_id"];
                                $cart_details = mysqli_query($conn, $sql);
                                $row_cart = mysqli_fetch_array($cart_details); 
                            ?>
                            <p class="size">Size:  <?php echo $row_cart['size']; ?></p>
                            <p class="color">Color:  <?php echo $row_cart['color']; ?></p>
                            <?php $sql = "select count(cart_id) as count from tbl_cart where product_id=".$row["product_id"];
                                $product_count = mysqli_query($conn, $sql);
                                $row_prod_count = mysqli_fetch_array($product_count); 
                            ?>
                            <p class="color">Count:  <?php echo $row_prod_count["count"] ?></p>
                            <p class="price">Price:  ₹<?php echo $row["price"] ?></p>
                        </div>
                    </a>
                </div>
        <?php       }
               } ?>
            </div>

            <!-- Cart Summary -->
            <div class="cart-amount-summary">
                <h2>Summary</h2>
		        <?php if ($details_sum){
                        $row = mysqli_fetch_array($details_sum);
                 }else{
                     $row["sum"] = 0;
                 } ?>
                <ul class="summary-table">
                    <li><span>Subtotal:</span> <span>₹<?php echo $row["sum"]?></span></li>
                    <li><span>Delivery:</span> <span><?php if($row["sum"] > 8000){?>₹0<?php } else {?>₹150<?php } ?></span></li>
                    <li><span>Total:</span> <span>₹<?php if($row["sum"] > 8000){ echo $row["sum"]; } else { echo $row["sum"]+150; } ?></span></li>
                </ul>
                <div class="checkout-btn mt-100">
                    <a href="checkout.php" class="btn essence-btn">check out</a>
                </div>
            </div>
        </div>
    </div>
<!-- ##### Right Side Cart End ##### -->
