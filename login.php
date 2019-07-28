<?php
    include('header.php');
 
    require 'admin/config.php';
    date_default_timezone_set('Asia/Kolkata');

if (isset($_POST['login'])) {
  login();
}


function login()
{

	require 'admin/config.php'; 

	//Starting the user session  
  	session_start();

	$user_email = $_POST["user_email"];
	$user_pass = $_POST["user_pass"];
	
	$sql = "SELECT user_id, user_email, first_name, last_name 
			FROM tbl_users_credentials 
			WHERE user_email = '$user_email' AND user_pass = MD5('$user_pass') LIMIT 1";
	$results = mysqli_query($conn,$sql);
	
	if(mysqli_num_rows($results)>=1) 
	{
		while ($row = mysqli_fetch_array($results))
        {
			$user_id = $row['user_id'];
			$username = $row['user_email'];
			$fullname = $row['first_name'] . ' ' . $row['last_name'];
			$first_name = $row['first_name'];
        }
		
		$_SESSION['user_id'] = $user_id;
		$_SESSION['username'] = $username;
		$_SESSION['fullname'] = $fullname;
		$_SESSION['first_name'] = $first_name;
		// header('Location: shop.php');
		echo "<script>window.location='shop.php'</script>";
	}
}
?>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

	<style type="text/css">
	
		.bg1 {background-color: #3b5998}
		.bg2 {background-color: #1da1f2}
		.bg3 {background-color: #ea4335}

		.flex-c-m {
		display: -webkit-box;
		display: -webkit-flex;
		display: -moz-box;
		display: -ms-flexbox;
		display: flex;
		justify-content: center;
		-ms-align-items: center;
		align-items: center;
	}

		.login100-social-item {
		  font-size: 25px;
		  color: #fff;

		  display: -webkit-box;
		  display: -webkit-flex;
		  display: -moz-box;
		  display: -ms-flexbox;
		  display: flex;
		  justify-content: center;
		  align-items: center;
		  width: 50px;
		  height: 50px;
		  border-radius: 50%;
		  margin: 5px;
		}

		.login100-social-item:hover {
		  color: #fff;
		  background-color: #333333;
		}

		
		@media (max-width: 576px) {
		  .wrap-login100 {
		    padding-left: 15px;
		    padding-right: 15px;    
		} 

		.txt {
			text-align: center;
		}
		
	</style>

    <!-- ##### Breadcumb Area Start ##### -->
 <!-- <div class="background_area bg-img" style="background-image: url(img/skyline.png);"> -->
        <div class="container" style="margin-top: 10%; margin-bottom: 3%;">
            <div class="row h-100 align-items-center">
                <div class="col-12">
                    <div class="page-title text-center">
                        <h2>Login</h2>
                    </div>
                </div>
            </div>
        </div>
    <!-- </div> -->
    <!-- ##### Breadcumb Area End ##### -->

    <!-- ##### Checkout Area Start ##### -->
    <div class="checkout_area section-padding-10">
        <div class="container">
            <div class="row">
                <div class="col-12 col-md-4">
                </div>
                <div class="col-12 col-md-4">	
                    <div class="checkout_details_area mt-10 clearfix">
                        <form action="login.php" method="post">
                            <div class="row">
                                <div class="col-12 mb-4">
                                    <label for="email_address">Email Address <span>*</span></label>
                                   
                                    <input type="email" class="form-control" id="user_email "name="user_email" placeholder="Type your email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$"  title="Please enter evalid email address">
                                    <!-- <div class="input-container">
									    <i class="fa fa-user icon"></i>
									     <input type="email" class="form-control" id="user_email "name="user_email" placeholder="Type your email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$"  title="Please enter evalid email address">
									 </div> -->
                                    
                                </div>
                                <div class="col-12 mb-4">
                                    <label for="password">Password <span>*</span></label>
                                    <input type="password" class="form-control" name="user_pass" placeholder="Type your password" required>
                                </div>
                                <div class="col-12 mb-4" >
									<a style="float: right;" href="login/forgot_pass_mail.php">
										Forgot password?
									</a>
								</div>
								<div class="txt" style="text-align: center;">
									<span>
										Or Sign In Using
									</span>
								</div>
                            	<div class="col-12 mb-4">
	                            	<div class="flex-c-m">
										<a href="#" class="login100-social-item bg1">
											<i class="fa fa-facebook"></i>
										</a>

										<a href="#" class="login100-social-item bg2">
											<i class="fa fa-twitter"></i>
										</a>

										<a href="#" class="login100-social-item bg3">
											<i class="fa fa-google"></i>
										</a>
									</div>
								</div>	
                            </div>
                            <div class="row">
                            	<div class="col-12 mb-4">	
                            		<button type="submit" name="login" class="btn essence-btn" style="float: right; margin-bottom: 10px; width:100%;">Login</button>
                            	</div>	
                            	
                           		<div class="col-12 mb-4">	
									<div class="flex-col-c">
										<span class="txt1 p-b-17">
											Or Create an account
										</span>

										<a href="register_user.php" class="txt2">
											<strong>Sign Up</strong>
										</a>
									</div>
								</div>	
							</div>
                        </form>
                    </div>
                </div>
                <div class="col-12 col-md-4">
                </div>
            </div>
        </div>
    </div>
    <!-- ##### Checkout Area End ##### -->

<?php
    include('footer.php');
?>
