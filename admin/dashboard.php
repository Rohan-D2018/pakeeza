<?php
$page = 'dashboard';
include('header.php');
require('config.php');

$count_data = array();

$sql = "SELECT count(product_id) as count FROM tbl_products";
$result = mysqli_query($conn, $sql);

while($row = mysqli_fetch_array($result))
{	
	$total_product = $row['count'];  
}

$sql = "SELECT count(user_id) as user_count FROM tbl_users_credentials";
$result = mysqli_query($conn, $sql);

while($row = mysqli_fetch_array($result))
{	
	$total_users = $row['user_count'];  
}


$sql = "SELECT count(order_id) as order_count FROM tbl_orders";
$result = mysqli_query($conn, $sql);

while($row = mysqli_fetch_array($result))
{	
	$total_orders = $row['order_count'];  
}
?>

   
	<link rel="stylesheet" href="assets/bootstrap/bootstrap4-alpha3.min.css">
	<!-- Google Font Roboto -->

	
	<link href="assets/css/font-awesome.min.css" rel="stylesheet">

	<style>	
		body {
			background-color: #000000;
			color: #ffffff;
			/*font-family: "Roboto", Helvetica, Arial, sans-serif;*/
			/*font-family: 'Courgette', cursive;*/
			font-family: 'El Messiri', sans-serif;
			font-size: 16px;
			line-height: 1.5;
			padding-bottom: 3.5rem;
			
		}

		h1, h2, h3, h4, h5, h6 {
			font-weight: 300;
		}

		hr {
			border-top: 1px solid #727273;
			margin-bottom: 2rem;
			margin-top: 2rem;
		}
		
		#revenue-tag {
			border-radius: 0px !important;
			font-size: inherit !important;
			font-weight: inherit !important;
		}

		.align-center {
			text-align: center;
		}

		.card {
			background-color: transparent;
			border: none;
			margin-bottom: 0px;
		}

		#sales-doughnut-chart-us, #sales-doughnut-chart-nl, #sales-doughnut-chart-de {
			height: 280px;
			margin-top: 1rem;
			width: 100%;
		}

		#page-views-spline-area-chart, #orders-spline-area-chart, #revenue-spline-area-chart {
			height: 100px;
			width: 100%;
		}

		#users-doughnut-chart, #users-spline-chart {
			height: 280px; 
			margin-top: 2rem;
			width: 100%;
		}

		#users-countries-bar-chart {
			height: 360px; 
			margin-top: 2rem;
			width: 100%;
		}

/*===========================================This is for features============================*/
		#features {
		  text-align: center;
		  background-image: url(../images/background-2.jpg);
		}

		#features i {
		  font-size: 48px;
		}

		#features h3 {
		  margin-top: 15px;
		  font-size: 30px;
		  margin-bottom: 7px;
		  color: #fff;
		}

		#features .slider-overlay {
		  opacity: 0.9;
		}

		.icons {
		  color: #fff;
		}
	</style>
	
	<!-- Scripts -->
	<script src="assets/jquery/jquery-3.1.0.min.js"></script>
	<script src="assets/tether/tether.min.js"></script>
	<script src="assets/bootstrap/bootstrap4-alpha3.min.js"></script>
	<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
	<script src="assets/jquery.scrollspeed/jquery.scrollspeed.min.js"></script>
	<script src="assets/jquery.inview/jquery.inview.min.js"></script>


	<div class="container" style="margin-top: 1%">
		<div class="row">
			<h2>Pakeeza Dashboard</h2>
		
		<hr class="m-t-2">
		
		</div>
	</div>

	<section id="features" class="parallax">
	    <div class="container">
	      	<div class="row count"  style="margin-top: 3%">
		        <div class="col-sm-4 col-xs-6 wow fadeInLeft" data-wow-duration="1000ms" data-wow-delay="300ms">
		          <i class="fa fa-users icons"></i>
		          <h3 class="timer"><?php echo($total_users);?></h3>
		          <p style="color: #fff">Total Customers</p>
		        </div>
		        <div class="col-sm-4 col-xs-6 wow fadeInLeft" data-wow-duration="1000ms" data-wow-delay="500ms">
		          <i class="fa fa-gift icons"></i>
		          <h3 class="timer"><?php echo($total_product);?></h3>                    
		          <p style="color: #fff">Total Products</p>
		        </div> 
		        <div class="col-sm-4 col-xs-6 wow fadeInLeft" data-wow-duration="1000ms" data-wow-delay="700ms">
		          <i class="fa fa-shopping-cart icons"></i>
		          <h3 class="timer"><?php echo($total_orders);?></h3>                    
		          <p style="color: #fff">Total Orders</p>
		        </div>                  
	      	</div>
	    </div>
 	</section><!--/#features-->


	<div class="container">
		<hr class="m-t-2">
		<h3>Top 3 Collections</h3>
		<!-- sales doughnut charts -->
		<div class="row">	
			<div class="col-md-4">
				<div class="inview" id="sales-doughnut-chart-us"></div>
				<h3 class="align-center">Anjuman</h3>
			</div>
			
			<div class="col-md-4">
				<div class="inview" id="sales-doughnut-chart-nl"></div>
				<h3 class="align-center">Dori Dresses</h3>
			</div>
			
			<div class="col-md-4">
				<div class="inview" id="sales-doughnut-chart-de"></div>
				<h3 class="align-center">Skater Dresses</h3>
			</div>
		</div>
		<!-- row sales doughnt charts -->

	</div> <!-- container -->
	
	

	<script>

		$(document).ready(function(){
			$.ajax({
		        url:'fetch_count.php',
		        method:'POST',
		      
		        success: function(data){

		            console.log(data);
		            collection_data = JSON.parse(data);
		            // collection_data = data;
		            show_data(collection_data)
		        	},

		    	});
		 });

		function show_data(collection_data) {	
			
			console.log(collection_data)
			var totalProducts= collection_data['total_products'];
			totalProducts = parseInt(totalProducts,10) ;
			var per_collection_1
			var per_collection_2
			var per_collection_3
			var per_collection_4

			var collection_1
			var collection_2
			var collection_3
			var collection_4

			// console.log(totalProducts)
			
			var collection_names = (Object.keys(collection_data));
			// console.log(collection_names);

			collection_1 = collection_names[1]
			collection_2 = collection_names[2]
			collection_3 = collection_names[3]
			// collection_4 = collection_names[4]


			per_collection_1 = parseInt(collection_data[collection_1],10)*100/parseInt(totalProducts,10) 
			// per_collection_1 =Math.round(per_collection_1)
			per_collection_1 = per_collection_1.toFixed(2);
			// console.log(per_collection_1);

			per_collection_2 = parseInt(collection_data[collection_2],10)*100/parseInt(totalProducts,10)
			// per_collection_2 =Math.round(per_collection_2) 
			per_collection_2 = per_collection_2.toFixed(2);
			// console.log(per_collection_2);

			per_collection_3 = parseInt(collection_data[collection_3],10)*100/parseInt(totalProducts,10) 
			// per_collection_3 =Math.round(per_collection_3)
			per_collection_3 = per_collection_3.toFixed(2);
			// console.log(per_collection_3);

			// per_collection_4 = parseInt(collection_data[collection_4])*100/parseInt(totalProducts) 
			// per_collection_4 =Math.round(per_collection_4)
			// console.log(per_collection_4);


			
			
			var val_collection_1 = parseInt(collection_data[collection_1],10);
			// console.log(val_collection_1);
			var val_collection_2 = parseInt(collection_data[collection_2],10);
			// console.log(val_collection_2);
			var val_collection_3 = parseInt(collection_data[collection_3],10);
			// console.log(val_collection_3);
			// var val_collection_4 = parseInt(collection_data[collection_4],10);
			// console.log(val_collection_4);

			var totalRevenue = 15341110
			
			
			// CanvasJS doughnut chart to show annual sales percentage from United States(US)
			var salesDoughnutChartUS = new CanvasJS.Chart("sales-doughnut-chart-us", { 
				animationEnabled: true,
				backgroundColor: "transparent",
				title: {
					fontColor: "#848484",
					fontSize: 70,
					horizontalAlign: "center",
					text: per_collection_1+"%",
					verticalAlign: "center"
				},
				toolTip: {
					backgroundColor: "#ffffff",
					borderThickness: 0,
					cornerRadius: 0,
					fontColor: "#424242"
				},
				data: [
					{
						explodeOnClick: false,
						innerRadius: "96%",
						radius: "90%",
						startAngle: 270,
						type: "doughnut",
						dataPoints: [
							{ y: per_collection_1, color: "#c70000", toolTipContent: collection_1+": <span>" + CanvasJS.formatNumber(val_collection_1)},
							{ y: 100-per_collection_1, color: "#424242", toolTipContent: null }
						]
					}
				]
			});

			// CanvasJS doughnut chart to show annual sales percentage from Netherlands(NL)
			var salesDoughnutChartNL = new CanvasJS.Chart("sales-doughnut-chart-nl", { 
				animationEnabled: true,
				backgroundColor: "transparent",
				title: {
					fontColor: "#848484",
					fontSize: 70,
					horizontalAlign: "center",
					text: per_collection_2+"%",
					verticalAlign: "center"
				},
				toolTip: {
					backgroundColor: "#ffffff",
					borderThickness: 0,
					cornerRadius: 0,
					fontColor: "#424242"
				},
				data: [
					{
						explodeOnClick: false,
						innerRadius: "96%",
						radius: "90%",
						startAngle: 270,
						type: "doughnut",
						dataPoints: [
							{ y: per_collection_2, color: "#c70000", toolTipContent: collection_2+": <span>" + CanvasJS.formatNumber(val_collection_2)},
							{ y: 100-per_collection_2, color: "#424242", toolTipContent: null }
						]
					}
				]
			});

			// CanvasJS doughnut chart to show annual sales percentage from Germany(DE)
			var salesDoughnutChartDE = new CanvasJS.Chart("sales-doughnut-chart-de", { 
				animationEnabled: true,
				backgroundColor: "transparent",
				title: {
					fontColor: "#848484",
					fontSize: 70,
					horizontalAlign: "center",
					text: per_collection_3+"%",
					verticalAlign: "center"
				},
				toolTip: {
					backgroundColor: "#ffffff",
					borderThickness: 0,
					cornerRadius: 0,
					fontColor: "#424242"
				},
				data: [
					{
						explodeOnClick: false,
						innerRadius: "96%",
						radius: "90%",
						startAngle: 270,
						type: "doughnut",
						dataPoints: [
							{ y: per_collection_3, color: "#c70000", toolTipContent: collection_3+": <span>" + CanvasJS.formatNumber(val_collection_3) },
							{ y: 100-per_collection_2, color: "#424242", toolTipContent: null }
						]
					}
				]
			});

	
			jQuery.scrollSpeed(100, 400); // for smooth mouse wheel scrolling
			
			// jQuery.inview plugin
			$('.inview').one('inview', function (e, isInView) {
				if (isInView) {
					switch (this.id) {
						case "sales-doughnut-chart-us": salesDoughnutChartUS.render();
							break;
						case "sales-doughnut-chart-nl": salesDoughnutChartNL.render();
							break;
						case "sales-doughnut-chart-de": salesDoughnutChartDE.render();
							break;
						
					}
				}
			});
	
		};
		

	</script>
<?php
include('footer.php');
?>