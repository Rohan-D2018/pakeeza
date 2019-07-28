<?php
require '../admin/config.php';
if (isset($_GET['email'])) {
  register();
}
function register()
{
    require '../admin/config.php';
    $first_name = $_POST["first_name"];
    $last_name =  $_POST["last_name"];
    $email_address = $_POST["email"];
    $user_status = 0;
    $user_gender = $_POST['gender'];

    // Change the date format to yyy-mm-dd
    //$$user_dob = strtr($user_dob, '/', '-');
    //$user_dob =  date('Y-m-d', strtotime($$user_dob));

    // Array to store the count of errors
    $errors  = array(); 


    $sql = "select * from tbl_users_credentials where user_email = '$email_address'";
    
    $results = mysqli_query($conn,$sql);

    if(mysqli_num_rows($results)>=1) 
	{
		while ($row = mysqli_fetch_array($results))
        {
			$user_id = $row['user_id'];
			$username = $row['user_email'];
			$fullname = $row['first_name'] . ' ' . $row['last_name'];
        }
		
		$_SESSION['user_id'] = $user_id;
		$_SESSION['username'] = $username;
		$_SESSION['fullname'] = $fullname;
		header('Location: ../shop.php');
		
	}

    else 
    {
        $sql1 = "insert into tbl_users_credentials(first_name,last_name,user_email,user_status,user_gender) values('$first_name','$last_name','$email_address','$user_status','$user_gender');";
        $result1 = mysqli_query($conn,$sql1);

	$sql1 = "select * from tbl_users_credentials where user_email = '$email_address'";
	$results1 = mysqli_query($conn,$sql);

	if(mysqli_num_rows($results)>=1) 
	{
		while ($row = mysqli_fetch_array($results))
        {
			$user_id = $row['user_id'];
			$username = $row['user_email'];
			$fullname = $row['first_name'] . ' ' . $row['last_name'];
        }
		
		$_SESSION['user_id'] = $user_id;
		$_SESSION['username'] = $username;
		$_SESSION['fullname'] = $fullname;
		header('Location: ../shop.php');
		
	}
        exit();
    }

}
?>
