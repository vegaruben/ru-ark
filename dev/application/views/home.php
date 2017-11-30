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
                    <a class="nav-link" href="/about">about <span class="sr-only">(current)</span></a>
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
<div aria-hidden="true" aria-labelledby="signupDlgLabel" class="modal fade" id="signupDlg" autocomplete="off" role="dialog" tabindex="-1">
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
                            <input type="text" class="form-control" autocomplete="off" name="email" placeholder="Email Address" required value="">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="firstname" class="col-md-3 form-control-label">First Name</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" autocomplete="off" name="firstName" placeholder="First Name" required value="">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="lastname" class="col-md-3 form-control-label">Last Name</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" autocomplete="off" name="lastName" placeholder="Last Name" required value="">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="password" class="col-md-3 form-control-label">Password</label>
                        <div class="col-md-9">
                            <input type="password" class="form-control" autocomplete="off" name="password" placeholder="Password" required >
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
        <div class="col-md-12">
            <?php $this->load->view('status');?>
        </div>
    </div>
</div>
<div class="tier1-bg">
    <div class="container h-100">
        <div class="row h-100">
            <div class="col-md-6 h-100 justify-content-center align-items-center">

                <iframe src="https://www.youtube.com/embed/b41AELY7i04?ecver=2" width="640" height="360" frameborder="0" style="position:absolute;width:100%;height:100%;padding: 0 47px;left:0" allowfullscreen></iframe>

            </div>
            <div class="col-md-6 h-100 justify-content-center align-items-center">
                <div class="tier1-txt">
                    A Better Way To Advertise<br>
                    Because You Have<br>
                    A Business To Run&hellip;
                </div>
            </div>
        </div>
    </div>
</div>
<div class="container">
    <div class="row tier2">
        <div class="col-md">
            <p>Running ads is hard and time consuming.</p>
            Between:
            <ul>
                <li>Learning to run ads</li>
                <li>Writing ad copy</li>
                <li>Managing campaigns</li>
                <li>Moderating comments</li>
            </ul>
            <span>Now There&rsquo;s A Better Way</span>
        </div>
        <div class="col-md">
            <p>Marketing your business can get really
                expensive</p>
            <p><b>Funnlz can help reduce your marketing budget for your ads by as much as 50%</b></p>
            <div class="btn-pos text-center"><button class="btn btn-secondary my-2 my-sm-0" role="button" type="button">LEARN MORE</button></div>
        </div>
        <div class="col-md">
            Getting customers to convert to sales has never been  easier. With Funnelz unique co-operative marketing platform your products receive more exposure for less money, leading to more sales.
        </div>
    </div>
    <row>
        <div class="col text-center">
            <h2>A MUCH NEEDED
                TITLE FOR THIS AREA</h2>
        </div>
    </row>
    <div class="row tier3 tier3-type1">
        <div class="col-6 col-lg-3">
            <div class="spotimg spot5"></div>
            <div>Running ads is hard and time consuming. Between: Learning to run ads Writing ad copy Managing campaigns Moderating comments Now There’s A Better Way</div>
            <div class="overlay">
                <div class="text">More descriptive text</div>
            </div>
        </div>
        <div class="col-6 col-lg-3">
            <div>Running ads is hard and time consuming. Between: Learning to run ads Writing ad copy Managing campaigns Moderating comments Now There’s A Better Way</div>
            <div class="spotimg spot6"></div>
            <div class="overlay">
                <div class="text">More descriptive text 2 More descriptive text 2</div>
            </div>
        </div>
        <div class="col-6 col-lg-3">
            <div class="spotimg spot7"></div>
            <div>Running ads is hard and time consuming. Between: Learning to run ads Writing ad copy Managing campaigns Moderating comments Now There’s A Better Way</div>
            <div class="overlay">
                <div class="text">More descriptive text</div>
            </div>
        </div>
        <div class="col-6 col-lg-3">
            <div>Running ads is hard and time consuming. Between: Learning to run ads Writing ad copy Managing campaigns Moderating comments Now There’s A Better Way</div>
            <div class="spotimg spot8"></div>
            <div class="overlay">
                <div class="text">More descriptive text 2 More descriptive text 2</div>
            </div>
        </div>
    </div>
    <div class="row tier3 tier3-type2">
        <div class="col-6 col-lg-3">
            <div class="spotimg spot9"></div>
            <div>Running ads is hard and time consuming. Between: Learning to run ads Writing ad copy Managing campaigns Moderating comments Now There’s A Better Way</div>
            <div class="overlay">
                <div class="text">More descriptive text</div>
            </div>
        </div>
        <div class="col-6 col-lg-3">
            <div>Running ads is hard and time consuming. Between: Learning to run ads Writing ad copy Managing campaigns Moderating comments Now There’s A Better Way</div>
            <div class="spotimg spot7"></div>
            <div class="overlay">
                <div class="text">More descriptive text 2 More descriptive text 2</div>
            </div>
        </div>
        <div class="col-6 col-lg-3">
            <div class="spotimg spot5"></div>
            <div>Running ads is hard and time consuming. Between: Learning to run ads Writing ad copy Managing campaigns Moderating comments Now There’s A Better Way</div>
            <div class="overlay">
                <div class="text">More descriptive text</div>
            </div>
        </div>
        <div class="col-6 col-lg-3">
            <div>Running ads is hard and time consuming. Between: Learning to run ads Writing ad copy Managing campaigns Moderating comments Now There’s A Better Way</div>
            <div class="spotimg spot6"></div>
            <div class="overlay">
                <div class="text">More descriptive text 2 More descriptive text 2</div>
            </div>
        </div>
    </div>
    <div class="row tier3 tier3-type1">
        <div class="col-6 col-lg-3">
            <div class="spotimg spot8"></div>
            <div>Running ads is hard and time consuming. Between: Learning to run ads Writing ad copy Managing campaigns Moderating comments Now There’s A Better Way</div>
            <div class="overlay">
                <div class="text">More descriptive text</div>
            </div>
        </div>
        <div class="col-6 col-lg-3">
            <div>Running ads is hard and time consuming. Between: Learning to run ads Writing ad copy Managing campaigns Moderating comments Now There’s A Better Way</div>
            <div class="spotimg spot6"></div>
            <div class="overlay">
                <div class="text">More descriptive text 2 More descriptive text 2</div>
            </div>
        </div>
        <div class="col-6 col-lg-3">
            <div class="spotimg spot9"></div>
            <div>Running ads is hard and time consuming. Between: Learning to run ads Writing ad copy Managing campaigns Moderating comments Now There’s A Better Way</div>
            <div class="overlay">
                <div class="text">More descriptive text</div>
            </div>
        </div>
        <div class="col-6 col-lg-3">
            <div>Running ads is hard and time consuming. Between: Learning to run ads Writing ad copy Managing campaigns Moderating comments Now There’s A Better Way</div>
            <div class="spotimg spot7"></div>
            <div class="overlay">
                <div class="text">More descriptive text 2 More descriptive text 2</div>
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

