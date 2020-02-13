<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?php echo $pageTitle; ?></title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <!-- Bootstrap-->
    <link href="<?php echo base_url(); ?>assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <!-- Ionicons 2.0.0 -->
    <link href="<?php echo base_url(); ?>assets/plugins/Ionicons/css/ionicons.min.css" rel="stylesheet" type="text/css" />
    <!-- Theme style -->
    <link href="<?php echo base_url(); ?>assets/dist/css/AdminLTE.css" rel="stylesheet" type="text/css" />
    <!-- AdminLTE Skins. Choose a skin from the css/skins 
         folder instead of downloading all of them to reduce the load. -->
    <link href="<?php echo base_url(); ?>assets/dist/css/skins/_all-skins.css" rel="stylesheet" type="text/css" />

    <!-- Custom Project style -->
    <link href="<?php echo base_url(); ?>assets/dist/css/cias.css" rel="stylesheet" type="text/css" />

    <script src="<?php echo base_url(); ?>assets/plugins/jquery/jquery.min.js"></script>
    <script type="text/javascript">
        var baseURL = "<?php echo base_url(); ?>";
    </script>
    
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
    <link rel="shortcut icon" type="image/jpg" href="<?php echo base_url(); ?>/favicon.png"/>
  </head>
  <body>
    <div class="wrapper d-flex flex-column" style="min-height: 100vh">
      <?php 
          $className = ($uri == "" || $uri == "search") ? "container" : "container-fluid";
      ?>
      <header class="<?php echo $className; ?>">
        <nav class="navbar navbar-expand-lg navbar-light bg-white">
          <div class="navbar-brand">
            <a href="<?php echo base_url(); ?>">
              <img src="<?php echo base_url(); ?>assets/images/logo.png" height="40" class="d-inline-block align-top" alt="Logo Image">
            </a>
          </div>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>

          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <?php
              $hidden_str = ($uri == "register" || $uri == "login") ? "d-none" : ""; 
            ?>         
            <ul class="navbar-nav ml-auto <?php echo $hidden_str; ?>">
              <?php
                $active_str = ($uri == "" || $uri == "search" ) ? "active" : ""; 
                $hidden_str = (strpos($uri, "admin") !==false) ? "d-none" : "";
              ?>
              <li class="nav-item">
                <a class="nav-link font-size-14 font-weight-bold <?php echo $active_str; ?> <?php echo $hidden_str; ?>" href="<?php echo base_url(); ?>">Search</a>
              </li>
              <?php
                $active_str = ($uri == "login") ? "active" : ""; 
                $hidden_str = ($logged_in == true) ? "d-none" : "";
              ?>
              <li class="nav-item">
                <a class="nav-link font-size-14 font-weight-bold <?php echo $active_str; ?> <?php echo $hidden_str; ?>" href="<?php echo base_url(); ?>login">Log In</a>
              </li>
              <?php
                $active_str = ($uri == "register") ? "active" : ""; 
                $hidden_str = ($logged_in == true) ? "d-none" : "";
              ?>
              <li class="nav-item">
                <a class="nav-link font-size-14 font-weight-bold <?php echo $active_str; ?> <?php echo $hidden_str; ?>" href="<?php echo base_url(); ?>register">Register</a>
              </li>
              <?php
                $hidden_str = ($logged_in != true || strpos($uri, "admin") !==false) ? "d-none" : ""; 
              ?>
              <li class="nav-item">
                <a class="nav-link font-size-14 font-weight-bold <?php echo $hidden_str; ?>" href="<?php echo base_url(); ?>logout">Log Out</a>
              </li>
            </ul>            
          </div>
        </nav>          
      </header>
      <?php
        
        $hidden_str = ($uri == "register" || $uri == "forgot_password"  || $uri == "login" || strpos($uri, "admin") !==false) ? "d-none" : "d-flex"; 
      ?>
      <div class="<?php echo $className; ?> justify-content-center <?php echo $hidden_str; ?>">
          <img src="<?php echo base_url(); ?>assets/images/ad.jpg" height="90px" class="d-inline-block align-top" alt="Advertisement Image">
      </div>
