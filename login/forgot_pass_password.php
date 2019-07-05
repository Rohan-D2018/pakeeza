<?php

require 'config.php';
if(isset($_POST['SubmitButtonPassword']))
{
    $password = $_POST['password'];
    $access_token = $_POST['token_code'];

	$sql = "update tbl_users_credentials set user_pass = MD5('$password') where token_code = '$access_token'";
	$result = mysqli_query($conn,$sql);

    if($result) 
    {
        // code here
        header("location:login.php");
    }
    else
    {   $message = 'Please verify the access token';
        echo "<script> alert($message);</script>";
    }
	
}
?>


<html>
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
    body {font-family: Arial, Helvetica, sans-serif;}

    input[type=text], input[type=password] {
      width: 50%;
      padding: 12px 20px;
      margin: 8px 0;
      display: inline-block;
      border: 1px solid #ccc;
      box-sizing: border-box;
    }

    .buttonclass {
      background-color: #4CAF50;
      color: white;
      padding: 14px 20px;
      margin: 8px 0;
      border: none;
      cursor: pointer;
      width: 50%;
    }

    .buttonclass:hover {
      opacity: 0.8;
    }

    }
</style>
<body>    

<div class="imgcontainer" align="center">
    <img src="pakeezalogo.jpeg" alt="Pakeeza" class="avatar">
</div>
<form action="" method="post" name="forgot_password" onSubmit="return validateForm();">
    <div class="container" align="center">
        <div class="col-md-12 col-sm-12">
            <div class="row">
                <div class="col-md-4 col-sm-4">
                    <input type="text" placeholder="Enter Token" name="token_code" required>
                </div>
                
                <div class="col-md-4 col-sm-4">
                    <input type="password" placeholder="Enter Password" name="password" required>
                </div>
               
                <div class="col-md-4 col-sm-4">
                    <input type="password" placeholder="Confirm Password" name="confirm_password">
                </div>
                <div class="col-md-4 col-sm-4">        
                    <input type="submit" name="SubmitButtonPassword" value="Change Passowrd"  required class="buttonclass">
                </div>
            </div>
        </div>        
    </div>
</form> 


<script>
    function validateForm()
    {
        var password=document.forms["forgot_password"]["password"].value;
        var confirm_password=document.forms["forgot_password"]["confirm_password"].value;
        if (password===confirm_password)
        {
            alert(password);
            return true;
        }
        else
        {
            alert(confirm_password);
            return false;
        }
    }
</script>   
</body>
</html>

