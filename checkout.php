<?php
   
    session_start();
    if (!isset($_SESSION['user_id'])){
        header('Location: login/login.php');
    }
    include('header.php');
    require 'admin/config.php';
    
    $user_id = $_SESSION['user_id']; 


    $api_key = "rzp_test_4wzwSi2HAtSYUL";

    // $api_key = "rzp_test_4wzwSi2HAtSYUL";

    $sql ="SELECT sum(price) as sum from tbl_products where delete_status=0 and product_id in (SELECT product_id FROM tbl_cart where user_id='$user_id' and cart_product_status=0)";
    $total_price = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($total_price);
    $total_price_sum = $row["sum"];

    $amount_in_paisa = $total_price_sum*100;


?>
    <style>
        .razorpay-payment-button{
            text-align: center;
            margin-top: 5%;
            margin-left: 45%;
            color: #ffffff !important;
            background-color: #7266ba;
            font-size: 14px;
            padding: 10px;
        }
    </style>

    <!-- ##### Breadcumb Area Start ##### -->
    <div class="breadcumb_area bg-img" style="background-image: url(img/bg-img/breadcumb.jpg);">
        <div class="container h-100">
            <div class="row h-100 align-items-center">
                <div class="col-12">
                    <div class="page-title text-center">
                        <h2>Checkout</h2>
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
                            <h5>Billing Address</h5>
                        </div>

                        <form action="charge.php" method="post">
                            <div class="row">
                                <?php
                                    $sql = "SELECT * 
                                            FROM tbl_user_details
                                            WHERE user_id='$user_id'";

                                    $results = mysqli_query($conn, $sql);

                                    if(mysqli_num_rows($results) >= 1) 
                                    {
                                        $i = 1;
                                        while ($row = mysqli_fetch_array($results))
                                        {
                                            echo'
                                                <div class="col-12 mb-3" id ="p_scents">
                                                    <p>
                                                        <input type="radio" name="optradio" value="'. $i.'"> 
                                                        <input type="text" class="form-control mb-3" id="shipping_address_'. $i.'" name="shipping_address_'. $i.'" value= "' . $row["address_1"] .' '. $row["address_2"].'"  readonly="true">
                                                    </p>    
                                                </div>';
                                                $i++;
                                        }
                                        echo '<button type="button" id="addScnt" style="float:right;" class="btn btn-primary">+</button>' ;

                                    }
                                    else
                                    {
                                        
                                        echo'
                                            <div class="col-12 mb-3">
                                                <label for="street_address">Address <span>*</span></label>
                                                <input type="radio" name="optradio" value="1"> 
                                                <input type="text" class="form-control mb-3" id="shipping_address_1" name="shipping_address_1" value="">
                                               
                                            </div>';
                                    }
                                    ?>
                                
                            </div>
                            <script
                                src="https://checkout.razorpay.com/v1/checkout.js"
                                data-key= "<?php echo $api_key; ?>"                                     // Enter the Key ID generated from the Dashboard
                                data-amount="<?php echo $amount_in_paisa;?>"                    // Amount is in currency subunits. Default currency is INR. Hence, 29935 refers to 29935 paise or INR 299.35.
                                data-currency="INR"
                                data-buttontext="Pay with Razorpay"
                                data-name="Pakeeza"
                                data-description="A shopping webasite"
                                data-image="img/logo.png"
                                data-prefill.name="Gaurav Kumar"
                                data-prefill.email="website.pakeezalucknowi@gmail.com"
                                data-theme.color="#F37254"
                            ></script>

                        </form>
                    </div>
                </div>

                <div class="col-12 col-md-6 col-lg-5 ml-lg-auto">
                    <div class="order-details-confirmation">

                        <div class="cart-page-heading">
                            <h5>Your Order</h5>
                            <p>The Details</p>
                        </div>

                        <ul class="order-details-form mb-4">
                            <li><span><strong>Product</strong></span> <span><strong>Price</strong></span></li>

                            <?php
                                $sql = "SELECT * FROM tbl_cart  WHERE user_id= '$user_id'";        
                                $result = mysqli_query($conn, $sql);
                                $array_product_id = array();
                                while ($row = mysqli_fetch_array($result))
                                { 
                                    array_push($array_product_id,$row['product_id']); 
                                }

                                for($i =0; $i<count($array_product_id); $i++)
                                {
                                    $product_id = $array_product_id[$i];
                                    
                                    $sql_1 = "SELECT * FROM tbl_products  WHERE product_id= '$product_id' AND delete_status =0";        
                                    $result_1 = mysqli_query($conn, $sql_1);
                                     while ($row = mysqli_fetch_array($result_1 ))
                                    {
                                        echo'<li><span>'.$row['product_name'].'</span> <span>'.$row['price'].'</span></li>';
                                    }
                                }

                                echo'<li><span><strong>Shipping</strong></span> <span>150</span></li>
                                <li><span><strong>Total</strong></span> <span>'.$total_price_sum.'</span></li>';

                                echo '</ul>';

                            ?>
                            <button onclick='$(".razorpay-payment-button").click();' class="btn essence-btn">Place Order</button>
                       
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
    var divsToHide = document.getElementsByClassName("razorpay-payment-button"); //divsToHide is an array
    for(var i = 0; i < divsToHide.length; i++){
        divsToHide[i].style.visibility = "hidden"; // or
        divsToHide[i].style.display = "none"; // depending on what you're doing
    }
</script>

<script type="text/javascript">
        // $(function() {
        $(document).ready(function() {
            var scntDiv = $('#p_scents');
            var i = $('#p_scents p').size() + 1;
            console.log(i)
            $('#addScnt').one('click', function() {
                 
                    $('<p><input type="radio" name="optradio" value="'+i+'"><input type="text" class="form-control mb-3" id="shipping_address_' +i+'" name="shipping_address_' +i+'" placeholder="Enter address "><button type="button" class="btn btn-danger btn_remove" id="remScnt_' +i+'">Remove</button></p>').appendTo(scntDiv);

                    // i++;
                    return false;
            });
            

            $(document).on('click', '.btn_remove', function(){  
                var button_id = $(this).attr("id");   
                // $('#row'+button_id+'').remove();  
                $(this).parents('p').remove();

            });  
        });

</script>