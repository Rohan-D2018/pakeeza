<?php
    include('header.php');
    if (!isset($_SESSION['user_id'])){
        header('Location: login/login.php');
    }
    require 'admin/config.php';
    $user_id = $_SESSION['user_id']; 


    // $user_id =1;
?>


    <!-- ##### Breadcumb Area Start ##### -->
    <div class="breadcumb_area bg-img" style="background-image: url(img/bg-img/breadcumb.jpg);">
        <div class="container h-100">
            <div class="row h-100 align-items-center">
                <div class="col-12">
                    <div class="page-title text-center">
                        <h2>Orders</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ##### Breadcumb Area End ##### -->

    <!-- ##### Order details Area Start ##### -->
    <div class="checkout_area section-padding-80">
        <div class="container">
            <div class="row">
                <div class="col-12 col-md-12">
                    <div class="mt-50 clearfix">
                        <div class="cart-page-heading mb-30">
                            <h5>Your Orders</h5>
                        </div>
                        <div class="row">
                               
                            <?php

                                $sql = "SELECT tbl_orders.order_id,tbl_orders.shipping_address,tbl_order_details.product_id,tbl_order_details.price,tbl_order_details.size,tbl_order_details.color,tbl_products.product_name,tbl_pictures.picture_url
                                        FROM tbl_orders
                                        INNER JOIN tbl_order_details ON tbl_orders.order_id = tbl_order_details.order_id
                                        INNER JOIN tbl_products ON tbl_order_details.product_id = tbl_products.product_id
                                        INNER JOIN tbl_pictures ON tbl_products.product_id = tbl_pictures.product_id
                                        WHERE tbl_pictures.picture_url IN(SELECT MAX(tbl_pictures.picture_url) FROM tbl_pictures GROUP BY tbl_pictures.product_id) AND tbl_orders.user_id= '$user_id'";

                                $results = mysqli_query($conn, $sql);



                                if(mysqli_num_rows($results) >= 1) 
                                {
                                    
                                    while ($row = mysqli_fetch_array($results))
                                    {

                                        //Get image here
                                        // $image_name = 'github-pro.png';
                                        $image_name = $row['picture_url'];


                                        echo    '<div class="col-md-6 col-sm-6 mb-100">
                                                    <div class="product-img" >
                                                        <img src="admin/uploads/'.$image_name.'" alt="">
                                                    </div>
                                                </div>';

                                                
                                        //get rest of the information here
                                        echo   '<div class="col-md-6 col-sm-6 mb-100">
                                                    <div class="cart-page-heading">
                                                        
                                                        <h6>Order Number : '.$row['order_id'].'</h6>
                                                        <p>The Details</p>
                                                        <ul class="order-details-form mb-4">
                                                            <li><strong>Product Name : </strong><span>'.$row['product_name'].'</span></li>
                                                            <li><strong>Price : </strong><span>'.$row['price'].'</span></li>
                                                            <li><strong>Size : </strong><span>'.$row['size'].'</span></li>
                                                            <li><strong>Color : </strong><span>'.$row['color'].'</span></li>

                                                        </ul>
                                                        <p>Shipping Address</p>
                                                         <ul class="order-details-form mb-4">
                                                            <li><span>'.$row['shipping_address'].'</span></li>
                                                        </ul>
                                                    </div>
                                                    <a href="product_details.php?id='.$row['product_id'].'" class="btn essence-btn">View</a>
                                                    
                                                </div>' ;
                                         echo '<hr/>';             
                                      
                                    }
                                   

                                }

                                else
                                {
                                    echo '<h4>No orders yet</h4>';
                                }
                            
                            ?> 

                        </div>          
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ##### Order details end  ##### -->



<?php
    include('footer.php');
?>
