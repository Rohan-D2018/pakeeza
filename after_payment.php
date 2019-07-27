<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Pakeeza</title>
<link href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round" rel="stylesheet">
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style type="text/css">
    body {
		font-family: 'Varela Round', sans-serif;
	}
	.modal-confirm {		
		color: #636363;
		width: 400px;
	}
	.modal-confirm .modal-content {
		padding: 20px;
		border-radius: 5px;
		border: none;
	}
	.modal-confirm .modal-header {
		border-bottom: none;   
        position: relative;
	}
	.modal-confirm h4 {
		text-align: center;
		font-size: 26px;
		margin: 30px 0 -15px;
	}
	.modal-confirm .form-control, .modal-confirm .btn {
		min-height: 40px;
		border-radius: 3px; 
	}
	.modal-confirm .close {
        position: absolute;
		top: -5px;
		right: -5px;
	}	
	.modal-confirm .modal-footer {
		border: none;
		text-align: center;
		border-radius: 5px;
		font-size: 13px;
	}	
	.modal-confirm .icon-box {
		color: #fff;		
		position: absolute;
		margin: 0 auto;
		left: 0;
		right: 0;
		top: -70px;
		width: 95px;
		height: 95px;
		border-radius: 50%;
		z-index: 9;
		background: #82ce34;
		padding: 15px;
		text-align: center;
		box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.1);
	}
	.modal-confirm .icon-box i {
		font-size: 58px;
		position: relative;
		top: 3px;
	}
	.modal-confirm.modal-dialog {
		margin-top: 80px;
	}
    .modal-confirm .btn {
        color: #fff;
        border-radius: 4px;
		background: #82ce34;
		text-decoration: none;
		transition: all 0.4s;
        line-height: normal;
        border: none;
    }
	.modal-confirm .btn:hover, .modal-confirm .btn:focus {
		background: #6fb32b;
		outline: none;
	}
	.trigger-btn {
		display: inline-block;
		margin: 100px auto;
	}


	.fa {
	  padding: 10px;
	  font-size: 20px;
	  width: 40px;
	  text-align: center;
	  text-decoration: none;
	  margin: 5px 2px;
	}


	/*.fa {
  padding: 20px;
  font-size: 30px;
  width: 50px;
  text-align: center;
  text-decoration: none;
  margin: 5px 2px;
  border-radius: 50%;
}*/


	.fa:hover {
    opacity: 0.9;
    color: white;
	}

	.fa-facebook {
	  background: #3B5998;
	  color: white;
	}

	.fa-instagram {
	  background: #00aff0;
	  color: white;
	}

</style>
</head>
<body>
<div class="text-center">
	<!-- Button HTML (to Trigger Modal) -->
	<!-- <a href="#myModal" class="trigger-btn" data-toggle="modal">Click to Open Confirm Modal</a> -->
</div>

<!-- Modal HTML -->
<div id="myModal" class="modal fade">
	<div class="modal-dialog modal-confirm">
		<div class="modal-content">
			<div class="modal-header">
				<div class="icon-box">
					<i class="material-icons">&#xE876;</i>
				</div>				
				<h4 class="modal-title">आपका यह नवाज़िश-ए-करम बरकरार रहे!</h4>	
			</div>
			<div class="modal-body">
				<p class="text-center">Thank you so much for shopping at Pakeeza! It was an absolute pleasure serving you and we sincerely hope you'll come back for more.</p>

				<p class="text-center">In the meanwhile, let's be friends on Facebook and Instagram and do spread the word!</p>
				<p class="text-center"><strong>Thank you!</strong>  Team Pakeeza</p>
				<div class="text-center">
					<a href="https://www.facebook.com/pakeeza.lucknowi/" class="fa fa-facebook"></a>
					<a href="#" class="fa fa-instagram"></a>
				</div>
				
			</div>

			<div class="modal-footer">
				<button class="btn btn-success btn-block" onclick="location.href='index.php';" data-dismiss="modal">Continue Shopping</button>
				<button class="btn btn-primary btn-block" style="background-color: #44abe0;" onclick="location.href='user_orders.php';" data-dismiss="modal">Back to Orders</button>
			</div>
		</div>
	</div>
</div>    

<script type="text/javascript">
    $(window).on('load',function(){
        $('#myModal').modal('show');
    });
</script> 

<script>
	$(document).ready(function(e) {
	  $('#myModal').on('hidden.bs.modal', function(e) {
	    window.location.href = 'user_orders.php'
	  });
});
</script>

</body>
</html>                                                        