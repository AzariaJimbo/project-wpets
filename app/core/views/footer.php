       
    <!-- footer start -->
    <footer class="footer">
        <div class="copy-right_text">
            <div class="container">
                <div class="footer_border"></div>
                <div class="row">
                    <div class="col-xl-7 col-md-6">
                        <p class="copy_right">
                            <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | Powered by <a href="#" target="_blank">SKYTEC INDUSTRIES</a>
<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                        </p>
                    </div>
                    <div class="col-xl-5 col-md-6">
                        <div class="footer_links">
                            <ul>
                                <li><a href="<?=__BASE_URL__ ?>">WPETS</a></li>
                                <li><a _blank href="<?=__PUBLIC_DIR__?>about/<?=__ABOUT_FILE__ ?>">ABOUT</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!--/ footer end  -->
    
    </script>
    <script src="<?=__ASSETS_DIR__ ?>js/vendor/modernizr-3.5.0.min.js"></script>
    <script src="<?=__ASSETS_DIR__ ?>js/vendor/jquery-3.2.1.min.js"></script>
    <script src="<?=__ASSETS_DIR__ ?>js/bootstrap.min.js"></script>
    <!--contact js-->    
    <script src="<?=__ASSETS_DIR__ ?>js/jquery.ajaxchimp.min.js"></script>

    <script src="<?=__ASSETS_DIR__ ?>js/timveke.main.js"></script>
    <script src="<?=__ASSETS_DIR__ ?>js/jquery.circle-progress.min.js"></script>

    <script src="<?=__ASSETS_DIR__ ?>js/highlight.pack.js"></script>
	<script src="<?=__ASSETS_DIR__ ?>js/circle-progress.js"></script>
	<script src="<?=__ASSETS_DIR__ ?>js/circles.mine.js"></script>

    <script>

        $(function() {
            // likes 
            let ans, ans2, current_box, previous_box;
            // check-box -- publish
            setInterval (function (e) {
                // base url
                var baseUrl = $('#controllerActions-url').val();
                var is_published = "get-data";
                // send data via ajax
                $.ajax({
                    method: "POST",
                    url: baseUrl,
                    data: {
                        get_data: is_published
                    },
                    success: function (data) {   
                        $('.data-getter-div').html(data)
                        ans = $('#transmitted-power').val()
                        ans2 = $('#received-power').val()
                        current_box = $('#coil-active').val()   
                        previous_box = $('#previous_coil_active').val()                           
                        console.log(data)                       
                    }
                })

                // progress bar 1
                $('.progress1').circleProgress({
                    max: 100,
                    value: ans,
                    textFormat: function (value, max) {
                        return value + ' Watts';
                    }
                })

                // progress bar 2
                $('.progress2').circleProgress({
                    max: 100,
                    value: ans2,
                    textFormat: function (value, max) {
                        return value + ' Watts';
                    }
                })

                
                // power boxes
                if ($('.power-box').hasClass (current_box) == true) {
                    $("." + current_box).addClass ('power-box-active')
                    $("." + previous_box).removeClass ('power-box-active')
                } else {
                    $("." + previous_box).removeClass ('power-box-active')
                }

            }, 100)


        });
    </script>
</body>

</html>