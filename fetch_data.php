<?php

include('admin/config.php');

if(isset($_POST["action"]))
{
    $sql ="SELECT * FROM tbl_products ";
    
    if(isset($_POST["collection_id"])){
        $sql = $sql . " WHERE collection_id=".$_POST['collection_id']." AND delete_status=0";
    }
    else if(isset($_POST['range'])){
        $sql = $sql . " WHERE price BETWEEN ".$_POST['range'][0]." AND ".$_POST['range'][1]." AND delete_status=0";
    }
    else if(isset($_POST['color_hex'])){
        $sql = $sql . " WHERE price BETWEEN ".$_POST['range'][0]." AND ".$_POST['range'][1]." AND delete_status=0";
    }
    $result = mysqli_query($conn,$sql);
    $return_output = array();
	$output = '';
	while($row = mysqli_fetch_array($result))
    {
        $sql = "SELECT * FROM tbl_pictures WHERE product_id=".$row['product_id']." LIMIT 2";        
        $images = mysqli_query($conn, $sql);
        $image_array = array();
        while($row_image = mysqli_fetch_array($images))
        {
            array_push($image_array, $row_image['picture_url']);
        }
        $output .= '
        <div class="col-12 col-sm-6 col-lg-4">
            <div class="single-product-wrapper">
                <div class="product-img">
                    <img src="admin/uploads/'.$image_array[0].'" alt="">
                    <!-- Hover Thumb -->
                    <img class="hover-img" src="admin/uploads/'.$image_array[1].'" alt="">

                    <!-- Product Badge -->
                    <!-- <div class="product-badge offer-badge">
                        <span>-30%</span>
                    </div> -->
                    <!-- Favourite -->
                    <!-- <div class="product-favourite">
                        <a href="#" class="favme fa fa-heart"></a>
                    </div> -->
                </div>
                <div class="product-description">
                    <a href=""product_details.php?id="'.$row["product_id"].'">
                        <h6>'.$row["product_name"].'</h6>
                    </a>
                    <p class="product-price">₹' . $row["price"].'</p>

                    <!-- Hover Content -->
                    <div class="hover-content">
                        <!-- Add to Cart -->
                        <div class="add-to-cart-btn">
                            <a href="#" class="btn essence-btn">Add to Cart</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        ';
    } 
    array_push($return_output, $output);
    array_push($return_output, mysqli_num_rows($result));
    echo json_encode($return_output);
}

?>