<!-- require header -->
<?php require_once('header.php')?>

<!-- PUT CONTENT -->

<!-- contact_rsvp -->
<div class="contact_rsvp">
    <div class="container">
        <!-- title -->
        <div class="row">
            <div class="col-xl-12">
                <div class="text text-center">
                    <h3>Wpets Monitoring System</h3>
                </div>
            </div>
        </div>
        <!-- end title -->

        <!-- monitoring section -->
        <div class="monitoring-section">            
            <input type="hidden" id="controllerActions-url" value="<?=__BASE_URL__ ."controllerActions"?>">
            <!-- get data from database -->
            <div class="data-getter-div"></div> 
            <!-- end of get data -->
            <div class="monitoring-container">
                <!-- power circles -->
                <div class="power-circles">
                    <div class="power-circle">
                        <div class="progress1 progress-1"></div>
                        <div class="data">Source Power</div>
                    </div>
                    <div class="power-circle">
                        <div class="progress2 progress-1"></div>
                        <div class="data">Received Power</div>
                    </div>
                </div>
                <!-- end of power circles -->
                
                <div class="power-boxes-container">
                    <h4 class="power-boxes-title">Transmitter Coils</h4>
                    <div class="power-boxes">
                        <div class="power-box box5 e"></div>
                        <div class="power-box box6 f"></div>
                        <div class="power-box box7 g"></div>
                        <div class="power-box box8 h"></div>
                    </div>
                </div>
            </div>
        </div>
        <!-- end of monitoring section -->
    </div>
</div>
<!--/ contact_rsvp -->

<!-- END OF CONTENT -->

<!-- require footer -->
<?php require_once('footer.php')?>




