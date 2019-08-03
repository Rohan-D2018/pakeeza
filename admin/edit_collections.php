<?php
$page = 'collection';
include('header.php');
require 'config.php';

if(isset($_GET['id']))
{
    $collection_id = $_GET['id'];  
}
?>

<div class="container">
    <div class="row" style="margin-top: 1%;">
    </div>
    <form action="update_data.php" method="POST" enctype="multipart/form-data">
        <div class="row text-center">
            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                <div class="clearfix" style="margin-left: 3%">
                    <img class="img-fluid" src="http://via.placeholder.com/920x470" id="collection-img"/>
                    <input type="file" name= "file" id="profile-img" style="margin-top: 3%">
                    <input type="button" id="removeImage1" value="x" class="btn-rmv1 btn btn-danger" style="margin-top: 3%;margin-left: 5%"/>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                <b class="clearfix float-left">Collection Id:</b>
                <input type="text" class="form-control clearfix" name="collection_id2" id="collection_id2" readonly="true">

                <b class="clearfix float-left">Collection Name:</b>
                <input type='text' class='form-control ' name='collection_name2' id='collection_name2' required>

                <b class="clearfix float-left">Collection Description:</b>
                <textarea class="form-control clearfix" cols=10 rows=5 name="collection_description2"  id='collection_description2' required></textarea>

                <div class="clearfix float-left">
                    <b class="clearfix float-left">Show On Langing Page:</b>
                    <input type="checkbox" name="show_on_landing_page2" id="show_on_landing_page2" value="1">  
                </div>
                <div class="clearfix float-right">
                     <button type="submit" value="submit" id="btn_edit_collections" name="btn_edit_collections" class="btn btn-primary">Update</button>
                </div>
            </div>
        </div>
    </form>    
</div>


<!-- =========================edit data modal ends here========================= -->



<script type="text/javascript">
$(document).ready(function(){

     var collection_id = '<?php echo $collection_id; ?>';

     $.ajax({
            url:'fetch.php',
            method:'POST',
            data: {'collection_id':collection_id},
            dataType:"json",
            success: function(data){
                // console.log(data)
                $('#collection_id2').val(data.collection_id);
                $('#collection_name2').val(data.collection_name);
                $('#collection_description2').val(data.collection_description);
                // $('#show_on_landing_page2').val(data.show_on_landing_page).checked = true;
                $('#collection-img').attr('src', 'uploads/collections/' + data.collection_picture_url);
                console.log(data.show_on_landing_page)

                var show_on_landing_page_flag = data.show_on_landing_page 
                if(show_on_landing_page_flag ==1)
                {
                    // console.log("inside");
                    document.getElementById('show_on_landing_page2').checked = true;
                }
                else{
                    document.getElementById('show_on_landing_page2').checked = false;
                }
          },

      });

  });

</script>

<script>
function readURL(input) {
    // document.getElementById(removeImage1).style.display = 'block';
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        
        reader.onload = function (e) {
            $('#collection-img').attr('src', e.target.result);
        }
        reader.readAsDataURL(input.files[0]);
    }
}

$("#profile-img").change(function(){
    readURL(this);
});
</script>

<?php
include('footer.php');
?>