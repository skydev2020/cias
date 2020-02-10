<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Swimmeetcast | Registration Email Sent</title>
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
                <p class="login-box-msg font-size-22 font-weight-bold">Email Verification</p>
                
                <div class="row">
                    <div class="col-12">
                    <?php                                    
                        $error = $this->session->flashdata('error');
                        if($error)
                        {
                    ?>
                        <div class="alert alert-danger alert-dismissable">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            <?php echo $this->session->flashdata('error'); ?>                    
                        </div>
                        <?php } ?>
                        <?php  
                            $success = $this->session->flashdata('success');
                            if($success)
                            {
                        ?>
                        <div class="alert alert-success alert-dismissable">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            <?php echo $this->session->flashdata('success'); ?>
                        </div>
                    <?php } ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 d-flex justify-content-end align-items-center">    
                        <small class="text-muted">
                            You can go back to&nbsp;
                            <a href="<?php echo base_url() ?>login">Log in</a>
                        </small>                                    
                    </div><!-- /.col -->
                </div>  
                

            </div><!-- /.login-box-body -->
        </div><!-- /.login-box -->

   </body>
   <script src="<?php echo base_url(); ?>assets/plugins/jquery/jquery.min.js"></script>
   <script src="<?php echo base_url(); ?>assets/plugins/bootstrap/js/bootstrap.min.js"></script>
  </html>