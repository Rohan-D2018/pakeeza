<?php
    include('header.php');
 
    require 'admin/config.php';
    date_default_timezone_set('Asia/Kolkata');

if (isset($_POST['submit_register'])) {
    register();
}

function register()
{
    require 'admin/config.php';
    $first_name = $_POST["first_name"];
    $last_name =  $_POST["last_name"];
    $email_address = $_POST["email_address"];
    $contact_number = $_POST["contact_number"];
    $user_pass =  $_POST["password"];
    $conf_pass =  $_POST["confirm_password"];
    $user_status = 0;
    $user_dob = $_POST["user_dob"];
    $user_gender = $_POST['user_gender'];

    // Change the date format to yyy-mm-dd
    // $$user_dob = strtr($user_dob, '/', '-');
    // $user_dob =  date('Y-m-d', strtotime($$user_dob));
    // echo $contact_number;
    // Array to store the count of errors
    $errors  = array(); 


    $sql = "select * from tbl_users_credentials where user_email = '$email_address'";
    
    $results = mysqli_query($conn,$sql);

    if(mysqli_num_rows($results) > 0) 
    {
        $message = "Your email Id is already registered";
        array_push($errors, "Username already present");
        echo "<script type='text/javascript'>alert('$message');</script>";
    }

    if ($user_pass != $conf_pass)
    {
        $message = "Please enter the correct password";
        array_push($errors, "Password should be same");
        echo "<script type='text/javascript'>alert('$message');</script>";
    }

    if (count($errors) == 0) 
    {
        $sql1 = "insert into tbl_users_credentials(first_name,last_name,user_email,user_contact_number,user_pass,user_status,user_dob,user_gender) values('$first_name','$last_name','$email_address','$contact_number',MD5('$user_pass'),'$user_status','$user_dob','$user_gender');";
        $result1 = mysqli_query($conn,$sql1);
        echo "<script>window.location='login.php'</script>";
        // header('Location: login/login.php');
        exit();
    }

}
?>

    <!-- ##### Breadcumb Area Start ##### -->
    <div class="breadcumb_area bg-img" style="background-image: url(img/skyline.png);">
        <div class="container h-80">
            <div class="row h-100 align-items-center">
                <div class="col-12">
                    <div class="page-title text-center">
                        <h2>Register</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ##### Breadcumb Area End ##### -->

    <!-- ##### Checkout Area Start ##### -->
    <div class="checkout_area section-padding-10">
        <div class="container">
            <div class="row" style="margin-bottom: 10px;">
                <div class="col-12 col-md-3">
                </div>
                <div class="col-12 col-md-6">
                    <div class="checkout_details_area mt-50 clearfix">

                        <div class="cart-page-heading mb-30">
                            <h5>Register Below</h5>
                        </div>

                        <form action="register_user.php" method="post">
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="first_name">First Name <span>*</span></label>
                                    <input type="text" class="form-control" id="first_name" name="first_name" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="last_name">Last Name <span>*</span></label>
                                    <input type="text" class="form-control" id="last_name" name="last_name" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="dob">Birthday <span>*</span></label>
                                    <input type="date" class="form-control" id="user_dob" name="user_dob"  required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="gender">Gender <span>*</span></label>
                                    <select class="w-100" id="user_gender" name="user_gender">
                                        <option disabled="disabled" selected="selected">Choose option</option>
                                        <option value="male">Male</option>
                                        <option value="female">Female</option>
                                        <option value="others">Others</option>
                                    </select>
                                </div>
                               <!--  <div class="col-12 mb-3">
                                    <label for="street_address">Address <span>*</span></label>
                                    <input type="text" class="form-control mb-3" id="street_address" value="">
                                    <input type="text" class="form-control" id="street_address2" value="">
                                </div> -->
                                
                                <div class="col-12 mb-3">
                                    <label for="contact_number">Phone No <span>*</span></label>
                                    <input type="number" class="form-control" id="contact_number" name="contact_number" title="Please enter evalid number" autocomplete="off">
                                </div>
                                <div class="col-12 mb-4">
                                    <label for="email_address">Email Address <span>*</span></label>
                                    <input type="email" class="form-control" id="email_address"name="email_address" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$"  title="Please enter evalid email address" autocomplete="off">
                                </div>
                                <div class="col-12 mb-4">
                                    <label for="password">Password <span>*</span></label>
                                    <input type="password" class="form-control" name="password" required>
                                </div>
                                <div class="col-12 mb-4">
                                    <label for="password"> Confirm Password<span>*</span></label>
                                    <input type="password" class="form-control" name="confirm_password" required>
                                </div>
                            </div>
                            <button type="submit" name="submit_register" class="btn essence-btn" style="float: right;">Submit</button>
                        </form>
                    </div>
                </div>
                <div class="col-12 col-md-3">
                </div>
            </div>
        </div>
    </div>
    <!-- ##### Checkout Area End ##### -->

<?php
    include('footer.php');
?>
