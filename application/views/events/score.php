<div class="container-fluid">
    <!-- Content Page -->
    <section class="content">
        <div class="row event">
            <div class="col-md-4 col-sm-6 col-12">
                <div class="row">
                    <div class="col-12 d-flex font-size-22 font-weight-bold name font-italic">
                        EVENT #<?php echo $swimmingData->EventNumber; ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 d-flex font-size-24 font-weight-bold color-dark">
                        <?php echo $swimmingData->EventName; ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 d-flex font-size-22 color-dark">
                        <?php echo $event->name; ?>
                    </div>
                </div>                                                 
            </div>
            <div class="col-md-4 col-sm-6 col-12 d-flex flex-column align-items-center justify-content-center">
                <div class="clock-cell">
                    <div class="col-12 d-flex font-size-10 text-white align-items-center justify-content-center">
                        LIVE MEET CLOCK
                    </div>
                </div>
                <div class="flex-grow-1 clock-cell">
                    <div class="col-12 h-100 d-flex font-size-60 text-white align-items-center justify-content-center">
                        <?php echo $swimmingData->RunningTime; ?>
                    </div>
                </div>                                                            
            </div>
           
            <div class="col-md-4 col-sm-6 col-12 d-flex align-items-center justify-content-center">
                <div>
                    <select id="In the Water">
                        <option value="volvo">Volvo</option>
                        <option value="saab">Saab</option>
                        <option value="opel">Opel</option>
                        <option value="audi">Audi</option>
                    </select>
                </div>                                                       
            </div>
        </div>
        <?php
        if(!empty($swimmingData->LaneAthleteTeam)){
            foreach($swimmingData->LaneAthleteTeam as $lane)
            {
        ?>
        <div class="row lane">
            <div class="col-md-2 col-sm-6 col-12">
                <div class="row">
                    <div class="col-1 d-flex number font-size-36 justify-content-center align-items-center text-white">
                        <?php echo $lane->LaneNumber ?>
                    </div>
                    <div class="col-1 bg-white">
                    </div>
                    <div class="col bg-white">
                        <div class="row">
                            <div class="col-12 d-flex font-size-24 font-weight-bold color-dark">
                                <?php echo $lane->AthleteName ?>&nbsp;
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 d-flex align-items-center">
                                <span class="font-weight-bold font-size-18 color-dark">Age:&nbsp;</span>18
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 d-flex align-items-center">
                                <span class="font-weight-bold font-size-18 color-dark">TEAM:&nbsp;</span>
                                <?php echo $lane->Team ?>
                            </div>                            
                        </div>
                        <div class="row">
                            <div class="col-12 d-flex align-items-center"><span class="font-weight-bold font-size-18 color-dark">Seed:&nbsp;</span>01:52.4</div>                            
                        </div>
                    </div>
                </div>                
            </div>
            <div class="col-md-2 col-sm-6 col-12 d-flex justify-content-center align-items-center">                
                <div class="pl-4 pr-4 pt-2 pb-2 font-size-24 font-weight-bold text-white bg-color-333333 r-cell">
                    &nbsp;<?php echo $lane->FinalTime ?>&nbsp;
                </div>
            </div>
            <div class="col-md-2 col-sm-6 col-12 d-flex flex-column">
                <div class="">
                    <div class="col-12 d-flex text-white justify-content-center distance-cell align-items-center font-size-18" style="height: 30px;">50m</div>
                </div>
                <div class="flex-grow-1">
                    <div class="col-12 h-100 bg-white d-flex font-size-30 color-dark align-items-center justify-content-center">(27.44)</div>
                </div>
            </div>
            <div class="col-md-2 col-sm-6 col-12 d-flex flex-column">
                <div class="">
                    <div class="col-12 d-flex text-white justify-content-center distance-cell align-items-center font-size-18" style="height: 30px;">100m</div>
                </div>
                <div class="flex-grow-1">
                    <div class="col-12 h-100 bg-white d-flex font-size-24 color-dark align-items-center justify-content-center font-weight-bold">52.78</div>
                </div>
                <div class="flex-grow-1">
                    <div class="col-12 h-100 bg-white d-flex font-size-30 color-dark align-items-center justify-content-center">(27.44)</div>
                </div>
            </div>
            <div class="col-md-2 col-sm-6 col-12 d-flex flex-column">
                <div class="">
                    <div class="col-12 d-flex text-white justify-content-center distance-cell align-items-center font-size-18" style="height: 30px;">150m</div>
                </div>
                <div class="flex-grow-1">
                    <div class="col-12 h-100 bg-white d-flex font-size-24 color-dark align-items-center justify-content-center font-weight-bold">52.78</div>
                </div>
                <div class="flex-grow-1">
                    <div class="col-12 h-100 bg-white d-flex font-size-30 color-dark align-items-center justify-content-center">(27.44)</div>
                </div>
            </div>
            <div class="col-md-2 col-sm-6 col-12 d-flex flex-column">
                <div class="">
                    <div class="col-12 d-flex text-white justify-content-center distance-cell align-items-center font-size-18" style="height: 30px;">200m</div>
                </div>
                <div class="flex-grow-1">
                    <div class="col-12 h-100 bg-white d-flex font-size-24 color-dark align-items-center justify-content-center font-weight-bold">52.78</div>
                </div>
                <div class="flex-grow-1">
                    <div class="col-12 h-100 bg-white d-flex font-size-30 color-dark align-items-center justify-content-center">(27.44)</div>
                </div>
            </div>
        </div>
        <?php
            } 
        }
        ?>
    </section>
</div>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/common.js" charset="utf-8"></script>
<script type="text/javascript">
    jQuery(document).ready(function(){
        jQuery('ul.pagination li a').click(function (e) {
            e.preventDefault();            
            var link = jQuery(this).get(0).href;            
            var value = link.substring(link.lastIndexOf('/') + 1);
            jQuery("#searchList").attr("action", baseURL + "userListing/" + value);
            jQuery("#searchList").submit();
        });
    });
</script>