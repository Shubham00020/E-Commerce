<?php 
  include 'head.php';
?>
  <div class="header-top">
    <div class="container">
        <div class="col-sm-4 logo animated wow fadeInLeft" data-wow-delay=".5s">
          <h1><a href="/web/admin/index.php">Youth <span>Fashion</span></a></h1> 
        </div>
    </div>
  </div>
        <nav class="navbar nav_bottom" role="navigation">
         <!-- Brand and toggle get grouped for better mobile display -->
          <div class="navbar-header nav_2">
            <button type="button" class="navbar-toggle collapsed navbar-toggle1" data-toggle="collapse" data-target="#bs-megadropdown-tabs">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#"></a>
           </div> 
           <!-- Collect the nav links, forms, and other content for toggling -->
          <div class="collapse navbar-collapse" id="bs-megadropdown-tabs">
            <ul class="nav navbar-nav nav_1">
              <li><a href="index.php">Administrator Home</a></li>
              <li><a href="brands.php">Brands</a></li>
              <li><a href="categories.php">Category</a></li>
              <li><a href="products.php">Products</a></li>              
              <li><a href="archives.php">Archived</a></li>
              <?php if(has_permission('admin')): ?>
                <li><a href="users.php">Users</a></li>
              <?php endif;?>
              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">Hello <?=$user_data['first'];?>!
                <span class="caret"></span>
              </a>
              <ul class="dropdown-menu" role="menu">
                <li><a href="change_password.php">Change Password</a></li>
                <li><a href="logout.php">Log Out</a></li>
              </ul>
              </li>
            </ul>
          </div>
          <hr>
        </nav>
          <link href="../css/popuo-box.css" rel="stylesheet" type="text/css" media="all"/>
          <script src="../js/jquery.magnific-popup.js" type="text/javascript"></script>
        </div>
<div class="container">