
    <!-- ##### Footer Area Start ##### -->
    <footer class="footer_area clearfix" style="border: 1px solid #D3D3D3; padding-bottom: 0px;">
        <div class="container">
            <div class="row">
                <!-- Single Widget Area -->
                <div class="col-12 col-md-2">
                    <div class="logo-box">
                        <img src="img/logo.png" alt="" class="center">
                    </div>
                    <h5>मुस्कुराइए आप लखनऊ में है</h5>

		        </div>

                <div class="col-12 col-md-3">
                    <div class="single_widget_area d-flex mb-30">
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
    		                    <a href="https://wa.me/917755915311" data-toggle="tooltip" data-placement="top" title="Whatsapp"><i class="fa fa-whatsapp" aria-hidden="true"></i></a>
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
            <img class="img-fluid" src="img/skyline_footer.png">
		</div>
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
