<?php
$page = 'deleted_records';
include('header.php');
require 'config.php';
?>

<div class="container-fluid">
    <div class="row" style="margin-top: 1%;">
    </div>
    
    <table class="table display" id="collections" style="margin-top: 20px; width:100%">
        <thead class="thead-dark" style="background-color: #e8eaf6; padding-top:2px;padding-bottom:5px;">
            <tr>                   
                <th width="12%" style="text-align: left;">Name</th>
                <th width="7%" style="text-align: left;">Collection</th>
                <th width="5%" style="text-align: left;">Branch</th>
                <th width="7%" style="text-align: left;">Price</th>
                <th width="3%" style="text-align: left;">Discount</th>
                <th width="6%" style="text-align: left;">Color</th>
                <th width="7%" style="text-align: left;">Type</th>
                <th width="5%" style="text-align: left;">Code</th>
                <th width="7%" style="text-align: left;">Material</th>
                <th width="7%" style="text-align: left;">Gender</th>
                <th width="7%" style="text-align: left;">Undo Product</th>
            </tr>
        </thead>
        <tbody>
            <?php 
                $sql = "SELECT tbl_products.product_id,tbl_products.product_name,tbl_products.product_type,tbl_products.price,tbl_products.product_code,tbl_products.discount,tbl_products.product_description,tbl_products.material,tbl_products.gender, tbl_collections.collection_name, tbl_product_color.color_name,tbl_sub_branch.sub_branch_name
                      FROM tbl_products 
                      INNER JOIN tbl_collections ON tbl_products.collection_id = tbl_collections.collection_id
                      LEFT JOIN tbl_sub_branch ON tbl_products.sub_branch_id = tbl_sub_branch.sub_branch_id
                      INNER JOIN tbl_product_color_mapping ON tbl_products.product_id = tbl_product_color_mapping.product_id
                      Left JOIN tbl_product_color ON tbl_product_color_mapping.color_id = tbl_product_color.color_id
                      WHERE tbl_products.delete_status =1";
                
                $result = mysqli_query($conn, $sql);
                
                if (!$result) 
                {
                    die ('SQL Error: ' . mysqli_error($conn));
                }
                
                while ($row = mysqli_fetch_array($result))
                { 
                    
                // if equal to current
                    echo '<tr>
                        <td width="20%" style="text-align: left;">'.$row['product_name'].'</td>
                        <td width="10%" style="text-align: left;">'.$row['collection_name'].'</td>
                        <td width="10%" style="text-align: left;">'.$row['sub_branch_name'].'</td>
                        <td width="7%" style="text-align: left;">'.$row['price'].'</td>
                        <td width="3%" style="text-align: left;">'.$row['discount'].'</td>
                        <td width="5%" style="text-align: left;">'.$row['color_name'].'</td>
                        <td width="7%" style="text-align: left;">'.$row['product_type'].'</td>
                        <td width="5%" style="text-align: left;">'.$row['product_code'].'</td>
                        <td width="10%" style="text-align: left;">'.$row['material'].'</td>
                        <td width="7%" style="text-align: left;">'.$row['gender'].'</td>
                        <td width="15%" style="text-align: center;"><button type="button" name="edit"  id="'.$row['product_id'].'" class="btn btn-primary edit_data"><i class="fa fa-undo"></td>
                    </tr>';
                 
                }
            ?>        
        </tbody>
    </table>    
</div>



<script>
    $(document).ready(function() {
    $('#collections').DataTable({
    "lengthMenu": [15, 75, 100 ], 
    "paging":   true,
    "stateSave": true,
    } );
    var topRow = $('#collections_wrapper').children().first();
    topRow.children().first().attr('class','col-sm-3');
    topRow.children().eq(1).attr('class','col-sm-6');
    var searchBar = $('#collections_filter').children().first();
    searchBar.children().first().css('width','300px');

    var lengthMenu =  $('#collections_length')
    lengthMenu.css('display','none');
} );

</script>


<script type="text/javascript">
$(document).on('click','.edit_data',function(){

    var product_id = $(this).attr("id");

     $.ajax({
            url:'undo_product.php',
            method:'POST',
            data: {'product_id':product_id},
            // dataType:"json",
            success: function(data){
                console.log(data);
                window.location='deleted_records.php';
          },

      });

  });
</script>

<?php
include('footer.php');
?>