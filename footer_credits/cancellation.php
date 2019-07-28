
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

<div class="modal fade" id="cancellation" class="cancellation">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
			<div class="modal-header">
				<div class="icon-box">
					<img src="img/logo.png" alt="" class="center">
				</div>				
			</div>
			<div class="modal-body">
				<h3>Return Policy:</h3>
				<ul>

					<li>If a product has been received, in a bad condition or if the packaging is tampered with or damaged before delivery, please refuse to accept the package and return the package to the delivery person. Also, please email us at pakeezalucknawi@gmail.com mentioning your Order ID. </li> 
					<li>We will personally ensure that a brand new replacement, (if possible or an alternative product) is issued to you with no additional cost.</li>

					<li>Please make sure that the original product tag and packing is intact when you courier it back to us </li>
					<li>If you do not like the product, you will have to inform us within 2-3 working days and ship it back to us within a week. Kindly note, Pakeeza will not arrange for the pick up or bear the courier cost. We will refund you the product price and the courier charges you had paid during ordering the product </li>

					<li>Return should happen within 7 working days </li>
					<li>Apart from condition reserved herein above, the following products shall not be eligible for return or replacement, viz:
				<ul>
					<li>If the product exhibits any physical.</li>
					<li>If the product is customized for you in any way. </li>
				</ul>
				</li>
				</ul>
				<h3>Refund Policy:</h3>

				<p>Refund will be made to the customer account via NEFT/IMPS within 4 working days.</p>
			</div>
			<div class="modal-footer">
				<button class="btn btn-primary btn-block" style="background-color: #44abe0;" onclick="history.back()" data-dismiss="modal">Back</button>
			</div>

	</div>
    </div>
</div>

<script type="text/javascript">
    $(window).on('load',function(){
        $('#cancellation').modal('show');
    });
</script> 

<script>
	$(document).ready(function(e) {
	  $('#cancellation').on('hidden.bs.modal', function(e) {
		window.history.back();
	  });
});
</script>

</html>
