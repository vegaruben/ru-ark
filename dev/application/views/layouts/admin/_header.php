<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>
<?=$meta_title?>
</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="<? if(isset($meta_desc)) echo $meta_desc;?>">
<meta name=”robots” content=”noindex,nofollow”>
<?php if (isset( $canonical)) echo link_tag($canonical);?>
<link rel="icon" href="<?=site_url('favicon.ico')?>">
<link href="<?=base_url('assets/css/bootstrap-theme.min.css')?>" rel="stylesheet">
<link href="<?=base_url('assets/css/bootstrap.min.css')?>" rel="stylesheet">
<link href="<?=base_url('assets/css/override.css')?>" rel="stylesheet">
<link href='http://fonts.googleapis.com/css?family=Nunito' rel='stylesheet' type='text/css'>
<link href='https://fonts.googleapis.com/css?family=Roboto+Slab' rel='stylesheet' type='text/css'>
<script type="text/javascript" src="<?=base_url('assets/js/jquery-1.10.2.min.js')?>"></script>
<link rel="stylesheet" type="text/css" href="<?php echo site_url('assets/DataTables/datatables.min.css');?>"/> 
<script type="text/javascript" src="<?php echo site_url('assets/js/moment.js');?>"></script>
<script type="text/javascript" src="<?php echo site_url('assets/DataTables/datatables.min.js');?>"></script>
<!--360 player-->
<link rel="stylesheet" type="text/css" href="<?=base_url('assets/360-player/360player.css')?>" />
<!-- Apache-licensed animation library -->
<script type="text/javascript" src="<?=base_url('assets/360-player/berniecode-animator.js')?>"></script>
<!-- the core stuff -->
<script type="text/javascript" src="<?=base_url('assets/360-player/soundmanager2.js')?>"></script>
<script type="text/javascript" src="<?=base_url('assets/360-player/360player.js')?>"></script>

<script type="text/javascript">
soundManager.setup({
  // path to directory containing SM2 SWF
  url: '<?=base_url('assets/360-player/swf/')?>'
});
</script>


<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
<!--[if lt IE 9]>
<link href="<?=base_url('assets/css/ie7.css')?>" rel="stylesheet">
  <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]-->

<script>
 /* (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-21348513-1', 'auto');
  ga('send', 'pageview');
*/
</script>
<meta property="og:type" content="company" />
<meta property="fb:admins" content="718634781"/>
<meta property="og:site_name" content="Tango Magento" />
<meta property="og:title" content="<?=$meta_title?>" />
<meta property="og:image" content="" />
</head>

<body>
      <div class="container">
