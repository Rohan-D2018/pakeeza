<?php
	require 'config.php';  
	session_start();

	if (!isset($_SESSION['username']))
    {
    //   header('Location: products.php');
    } 

	if (isset($_POST['bttLogin'])) {
		$username = $_POST['admin_username'];
		$password = $_POST['admin_password'];
	
		$query = "SELECT admin_access_role,admin_id,admin_username,admin_password
				  FROM tbl_admin_panel
				  WHERE admin_username='$username' AND admin_password = '$password'
				  ORDER BY admin_access_role ASC";
				  
		$results = mysqli_query($conn, $query);
	
		if(mysqli_num_rows($results)>=1)
		{ 
			// $logged_in_user = mysqli_fetch_array($results);
			echo "Inside";
			$access_roles = array();
			$user_name = array();
			while ($row = mysqli_fetch_array($results))
			{
			  array_push($access_roles, $row['admin_access_role']);
			  array_push($user_name, $row['admin_username']);
			}  
			// print_r($access_roles);
			
			if (in_array("admin", $access_roles, TRUE) )
			{
			  echo "Found admin user";
			  $_SESSION['username'] = $user_name[0]; 
			  $_SESSION['access_role'] = $access_roles;  
			  header('location: products.php');  
			} 
	
			elseif (in_array("system_user", $access_roles, TRUE))
			{
			  echo "Found system_user";
			  $_SESSION['username'] = $user_name[0]; 
			  $_SESSION['access_role'] = $access_roles;         
				  header('Location: products.php');  
			} 
	
		}  
		else
		{	
			echo "Exception";
		   
		   $_SESSION['error'] = "Invalid Username or Password";
		   // echo '<script>window.location = "index.php"</script>';
		}
	}
	 
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Pakeeza</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->	
	<link rel="icon" type="image/png" href="images/icons/favicon.ico"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/iconic/css/material-design-iconic-font.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animsition/css/animsition.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="vendor/daterangepicker/daterangepicker.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="css/util.css">
	<link rel="stylesheet" type="text/css" href="css/main.css">
<!--===============================================================================================-->
</head>
<body>
	
	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100 ">
				<form action="#" method="post">
					<span class="login100-form-title">
						Welcome
					</span>
					<span class="login100-form-avatar">
						<img src="images/pakeezalogo.jpeg" alt="AVATAR">
					</span>

					<div class="wrap-input100 validate-input m-t-25 m-b-35" data-validate = "Enter username">
						<input class="input100" type="text" name="admin_username">
						<span class="focus-input100" data-placeholder="Username"></span>
					</div>

					<div class="wrap-input100 validate-input m-b-50" data-validate="Enter password">
						<span class="btn-show-pass">
							<i class="fa fa-eye"></i>
						</span>
						<input class="input100" type="password" name="admin_password">
						<span class="focus-input100" data-placeholder="Password"></span>
					</div>

					<div class="container-login100-form-btn">
						<button class="login100-form-btn" type="submit" value="Submit" id="submit" name="bttLogin">
							Login
						</button>
					</div>
				</form>
				<div class="text-center" style="margin-top: 15px;">
        			<?php
			          	//Add user status message
			          	include('functions.php');
			          	display_message();
        			?> 
      			</div>
			</div>
		</div>
	</div>
	

<!--===============================================================================================-->
	<script src="vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/animsition/js/animsition.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/bootstrap/js/popper.js"></script>
	<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/daterangepicker/moment.min.js"></script>
	<script src="vendor/daterangepicker/daterangepicker.js"></script>
<!--===============================================================================================-->
	<script src="vendor/countdowntime/countdowntime.js"></script>
<!--===============================================================================================-->
	<script src="js/main.js"></script>

</body>
</html>