<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Swimmeetcast | Login</title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        <link href="<?php echo base_url(); ?>assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url(); ?>assets/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url(); ?>assets/dist/css/AdminLTE.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url(); ?>assets/dist/css/cias.css" rel="stylesheet" type="text/css" />

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
            <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
        <!-- Google Font -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
    </head>
    <body class="auth-page">
        <div class="w-100 header d-flex justify-content-center">
            <a href="<?php echo base_url(); ?>">
                <img src="<?php echo base_url(); ?>assets/images/logo.png" height="40" class="d-inline-block align-top" alt="Logo Image">
            </a>
        </div>
        <div class="login-box" style="padding-top: 100px; margin-top: 0px;">      
            <!-- <div class="login-logo">
                <a href="#"><b>Swimmeetcast</b><br>Admin System</a>
            </div> -->
            <div class="login-box-body">
                <p class="login-box-msg font-size-22 font-weight-bold">Log In to Swimmeetcast</p>
                <?php $this->load->helper('form'); ?>
                <div class="row">
                    <div class="col-12">
                        <?php echo validation_errors('<div class="alert alert-danger alert-dismissable">', ' <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></div>'); ?>
                    </div>
                </div>
                <?php               
                $error = $this->session->flashdata('error');
                if($error)
                {
                ?>
                    <div class="alert alert-danger alert-dismissable">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <?php echo $error; ?>                    
                    </div>
                <?php }
                $success = $this->session->flashdata('success');
                if($success)
                {
                    ?>
                    <div class="alert alert-success alert-dismissable">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <?php echo $success; ?>                    
                    </div>
                <?php } ?>
                <form action="<?php echo base_url(); ?>login" method="post">
                    <div class="form-group has-feedback">
                        <input type="email" class="form-control" placeholder="Email" name="email" required />
                        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                    </div>
                    <div class="form-group has-feedback">
                        <input type="password" class="form-control" placeholder="Password" name="password" required />
                        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                    </div>
                    <div class="row">
                        <div class="col-12 d-flex justify-content-end">    
                            <a class="" href="<?php echo base_url() ?>forgot_password"><small>Forgot Password?</small></a><br/>
                        </div><!-- /.col -->              
                    </div>
                    <div class="row" style="padding-top: 10px;">                
                        <div class="col-12">
                            <div class="form-group w-100">
                            <input type="submit" class="btn btn-primary btn-block btn-flat" value="Login In" />
                            </div>  
                        </div><!-- /.col -->
                    </div>
                    <div class="row">
                        <div class="col-12 d-flex justify-content-end align-items-center">    
                            <small class="text-muted">
                                New to Swimmeetcast? &nbsp;
                                <a href="<?php echo base_url() ?>register">Sign up</a>
                            </small>                    
                        </div><!-- /.col -->
                    </div>
                    
                </form>

            </div><!-- /.login-box-body -->
        </div><!-- /.login-box -->

   </body>
   <script src="<?php echo base_url(); ?>assets/plugins/jquery/jquery.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/plugins/bootstrap/js/bootstrap.min.js"></script>
  </html>


