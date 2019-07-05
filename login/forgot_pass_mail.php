<?php 

require '../admin/config.php';

if(isset($_POST['submit_email']))
{

	$email_address = $_POST['email_address'];

    // This function will return a random 
    // string of specified length 
    function random_strings($length_of_string) 
    { 
      
        // String of all alphanumeric character 
        $str_result = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz'; 
      
        // Shufle the $str_result and returns substring 
        // of specified length 
        return substr(str_shuffle($str_result),  
                           0, $length_of_string); 
    } 
      

    // This function will generate 
    // Random string of length 10 
    $access_token = random_strings(10);  
   


	$sql = "update tbl_users_credentials set token_code = '$access_token' where user_email = '$email_address'";
	$result = mysqli_query($conn,$sql);
	//echo $sql;

    $python_path = 'C:\Users\ATIS28\AppData\Local\Programs\Python\Python37-32\python.exe';
    $file_path = 'C:\wamp\www\pakeeza\pakeeza-master\pakeeza-master\login\sendmail.py';
    $redirect_url = 'localhost:82/pakeeza/pakeeza-master/pakeeza-master/login/forgot_pass_password.php';

    exec($python_path.' '.$file_path.' '.$email_address.' '.$redirect_url.' '.$access_token,$output,$status);

}

?>

<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>

        body {font-family: Arial, Helvetica, sans-serif;}

        input[type=email], input[type=password] {
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
</head>
<body>    

<div class="imgcontainer" align="center">
    <img src="pakeezalogo.jpeg" alt="Pakeeza" class="avatar">
</div>
<form action="" method="post">
    <div class="container" align="center">
        <div class="col-md-12 col-sm-12">
            <div class="row">
                <div class="col-md-4 col-sm-4">        
                    <h3>Please enter your registered email address</h3>
                </div>
                <div class="col-md-4 col-sm-4">
                    <input type="email" placeholder="Enter Your Email Address" name="email_address" required>
                </div>
                <div class="col-md-4 col-sm-4">        
                    <input type="submit" name="submit_email" value="Submit" class="buttonclass">
                </div>

                
            </div>
        </div>        
    </div>

</form>   
</body>
</html>
