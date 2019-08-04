
    <!-- ##### Footer Area Start ##### -->
    <footer class="footer_area clearfix" style="border: 1px solid #D3D3D3;">
        <div class="container">
            <div class="row">
                <!-- Single Widget Area -->
                <div class="col-12 col-md-1">
		</div>
                <div class="col-12 col-md-4">
                    <div class="single_widget_area d-flex mb-30">
                        <!-- Logo 
                        <div class="footer-logo mr-50">
                            <a href="#"><img src="img/core-img/logo2.png" alt=""></a>
                        </div> -->
                        <!-- Footer Menu -->
                        <div class="footer_menu">
                            <ul>
				<li><h5>Quick Links</h5></li>
                                <li><a href="shop.php">Shop</a></li>
                                <li><a href="index.php#collections">Collections</a></li>
                                <li><a href="contact.php">Contact Us</a></li>
                                <li><a href="checkout.php">Check Out</a></li>
                                <li><a href="#">Size Chart</a></li>
                            </ul>
                        </div>
                    </div>
		    <div class="row">
			<div class="single_widget_area ">
		                <div class="footer_social_area">
		                    <a href="https://www.facebook.com/pakeeza.lucknowi/" data-toggle="tooltip" data-placement="top" title="Facebook"><i class="fa fa-facebook" aria-hidden="true"></i></a>
		                    <a href="https://instagram.com/pakeeza.lucknowi?igshid=1vdv3ijqy274i" data-toggle="tooltip" data-placement="top" title="Instagram"><i class="fa fa-instagram" aria-hidden="true"></i></a>
		                    <a href="#" data-toggle="tooltip" data-placement="top" title="Twitter"><i class="fa fa-twitter" aria-hidden="true"></i></a>
		                    <a href="#" data-toggle="tooltip" data-placement="top" title="Pinterest"><i class="fa fa-pinterest" aria-hidden="true"></i></a>
		                    <a href="#" data-toggle="tooltip" data-placement="top" title="Youtube"><i class="fa fa-youtube-play" aria-hidden="true"></i></a>
		                </div>
		            </div>
		        </div>
		</div>
		<div class="col-12 col-md-4">
		</div>
                <!-- Single Widget Area -->
                <div class="col-12 col-md-3">
                    <div class="single_widget_area mb-30 align-items-end">
                        <ul class="footer_widget_menu">
			    <li><h5>Customer Service</h5></li>
                            <li><a href="footer_credits/terms_and_conditions.php" class="terms_link" id="terms_link">Terms and Conditions</a></li>
                            <li><a href="footer_credits/shipping_and_delivery.php" class="shipping_link" id="shipping_link">Shipping and Delivery Policy</a></li>
                            <li><a href="footer_credits/privacy.php" class="privacy_link" id="privacy_link">Privacy Policy</a></li>
                            <li><a href="footer_credits/disclaimer.php" class="disclaimer_link" id="disclaimer_link">Disclaimer Policy</a></li>
                            <li><a href="footer_credits/cancellation.php" class="refund_link" id="refund_link">Cancellation and Refund policy</a></li>
			    <li><a href="footer_credits/faqs.php" class="faqs_link" id="faqs_link">Frequently Asked Questions</a></li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- <div class="row align-items-end">
                <!-- Single Widget Area 

                <div class="col-12 col-md-4">
                    <div class="single_widget_area ">
                        <div class="footer_social_area" align="center">
                            <a href="#" data-toggle="tooltip" data-placement="top" title="Facebook"><i class="fa fa-facebook" aria-hidden="true"></i></a>
                            <a href="#" data-toggle="tooltip" data-placement="top" title="Instagram"><i class="fa fa-instagram" aria-hidden="true"></i></a>
                            <a href="#" data-toggle="tooltip" data-placement="top" title="Twitter"><i class="fa fa-twitter" aria-hidden="true"></i></a>
                            <a href="#" data-toggle="tooltip" data-placement="top" title="Pinterest"><i class="fa fa-pinterest" aria-hidden="true"></i></a>
                            <a href="#" data-toggle="tooltip" data-placement="top" title="Youtube"><i class="fa fa-youtube-play" aria-hidden="true"></i></a>
                        </div>
                    </div>
                </div>
		<div class="col-12 col-md-4">
		</div>
                <div class="col-12 col-md-4">
		</div>
            </div> -->

            <!--<div class="row mt-5">-->
                <div class="col-md-12 text-center">
                  <!--  <p>-->
                        <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                    <!-- Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | This template is made with <i class="fa fa-heart-o" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib</a> -->
                    <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                    <!-- </p>-->
                </div>
           <!-- </div>-->

    <img src="img/skyline.png" style="width: 100%;">
    </footer>
    <!-- ##### Footer Area End ##### -->



    <!-- jQuery (Necessary for All JavaScript Plugins) -->
    <script src="js/jquery/jquery-2.2.4.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/lozad/dist/lozad.min.js"></script>
    <!-- Popper js -->
    <script src="js/popper.min.js"></script>
    <!-- Bootstrap js -->
    <script src="js/bootstrap.min.js"></script>
    <!-- Plugins js -->
    <script src="js/plugins.js"></script>
    <!-- Classy Nav js -->
    <script src="js/classy-nav.min.js"></script>
    <!-- Active js -->
    <script src="js/active.js"></script>
    <script>
    $(document).ready(function(){
        const observer = lozad();
        observer.observe();
    });
    
    $('.product-remove').on('click', function(){
        var id = $(this).attr("data-id");
        action = 'remove_from_cart';
        $.ajax({
            url:"remove_from_cart.php",
            method:"POST",
            data:{
                action:action,
                product_id:id,
                user_id: <?php echo $_SESSION['user_id']; ?>
            },
            success: function(data){
                data = JSON.parse(data);
                if(data[0] === 'done'){
                    location.reload();
                }
            }
        });
    });
    </script>
</body>

</html>
