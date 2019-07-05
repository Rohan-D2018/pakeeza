<?php
$page = 'customer_address';
require 'config.php';
include('header.php');
//$user_id = $_GET["id"]
?>


<div class="container-fluid">
	<div class="row" style="margin-top: 1%;">
    </div>
    <h3 style="color: #00529b;">Customers </h3> 
    <div class="table-responsive">    
        <table class="table display" id="products" style="margin-top: 20px; width:100%">
            <thead class="thead-dark" style="background-color: #e8eaf6; padding-top:2px;padding-bottom:5px;">
                <tr>                   
                    <th width="8%" style="text-align: left;">User Address ID</th>
                    <th width="8%" style="text-align: left;">User ID</th>
                    <th width="8%" style="text-align: left;">Country</th>
                    <th width="9%" style="text-align: left;">State</th>
                    <th width="8%" style="text-align: left;">City</th>
                    <th width="7%" style="text-align: left;">Zip</th>
                    <th width="7%" style="text-align: left;">Phone</th>
                    <th width="14%" style="text-align: left;">Address 1</th>
                    <th width="14%" style="text-align: left;">Address 2</th>
                </tr>
            </thead>
            <tbody >
                <?php
		    if(isset($_GET['user_id'])
		    {
                    	$sql = "select * from tbl_user_details user_id='".$_GET['user_id']."'";
			$result = mysqli_query($conn, $sql);
                    }
		    else if(isset($_GET['user_address_id'])
		    {
                    	$sql = "select * from tbl_user_details user_address_id='".$_GET['user_address_id']."'";
			$result = mysqli_query($conn, $sql);
                    }	
                    
                    
                    if (!$result) 
                    {
                        die ('SQL Error: ' . mysqli_error($conn));
                    }
                    
                    while ($row = mysqli_fetch_array($result))
                    { 
                            echo '<tr>
                                <td width="8%" style="text-align: left;">'.$row['user_address_id'].'</td>
                                <td width="8%" style="text-align: left;">'.$row['user_id'].'</td>
                                <td width="8%" style="text-align: left;">'.$row['country'].'</td>
                                <td width="9%" style="text-align: left;">'.$row['state'].'</td>
                                <td width="8%" style="text-align: left;">'.$row['city'].'</td>
                                <td width="7" style="text-align: left;">'.$row['zip'].'</td>
                                <td width="7%" style="text-align: left;">'.$row['phone'].'</td>
                                <td width="14%" style="text-align: left;">'.$row['address_1'].'</td>
                                <td width="14%" style="text-align: left;">'.$row['address_2'].'</td>
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
