<?php
$page = 'keywords';
include('header.php');
require 'config.php';
?>
<div class="container-fluid">
    <div class="row" style="margin-top: 1%;">
    </div>
    <form action="admin_keyword.php" method="POST">
        <div class="row text-center" style="margin-left: 3%">
            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                
                <div class="row">
                    <b class="clearfix">Add Keyword</b>
                    <input type="text" class="form-control clearfix" name="keyword" required>
                </div>

                <div class="row clearfix">
                    <input type="submit" value="Add keyword" class="btn btn-success" style="margin-bottom: 10px; float: right;">
                </div>
            </div>
            <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
                <div class="row" style="margin-top: 1%;">
                </div>
                <!-- <h3 style="color: #00529b;">All Sizes </h3>  -->   
                <table class="table display" id="keyword" style="margin-top: 20px; width:100%">
                    <thead class="thead-dark" style="background-color: #e8eaf6; padding-top:2px;padding-bottom:5px;">
                        <tr>                   
                            <th width="30%" style="text-align: left;">Keyword</th>
                           
                            <th width="15%" style="text-align: left;"></th>
                            <th width="15%" style="text-align: left;"></th>
                        </tr>
                    </thead>
                    <tbody >
                        <?php
                            $sql = "SELECT keyword_id,keyword  FROM tbl_keywords";
                            
                            $result = mysqli_query($conn, $sql);
                            
                            if (!$result) 
                            {
                                die ('SQL Error: ' . mysqli_error($conn));
                            }
                            
                            while ($row = mysqli_fetch_array($result))
                            { 
                                
                            // if equal to current
                                echo '<tr>
                                    <td width="30%" style="text-align: left;">'.$row['keyword'].'</td>
                                   
                                    <td width="15%" style="text-align: right;"><button type="button" name="edit"  id="'.$row['keyword_id'].'" class="btn btn-primary edit_data"><i class="fa fa-pencil"></td>
                                    <td width="15%" style="text-align: right;"><a href="javascript:delete_id('.$row['keyword_id'].')"><button type="button" class="btn btn-danger fa fa-trash"></button></a></td>
                                </tr>';
                            }
                        ?>        
                    </tbody>
                </table>    
            </div>
        </div>
    </form>    
</div>

<!-- ====================================Data modal to edit the data============================================= -->

<div class="modal fade" id="add_data_Modal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
      
            <!-- Modal Header -->
            <div class="modal-header">
              <h4 class="modal-title">Edit Keyword </h4>
              <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
        
        <!-- Modal body -->
            <div class="modal-body">
                <form method="post" action="update_data.php">
                    <div class="row">
                        <div class="col-md-3 col-sm-3">
                            <div class="form-group">
                              <label for="keyword_id">Keyword Id</label>
                             <input type='text' class='form-control ' name='keyword_id2' id='keyword_id2' readonly="true">
                            </div>  
                        </div>

                        <div class="col-md-3 col-sm-3">
                            <div class="form-group">
                              <label for="keyword">Keyword</label>
                             <input type='text' class='form-control ' name='keyword2' id='keyword2'>
                            </div>  
                        </div>

                        <div  style="float: right;">
                            <button type="submit" value="submit" id="btn_edit_keyword" name="btn_edit_keyword" class="btn btn-primary">Update</button>
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

<!-- =========================edit data modal ends here========================= -->

<script>
    function delete_id(id)
    {
     if(confirm('Sure To Remove This Record ?'))
     {
      window.location.href='delete_keyword.php?delete_id='+id;
     }
    }   
</script>

<script>
    $(document).ready(function() {
    $('#keyword').DataTable({
    "lengthMenu": [50, 75, 100 ], 
    "paging":   true,
    } );
    var topRow = $('#keyword_wrapper').children().first();
    topRow.children().first().attr('class','col-sm-3');
    topRow.children().eq(1).attr('class','col-sm-3');
    var searchBar = $('#keyword_filter').children().first();
    searchBar.children().first().css('width','200px');

    var lengthMenu =  $('#keyword_length')
    lengthMenu.css('display','none');
} );

</script>


<script type="text/javascript">
    $(document).on('click','.edit_data',function(){

        var keyword_id = $(this).attr("id");

         $.ajax({
                url:'fetch.php',
                method:'POST',
                data: {'keyword_id':keyword_id},
                dataType:"json",
                success: function(data){
                    console.log(data);
                    $('#keyword_id2').val(data.keyword_id);
                    $('#keyword2').val(data.keyword);
                    $('#btn_edit_color').val("Update");
                    $('#add_data_Modal').modal('show');
              },

        });

    });
</script>

<?php
include('footer.php');
?>