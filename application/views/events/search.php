<div class="container-fluid search-page">
    <!-- Content Page -->
    <section class="content">
        <div class="row">
            <div class="col-12">
                <form action="<?php echo base_url() ?>search?"  id="searchList" class="justify-content-center d-flex">
                    <input class="form-control search" type="text" name="q" value="<?php echo $q; ?>" placeholder="Start typing...">
                </form>                               
            </div>            
        </div>
        <div class="row">
            <div class="col-12" style="height: 25px;">
            </div>
        </div>
        <?php
        if(!empty($eventRecords))
        {
            foreach($eventRecords as $event)
            {
        ?>
        <div class="row">
            <div class="col-12 col-sm-4 text-center">
                <a href="<?php echo base_url() ?>score?id=<?php echo $event->id ?>"><?php echo $event->name ?></a>
            </div>
            <div class="col-12 col-sm-4 text-center">
                <?php echo date("d-m-Y", strtotime($event->date_start)) ?>
            </div>
            <div class="col-12 col-sm-4 text-center">
                <?php echo date("d-m-Y", strtotime($event->date_end)) ?>
            </div>
        </div>                    
        <?php
            }
        }
        ?>        
    </section>
</div>

