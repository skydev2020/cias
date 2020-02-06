<div class="container-fluid">
    <!-- Content Page -->
    <section class="content">
        <div class="row event">
            <div class="col-md-2 col-sm-6 col-12">
                <div class="row">
                    <div class="col-1 d-flex number font-size-36 justify-content-center align-items-center text-white">0</div>
                    <div class="col-1">
                    </div>
                    <div class="col">
                        <div class="row">
                            <div class="col-12 d-flex font-size-24 font-weight-bold color-dark">Nunn, S</div>
                        </div>
                        <div class="row">
                            <div class="col-12 d-flex align-items-center"><span class="font-weight-bold font-size-18 color-dark">Age:&nbsp;</span>18</div>
                        </div>
                        <div class="row">
                            <div class="col-12 d-flex align-items-center"><span class="font-weight-bold font-size-18 color-dark">TEAM:&nbsp;</span>QUEST</div>                            
                        </div>
                        <div class="row">
                            <div class="col-12 d-flex align-items-center"><span class="font-weight-bold font-size-18 color-dark">Seed:&nbsp;</span>01:52.4</div>                            
                        </div>
                    </div>
                </div>                
            </div>
            <div class="col-md-2 col-sm-6 col-12 d-flex justify-content-center align-items-center">                
                <div class="pl-5 pr-5 pt-3 pb-3 font-size-24 font-weight-bold text-white bg-color-333333 r-cell">r:+0.77</div>
            </div>
            <div class="col-md-2 col-sm-6 col-12">
                50m <br/> (27.44)
            </div>
            <div class="col-md-2 col-sm-6 col-12">
                100m <br/> 52.78 (27.44)
            </div>
            <div class="col-md-2 col-sm-6 col-12">
                150m <br/> 52.78 (27.44)
            </div>
            <div class="col-md-2 col-sm-6 col-12">
                200m <br/> 52.78 (27.44)
            </div>
        </div>
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
