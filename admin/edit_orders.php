<?php
$page = 'order';
require 'config.php';
include('header.php');

if(isset($_GET['id']))
{
    $order_id = $_GET['id'];
    $sql ="SELECT tbl_order_details.order_id, tbl_order_details.price, tbl_order_details.size,tbl_order_details.color, tbl_order_details.quantity, tbl_products.product_name,tbl_users_credentials.user_email
            FROM tbl_order_details
            INNER JOIN tbl_products ON tbl_order_details.product_id = tbl_products.product_id
            INNER JOIN tbl_orders ON tbl_order_details.order_id = tbl_orders.order_id
            INNER JOIN tbl_users_credentials ON tbl_orders.user_id = tbl_users_credentials.user_id
		    WHERE tbl_orders.order_id = '".$order_id."'";

	$result = mysqli_query($conn,$sql);
    $order_details = mysqli_fetch_array($result);

}
?>

<div class="container" style="margin-top: 2%">
    <form method="post" action="update_data.php" enctype="multipart/form-data">
        <div class="row">
            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                <div class="form-group">
                    <label for="order_id">Order Id</label>
                    <input type='text' class='form-control ' name='order_id2' id='order_id2' readonly="true">
                </div> 
            </div>
            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                <div class="form-group">
                    <label for="user">User</label>
                    <input type='text' class='form-control ' name='user2' id='user2' required>
                </div> 
            </div>    
            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                <div class="form-group">
                    <label for="product_name">Product Name</label>
                    <input type='text' class='form-control ' name='product_name2' id='product_name2' required>
                </div> 
            </div>
            
            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">    
                <div class="form-group">
                    <label for="product_price"> Price</label> 
                    <input type="number" class="form-control" name="product_price2" id="product_price2" step=".01" required>
                </div>
            </div>    
            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">    
                <div class="form-group">
                    <label for="product_quantity">Quantity</label>
                    <input type="number" class="form-control" name="product_quantity2" id="product_quantity2"  required>
                </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">    
                <label for="product_color">Color</label>
                <select class="browser-default custom-select form-group" id="product_color2" name="product_color2" required>
                    <!-- <option selected>Select Collection</option> -->
                    <?php
                        $sql = "SELECT DISTINCT(color_name) FROM tbl_product_color";
                    
                        $result = mysqli_query($conn, $sql);
                        while($row = mysqli_fetch_array($result))
                        {
                        echo '<option value="' . $row["color_name"] . '">' . $row["color_name"] . '</option>'; 
                        }
                        if (!$result)
                        {
                            die ('SQL Error: ' . mysqli_error($conn));
                        }
                    ?>
                </select>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">    
                <div class="form-group">
                    <label for="product_size">Size</label>
                    <input type="text" class="form-control" name="product_size2" id="product_size2" required>
                </div>
            </div>

            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
            </div>
             <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
            </div>
             <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
            </div>
             <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
            </div>

            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">

                <button type="submit" value="submit" id="btn_edit_orders" name="btn_edit_orders" class="btn btn-primary" style="float: right;">Update</button>
            
            </div>
        </div>
    </form>
</div>
<script>

$(document).ready(function(){
   
    var order_id = <?php echo $order_id; ?>;
    console.log(order_id);
    $.ajax({
            url:'fetch.php',
            method:'POST',
            data: {'order_id':order_id},
            dataType:"json",
            success: function(data){
                console.log(data);
                $('#order_id2').val(data.order_id);
                $('#user2').val(data.user_email);
                $('#product_name2').val(data.product_name);
                $('#product_price2').val(data.price);
                $('#product_quantity2').val(data.quantity);
                $('#product_color2').val(data.color);
                $('#product_size2').val(data.size);
          },

      });
});
</script>
<?php
include('footer.php');
?>

