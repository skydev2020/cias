<div class="login-box" style="padding-top: 100px; margin-top: 0px;">      
    <div class="login-box-body">
        <p class="login-box-msg font-size-22 font-weight-bold">Log In to Swimmeetcast</p>
        <?php $this->load->helper('form'); ?>
        <div class="row">
            <div class="col-md-12">
                <?php echo validation_errors('<div class="alert alert-danger alert-dismissable">', ' <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></div>'); ?>
            </div>
        </div>
        <?php
        $this->load->helper('form');
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
                    <a class="" href="<?php echo base_url() ?>forgotPassword"><small>Forgot Password?</small></a><br/>
                </div><!-- /.col -->              
            </div>
            <div class="row" style="padding-top: 10px;">                
                <div class="col-12">
                    <div class="form-group w-100">
                      <input type="submit" class="btn btn-primary btn-block btn-flat" value="Sign In" />
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
