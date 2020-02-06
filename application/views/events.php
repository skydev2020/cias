<div class="container-fluid">
    <!-- Content Page -->
    <section class="content">
        <div class="row event">
            <div class="col-md-2 col-sm-6 col-12">
                <div class="row">
                    <div class="col-1 d-flex number">0</div>
                    <div class="col">
                        <div class="row">
                            <div class="col-12 d-flex justify-content-center">Nunn, S</div>
                        </div>
                        <div class="row">
                            <div class="col-12">Age: 18</div>
                        </div>
                        <div class="row">
                            <div class="col-12">Team: QUFST</div>
                        </div>
                        <div class="row">
                            <div class="col-12">Seed: 52.4</div>
                        </div>
                    </div>
                </div>
                
            </div>
            <div class="col-md-2 col-sm-6 col-12">
                r:+0.77
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
