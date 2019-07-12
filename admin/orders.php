<?php
$page = 'order';
include('header.php'); 
include('config.php');
?>


<div class="container-fluid">
    <div class="row" style="margin-top: 1%;">
    </div>
    <h3 style="color: #00529b;">All Orders </h3> 
    <div class="table-responsive">    
        <table class="table display" id="products" style="margin-top: 20px; width:100%">
            <thead class="thead-dark" style="background-color: #e8eaf6; padding-top:2px;padding-bottom:5px;">
                <tr> 
                    <th width="15%" style="text-align: left;">order id</th>                  
                    <th width="15%" style="text-align: left;">User</th>
                    <th width="25%" style="text-align: left;">Product</th>
                    <th width="7%" style="text-align: left;">Price</th>
                    <th width="5%" style="text-align: left;">Quantity</th>
                    <th width="6%" style="text-align: left;">Color</th>
                    <th width="7%" style="text-align: left;">Size</th>
                    <th width="3%" style="text-align: right;"></th>
                </tr>
            </thead>
            <tbody >
                <?php
                    $sql = "SELECT tbl_order_details.order_id, tbl_order_details.price, tbl_order_details.size,tbl_order_details.color, tbl_order_details.quantity, tbl_products.product_name,tbl_users_credentials.user_email
                            FROM tbl_order_details
                            INNER JOIN tbl_products ON tbl_order_details.product_id = tbl_products.product_id
                            INNER JOIN tbl_orders ON tbl_order_details.order_id = tbl_orders.order_id
                            INNER JOIN tbl_users_credentials ON tbl_orders.user_id = tbl_users_credentials.user_id";
                    
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
                                <td width="15%" style="text-align: left;">'.$row['order_id'].'</td>
                                <td width="7%" style="text-align: left;">'.$row['user_email'].'</td>
                                <td width="25%" style="text-align: left;">'.$row['product_name'].'</td>
                                <td width="7%" style="text-align: left;">'.$row['price'].'</td>
                                <td width="5%" style="text-align: left;">'.$row['quantity'].'</td>                             
                                <td width="5%" style="text-align: left;">'.$row['color'].'</td>
                                <td width="5%" style="text-align: left;">'.$row['size'].'</td>

                                <td width="3%" style="text-align: left;"><a href="edit_orders.php?id='.$row['order_id'].'"><button type="button" name="edit" class="btn btn-primary edit_data"><i class="fa fa-pencil"></i></button></a></td>
                               
                            </tr>';
                        }
                        else
                        {
                             echo '<tr>
                                <td width="15%" style="text-align: left;">'.$row['order_id'].'</td>
                                <td width="7%" style="text-align: left;">'.$row['user_email'].'</td>
                                <td width="25%" style="text-align: left;">'.$row['product_name'].'</td>
                                <td width="7%" style="text-align: left;">'.$row['price'].'</td>
                                <td width="5%" style="text-align: left;">'.$row['quantity'].'</td>                             
                                <td width="5%" style="text-align: left;">'.$row['color'].'</td>
                                <td width="5%" style="text-align: left;">'.$row['size'].'</td>


                                <td width="3%" style="text-align: left;"><a href="edit_product.php?id='.$row['order_id'].'"><button type="button" name="edit" class="btn btn-primary edit_data"><i class="fa fa-pencil"></i></button></a></td>
                                
                        </tr>';
                        }
                   
                     
                    }
                ?>        
            </tbody>
        </table>
    </div>        
</div>



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
    "lengthMenu": [50, 75, 100 ], 
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


<?php
include('footer.php');
?>