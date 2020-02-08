<div class="container-fluid">
    <!-- Content Page -->
    <section class="content">
        <div class="row event">
            <div class="col-md-2 col-sm-6 col-12">
                <div class="row">
                    <div class="col-1 d-flex number font-size-36 justify-content-center align-items-center text-white">0</div>
                    <div class="col-1 bg-white">
                    </div>
                    <div class="col bg-white">
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
