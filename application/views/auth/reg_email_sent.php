<div class="dashboard-content d-flex d-flex align-items-center justify-content-center">
    <section class="register-form">
        <div class="row">
            <!-- left column -->
            <div class="col-12">
              <!-- general form elements -->
                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title">Email Verification</h3>
                    </div><!-- /.box-header -->
                    <!-- form start -->
                    
                    <div class="box-body">
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
                    </div><!-- /.box-body -->

                    <div class="box-footer">
                        <a href="<?php echo base_url(); ?>">Home</a>                        
                    </div>
                </div>
            </div>
        </div>
           
    </section>
    
</div>
<script src="<?php echo base_url(); ?>assets/js/addUser.js" type="text/javascript"></script>