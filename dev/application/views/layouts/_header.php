<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title><?=$meta_title?></title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="">
<meta name="keywords" content="">

<?php if (isset( $canonical)) echo link_tag($canonical);?>
<link rel="icon" href="<?=base_url('favicon.ico')?>">

<link href="<?=base_url('assets/css/style.min.css')?>" rel="stylesheet">

</head>

<body>

