<?php
$page = 'product';
require 'config.php';
include('header.php');
?>


<div class="container-fluid">
	<div class="row" style="margin-top: 1%;">
    </div>
    <h3 style="color: #00529b;">All Products </h3> 
    <div class="table-responsive">    
        <table class="table display" id="products" style="margin-top: 20px; width:100%">
            <thead class="thead-dark" style="background-color: #e8eaf6; padding-top:2px;padding-bottom:5px;">
                <tr>                   
                    <th width="15%" style="text-align: left;">Name</th>
                    <th width="7%" style="text-align: left;">Collection</th>
                    <th width="25%" style="text-align: left;">Description</th>
                    <th width="7%" style="text-align: left;">Price</th>
                    <th width="5%" style="text-align: left;">Discount</th>
                    <th width="6%" style="text-align: left;">Color</th>
                    <th width="7%" style="text-align: left;">Type</th>
                    <th width="5%" style="text-align: left;">Code</th>
                    <th width="7%" style="text-align: left;">Material</th>
                    <th width="7%" style="text-align: left;">Gender</th>
                    <th width="3%" style="text-align: right;"></th>
                    <th width="3%" style="text-align: right;"></th>
                    <th width="3%" style="text-align: left;"></th>
                </tr>
            </thead>
            <tbody >
                <?php
                    $sql = "SELECT tbl_products.product_id,tbl_products.product_name,tbl_products.product_type,tbl_products.price,tbl_products.product_code,tbl_products.discount,tbl_products.product_description,tbl_products.material,tbl_products.gender, tbl_collections.collection_name, tbl_product_color.color_name
                            FROM tbl_products 
                            INNER JOIN tbl_collections ON tbl_products.collection_id = tbl_collections.collection_id
                            INNER JOIN tbl_product_color_mapping ON tbl_products.product_id = tbl_product_color_mapping.product_id
                            INNER JOIN tbl_product_color ON tbl_product_color_mapping.color_id = tbl_product_color.color_id
                            WHERE tbl_products.delete_status =0";
                    
                    $result = mysqli_query($conn, $sql);
                    
                    if (!$result) 
                    {
                        die ('SQL Error: ' . mysqli_error($conn));
                    }
                    
                    while ($row = mysqli_fetch_array($result))
                    { 
                        if ((in_array("admin", $_SESSION['access_role'], TRUE)))
                        {
                            echo '<tr>
                                <td width="15%" style="text-align: left;">'.$row['product_name'].'</td>
                                <td width="7%" style="text-align: left;">'.$row['collection_name'].'</td>
                                <td width="25%" style="text-align: left;">'.$row['product_description'].'</td>
                                <td width="7%" style="text-align: left;">'.$row['price'].'</td>
                                <td width="5%" style="text-align: left;">'.$row['discount'].'</td>
                                <td width="5%" style="text-align: left;">'.$row['color_name'].'</td>
                                <td width="7%" style="text-align: left;">'.$row['product_type'].'</td>
                                <td width="5%" style="text-align: left;">'.$row['product_code'].'</td>
                                <td width="7%" style="text-align: left;">'.$row['material'].'</td>
                                <td width="7%" style="text-align: left;">'.$row['gender'].'</td>

                                <td width="3%" style="text-align: left;"><button type="button" id="'.$row['product_id'].'" class="show_data btn btn-secondary fa fa-plus-square" style="color:white"></button></td>

                                <td width="3%" style="text-align: left;"><a href="edit_product.php?id='.$row['product_id'].'"><button type="button" name="edit" class="btn btn-primary edit_data"><i class="fa fa-pencil"></i></button></a></td>
                                <td width="3%" style="text-align: left;"><a href="javascript:delete_id('.$row['product_id'].')"><button type="button" class="btn btn-danger fa fa-trash"></button></a></td>
                            </tr>';
                        }
                        else
                        {
                             echo '<tr>
                                <td width="15%" style="text-align: left;">'.$row['product_name'].'</td>
                                <td width="7%" style="text-align: left;">'.$row['collection_name'].'</td>
                                <td width="25%" style="text-align: left;">'.$row['product_description'].'</td>
                                <td width="7%" style="text-align: left;">'.$row['price'].'</td>
                                <td width="5%" style="text-align: left;">'.$row['discount'].'</td>
                                <td width="5%" style="text-align: left;">'.$row['color_name'].'</td>
                                <td width="7%" style="text-align: left;">'.$row['product_type'].'</td>
                                <td width="5%" style="text-align: left;">'.$row['product_code'].'</td>
                                <td width="7%" style="text-align: left;">'.$row['material'].'</td>
                                <td width="7%" style="text-align: left;">'.$row['gender'].'</td>


                                <td width="3%" style="text-align: left;"><button type="button" class="btn btn-warning fa fa-plus-square"></button></td>

                                <td width="3%" style="text-align: left;"><a href="edit_product.php?id='.$row['product_id'].'"><button type="button" name="edit" class="btn btn-primary edit_data"><i class="fa fa-pencil"></i></button></a></td>
                                <td width="3%" style="text-align: left;"><a href="javascript:delete_id('.$row['product_id'].')"><button type="button" class="btn btn-danger fa fa-trash" disabled></button></a></td>
                        </tr>';
                        }
                   
                     
                    }
                ?>        
            </tbody>
        </table>
    </div>        
</div>


<!-- ====================================Modal to edit the data Starts========================================= -->

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
	            <form method="post" action="update_data.php">
	                <div class="row">
	                	<div class="col-md-2 col-sm-2">
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
                             <label for="product_name">Select Collection</label>
                            <select class="browser-default custom-select" id="product_collection2" name="product_collection2">
                              <!-- <option selected>Select Collection</option> -->
                              <?php
                                 $sql = "SELECT DISTINCT(collection_name) FROM tbl_collections";
                              
                                  $result = mysqli_query($conn, $sql);
                                  while($row = mysqli_fetch_array($result))
                                 {
                                  echo '<option value="' . $row["collection_name"] . '">' . $row["collection_name"] . '</option>'; 
                                 }
                                  if (!$result)
                                   {
                                      die ('SQL Error: ' . mysqli_error($conn));
                                   }
                              ?>
                            </select>
                        </div>

                        <div class="col-md-2 col-sm-2">
                            <div class="form-group">
                              <label for="product_price"> Price</label>
                              <input type="number" class="form-control" name="product_price2" id="product_price2" step=".01">
                            </div>  
                        </div>

                        <div class="col-md-2 col-sm-2">
                            <div class="form-group">
                              <label for="product_discount">Discount</label>
                              <input type="number" class="form-control" name="product_discount2" id="product_discount2" step=".01">
                            </div>  
                        </div>
                    </div>

                    <div class="row">
                         <div class="col-md-2 col-sm-2">
                            <div class="form-group">
                              <label for="product_material">Material</label>
                              <input type="text" class="form-control" name="product_material2" id="product_material2">
                            </div>  
                        </div>

                        <div class="col-md-3 col-sm-3">
                            <div class="form-group">
                              <label for="product_code">Code</label>
                              <input type="text" class="form-control" name="product_code2" id="product_code2">
                            </div>  
                        </div>

	                    <div class="col-md-3 col-sm-3">
	                        <div class="form-group">
	                          <label for="product_type">Type</label>
	                          <input type='text' class='form-control ' name='product_type2' id='product_type2'>
	                        </div>  
	                    </div>


                        <div class="col-md-2 col-sm-2">
                             <label for="product_name">Color</label>
                            <select class="browser-default custom-select" id="product_color2" name="product_color2">
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

                        <div class="col-md-2 col-sm-2">
                            <label for="Gender">Gender</label>
                            <select class="browser-default custom-select" id="product_gender2" name="product_gender2">
                                <option value="male">Male</option> 
                                <option value="female">Female</option> 
                                <option value="kids">Kids</option>
                            </select> 
                        </div>  
                    </div>

                    <div class="row">
                        <div class="col-md-6 col-sm-6">
                            <div class="form-group">
                              <label for="product_description">Description</label>
                              <textarea class='form-control' name='product_description2' id='product_description2'></textarea>
                            </div>  
                        </div>

                       <div class="col-md-6 col-sm-6">
                            <div class="form-group">
                              <label for="Keywords">Keywords</label>
                              <textarea class='form-control' name='product_keywords2' id='product_keywords2'></textarea>
                            </div>  
                        </div>
                    </div>
  
                     <div class="row">
                        <div class="col-md-3 col-sm-3">     
                        </div>
                        <div class="col-md-3 col-sm-3">  
                        </div>
                        <div class="col-md-3 col-sm-3">  
                        </div>
	                    <div class="col-md-3 col-sm-3" >
	                        <button type="submit" value="submit" id="btn_edit_products" name="btn_edit_products" class="btn btn-primary" style="float: right;">Update</button>
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
<!-- =========================================Modal to edit end here============================== -->

<!-- ==========================================Modal to show size and quantity Starts============= -->

<div class="modal fade" id="add_data_Modal_show_size">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
      
            <!-- Modal Header -->
            <div class="modal-header">
              <h4 class="modal-title">More About Product</h4>
              <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
        
        <!-- Modal body -->
            <div class="modal-body">
                <form method="post">
                    <div class="row">
                        <div class="col-md-12 col-sm-12">
                            <div class="form-group">
                              <label for="product_id">Product Id</label>
                             <input type='text' class='form-control' name='product_id3' id='product_id3' readonly="true">
                            </div>  
                        </div>

                        <div class="col-md-12 col-sm-12">
                            <table class="table" id="sizes" style="border: none;">
                                <thead class="thead-dark" style=" padding-top:2px;padding-bottom:5px;">
                                    <tr>                   
                                        <th width="50%" style="text-align: left;">Size</th>   
                                        <th width="50%" style="text-align: left;">Quantity</th>   
                                    </tr>
                                </thead>
                                <tbody>
                                    
                                </tbody>   
                            </table>
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

<!-- ==========================================Modal to show size and quantity Ends =============== -->



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
                $('#product_collection2').val(data.collection_name);
                $('#product_type2').val(data.product_type);
                $('#product_code2').val(data.product_code);
                $('#product_color2').val(data.color_name);
                $('#product_description2').val(data.product_description);
                $('#product_price2').val(data.price);
                $('#product_discount2').val(data.discount);
                $('#product_material2').val(data.material);
                $('#product_gender2').val(data.gender);
                $('#product_keywords2').val(data.product_keywords);

                $('#btn_edit_products').val("Update");
                $('#add_data_Modal').modal('show');
          },

      });

  });
</script>

<script type="text/javascript">
$(document).on('click','.show_data',function(){

    var product_id = $(this).attr("id");

    var table = document.getElementById("sizes");
    //or use :  var table = document.all.tableid;
    for(var i = table.rows.length - 1; i > 0; i--)
    {
        table.deleteRow(i);
    }

     $.ajax({
            url:'fetch_size_quantity.php',
            method:'POST',
            data: {'product_id':product_id},
            dataType:"json",
            success: function(data){
                console.log(data);

                $('#product_id3').val(data[0].product_id);

                for (var i =0; i < data.length;i++)
                {
                    console.log(data[i]);
                    console.log(data[i]['size'])
                    console.log(data[i]['product_quantity'])

                    var size = data[i]['size'];
                    var quantity = data[i]['product_quantity'];

                    var table = document.getElementById("sizes");
                    var row = table.insertRow(1);
                    var cell1 = row.insertCell(0);
                    var cell2 = row.insertCell(1);
                    cell1.innerHTML = size;
                    cell2.innerHTML = quantity;
                }

                $('#btn_show_size').val("Update");
                $('#add_data_Modal_show_size').modal('show');

          },

      });

  });
</script>

<?php
include('footer.php');
?>