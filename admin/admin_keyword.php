<?php

require 'config.php';
function add_keyword()
{
	require 'config.php';

	if(isset($_POST["keyword"])){
        $keyword = $_POST["keyword"];
    }
    else{
        $keyword = "";
    }

	$sql ="INSERT INTO tbl_keywords (keyword) VALUES ('$keyword')";
    $result = mysqli_query($conn,$sql);

	// }
}

add_keyword();
header("Location: keywords.php");
?>