<?php
$page = 'manage_users';
require 'config.php';
include('header.php');

if ((!in_array("admin", $_SESSION['access_role'], TRUE)))
{
    header('Location:index.php');
    exit();

} 
?>

<div class="container-fluid">
	<?php
        //Add user status message
        include('functions.php');
        display_message();
    ?> 
	<div class="row" style="margin-top: 1%;">
    </div>
    <h3 style="color: #00529b;margin-bottom: 2%;margin-left: 3%; margin-left: 3%;">Add users </h3>
	<form method="POST">
    	<div class="row text-center" style="margin-left: 3%">
        	<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
            
                <div class="row">
                    <b class="clearfix">Username:</b>
                    <input type="text" class="form-control clearfix" name="admin_username" required>
                </div>

                <div class="row">
                    <b class="clearfix">Password:</b>
                    <input type="password" class="form-control clearfix" name="admin_password" required>
                </div>

                <div class="row">
                    <b class="clearfix">Retype Password:</b>
                    <input type="password" class="form-control clearfix" name="admin_password2" required>
                </div>

                <div class="row">
                    <b class="clearfix">Access Role:</b>
                    <select class="browser-default custom-select" id="admin_access_role" name="admin_access_role">
                      	<option selected>Select Access Role</option>
                     	<option value="admin">Admin</option>
                      	<option value="system_user">System User</option> 
                    </select>
                </div>

                <div class="row clearfix">
                    <input type="submit" value="Add User" name="btn_add_user" class="btn btn-success" style="margin-bottom: 10px; float: right;">
                </div>
       		 </div>
        	<div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
                <div class="row" style="margin-top: 1%;">
                </div>
				<table class="table display" id="products" style="margin-top: 0px; width:100%">
			        <thead class="thead-dark" style="background-color: #e8eaf6; padding-top:2px;padding-bottom:5px;">
			            <tr>                   
			                <th width="30%" style="text-align: left;">Username</th>
			                <th width="30%" style="text-align: left;">Access Role</th>
			                <th width="15%" style="text-align: right;"></th>
			                <th width="15%" style="text-align: left;"></th>
			            </tr>
			        </thead>
			        <tbody >
			            <?php
			                $sql = "SELECT admin_id,admin_username,admin_access_role FROM tbl_admin_panel";
			                
			                $result = mysqli_query($conn, $sql);
			                
			                if (!$result) 
			                {
			                    die ('SQL Error: ' . mysqli_error($conn));
			                }
			                
			                while ($row = mysqli_fetch_array($result))
			                { 
			                   if($row['admin_username']==$_SESSION['username'])
                                {
    			                    echo '<tr>
    			                        <td width="30%" style="text-align: left;">'.$row['admin_username'].'</td>
    			                        <td width="30%" style="text-align: left;">'.$row['admin_access_role'].'</td>
    			                        <td width="15%" style="text-align: right;"><button type="button" name="edit"  id="'.$row['admin_id'].'" class="btn btn-primary edit_data"><i class="fa fa-pencil"></td>
    			                        <td width="15%" style="text-align: right;"><a href="javascript:delete_id('.$row['admin_id'].')"><button type="button" class="btn btn-danger fa fa-trash" disabled></button></a></td>
    			                    </tr>';
                                }

                                else
                                {
                                    echo '<tr>
                                        <td width="30%" style="text-align: left;">'.$row['admin_username'].'</td>
                                        <td width="30%" style="text-align: left;">'.$row['admin_access_role'].'</td>
                                        <td width="15%" style="text-align: right;"><button type="button" name="edit"  id="'.$row['admin_id'].'" class="btn btn-primary edit_data"><i class="fa fa-pencil"></td>
                                        <td width="15%" style="text-align: right;"><a href="javascript:delete_id('.$row['admin_id'].')"><button type="button" class="btn btn-danger fa fa-trash" disables></button></a></td>
                                    </tr>';

                                }    
			                }    
			            ?>        
			        </tbody>
				</table>
			</div>
		</div>
	</form>			
</div>
  
<?php
require 'config.php';
if (isset($_POST['btn_add_user'])) {
  add_user();
}
function add_user()
{   
	$ref =false;
    require 'config.php';
   	
   	$errors  = array(); 

    if(isset($_POST["admin_username"])){
        $admin_username = $_POST["admin_username"];
    }
   
    if(isset($_POST["admin_password"])){
        $admin_password = $_POST["admin_password"];   
    }
   
    if(isset($_POST["admin_password2"])){
        $admin_password2 = $_POST["admin_password2"];
    }
    
    if(isset($_POST["admin_access_role"])){
        $admin_access_role = $_POST["admin_access_role"];
    }
   

    $sql = "SELECT admin_username FROM tbl_admin_panel WHERE (admin_username ='$admin_username')";
    $dup_user = mysqli_query($conn,$sql);


    if(mysqli_num_rows($dup_user) > 0) 
    {
        // display_message("parameter already present", "danger");
        $_SESSION['error'] = "Username already present";
        array_push($errors, "Username already present");
    }

   
    if ($admin_password != $admin_password2)
    {
    	$_SESSION['error'] = "Passwords are not matched";
        array_push($errors, "Passwords are not matched");
    }

     // register user if there are no errors in the form
    if (count($errors) == 0) 
    {
        // insert records in product table
	    $sql ="INSERT INTO tbl_admin_panel (admin_username,admin_password,admin_access_role) VALUES ('$admin_username','$admin_password','$admin_access_role')";
	    $result = mysqli_query($conn,$sql);
	    $ref = true;

	    if (!$result)
	    {
	        echo 'Could not run query: ' . mysql_error();
	        exit;
	    }
	    else
	    {
	        $_SESSION['success'] = "User added successfully";
	    }   
    }

    if($ref)
    {
    //header("Refresh:0");
        echo '<script>window.location = "manage_users.php"</script>';
    }  
    else
    {
    	echo '<script>window.location = "manage_users.php"</script>';
    }   
}


?>
<script>
    function delete_id(id)
    {
     if(confirm('Sure To Remove This Record ?'))
     {
      window.location.href='delete_admin_user.php?delete_id='+id;
     }
    }   
</script>

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