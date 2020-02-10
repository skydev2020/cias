<div class="container-fluid d-flex align-items-stretch">
    <nav id="sidebar">
        <div class="sidebar-header">
            <h3>Navigation</h3>
        </div>
        <ul class="list-unstyled components">
            <?php
                $url = $_SERVER['REQUEST_URI'];
                $active = ( strpos($url,'admin/users/1') !==false) ? "class='active'" : "" ;
            ?>
            <li <?php echo $active; ?>>
                <a href="<?php echo base_url(); ?>admin/users/1" class="text-white">                    
                    <img src="<?php echo base_url(); ?>assets/dist/img/avatar.png" class="img-circle" alt="User Image" />
                    <?php echo $fname. " " . $lname; ?>
                </a>
            </li>
            <?php
                if (strpos($url,'admin/users') !==false && strpos($url,'admin/users/') === false ) {
                    $active =  "class='active'" ;
                }
                else {
                    $active = "";
                }
            ?>
            <li <?php echo $active; ?>>
                <a href="<?php echo base_url(); ?>admin/users" class="text-white">
                    <i class="fa fa-users"></i>&nbsp;&nbsp;Users
                </a>
            </li>
            <li>
                <a href="<?php echo base_url(); ?>logout" class="text-white">
                    <i class="fa fa-sign-out"></i>&nbsp;&nbsp;Log Out
                </a>
            </li>
        </ul>
    </nav>
    <?=$module?>
</div>