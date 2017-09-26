<!doctype html>
<html <?php language_attributes(); ?> class="no-js">
	<head>
		<meta charset="<?php bloginfo('charset'); ?>">
		<title><?php wp_title(''); ?><?php if(wp_title('', false)) { echo ' :'; } ?> <?php bloginfo('name'); ?></title>

		<link href="//www.google-analytics.com" rel="dns-prefetch">
        <link href="<?php echo get_template_directory_uri(); ?>/favicon.ico" rel="shortcut icon">
        <link href="<?php echo get_template_directory_uri(); ?>/img/icons/touch.png" rel="apple-touch-icon-precomposed">

		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="description" content="<?php bloginfo('description'); ?>">

		<?php wp_head(); ?>
		<script>
        // conditionizr.com
        // configure environment tests
        conditionizr.config({
            assets: '<?php echo get_template_directory_uri(); ?>',
            tests: {}
        });
        </script>

	</head>
	<body <?php body_class(); ?>>
		<div class="container">
			<nav class="navbar navbar-expand-lg navbar-light">
				<a class="navbar-brand" href="#"><img src="<?php echo get_template_directory_uri(); ?>/assets/img/logo-funnlz.png"></a>
				<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon"></span>
				</button>

				<div class="collapse navbar-collapse" id="navbarSupportedContent">
					<?php html5blank_nav();?>
					
					<a class="login"><i class="fa fa-lg fa-sign-in" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;LOGIN&nbsp;</a><button class="btn btn-primary my-2 my-sm-0" role="button" type="button"><i class="fa fa-lg fa-user-plus" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;SIGN UP</button>
				</div>
			</nav>
			<div class="login-box">
				test
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
					
