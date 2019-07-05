<?php
$page = 'collection';
include('header.php');
require 'config.php';
?>

<div class="container">
    <div class="row" style="margin-top: 1%;">
    </div>
    <form action="admin_collection.php" method="POST" enctype="multipart/form-data">
        <div class="row text-center">
            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                <div class="clearfix" style="margin-left: 3%">
                    <img class="img-fluid" src="http://via.placeholder.com/920x470" id="profile-img-tag"/>
                    <input type="file" name= "file" id="profile-img" style="margin-top: 3%">
                    <input type="button" id="removeImage1" value="x" class="btn-rmv1 btn btn-danger" style="margin-top: 3%;margin-left: 5%"/>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                    <b class="clearfix float-left">Collection Name:</b>
                    <input type="text" class="form-control clearfix" name="collection_name" required>

                    <b class="clearfix float-left">Collection Description:</b>
                    <input type="textbox" class="form-control clearfix" name="collection_description" required>

                <div class="clearfix float-left">
                    <input type="submit" value="Add Collection" class="btn btn-success" style="margin-bottom: 10px;">
                </div>
            </div>
        </div>
    </form>    
</div>

<div class="container-fluid">
    <div class="row" style="margin-top: 1%;">
    </div>
    
    <table class="table display" id="collections" style="margin-top: 20px; width:100%">
        <thead class="thead-dark" style="background-color: #e8eaf6; padding-top:2px;padding-bottom:5px;">
            <tr>                   
                <th width="20%" style="text-align: left;">Collection Name</th>
                <th width="40%" style="text-align: left;">Collection Description</th>
                <th width="15%" style="text-align: right;"></th>
                <th width="15%" style="text-align: left;"></th>
            </tr>
        </thead>
        <tbody >
            <?php
                $sql = "SELECT collection_id,collection_name,collection_description FROM tbl_collections WHERE delete_status = 0";
                
                $result = mysqli_query($conn, $sql);
                
                if (!$result) 
                {
                    die ('SQL Error: ' . mysqli_error($conn));
                }
                
                while ($row = mysqli_fetch_array($result))
                { 
                    
                // if equal to current
                    echo '<tr>
                        <td width="20%" style="text-align: left;">'.$row['collection_name'].'</td>
                        <td width="40%" style="text-align: left;">'.$row['collection_description'].'</td>
                        <td width="15%" style="text-align: right;"><button type="button" name="edit"  id="'.$row['collection_id'].'" class="btn btn-primary edit_data"><i class="fa fa-pencil"></td>
                        <td width="15%" style="text-align: left;"><a href="javascript:delete_id('.$row['collection_id'].')"><button type="button" class="btn btn-danger fa fa-trash"></button></a></td>
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
              <h4 class="modal-title">Edit Collection details</h4>
              <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
        
        <!-- Modal body -->
            <div class="modal-body">
                <form method="post" action="update_data.php">
                    <div class="row">
                        <div class="col-md-3 col-sm-3">
                            <div class="form-group">
                              <label for="colection_name">Collection Id</label>
                             <input type='text' class='form-control ' name='collection_id2' id='collection_id2' readonly="true">
                            </div>  
                        </div>

                        <div class="col-md-3 col-sm-3">
                            <div class="form-group">
                              <label for="collection_name">Collection Name</label>
                             <input type='text' class='form-control ' name='collection_name2' id='collection_name2'>
                            </div>  
                        </div>
                          
                    
                        <div class="col-md-3 col-sm-3">
                            <div class="form-group">
                              <label for="collection_description">Collection Description</label>
                              <input type='text' class='form-control ' name='collection_description2' id='collection_description2'>
                            </div>  
                        </div>

                      
                        <div  style="float: right;">
                            <button type="submit" value="submit" id="btn_edit_collections" name="btn_edit_collections" class="btn btn-primary">Update</button>
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




<script type="text/javascript">
    function readURL(input) {
        // document.getElementById(removeImage1).style.display = 'block';
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            
            reader.onload = function (e) {
                $('#profile-img-tag').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }

    $("#profile-img").change(function(){
        readURL(this);
    });

    // document.getElementById(removeImage1).style.display = 'block';
    $("#removeImage1").click(function(e) {
        e.preventDefault();
        $("#profile-img").val("");
        $("#profile-img-tag").attr("src", "");
        // $('.preview1').removeClass('it');
        // $('.btn-rmv1').removeClass('rmv');
    });


</script>

<script>
    function delete_id(id)
    {
     if(confirm('Sure To Remove This Record ?'))
     {
      window.location.href='delete_collection.php?delete_id='+id;
     }
    }   
</script>


<script>
    $(document).ready(function() {
    $('#collections').DataTable({
    "lengthMenu": [50, 75, 100 ], 
    "paging":   true,
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

    var collection_id = $(this).attr("id");

     $.ajax({
            url:'fetch.php',
            method:'POST',
            data: {'collection_id':collection_id},
            dataType:"json",
            success: function(data){
                console.log(data);
                $('#collection_id2').val(data.collection_id);
                $('#collection_name2').val(data.collection_name);
                $('#collection_description2').val(data.collection_description);
                $('#btn_edit_collections').val("Update");
                $('#add_data_Modal').modal('show');
          },

      });

  });
</script>
<?php
include('footer.php');
?>