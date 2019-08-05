<?php
    include('header.php');
    $product_id   = $_GET['id'];
    $sql          = "SELECT * FROM tbl_products WHERE product_id=".$product_id;
    $product_info = mysqli_query($conn, $sql);
    $product_info = mysqli_fetch_assoc($product_info);
    // print_r($product_info);
?>
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
