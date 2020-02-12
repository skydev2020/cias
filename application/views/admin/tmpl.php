<div class="d-flex align-items-stretch" style="flex-grow: 1">
    <nav id="sidebar">
        <div class="sidebar-header">
            <h3>Admin Panel</h3>
        </div>
        <ul class="list-unstyled components">
            <?php
                $url = $_SERVER['REQUEST_URI'];
                $active = ( strpos($url,'admin/getUser/1') !==false) ? "class='active'" : "" ;
            ?>
            <li <?php echo $active; ?>>
                <a href="<?php echo base_url(); ?>admin/getUser/1" class="text-white">                    
                <i class="fas fa-user-cog"></i>&nbsp;&nbsp;<?php echo $fname. " " . $lname; ?>
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