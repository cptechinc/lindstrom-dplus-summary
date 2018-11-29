<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<title><?= $page->title; ?></title>
		<meta name="description" content="<?= $page->summary; ?>" />
		<?php if (100 == 1) : ?>
			<link rel="icon" href="<?= $site->company_favicon->url; ?>" type="image/x-icon">
			<link rel="apple-touch-icon" href="<?= $site->company_favicon->url; ?>"> 
		<?php endif; ?>
		<?php foreach($config->styles->unique() as $css) : ?>
			<link rel="stylesheet" type="text/css" href="<?= $css; ?>" />
		<?php endforeach; ?>
		<?php //include ('_config.js.php'); ?>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
		<script src="<?= hash_templatefile('scripts/moment.js'); ?>"></script>
		<script>moment().format();</script>
	</head>

	<body class="fuelux">
		<?php include('./_nav.php'); ?>
