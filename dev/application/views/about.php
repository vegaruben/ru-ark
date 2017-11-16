<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" type="image/png" href="img/favicon-32x32.png">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <link rel="stylesheet" href="/assets/css/echad.css">
</head>
<body class="home">

<div class="container">
    <nav class="navbar navbar-expand-lg navbar-light">
        <a class="navbar-brand" href="#"><img src="/assets/img/logo-funnlz.png"></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link" href="about.php">about <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">plans</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">contact</a>
                </li>
            </ul>
            <div class="login-bottons pull-right">
                <a href="#" class="login" id="" data-toggle="modal" data-target="#loginDlg"><i class="fa fa-lg fa-sign-in" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;LOGIN&nbsp;</a><a href="#" data-toggle="modal" data-target="#signupDlg" class="btn btn-primary my-2 my-sm-0" id="" ><i class="fa fa-lg fa-user-plus" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;SIGN UP</a>
            </div>
        </div>
    </nav>
</div>
<!-- Login Modal -->
<div aria-hidden="true" aria-labelledby="loginDlgLabel" class="modal fade" id="loginDlg" role="dialog" tabindex="-1">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="loginDlgLabel">Login</h5><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <?php echo form_open('/user/ajax_login', 'id="loginform" class="form-horizontal" role="form"');?>
                <?php $this->load->view('status') ;?>
                <div style="margin-bottom: 25px" class="input-group">
                    <span class="input-group-addon"><i class="fa fa-user" aria-hidden="true"></i></span>
                    <input id="login-username" type="text" class="form-control" name="username" value="" placeholder="username or email" required />
                </div>

                <div style="margin-bottom: 25px" class="input-group">
                    <span class="input-group-addon"><i class="fa fa-lock" aria-hidden="true"></i></span>
                    <input id="login-password" type="password" class="form-control" name="password" placeholder="password" required />
                </div>


                <!--
                <div class="input-group">
                    <div class="checkbox">
                        <label>
                            <input id="login-remember" type="checkbox" name="remember" value="1"> Remember me
                        </label>
                    </div>
                </div>
                -->

                <div style="margin-top:10px" class="form-group row">
                    <!-- Button -->

                    <div class="col-sm-3 controls">
                        <button type="submit" id="btn-login" class="btn btn-success">Login  </button>
                    </div>
                    <div class="col-sm-9 controls pull-right">
                        <p class="pull-right"><a id="btn-fblogin" href="/user/facebook-login" class="btn btn-primary ">Facebook</a>&nbsp;&nbsp; <a id="btn-gmaillogin" href="/user/gmail-login" class="btn btn-primary ">Gmail</a>&nbsp;&nbsp; <a id="btn-twitterlogin" href="/user/twitter-login" class="btn btn-primary">Twitter</a>&nbsp;</p>
                    </div>
                </div>

                <?php echo form_close();?>
            </div>

        </div>
    </div>
</div>
<!--signup modal-->
<!-- Login Modal -->
<div aria-hidden="true" aria-labelledby="signupDlgLabel" class="modal fade" id="signupDlg" role="dialog" tabindex="-1">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="signupDlgLabel">Signup</h5><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <?php echo form_open('/user/ajax-signup','id="signupform" class="form-horizontal" role="form"');?>
                <?php $this->load->view('status') ;?>
                <div class="form-group row">
                    <label for="email" class="col-md-3 form-control-label">Email</label>
                    <div class="col-md-9">
                        <input type="text" class="form-control" name="email" placeholder="Email Address" required value="">
                    </div>
                </div>

                <div class="form-group row">
                    <label for="firstname" class="col-md-3 form-control-label">First Name</label>
                    <div class="col-md-9">
                        <input type="text" class="form-control" name="firstName" placeholder="First Name" required value="">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="lastname" class="col-md-3 form-control-label">Last Name</label>
                    <div class="col-md-9">
                        <input type="text" class="form-control" name="lastName" placeholder="Last Name" required value="">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="password" class="col-md-3 form-control-label">Password</label>
                    <div class="col-md-9">
                        <input type="password" class="form-control" name="password" placeholder="Password" required >
                    </div>
                </div>

                <div class="form-group row">
                    <!-- Button -->
                    <div class="col-md-offset-3 col-md-9">
                        <button id="btn-signup" type="submit" class="btn btn-info"><i class="icon-hand-right"></i> &nbsp Sign Up</button>
                        <span style="margin-left:8px;">or</span>
                    </div>
                </div>

                <div style="border-top: 1px solid #999; padding-top:20px"  class="form-group">

                    <div class="col-md-offset-3 col-md-9">
                        <p class="pull-right"><a id="btn-fblogin" href="/user/facebook-login" class="btn btn-primary ">Facebook</a>&nbsp;&nbsp; <a id="btn-gmaillogin" href="/user/gmail-login" class="btn btn-primary ">Gmail</a>&nbsp;&nbsp; <a id="btn-twitterlogin" href="/user/twitter-login" class="btn btn-primary">Twitter</a>&nbsp;</p>
                    </div>

                </div>
                <?php echo form_close();?>
            </div>
        </div>
    </div>
</div>

<div class="container">
    <div class="row">
        <div class="col-md">
            <h1>About Us</h1>

            We started this business in hopes that it will help you with yours.
        </div>
    </div>
</div>

<div class="greyband">
    <div class="container">
        <div class="row">
            <div class="col-md-9">
                <h2>Ark Pizarro</h2>
                <span>Job Title</span>

                <p>Curabitur eleifend ex ultrices mauris hendrerit, id dictum libero cursus. Quisque ut lorem eu quam placerat cursus quis ac orci. Phasellus varius, arcu in interdum porttitor, nibh risus tincidunt metus, ac vulputate nulla lorem in tellus. Duis porta lacus in malesuada euismod. Fusce vestibulum ornare vestibulum. Morbi non dui sem. Maecenas blandit diam sed placerat mollis. Maecenas in faucibus sapien, a malesuada est. Curabitur risus lacus, lobortis et diam et, dictum sollicitudin elit.</p>

                <p>Curabitur eleifend ex ultrices mauris hendrerit, id dictum libero cursus. Quisque ut lorem eu quam placerat cursus quis ac orci. Phasellus varius, arcu in interdum porttitor, nibh risus tincidunt metus</p>
            </div>
            <div class="col-md-3"><img src="img/ark.jpg" class="img-fluid"></div>
        </div>
    </div>
</div>

<div class="greyband">
    <div class="container">
        <div class="row">
            <div class="col-md-3"><img src="img/ruben.jpg" class="img-fluid"></div>
            <div class="col-md-9">
                <h2>Ruben Vega</h2>
                <span>Job Title</span>

                <p>Ruben was born and raised in the San Francisco Bay Area. He has been a professional web developer since 2000, and has served high-profile companies such as Cisco Systems Inc. - dubbed the internet's "backbone", and Check Point Software Technologies LTD - which focuses on internet security. Ruben specializes in creating database driven web applications and responsive web designs in HTML5 / CSS3 that look beautiful on both a PC as well as on mobile platforms. His extensive experience also includes internet marketing and email marketing.</p>
            </div>
        </div>

    </div>
</div>

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
<script type="text/javascript" src="//code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>

<script type="text/javascript" src="<?=base_url('assets/js/main.min.js')?>"></script>


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


<?php
//for development may be its faster to separete the js files
if (isset($jsfiles) && count($jsfiles)){
    foreach ($jsfiles as $js){
        echo "<script type=\"text/javascript\" src=\"". base_url(). "assets/js/$js\" ></script>\r\n";
    }
}
?>
</html>


