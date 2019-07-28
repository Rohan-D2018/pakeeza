<html>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<link href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round" rel="stylesheet">
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

<style>
div {
  text-align: justify;
  text-justify: inter-word;
}

.center {
  display: block;
  margin-left: auto;
  margin-right: auto;
}
</style>

<div class="modal fade" id="ship_and_delivery" class="ship_and_delivery">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
			<div class="modal-header">
				<div class="icon-box">
					<img src="img/logo.png" alt="" class="center">
				</div>				
			</div>
			<div class="modal-body">
<p>Pakeeza is committed to deliver your order with good quality packaging within given time frame. We ship throughout the week, except Sunday & Public holidays. To ensure that your order reaches you in good condition, in the shortest span of time, we ship through reputed courier agencies only. If there is no courier service available in your area, we will ship your items via Government Registered Bookpost or Speedpost.</p>

<h2>Shipping Policies :</h2>

<p><strong>Domestic Shipping :</strong></p>
<ul>

<li>Shipping charges anywhere within India is INR 150 irresperctive of the number of Items bought </li>
<li>We do free Shipping when your purchase is above INR 8500 </li>
<li>Orders are dispatched within 3 working days or as per the delivery date specified by you at the time of placing the order </li>
<li>Most orders are delivered within 7 to 8 working days </li>
<li>Our delivery partner is DTDC.</li>
<li>Delivery of all orders will be duly done to the address as mentioned by you at the time of placing the order. In case of modifications, kindly drop us a  mail within 2-3 hours of placing the order.Or call us on 7755915311.</li>
<li>Our prices are all inclusive. GST is included with the listed prices except Octroi/customs, if applicable in your region</li>

</ul>
<p><strong>International Shipping : </strong></p>
<ul>
<li>Shipping charge will be taken at actuals</li>
<li>Our Delivery partner is DTDC </li>
<li>We don’t have any Transit insurance </li>
<li>Orders are dispatched within 3 working days or as per the delivery date specified by you at the time of placing the order </li>
<li>Delivery of all orders will be duly done to the address as mentioned by you at the time of placing the order</li>
<li>Our prices are all inclusive. GST is included with the listed prices except Octroi/customs, if applicable in your region </li>
</ul>

<p><strong>What if I the product is received in damaged condition?</strong></p>

<p>If a product has been received, in a bad condition or if the packaging is tampered with or damaged before delivery, please refuse to accept the package and return the package to the delivery person. Also, please email us at pakeezalucknawi@gmail.com mentioning your Order ID.</p>  
<p>We will personally ensure that a brand new replacement, (if possible or an alternative product) is issued to you with no additional cost.</p>

			</div>
			<div class="modal-footer">
				<button class="btn btn-primary btn-block" style="background-color: #44abe0;" onclick="history.back()" data-dismiss="modal">Back</button>
			</div>

	</div>
    </div>
</div>

<script type="text/javascript">
    $(window).on('load',function(){
        $('#ship_and_delivery').modal('show');
    });
</script> 

<script>
	$(document).ready(function(e) {
	  $('#ship_and_delivery').on('hidden.bs.modal', function(e) {
		window.history.back();
	  });
});
</script>
</html>
