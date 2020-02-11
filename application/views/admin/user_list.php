<div class="dashboard-content">
    <!-- Content Header (Page header) -->
    <section class="content">
        <div class="row">
            <div class="col-12">
                <h3>
                    <i class="fa fa-users"></i> User Management
                </h3>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="form-group">
                    <a class="btn btn-primary" href="<?php echo base_url(); ?>admin/addNew"><i class="fa fa-plus"></i> Add New</a>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title font-weight-bold">Users List</h3>
                        <div class="box-tools">
                            <form action="<?php echo base_url() ?>admin/users"  id="searchList">
                                <div class="input-group">
                                    <input type="text" name="searchText" value="<?php echo $searchText; ?>" class="form-control pull-right" style="width: 150px; height: 31px;" placeholder="Search"/>
                                    <div class="input-group-btn">
                                    <button class="btn btn-sm btn-default searchList"><i class="fa fa-search"></i></button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div><!-- /.box-header -->
                    <div class="box-body table-responsive no-padding">
                        <table class="table table-hover">
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Verified</th>                            
                            <th>Signup Date</th>
                            <th class="text-center">Actions</th>
                        </tr>
                        <?php
                        if(!empty($userRecords))
                        {
                            foreach($userRecords as $record)
                            {
                                $actionStr = ($record->isVerified == 1) ? "Suspend" : "Activate";
                                $actionUri = ($record->isVerified == 1) ? "Suspend" : "Activate";
                        ?>
                        <tr>
                            <td><?php echo $record->fname." ".$record->lname ?></td>
                            <td><?php echo $record->email ?></td>                            
                            <td>
                                <?php echo ($record->isVerified == 1) ? "Yes" : "No" ?>
                            </td>
                            <td><?php echo date("d-m-Y", strtotime($record->createdDtm)) ?></td>
                            <td class="text-center">
                                <a class="" href="<?php echo base_url().'admin/activate/'.$record->userId; ?>" title="<?php echo $actionStr ?>"><?php echo $actionStr ?></a>
                                <a class="btn btn-sm btn-info" href="<?php echo base_url().'admin/users/'.$record->userId; ?>" title="Edit"><i class="fa fa-pencil"></i></a>
                                <a class="btn btn-sm btn-danger deleteUser" href="#" data-userid="<?php echo $record->userId; ?>" title="Delete"><i class="fa fa-trash"></i></a>
                            </td>
                        </tr>
                        <?php
                            }
                        }
                        ?>
                        </table>
                        
                    </div><!-- /.box-body -->
                    <div class="box-footer clearfix">
                        <?php echo $this->pagination->create_links(); ?>
                    </div>
                    </div><!-- /.box -->
                </div>
            </div>
    </section>
</div>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/common.js" charset="utf-8"></script>  
