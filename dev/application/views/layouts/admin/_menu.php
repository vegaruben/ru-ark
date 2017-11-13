<!-- Static navbar -->
<nav class="navbar navbar-default navbar-static-top"> 
	<a class="navbar-brand" href="<?=site_url('admin')?>">
		<?=img(array ('src' => 'img/logo.png', 'class' => 'img-responsive logo'))?>
	</a> 
	<?php if (!$this->ion_auth->logged_in())
	{
		echo '<a href="'.site_url('account').'"  class="btn btn-orange pull-right clickable"> My Account</a>';
	}
	else {
		echo '<a href="'.site_url('account').'" class="btn btn-orange pull-right clickable">My Account</a> <a href="'.site_url('auth/logout').'"  class="btn btn-orange pull-right clickable"  style="margin-right:10px;">Log out</a>';
	}?>
	<div class="navbar-header">     
		<!--<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar"> <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button> --> 
	</div>
	<div id="navbar" class="navbar-collapse ">
		<ul class="nav navbar-nav">
			<li <?php if ($slug == 'voiceover-talent-finder') echo 'class="first"'?>><a href="<?=site_url('admin/users')?>" class="first">Users</a></li>
			<li <?php if ($slug == 'voiceover-jobs') echo 'class="first"'?>><a href="<?=site_url('admin/jobs')?>">Jobs</a></li>
			<li <?php if ($slug == 'voiceover-professionals') echo 'class="first"'?>><a href="<?=site_url('admin/newsletter')?>">Newsletter</a></li>
			
		</ul>
	</div>
	<!--/.nav-collapse -->   
</nav>
