<?php
include('header.php');
require 'admin/config.php';


$api_key = "rzp_test_4wzwSi2HAtSYUL";

if(isset($_GET['total'])){
    $amount = $_GET['total'];
    
}
$amount_in_paisa = $amount*100;
// $amount_in_paisa = 1*100;
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
</head>
<body>
    <div class="container" style="text-align:center;">
        <h3>Proceed to pay!!!</h3>
    </div>
<form action="charge.php" method="POST">
<script
    src="https://checkout.razorpay.com/v1/checkout.js"
    data-key= "<?php echo $api_key; ?>"										// Enter the Key ID generated from the Dashboard
    data-amount="<?php echo $amount_in_paisa;?>"					// Amount is in currency subunits. Default currency is INR. Hence, 29935 refers to 29935 paise or INR 299.35.
    data-currency="INR"
    data-buttontext="Pay with Razorpay"
    data-name="Pakeeza"
    data-description="A shopping webasite"
    data-image="img/logo.png"
    data-prefill.name="Gaurav Kumar"
    data-prefill.email="website.pakeezalucknowi@gmail.com"
    data-theme.color="#F37254"
></script>
<!-- <input type="hidden" custom="Hidden Element" name="hidden"> -->
</form>
