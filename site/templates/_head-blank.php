<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<title><?= $page->title; ?></title>
		<meta name="description" content="<?= $page->summary; ?>" />
        <meta http-equiv="refresh" content="90">
		<?php if (100 == 1) : ?>
			<link rel="icon" href="<?= $site->company_favicon->url; ?>" type="image/x-icon">
			<link rel="apple-touch-icon" href="<?= $site->company_favicon->url; ?>"> 
		<?php endif; ?>
		<?php foreach($config->styles->unique() as $css) : ?>
			<link rel="stylesheet" type="text/css" href="<?= $css; ?>" />
		<?php endforeach; ?>
		<?php //include ('_config.js.php'); ?>
	</head>

	<body class="fuelux">
        
