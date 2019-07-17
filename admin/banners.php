<?php
$page = 'banners';
include('header.php');
require 'config.php';
?>

<div class="container">
    <div class="row" style="margin-top: 1%;">
    </div>
    <form action="admin_banners.php" method="POST" enctype="multipart/form-data">
        <div class="row text-center">
            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                <div class="clearfix" style="margin-left: 3%">
                    <img class="img-fluid" src="http://via.placeholder.com/920x470" id="profile-img-tag"/>
                    <input type="file" name= "file" id="profile-img" style="margin-top: 3%">
                    <input type="button" id="removeImage1" value="x" class="btn-rmv1 btn btn-danger" style="margin-top: 3%;margin-left: 5%"/>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                    <b class="clearfix float-left">Banner Title:</b>
                    <input type="text" class="form-control clearfix" name="banner_title" required>

                    <b class="clearfix float-left">Banner Link:</b>
                    <input type="textbox" class="form-control clearfix" name="banner_link" required>
                <div class="clearfix float-left">
                    <input type="submit" value="Add Banner" class="btn btn-success" style="margin-bottom: 10px;">
                </div>
            </div>
        </div>
    </form>    
</div>

<div class="container-fluid">
    <div class="row" style="margin-top: 1%;">
    </div>
    
    <table class="table display" id="banners" style="margin-top: 20px; width:100%">
        <thead class="thead-dark" style="background-color: #e8eaf6; padding-top:2px;padding-bottom:5px;">
            <tr>                   
                <th width="20%" style="text-align: left;">Banner Title</th>
                <th width="40%" style="text-align: left;">Banner Link</th>
                <th width="15%" style="text-align: right;"></th>
                <th width="15%" style="text-align: left;"></th>
            </tr>
        </thead>
        <tbody >
            <?php
                $sql = "SELECT banner_id,banner_title,banner_link FROM tbl_banners";
                
                $result = mysqli_query($conn, $sql);
                
                if (!$result) 
                {
                    die ('SQL Error: ' . mysqli_error($conn));
                }
                
                while ($row = mysqli_fetch_array($result))
                { 
                    
                // if equal to current
                    echo '<tr>
                        <td width="20%" style="text-align: left;">'.$row['banner_title'].'</td>
                        <td width="40%" style="text-align: left;">'.$row['banner_link'].'</td>

                        <td width="3%" style="text-align: left;"><a href="edit_banners.php?id='.$row['banner_id'].'"><button type="button" name="edit" class="btn btn-primary edit_data"><i class="fa fa-pencil"></i></button></a></td>

                        <td width="15%" style="text-align: left;"><a href="javascript:delete_id('.$row['banner_id'].')"><button type="button" class="btn btn-danger fa fa-trash"></button></a></td>
                    </tr>';
                 
                }
            ?>        
        </tbody>
    </table>    
</div>



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
      window.location.href='delete_banners.php?delete_id='+id;
     }
    }   
</script>


<script>
    $(document).ready(function() {
    $('#banners').DataTable({
    "lengthMenu": [50, 75, 100 ], 
    "paging":   true,
    } );
    var topRow = $('#banners_wrapper').children().first();
    topRow.children().first().attr('class','col-sm-3');
    topRow.children().eq(1).attr('class','col-sm-6');
    var searchBar = $('#banners_filter').children().first();
    searchBar.children().first().css('width','300px');

    var lengthMenu =  $('#banners_length')
    lengthMenu.css('display','none');
} );

</script>

<?php
include('footer.php');
?>