<div class="dashboard-content d-flex d-flex justify-content-center" style="padding-top: 100px;">
    <section class="register-form">
        <div class="row">
            <!-- left column -->
            <div class="col-12">
              <!-- general form elements -->
                <div class="box box-primary">
                    <div class="box-header text-center">
                        <h3 class="box-title font-weight-bold font-size-22">Sign up for Swimmeetcast</h3>
                    </div><!-- /.box-header -->
                    <!-- form start -->
                    <?php $this->load->helper("form"); ?>
                    <form role="form" id="addUser" action="<?php echo base_url() ?>register" method="post" role="form">
                        <div class="box-body">
                            <div class="row">
                                <div class="col-12 col-md-6 d-flex ">                                
                                    <div class="form-group">
                                        <input type="text" class="form-control required" placeholder="First Name" id="fname" name="fname" maxlength="128">
                                    </div>                                    
                                </div>
                                <div class="col-12 col-md-6">                                
                                    <div class="form-group">
                                        <input type="text" class="form-control required" placeholder="Last Name" id="lname" name="lname" maxlength="128">
                                    </div>
                                </div>
                            </div>    
                            <div class="row">
                                <div class="col-12 d-flex align-items-center">
                                    <div class="form-group w-100">
                                        <input type="text" class="form-control required email" id="email" placeholder="Email" name="email" maxlength="128">                                        
                                    </div>
                                </div>                                
                            </div>
                            <div class="row">
                                <div class="col-12 col-md-6 d-flex">
                                    <div class="form-group">
                                        <input type="password" class="form-control required" placeholder="Password" id="password" name="password" maxlength="20">
                                    </div>
                                </div>
                                <div class="col-12 col-md-6">
                                    <div class="form-group">
                                    <input type="password" class="form-control required equalTo" placeholder="Confirm Password"  id="cpassword" name="cpassword" maxlength="20">
                                    </div>
                                </div>
                            </div>
             
                            <div class="row">
                                <div class="col-12 d-flex align-items-center">
                                    <div class="form-group w-100">
                                        <input type="text" class="form-control" placeholder="Mobile" id="mobile" name="mobile" maxlength="10">                                        
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 d-flex align-items-center">
                                    <div class="form-group w-100">
                                        <input type="submit" class="btn btn-primary btn-block" value="Sign Up" />
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 d-flex justify-content-end align-items-center">    
                                    <small class="text-muted">
                                        Already on Swimmeetcast?&nbsp;
                                        <a href="<?php echo base_url() ?>login">Log in</a>
                                    </small>                                    
                                </div><!-- /.col -->
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <?php
                                        $this->load->helper('form');
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
                                    
                                    <div class="row">
                                        <div class="col-md-12">
                                            <?php echo validation_errors('<div class="alert alert-danger alert-dismissable">', ' <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></div>'); ?>
                                        </div>
                                    </div>
                                </div>
                            </div> 
                        </div><!-- /.box-body -->
                    </form>
                </div>
            </div>
        </div>
           
    </section>
    
</div>
<script src="<?php echo base_url(); ?>assets/js/addUser.js" type="text/javascript"></script>