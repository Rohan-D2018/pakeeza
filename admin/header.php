<?php
session_start();
require 'config.php';
// error_reporting(E_ALL);
// ini_set('display_errors', TRUE);

if (!isset($_SESSION['username']))
    {
      header('Location:index.php');
      exit();
    } 
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- The above 4 meta tags *must* come first in the head; any other head content must come *after* these tags -->

    <!-- Title  -->
    <title>Pakaeeza Admin</title>

    <!-- Favicon  -->
    <link rel="icon" href="img/core-img/favicon.ico">

    <!-- Core Style CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css">  
    <link rel="stylesheet" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/custom.css">
    <link rel="stylesheet" href="css/unitgallery.css">
    

    <!-- <script src="js/jquery/jquery-2.2.4.min.js"></script> -->
    <script src="https://code.jquery.com/jquery-3.3.1.js"></script>

    <script src="js/ug-theme-compact.js"></script>
    <!-- <script type="text/javascript"  src="js/datatable.js"></script> -->
    <script  type="text/javascript" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>

    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
    <link href="css/bootstrap-toggle.min.css" rel="stylesheet">

</head>

<body>
    
    <nav class="navbar navbar-expand-sm navbar-dark bg-dark">
      <a class="navbar-brand" href="#">PAKEEZA ADMIN</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExample03" aria-controls="navbarsExample03" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarsExample03">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item  <?php if ($page == 'dashboard'){ echo "active"; } ?>">
            <a class="nav-link" href="dashboard.php">Dashboard</a>
          </li>
          <li class="nav-item  <?php if ($page == 'product'){ echo "active"; } ?>">
            <a class="nav-link" href="show_products.php">Product <span class="sr-only">(current)</span></a>
          </li>
          <li class="nav-item  <?php if ($page == 'collection'){ echo "active"; } ?>">
            <a class="nav-link" href="collection.php">Collection</a>
          </li>
           <li class="nav-item  <?php if ($page == 'branch'){ echo "active"; } ?>">
            <a class="nav-link" href="branch.php">Sub-Branch</a>
          </li>
          <li class="nav-item  <?php if ($page == 'size'){ echo "active"; } ?>">
            <a class="nav-link" href="size.php">Size</a>
          </li>
          <li class="nav-item  <?php if ($page == 'color'){ echo "active"; } ?>">
            <a class="nav-link" href="color.php">Color</a>
          </li>
          <li class="nav-item  <?php if ($page == 'order'){ echo "active"; } ?>">
            <a class="nav-link" href="orders.php">Orders</a>
          </li>
          <li class="nav-item  <?php if ($page == 'keywords'){ echo "active"; } ?>">
            <a class="nav-link" href="keywords.php">Keywords</a>
          </li>
           <li class="nav-item  <?php if ($page == 'banners'){ echo "active"; } ?>">
            <a class="nav-link" href="banners.php">Banners</a>
          </li>

          <!-- Only for admin user -->
          <?php
            if ((in_array("admin", $_SESSION['access_role'], TRUE)))
            {
              echo'<li class="nav-item '; if ($page == "manage_user"){ echo "active"; } echo'">
              <a class="nav-link" href="manage_users.php">Manage Users</a>
              </li>';
            }
          ?>
         
          <!-- <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="https://example.com" id="dropdown03" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Dropdown</a>
            <div class="dropdown-menu" aria-labelledby="dropdown03">
              <a class="dropdown-item" href="#">Action</a>
              <a class="dropdown-item" href="#">Another action</a>
              <a class="dropdown-item" href="#">Something else here</a>
            </div>
          </li> -->
        </ul>
        <ul class="navbar-nav ml-auto">
          <li class="nav-item">
            <a class="nav-link" href="logout.php?action=logout"><span class="fa fa-sign-out"></span><?php echo ($_SESSION['username'])?></a>
          </li>
        </ul>
        <!-- <form class="form-inline my-2 my-md-0">
          <input class="form-control" type="text" placeholder="Search">
        </form> -->
      </div>
    </nav>