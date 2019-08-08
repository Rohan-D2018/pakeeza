<?php
    $page = 'product_details';
    include('header.php');
    $product_id   = $_GET['id'];
    $sql          = "SELECT * FROM tbl_products WHERE product_id=".$product_id;
    $product_info = mysqli_query($conn, $sql);
    $product_info = mysqli_fetch_assoc($product_info);
    $sql = "SELECT * FROM tbl_pictures WHERE product_id=".$product_id." LIMIT 1";        
    $image = mysqli_query($conn, $sql);
    $image = mysqli_fetch_assoc($image);
    // print_r($product_info);
?>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="content-type" content="text/html; charset=utf-8">

    <!-- Enable responsiveness on mobile devices-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5, shrink-to-fit=no">

    <!-- SEO -->
    <meta name="description" content="<?php echo $product_info['product_description'];?>">
    <meta name="keywords" content="keywords">

    <meta name="mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="application-name" content="Pakeeza">
    <meta name="apple-mobile-web-app-title" content="Pakeeza">
    <meta name="theme-color" content="#FDBA17">
    <meta name="msapplication-navbutton-color" content="#FDBA17">
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
    <meta name="msapplication-starturl" content="/">

    <!-- Facebook Cards -->
    <meta property="og:description" content="<?php echo $product_info['product_description']; ?>"/>
    <meta property="og:url" content="http://pakeezachikankari.com/product_details.php?id=<?php echo $product_id; ?>"/>
    <meta property="og:image" content="<?php echo $image['picture_url']; ?>"/>
    <meta property="og:type" content="website"/>
    <meta property="og:site_name" content="Pakeeza"/>

    <!-- Twitter Cards -->
    <meta name="twitter:card" content="summary">
    <meta name="twitter:site" content="@pakeeza">
    <meta name="twitter:creator" content="Pakeeza">
    <meta name="twitter:title" content= "Pakeeza">
    <meta name="twitter:description" content="<?php echo $product_info['product_description']; ?>">
    <meta name="twitter:creator" content="Pakeeza">
    <meta name="twitter:image:src" content="<?php echo $image['picture_url']; ?>"/>
    <meta name="twitter:domain" content="http://pakeezachikankari.com/product_details.php?id=<?php echo $product_id; ?>">
<style>
@font-face {
  font-family: 'perpetua';
  src: url('perpetua.ttf') format('truetype'); /* Chrome 4+, Firefox 3.5, Opera 10+, Safari 3—5 */, 
}  

#heading {
  color: #4a494a;
  font-family: 'perpetua';
}

h2 {
  font-family: 'perpetua';
}
@font-face {
  font-family: 'goudy';
  src: url('goudos.ttf') format('truetype'); /* Chrome 4+, Firefox 3.5, Opera 10+, Safari 3—5 */, 
}  

#body1 {
  color: #707071;
  font-family: 'goudy';
}
</style>
    
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>

<style>
.button1 {
  background-color: #ffffff; /* Silver */
  border: 1;
  color: black;
  padding: 10px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 16px;
  margin: 4px 2px;
  cursor: pointer;
}

.button1 {border-radius: 10px;}

input[type=text]
{
  -moz-appearance: textfield;
}
</style>
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
	    <div class="heading" id="heading">
            <span><?php echo $row['collection_name']; ?></span>
            <a href="cart.html">
                <h2 style="font-family: perpetua"><?php echo $product_info['product_name']; ?></h2>
            </a>
	    </div>
            <p class="product-price" style="font-family: perpetua"> ₹ <?php echo $product_info['price']; ?></p>
	    <div class="body1" id="body1">
            <p class="product-desc"><?php echo $product_info['product_description']; ?></p>

            <!-- Form -->
            <form class="cart-form clearfix" method="post" action="add_to_cart.php">
                <!-- Select Box -->
                <div class="select-box d-flex mt-50 mb-30">
                    <select name="size" id="productSize" class="mr-5">
                       <?php
                        $sql          = "SELECT ps.size
                                        FROM tbl_product_size ps
                                        INNER JOIN tbl_product_size_mapping psm ON (psm.size_id=ps.size_id)
                                        INNER JOIN tbl_products p ON (p.product_id=psm.product_id)
                                        WHERE p.product_id=".$product_id." ORDER BY ps.size_id DESC";
                        $product_info = mysqli_query($conn, $sql);
                        while($row=mysqli_fetch_assoc($product_info)){
                            echo '<option value="'.$row['size'].'">Size: '.$row['size'].'</option>';
                        }
                       ?>
                    </select>
                    <select name="color" id="productColor">
                        <?php
                        $sql          = "SELECT pc.color_name
                                        FROM tbl_product_color pc
                                        INNER JOIN tbl_product_color_mapping pcm ON (pcm.color_id=pc.color_id)
                                        INNER JOIN tbl_products p ON (p.product_id=pcm.product_id)
                                        WHERE p.product_id=".$product_id;
                        $product_info = mysqli_query($conn, $sql);
                        while($row=mysqli_fetch_assoc($product_info)){
                            echo '<option value="'.$row['color_name'].'">Color: '.$row['color_name'].'</option>';
                        }
                       ?>
                    </select>
                </div>
		<div class="quantity align-items-center">
				      <button class="button1" type="button" id="button1" name="button1" onclick="add_quantity();"><span class="glyphicon glyphicon-plus"></span></button>
				      <input type="text" id="quant" value="1" name="quant" style="width:25%;">
				      <button class="button1" type="button" id="button1" name="button1" onclick="subtract_quantity();"><span class="glyphicon glyphicon-minus"></span></button>
				      <a href=""><span class="glyphicon glyphicon-share"></span></a>
		</div>
                <!-- Cart & Favourite Box -->
                <div class="cart-fav-box d-flex align-items-center">
                    <!-- Cart -->
                    <!-- <button type="submit" name="addtocart" value="5" class="btn essence-btn">Add to cart</button> -->
                    <input type="hidden" id="product_id" name="product_id" value="<?php echo $product_id?>">
                    <input type="submit" value="Add to Cart" class="btn essence-btn">
                </div>
            </form>
	  </div>
        </div>
    </section>

<script>
function add_quantity()
{
	var quantity = document.getElementById("quant").value;
	document.getElementById("quant").value = parseInt(quantity)+1;
}

function subtract_quantity()
{
	var quantity = document.getElementById("quant").value;
	if((parseInt(quantity)-1)>=0)
		document.getElementById("quant").value = parseInt(quantity)-1;
	else
		document.getElementById("quant").value = 0;
}
</script>
    <!-- ##### Single Product Details Area End ##### -->
<?php
    include('footer.php');
?>
