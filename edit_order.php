<?php
$page = 'product';
require 'config.php';
include('header.php');

if(isset($_GET['id'])){
    $order_id = $_GET['id'];
    $sql ="SELECT tbl_products.product_id,tbl_products.product_name,tbl_products.product_type,tbl_products.price,tbl_products.product_code,tbl_products.discount,tbl_products.product_description,tbl_products.material,tbl_products.gender,tbl_products.product_keywords, tbl_collections.collection_name, tbl_product_color.color_name
		FROM tbl_products 
		INNER JOIN tbl_collections ON tbl_products.collection_id = tbl_collections.collection_id
		INNER JOIN tbl_product_color_mapping ON tbl_products.product_id = tbl_product_color_mapping.product_id
		INNER JOIN tbl_product_color ON tbl_product_color_mapping.color_id = tbl_product_color.color_id
		WHERE tbl_products.product_id = '".$product_id."'";

	$result = mysqli_query($conn,$sql);
    $product_details = mysqli_fetch_array($result);

    $sql = "SELECT * FROM tbl_pictures WHERE product_id=".$product_id;

    $product_images = mysqli_query($conn,$sql);
}
?>

<div class="container" style="margin-top: 2%">
    <form method="post" action="update_order.php" enctype="multipart/form-data">
        <div class="row">

            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                <div class="form-group">
                    <label for="product_name">Order Id</label>
                    <input type='text' class='form-control ' name='order_id' id='order_id' readonly="true">
                </div> 

                <div class="form-group">
                    <label for="product_name">User Id</label>
                    <input type='text' class='form-control ' name='user_id' id='user_id' readonly="true">
                </div>    

	   </div>
	   <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">  

                <div class="form-group">
                    <label for="product_name">Product Id</label>
                    <input type='number' class='form-control ' name='product_id' id='product_id'>
                </div> 
           
                <div class="form-group">
                    <label for="product_price"> Shipping Date</label>
                    <input type="date" class="form-control" name="shipping_date" id="shipping_date" step=".01">
                </div>

		<div class="form-group">
                <label for="product_name">Shipping ID</label>
		<input type="number" class="form-control" name="shipping_id" id="shipping_id" step=".01">
                </div>


		<div class="form-group">
                <label for="product_name">Transaction Status</label>
		<input type="number" class="form-control" name="transaction_status" id="transaction_status" step=".01">
                </div>

                <button type="submit" value="submit" id="btn_edit_order" name="btn_edit_order" class="btn btn-primary" style="float: right;">Update</button>
            </div>
        </div>
    </form>
</div>

<?php
include('footer.php');
?>



<script>
$(document).ready(function(){

    var product_id = <?php echo $product_id; ?>;
    
    $.ajax({
            url:'fetch_order.php',
            method:'POST',
            data: {'order_id':order_id},
            dataType:"json",
            success: function(data){
                console.log(data);
                $('#order_id').val(data.order_id);
                $('#user_id').val(data.user_id);
                $('#product_id').val(data.product_id);
                $('#shipping_date').val(data.shipping_date);
                $('#shipping_id').val(data.shipping_id);
                $('#order_tax').val(data.order_tax);
                $('#payment_id').val(data.payment_id);
                $('#payment_status').val(data.payment_status);
                $('#transaction_status').val(data.transaction_status);
          },

      });
});
</script>
