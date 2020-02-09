<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?php echo $pageTitle; ?></title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <!-- Bootstrap-->
    <link href="<?php echo base_url(); ?>assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <!-- FontAwesome 4.3.0 -->
    <link href="<?php echo base_url(); ?>assets/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <!-- Ionicons 2.0.0 -->
    <link href="<?php echo base_url(); ?>assets/plugins/Ionicons/css/ionicons.min.css" rel="stylesheet" type="text/css" />
    <!-- Theme style -->
    <link href="<?php echo base_url(); ?>assets/dist/css/AdminLTE.css" rel="stylesheet" type="text/css" />
    <!-- AdminLTE Skins. Choose a skin from the css/skins 
         folder instead of downloading all of them to reduce the load. -->
    <link href="<?php echo base_url(); ?>assets/dist/css/skins/_all-skins.css" rel="stylesheet" type="text/css" />

    <!-- Custom Project style -->
    <link href="<?php echo base_url(); ?>assets/dist/css/cias.css" rel="stylesheet" type="text/css" />

    <style>
    	.error{
    		color:red;
    		font-weight: normal;
    	}
    </style>
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
  </head>
  <body class="hold-transition">
    <div class="wrapper">
      <header class="container-fluid">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
          <div class="navbar-brand">
            <img src="<?php echo base_url(); ?>assets/images/logo.png" height="40" class="d-inline-block align-top" alt="Logo Image">
          </div>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>

          <div class="collapse navbar-collapse" id="navbarSupportedContent">         
            <ul class="navbar-nav ml-auto">
              <?php
                $active_str = ($uri == "" || $uri == "search") ? "active" : ""; 
              ?>
              <li class="nav-item">
                <a class="nav-link <?php echo $active_str; ?>" href="<?php echo base_url(); ?>">Home</a>
              </li>
              <?php
                $active_str = ($uri == "login") ? "active" : ""; 
                $hidden_str = ($logged_in == true) ? "d-none" : "";
              ?>
              <li class="nav-item">
                <a class="nav-link <?php echo $active_str; ?> <?php echo $hidden_str; ?>" href="<?php echo base_url(); ?>login">Log in</a>
              </li>
              <?php
                $active_str = ($uri == "register") ? "active" : ""; 
                $hidden_str = ($logged_in == true) ? "d-none" : "";
              ?>
              <li class="nav-item">
                <a class="nav-link <?php echo $active_str; ?> <?php echo $hidden_str; ?>" href="<?php echo base_url(); ?>register">Register</a>
              </li>
              <?php
                $hidden_str = ($logged_in != true) ? "d-none" : ""; 
              ?>
              <li class="nav-item">
                <a class="nav-link <?php echo $hidden_str; ?>" href="<?php echo base_url(); ?>logout">Log out</a>
              </li>
            </ul>            
          </div>
        </nav>          
      </header>
      <div class="container-fluid d-flex ">
          <img src="<?php echo base_url(); ?>assets/images/ad.jpg" height="40" class="d-inline-block align-top" alt="Advertisement Image">
      </div>
