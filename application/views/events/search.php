<div class="container search-page">
    <!-- Content Page -->
    <section class="content">
        <div class="row">
            <div class="col-12">
                <form action="<?php echo base_url() ?>search?"  id="searchList" class="justify-content-center d-flex">
                    <!-- <input class="form-control search" type="text" name="q" value="<?php echo $q; ?>" placeholder="Start typing..."> -->
                    <div class="input-group md-form form-sm form-2 pl-0 search-panel">
                        <input class="form-control my-0 py-1 query-text font-size-18" name="q" value="<?php echo $q; ?>"  type="text" placeholder="Start typing..." aria-label="Search">
                        <div class="input-group-append">
                            <button class="input-group-text search-btn"><i class="fa fa-search text-white font-size-24"
                                aria-hidden="true"></i></button>
                        </div>
                    </div>
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
            <div class="col-12 event-cell font-size-20 font-weight-bold">
                <a href="<?php echo base_url() ?>score?id=<?php echo $event->id ?>"><?php echo $event->name ?></a>
            </div>            
        </div>                    
        <?php
            }
        }
        ?>        
    </section>
</div>

