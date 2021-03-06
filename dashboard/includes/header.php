<?php
require_once("config.php");

if(isset($_SESSION['userLoggedIn'])) {
  $userLoggedIn = $_SESSION['userLoggedIn'];
  $query = $db_host->prepare("SELECT * FROM admin_user WHERE username=:username");
  $query->bindParam(":username", $userLoggedIn);
  $query->execute();

  $sqlData = $query->fetch(PDO::FETCH_ASSOC);
} else {
  header("Location: signIn.php");
}
?>

<!DOCTYPE html>
<html lang="zh-Hant-TW">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <!-- Meta, title, CSS, favicons, etc. -->
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>ISport! | <?= $title ?></title>

  <!-- Bootstrap -->
  <link href="../vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="<?= $bootstrapLink ?>" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

  <!-- Font Awesome -->
  <link href="../vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"
    integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
    <!-- iCheck -->
<!--    <link href="../vendors/iCheck/skins/flat/green.css" rel="stylesheet">-->
  <!-- NProgress -->
  <link href="../vendors/nprogress/nprogress.css" rel="stylesheet">

  <!-- Custom Theme Style -->
  <link href="../build/css/custom.min.css" rel="stylesheet">
  <link href="/project_01/dashboard/css/<?= $style ?>" rel="stylesheet">
</head>

<body class="nav-md">
  <div class="container body">
    <div class="main_container">
      <div class="col-md-3 left_col">
        <div class="left_col scroll-view">
          <div class="navbar nav_title" style="border: 0;">
            <a href="index.html" class="site_title"><img class="px-1 mx-1" src="./images/biceps.svg" alt="" width="40">
              <span>ISport!</span></a>
          </div>

          <div class="clearfix"></div>

          <!-- menu profile quick info -->
          <div class="profile clearfix">
            <div class="profile_pic">
              <img src="images/img.jpg" alt="..." class="img-circle profile_img">
            </div>
            <div class="profile_info">
              <span>Welcome,</span>
              <h2>John Doe</h2>
            </div>
            <div class="clearfix"></div>
          </div>
          <!-- /menu profile quick info -->

          <br />

          <!-- sidebar menu -->
          <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
            <div class="menu_section">
              <h3>General</h3>
              <ul class="nav side-menu">
                <li><a><i class="fas fa-user"></i> ???????????? <span class="fa fa-chevron-down"></span></a>
                  <ul class="nav child_menu">
                    <li><a href="/project_01/dashboard/axios_user_list.php">????????????</a></li>
                    <li><a href="/project_01/dashboard/user_create.php">????????????</a></li>
                  </ul>
                </li>
                <li><a><i class="far fa-list-alt"></i> ???????????? <span class="fa fa-chevron-down"></span></a>
                  <ul class="nav child_menu">
                    <li><a href="user_order.php">????????????</a></li>
                    <li><a href="user_order_create.php">????????????</a></li>
                  </ul>
                </li>
                <li><a><i class="far fa-newspaper"></i> ???????????? <span class="fa fa-chevron-down"></span></a>
                  <ul class="nav child_menu">
                    <li><a href="article_list.php">????????????</a></li>
                    <li><a href="article_create.php">????????????</a></li>
                  </ul>
                </li>
                <li><a><i class="fas fa-shopping-bag"></i> ???????????? <span class="fa fa-chevron-down"></span></a>
                  <ul class="nav child_menu">
                    <li><a href="/project_01/dashboard/product_list.php">????????????</a></li>
                    <li><a href="/project_01/dashboard/product_creat.php">????????????</a></li>
                  </ul>
                </li>
                <li><a><i class="fab fa-youtube"></i> ???????????? <span class="fa fa-chevron-down"></span></a>
                  <ul class="nav child_menu">
                    <li><a href="showVideoList.php">????????????</a></li>
                    <li><a href="uploadVideoFile.php">????????????</a></li>
                  </ul>
                </li>
              </ul>
            </div>


          </div>
          <!-- /sidebar menu -->


        </div>
      </div>

      <!-- top navigation -->
      <div class="top_nav">
        <div class="nav_menu d-flex justify-content-between align-item-center">
          <div class="toggle my-2">
            <a id="menu_toggle"><i class="fa fa-bars"></i></a>
          </div>
          <a class="align-self-center mx-3 btn btn-round btn-secondary text-white h6 m-0" style="font-size:.5em;"
            href="logOut.php">
            ??????
          </a>
        </div>
      </div>
      <!-- /top navigation -->
