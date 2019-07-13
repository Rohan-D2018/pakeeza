<?php

require('config.php');

$count_data = array();

$sql = "SELECT tbl_collections.collection_name,count(tbl_products.product_id) as product_count from tbl_collections
		INNER JOIN tbl_products ON tbl_collections.collection_id = tbl_products.collection_id
		GROUP BY tbl_collections.collection_name
		ORDER BY product_count DESC
		LIMIT 3";
                    
$result = mysqli_query($conn, $sql);

$sql_1 = "SELECT count(product_id) as count FROM tbl_products";
$result_1 = mysqli_query($conn, $sql_1);

while($row = mysqli_fetch_array($result_1))
{	
	$count_data['total_products'] = $row['count'];  
}


while($row = mysqli_fetch_array($result))
{	
	$count_data[$row['collection_name']] = $row['product_count'];  
}

$formatted_data = json_encode($count_data);
print_r($formatted_data);

?>
