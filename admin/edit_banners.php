<?php
$page = 'banners';
include('header.php');
require 'config.php';

if(isset($_GET['id']))
{
    $banner_id = $_GET['id'];
   
}
?>


<div class="container">
    <div class="row" style="margin-top: 1%;">
    </div>
    <form action="update_data.php" method="POST" enctype="multipart/form-data">
        <div class="row text-center">
            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                <div class="clearfix" style="margin-left: 3%">
                    <img class="img-fluid" src="http://via.placeholder.com/920x470" id="sub-branch-img"/>
                    <input type="file" name= "file" id="profile-img" style="margin-top: 3%">
                    <input type="button" id="removeImage1" value="x" class="btn-rmv1 btn btn-danger" style="margin-top: 3%;margin-left: 5%"/>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">

                    <b class="clearfix float-left">Banner Id:</b>
                    <input type="text" class="form-control clearfix" name="banner_id2" id="banner_id2" readonly="true">

                    <b class="clearfix float-left">Banner Title:</b>
                    <input type="text" class="form-control clearfix" name="banner_link2" id="banner_link2" required>

                    <b class="clearfix float-left">Banner URL:</b>
                    <textarea class="form-control clearfix" cols=10 rows=5 name="banner_title2" id="banner_title2" required></textarea>

                    <b class="clearfix float-left">Banner Order:</b>
                    <input type="text" class="form-control clearfix" name="banner_orders2" id="banner_orders2" required>

                    <div class="clearfix float-left">
                        <button type="submit" value="submit" id="btn_edit_banner" name="btn_edit_banner" class="btn btn-primary" style="float: right;">Update</button>
                    </div>
            </div>
        </div>
    </form>    
</div>



<!-- =========================edit data modal ends here========================= -->



<script type="text/javascript">
$(document).ready(function(){

     var banner_id = '<?php echo $banner_id; ?>';

     $.ajax({
            url:'fetch.php',
            method:'POST',
            data: {'banner_id':banner_id},
            dataType:"json",
            success: function(data){
                console.log(data)
                $('#banner_id2').val(data.banner_id);
                $('#banner_title2').val(data.banner_title);
                $('#banner_link2').val(data.banner_link);
                $('#banner_orders2').val(data.banner_order);
                $('#sub-branch-img').attr('src', 'uploads/banners/' + data.banner_picture_url);
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
            $('#sub-branch-img').attr('src', e.target.result);
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