<!DOCTYPE html>
<html>
<head>
	<title><?php echo $title; ?></title>
	<style>
	body {
		font-family:'Verdana';
	}

	body img {
		margin-top:5%;
	}

	body h1 {
		font-size:4rem;
		margin-top:5%;
		text-transform: uppercase;
		color:#620505;
	}

	body p {
		font-size:1.5rem;
		font-variant: small-caps;
	}

	</style>
</head>
<body>
<center>
<img src="<?php echo assets_url(); ?>public/images/logoIt.png"><br>
<h1>Portal Wyłączony</h1>
<p><?php echo nl2br($disabled_message); ?></p>
</center>
</body>
</html>