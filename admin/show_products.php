<?php
$page = 'product';
require 'config.php';
include('header.php');
?>


<div class="container-fluid">
	<div class="row" style="margin-top: 1%;">
    </div>
    <h3 style="color: #00529b;">All Products </h3>    
    <table class="table display" id="products" style="margin-top: 20px; width:100%">
        <thead class="thead-dark" style="background-color: #e8eaf6; padding-top:2px;padding-bottom:5px;">
            <tr>                   
                <th width="30%" style="text-align: left;">Name</th>
                <th width="20%" style="text-align: left;">Type</th>
                <th width="10%" style="text-align: left;">Price</th>
                <th width="20%" style="text-align: left;">Code</th>
                <th width="10%" style="text-align: left;">Discount</th>
                <th width="5%" style="text-align: right;"></th>
                <th width="5%" style="text-align: left;"></th>
            </tr>
        </thead>
        <tbody >
            <?php
                $sql = "SELECT product_id,product_name,product_type,price,product_code,discount FROM tbl_products WHERE delete_status =0";
                
                $result = mysqli_query($conn, $sql);
                
                if (!$result) 
                {
                    die ('SQL Error: ' . mysqli_error($conn));
                }
                
                while ($row = mysqli_fetch_array($result))
                { 
                    
                // if equal to current
                    echo '<tr>
                        <td width="30%" style="text-align: left;">'.$row['product_name'].'</td>
                        <td width="20%" style="text-align: left;">'.$row['product_type'].'</td>
                        <td width="10%" style="text-align: left;">'.$row['price'].'</td>
                        <td width="20%" style="text-align: left;">'.$row['product_code'].'</td>
                        <td width="10%" style="text-align: left;">'.$row['discount'].'</td>
                        <td width="5%" style="text-align: right;"><button type="button" name="edit"  id="'.$row['product_id'].'" class="btn btn-primary edit_data"><i class="fa fa-pencil"></td>
                        <td width="5%" style="text-align: left;"><a href="javascript:delete_id('.$row['product_id'].')"><button type="button" class="btn btn-danger fa fa-trash"></button></a></td>
                    </tr>';
                 
                }
            ?>        
        </tbody>
    </table>    
</div>


<!-- ====================================Data modal to edit the data============================================= -->

<div class="modal fade" id="add_data_Modal">
    <div class="modal-dialog modal-lg">
      	<div class="modal-content">
      
	        <!-- Modal Header -->
	        <div class="modal-header">
	          <h4 class="modal-title">Edit product details</h4>
	          <button type="button" class="close" data-dismiss="modal">&times;</button>
	        </div>
        
        <!-- Modal body -->
	        <div class="modal-body">
	            <form method="post">
	                <div class="row">
	                	<div class="col-md-3 col-sm-3">
	                        <div class="form-group">
	                          <label for="product_name">Product Id</label>
	                         <input type='text' class='form-control ' name='product_id2' id='product_id2' readonly="true">
	                        </div>  
	                    </div>

	                    <div class="col-md-3 col-sm-3">
	                        <div class="form-group">
	                          <label for="product_name">Product Name</label>
	                         <input type='text' class='form-control ' name='product_name2' id='product_name2'>
	                        </div>  
	                    </div>
	                      
	                    <div class="col-md-3 col-sm-3">
	                        <div class="form-group">
	                          <label for="product_type">Product Type</label>
	                          <input type='text' class='form-control ' name='product_type2' id='product_type2'>
	                        </div>  
	                    </div>

	                    <div class="col-md-3 col-sm-3">
	                        <div class="form-group">
	                          <label for="product_description">Product Description</label>
	                          <input type='text' class='form-control ' name='product_description2' id='product_description2'>
	                        </div>  
	                    </div>

	                    <div class="col-md-3 col-sm-3">
	                        <div class="form-group">
	                          <label for="product_price">Product Price</label>
	                          <input type="number" class="form-control" name="product_price2" id="product_price2" step=".01">
	                        </div>  
	                    </div>
	                    <div  style="float: right;">
	                        <button type="submit" value="submit" id="btn_edit_products" name="btn_edit_products" class="btn btn-primary">Update</button>
	                    </div>
	                </div>     
	            </form>
	        </div>
        
	        <!-- Modal footer -->
	        <div class="modal-footer">
	          <!-- <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button> -->
	        </div> 
      	</div>
    </div>
</div>

<?php

if(isset($_POST["btn_edit_products"]))
{
    $product_id = $_POST['product_id2'];
    $product_name = $_POST['product_name2'];
    $product_type = $_POST['product_type2'];
    // $product_description =  $_POST['product_description2'];
    $product_price =  $_POST['product_price2'];
   
        
    $sql ="UPDATE tbl_products SET product_name = '$product_name', product_type = '$product_type',price='$product_price' WHERE product_id = '$product_id'";
    $result = mysqli_query($conn,$sql);

    // $_SESSION['success'] = "Data Updated succesfully ";
    
    // header('Location:../alert.php');
    // exit();

}
?>




<script>
    function delete_id(id)
    {
     if(confirm('Sure To Remove This Record ?'))
     {
      window.location.href='delete_product.php?delete_id='+id;
     }
    }   
</script>


<script>
    $(document).ready(function() {
    $('#products').DataTable({
    "lengthMenu": [ 7,10, 25, 50, 75, 100 ], 
    "paging":   true,
    } );
    var topRow = $('#products_wrapper').children().first();
    topRow.children().first().attr('class','col-sm-3');
    topRow.children().eq(1).attr('class','col-sm-6');
    var searchBar = $('#products_filter').children().first();
    searchBar.children().first().css('width','300px');

    var lengthMenu =  $('#products_length')
    lengthMenu.css('display','none');
} );

</script>
<script type="text/javascript">
$(document).on('click','.edit_data',function(){

    var product_id = $(this).attr("id");

     $.ajax({
            url:'fetch.php',
            method:'POST',
            data: {'product_id':product_id},
            dataType:"json",
            success: function(data){
                console.log(data);
                $('#product_id2').val(data.product_id);
                $('#product_name2').val(data.product_name);
                $('#product_type2').val(data.product_type);
                $('#product_price2').val(data.price);
                $('#product_description2').val(data.product_code);
                $('#btn_edit_products').val("Update");
                $('#add_data_Modal').modal('show');
          },

      });

  });
</script>
<?php
include('footer.php');
?>