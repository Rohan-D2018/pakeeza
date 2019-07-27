<?php
    include('header.php');
    if (!isset($_SESSION['user_id'])){
        header('Location: login/login.php');
    }
    require 'admin/config.php';


    $user_id = $_SESSION['user_id']; 

    date_default_timezone_set('Asia/Kolkata');

    if (isset($_POST['submit'])) 
    {

        $first_name = $_POST["first_name"];
        $last_name =  $_POST["last_name"];
        $email_address = $_POST["user_email"];
        $contact_number = $_POST["user_contact_number"];
        $user_dob = $_POST["user_dob"];
        $user_gender = $_POST['user_gender'];

        
        $sql = "UPDATE tbl_users_credentials SET first_name = '$first_name',last_name = '$last_name',user_contact_number = '$contact_number',user_dob = '$user_dob', user_gender = '$user_gender'
                WHERE user_id = '$user_id'";
        $result = mysqli_query($conn,$sql);

    }
?>

    <!-- ##### Breadcumb Area Start ##### -->
    <div class="breadcumb_area bg-img" style="background-image: url(img/bg-img/breadcumb.jpg);">
        <div class="container h-100">
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
    <div class="checkout_area section-padding-80">
        <div class="container">
            <div class="row">

                <div class="col-12 col-md-6">
                    <div class="checkout_details_area mt-50 clearfix">

                        <div class="cart-page-heading mb-30">
                            <h5>Edit Information</h5>
                        </div>

                        <form action="edit_user_details.php" method="post">
                            <div class="row">
                                <div class="col-12 mb-4">
                                    <label for="email_address">Email Address <span>*</span></label>
                                    <input type="email" class="form-control" id="user_email" name="user_email" readonly >
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="first_name">First Name <span>*</span></label>
                                    <input type="text" class="form-control" id="first_name" name="first_name"  required>
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
                                        <option value="other">Other</option>
                                    </select>
                                </div>
                                <div class="col-12 mb-3">
                                    <label for="phone_number">Phone No <span>*</span></label>
                                    <input type="number" class="form-control" id="user_contact_number" name="user_contact_number" min="0" >
                                </div>
                         
                            </div>
                            
                            <button type="submit" name="submit" class="btn essence-btn" style="float: right;">Update</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ##### Checkout Area End ##### -->

<?php
    include('footer.php');
?>

<script type="text/javascript">
    
    $(document).ready(function(){
        var user_id = '<?php echo $user_id; ?>';
        console.log(user_id)
        $.ajax({
            url:'fetch_user_details.php',
            method:'POST',
            data: {'user_id': user_id},
            dataType:"json",
            success: function(data){
                console.log(data);
                console.log(data.user_gender);
                $('#first_name').val(data.first_name);
                $('#last_name').val(data.last_name);
                $('#user_dob').val(data.user_dob);
                $('#user_gender').val(data.user_gender);
                $('#user_email').val(data.user_email);
                $('#user_contact_number').val(data.user_contact_number);

                
            },
        });
    });
</script>