<?php

include('header.php');

$sql ="SELECT * FROM tbl_sub_branch";
$sub_branches = mysqli_query($conn, $sql);
echo "number of rows: " . $result->num_rows;

?>

<html>
<div class="row" id="products">

                            <?php while($row = $sub_branches->fetch_assoc()){ ?>
                                <div class="col-sm-4">
				</div>
                                <!-- Single Product -->
                                <div class="col-sm-4">
                                    <div class="single-product-wrapper">
                                        <!-- Product Image -->
                                        <?php
                                            
                                            echo '<div class="product-img">
                                                    <img src="/img/'.$row['sub_branch_picture_url'].'" alt="">
                                                </div>';
                                        ?>

                                        <!-- Sub_branch Description -->
                                        <div class="product-description">
                                            <a href="<?php echo 'shop.php?id='.$row["sub_branch_id"]; ?>">
                                                <h6><?php echo $row["sub_branch_name"]; ?></h6>
						<h6><?php echo $row["sub_branch_description"]; ?></h6>
                                            </a>


                                            <!-- Hover Content -->
                                            <div class="hover-content">
                                                <!-- Select -->
                                                <div class="add-to-cart-btn">
                                                    <a href="#" class="btn essence-btn">Select</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
				<?php $row = $sub_branches->fetch_assoc(); ?>
				<div class="col-sm-4">
                                    <div class="single-product-wrapper">
                                        <!-- Product Image -->
                                        <?php
                                            
                                            echo '<div class="product-img">
                                                    <img src="/img/'.$row['sub_branch_picture_url'].'" alt="">
                                                </div>';
                                        ?>

                                        <!-- Sub_branch Description -->
                                        <div class="product-description">
                                            <a href="<?php echo 'shop.php?id='.$row["sub_branch_id"]; ?>">
                                                <h6><?php echo $row["sub_branch_name"]; ?></h6>
						<h6><?php echo $row["sub_branch_description"]; ?></h6>
                                            </a>


                                            <!-- Hover Content -->
                                            <div class="hover-content">
                                                <!-- Select -->
                                                <div class="add-to-cart-btn">
                                                    <a href="#" class="btn essence-btn">Select</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>
                        </div>


</html>





<?php

include('footer.php');

?>
