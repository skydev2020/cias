<div class="container-fluid d-flex align-items-stretch">
    <nav id="sidebar">
        <div class="sidebar-header">
            <h3>Navigation</h3>
        </div>
        <ul class="list-unstyled components">
            <li>
                <a href="<?php echo base_url(); ?>admin/profile" class="text-white">                    
                    <img src="<?php echo base_url(); ?>assets/dist/img/avatar.png" class="img-circle" alt="User Image" />
                    <?php echo $name; ?>
                </a>
            </li>
            <li class="active">
                <a href="<?php echo base_url(); ?>admin/users" class="text-white">
                    <i class="fa fa-users"></i>&nbsp;&nbsp;Users
                </a>
            </li>
        </ul>
    </nav>
    <?=$module?>
</div>