<?php
$page = 'order';
require 'admin/config.php';
include('header.php');
?>


<div class="container-fluid">
	<div class="row" style="margin-top: 1%;">
    </div>
    <h3 style="color: #00529b;">Orders </h3> 
    <div class="table-responsive">    
        <table class="table display" id="products" style="margin-top: 20px; width:100%">
            <thead class="thead-dark" style="background-color: #e8eaf6; padding-top:2px;padding-bottom:5px;">
                <tr>                   
                    <th width="8%" style="text-align: left;">Order ID</th>
                    <th width="7%" style="text-align: left;">Product ID</th>
                    <th width="8%" style="text-align: left;">User Address ID</th>
                    <th width="8%" style="text-align: left;">Order Number</th>
                    <th width="5%" style="text-align: left;">Order Date</th>
                    <th width="6%" style="text-align: left;">Shipping Date</th>
                    <th width="9%" style="text-align: left;">Shipping ID</th>
                    <th width="5%" style="text-align: left;">Order Tax</th>
                    <th width="9%" style="text-align: left;">Payment ID</th>
                    <th width="7%" style="text-align: left;">Payment Date</th>
                    <th width="6%" style="text-align: left;">Payment Status</th>
                    <th width="7%" style="text-align: left;">Transaction Status</th>
                </tr>
            </thead>
            <tbody >
                <?php
                    $sql = "select * from tbl_orders 
			    INNER JOIN tbl_order_details on tbl_orders.order_id=tbl_order_details.order_id
			    INNER JOIN tbl_payment on tbl_orders.payment_id = tbl_payment.payment_id where user_id=".$_GET["user_id"];
                    
                    $result = mysqli_query($conn, $sql);
                    
                    if (!$result) 
                    {
                        die ('SQL Error: ' . mysqli_error($conn));
                    }
                    
                    while ($row = mysqli_fetch_array($result))
                    { 
                        
                            echo '<tr>
                                <td width="8%" style="text-align: left;">'.$row['order_id'].'</td>
                                <td width="7%" style="text-align: left;"><a href="product_details.php?id='.$row['product_id'].'">'.$row['product_id'].'</a></td>
                                <td width="8%" style="text-align: left;"><a href="user_address_details.php?user_address_id='.$row['user_address_id'].'">'.$row['user_address_id'].'</a></td>
                                <td width="7%" style="text-align: left;">'.$row['order_number'].'</td>
                                <td width="5%" style="text-align: left;">'.$row['order_date'].'</td>
                                <td width="6%" style="text-align: left;">'.$row['shipping_date'].'</td>
                                <td width="7%" style="text-align: left;">'.$row['shipping_id'].'</td>
                                <td width="5%" style="text-align: left;">'.$row['order_tax'].'</td>
                                <td width="7%" style="text-align: left;">'.$row['payment_id'].'</td>
                                <td width="7%" style="text-align: left;">'.$row['payment_date'].'</td>
                                <td width="6%" style="text-align: left;">'.$row['payment_status'].'</td>
                                <td width="7%" style="text-align: left;">'.$row['transaction_status'].'</td>

                            </tr>';
			
                  
                    }
                ?>        
            </tbody>
        </table>
    </div>        
</div>



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


<?php
include('footer.php');
?>
