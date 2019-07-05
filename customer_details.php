<?php
$page = 'customer';
require 'config.php';
include('header.php');
?>


<div class="container-fluid">
	<div class="row" style="margin-top: 1%;">
    </div>
    <h3 style="color: #00529b;">Customers </h3> 
    <div class="table-responsive">    
        <table class="table display" id="products" style="margin-top: 20px; width:100%">
            <thead class="thead-dark" style="background-color: #e8eaf6; padding-top:2px;padding-bottom:5px;">
                <tr>                   
                    <th width="20%" style="text-align: left;">User ID</th>
                    <th width="20%" style="text-align: left;">First Name</th>
                    <th width="20%" style="text-align: left;">Last Name</th>
                    <th width="20%" style="text-align: left;">Email Address</th>
                    <th width="17%" style="text-align: left;">Registration Date</th>
		    <th width="3%" style="text-align: left;"></th>
                </tr>
            </thead>
            <tbody >
                <?php
                    $sql = "select * from tbl_user_credentials inner join tbl_user_details on tbl_user_credentials.user_id = tbl_user_details.user_id";
                    
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
                                <td width="20%" style="text-align: left;"><a href="user_address_details.php?user_id='.$row['user_id'].'>'.$row['user_id'].'</a></td>
                                <td width="20%" style="text-align: left;">'.$row['first_name'].'</td>
                                <td width="20%" style="text-align: left;">'.$row['last_name'].'</td>
                                <td width="20%" style="text-align: left;">'.$row['user_email'].'</td>
                                <td width="17%" style="text-align: left;">'.$row['registration_date'].'</td>
                            </tr>';
                        }
                        else
                        {
                            echo '<tr>
                                <td width="20%" style="text-align: left;"><a href="user_address_details.php?user_id='.$row['user_id'].'>'.$row['user_id'].'</a></td>
                                <td width="20%" style="text-align: left;">'.$row['first_name'].'</td>
                                <td width="20%" style="text-align: left;">'.$row['last_name'].'</td>
                                <td width="20%" style="text-align: left;">'.$row['user_email'].'</td>
                                <td width="17%" style="text-align: left;">'.$row['registration_date'].'</td>
                            </tr>';
                        }
                   
                     
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
