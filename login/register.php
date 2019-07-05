<?php

require '../admin/config.php';
date_default_timezone_set('Asia/Kolkata');

if (isset($_POST['submit_register'])) {
  register();
}

function register()
{
    require '../admin/config.php';
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
    $$user_dob = strtr($user_dob, '/', '-');
    $user_dob =  date('Y-m-d', strtotime($$user_dob));

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
        header('Location: login.php');
        exit();
    }

}
?>

<!DOCTYPE html>
<html lang="en"> 

<head>
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" >
    <meta name="author">
    <meta name="keywords" >

    <!-- Title Page-->
    <title>Pakeeza</title>

    <!-- Icons font CSS-->
    <link href="vendor/mdi-font/css/material-design-iconic-font.min.css" rel="stylesheet" media="all">
    <link href="vendor/font-awesome-4.7/css/font-awesome.min.css" rel="stylesheet" media="all">
    <!-- Font special for pages-->
    <link href="https://fonts.googleapis.com/css?family=Poppins:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Vendor CSS-->
    <link href="vendor/select2/select2.min.css" rel="stylesheet" media="all">
    <link href="vendor/datepicker/daterangepicker.css" rel="stylesheet" media="all">

    <!-- Main CSS-->
    <link href="css/register.css" rel="stylesheet" media="all">
</head>

<body>
    <div class="page-wrapper p-t-15 p-b-15 font-poppins" style="background-color: rgba(255, 245, 159, 0.1)">
        <div class="wrapper wrapper--w680">
            <div class="card card-4">
                <div class="card-body">
                    <h2 class="title">Register Below</h2>
                    <form method="POST">
                        <div class="row row-space">
                            <div class="col-2">
                                <div class="input-group">
                                    <label class="label">First Name</label>
                                    <input class="input--style-4" type="text" name="first_name" required autocomplete="off">
                                </div>
                            </div>
                            <div class="col-2">
                                <div class="input-group">
                                    <label class="label">Last Name</label>
                                    <input class="input--style-4" type="text" name="last_name" required autocomplete="off">
                                </div>
                            </div>
                        </div>
                        <div class="row row-space">
                            <div class="col-2">
                                <div class="input-group">
                                    <label class="label">Birthday</label>
                                    <div class="input-group-icon">
                                        <input class="input--style-4 js-datepicker" type="text" name="user_dob" autocomplete="off">
                                        <i class="zmdi zmdi-calendar-note input-icon js-btn-calendar"></i>
                                    </div>
                                </div>
                            </div>

                            <div class="col-2">
                                <div class="input-group">
                                    <label class="label">Gender</label>
                                    <div class="rs-select2 js-select-simple select--no-search">
                                        <select name="user_gender" required>
                                            <option disabled="disabled" selected="selected">Choose option</option>
                                            <option value="male">Male</option>
                                            <option value="female">Female</option>
                                            <option value="others">Others</option>
                                        </select>
                                        <div class="select-dropdown"></div>
                                    </div>
                                </div>
                            </div>  
                        </div>
                        <div class="row row-space">
                            <div class="col-2">
                                <div class="input-group">
                                    <label class="label">Email</label>
                                    <input class="input--style-4" type="email" name="email_address" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$"  title="Please enter evalid email address" autocomplete="off">
                                </div>
                            </div>
                            <div class="col-2">
                                <div class="input-group">
                                    <label class="label">Phone Number</label>
                                    <input class="input--style-4" type="text" name="contact_number" min="1111111111" max="9999999999" title="Please enter evalid number" autocomplete="off">
                                </div>
                            </div>
                        </div>

                        <div class="row row-space">
                            <div class="col-2">
                                <div class="input-group">
                                    <label class="label">Password</label>
                                    <input class="input--style-4" type="password" name="password" required>
                                </div>
                            </div>
                            <div class="col-2">
                                <div class="input-group">
                                    <label class="label">Confirm Password</label>
                                    <input class="input--style-4" type="password" name="confirm_password" required>
                                </div>
                            </div>
                        </div>
                     
                        <div class="p-t-15">
                            <button class="btn btn--radius-2 btn--blue" type="submit"  name="submit_register">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <!-- Jquery JS-->
    <script src="vendor/jquery/jquery-3.2.1.min.js"></script>
    <!-- Vendor JS-->
    <script src="vendor/select2/select2.min.js"></script>
    <script src="vendor/datepicker/moment.min.js"></script>
    <script src="vendor/datepicker/daterangepicker.js"></script>

    <!-- Main JS-->
    <script src="js/global.js"></script>

</body><!-- This templates was made by Colorlib (https://colorlib.com) -->

</html>
<!-- end document-->