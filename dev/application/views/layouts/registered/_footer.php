<footer>
    <div class="container">
        <div class="row">
            <div class="col-md-4 text-center">
                <ul>
                    <li><a href="#">about</a></li>
                    <li><a href="#">plans</a></li>
                    <li><a href="#">contact</a></li>
                </ul>
            </div>
            <div class="col-md-4 text-center">
                <a href="#"><img src="/assets/img/logo-funnlz.png"></a><br>
                <p>&copy;2017 funnlz.io ltd. all rights reserved.<br><a href="#">privacy</a> | <a href="#">terms</a></p>
            </div>
            <div class="col-md-4 text-center">
                <div class="social-networks">
                    <a href="#" class="facebook"><i class="fa fa-facebook-official" aria-hidden="true"></i></a>
                    <a href="#" class="instagram"><i class="fa fa-instagram" aria-hidden="true"></i></a>
                    <a href="#" class="instagram"><i class="fa fa-linkedin-square" aria-hidden="true"></i></a>
                    <a href="#" class="twitter"><i class="fa fa-twitter" aria-hidden="true"></i></a>
                    <a href="#" class="google"><i class="fa fa-google-plus-square" aria-hidden="true"></i></a>
                </div>
            </div>
        </div>
    </div>
</footer>
<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="<?php echo base_url('assets/js/jquery.min.js');?>"></script>
<script type="text/javascript" src="<?=base_url('assets/bootstrap/js/bootstrap.min.js')?>"></script>
<script type="text/javascript" src="<?=base_url('assets/DataTables/datatables.min.js')?>"></script>

<!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
<script src="<?=base_url('assets/js/ie10-viewport-bug-workaround.js')?>"></script>
<script>
    var csfrData = {};
    csfrData['<?php echo $this->security->get_csrf_token_name(); ?>'] = '<?php echo $this->security->get_csrf_hash(); ?>';
    jQuery(document).ready(function($) {
        // Attach csfr data token
        $.ajaxSetup({
            data: csfrData
        });
    });
</script>

<!--<script type="text/javascript" src="<?=base_url('assets/js/main.min.js')?>"></script>-->

<?php
//for development may be its faster to separete the js files
if (isset($jsfiles) && count($jsfiles)){
    foreach ($jsfiles as $js){
        echo "<script type=\"text/javascript\" src=\"". base_url(). "assets/js/$js\" ></script>\r\n";
    }
}
?>
</html>
