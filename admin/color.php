<?php
$page = 'color';
include('header.php');
require 'config.php';
?>
<div class="container-fluid">
    <div class="row" style="margin-top: 1%;">
    </div>
    <form action="admin_color.php" method="POST">
        <div class="row text-center" style="margin-left: 3%">
            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                
                <div class="row">
                    <b class="clearfix">Add Color:</b>
                    <input type="text" class="form-control clearfix" name="product_color" required>
                    <b class="clearfix">Add Color Hex Code:</b>
                    <input type="text" class="form-control clearfix" name="product_color_hex" required>
                </div>

                <div class="row clearfix">
                    <input type="submit" value="Add color" class="btn btn-success" style="margin-bottom: 10px; float: right;">
                </div>
            </div>
            <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
                <div class="row" style="margin-top: 1%;">
                </div>
                <!-- <h3 style="color: #00529b;">All Sizes </h3>  -->   
                <table class="table display" id="colors" style="margin-top: 20px; width:100%">
                    <thead class="thead-dark" style="background-color: #e8eaf6; padding-top:2px;padding-bottom:5px;">
                        <tr>                   
                            <th width="30%" style="text-align: left;">Color Name</th>
                            <th width="30%" style="text-align: left;">Color Hex code</th>
                            <th width="15%" style="text-align: left;"></th>
                        </tr>
                    </thead>
                    <tbody >
                        <?php
                            $sql = "SELECT color_id, color_name,product_color_hex  FROM tbl_product_color";
                            
                            $result = mysqli_query($conn, $sql);
                            
                            if (!$result) 
                            {
                                die ('SQL Error: ' . mysqli_error($conn));
                            }
                            
                            while ($row = mysqli_fetch_array($result))
                            { 
                                
                            // if equal to current
                                echo '<tr>
                                    <td width="30%" style="text-align: left;">'.$row['color_name'].'</td>
                                    <td width="30%" style="text-align: left;">'.$row['product_color_hex'].'</td>
                                    <td width="15%" style="text-align: right;"><a href="javascript:delete_id('.$row['color_id'].')"><button type="button" class="btn btn-danger fa fa-trash"></button></a></td>
                                </tr>';
                            }
                        ?>        
                    </tbody>
                </table>    
            </div>
        </div>
    </form>    
</div>

<script>
    function delete_id(id)
    {
     if(confirm('Sure To Remove This Record ?'))
     {
      window.location.href='delete_color.php?delete_id='+id;
     }
    }   
</script>

<script>
    $(document).ready(function() {
    $('#colors').DataTable({
    "lengthMenu": [ 7,10, 25, 50, 75, 100 ], 
    "paging":   true,
    } );
    var topRow = $('#colors_wrapper').children().first();
    topRow.children().first().attr('class','col-sm-3');
    topRow.children().eq(1).attr('class','col-sm-3');
    var searchBar = $('#colors_filter').children().first();
    searchBar.children().first().css('width','200px');

    var lengthMenu =  $('#colors_length')
    lengthMenu.css('display','none');
} );

</script>

<?php
include('footer.php');
?>