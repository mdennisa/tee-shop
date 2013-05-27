<?php
require_once 'session.php';
require_once 'config.php';
?>
<!DOCTYPE html>
<html>
<head>
	<title><?=title?> - 404 Page Not Found</title>
	<link rel="stylesheet" href="<?=base_url?>css/base.css" type="text/css" />
	<script type="text/javascript" src="/jquery/jquery-1.4.2.min.js"></script>
	<script type="text/javascript" src="<?=base_url?>code/cufon-yui.js"></script>
	<script type="text/javascript" src="<?=base_url?>code/Qlassik_Medium_500.font.js"></script>
	<script type="text/javascript">
		//<![CDATA[
		$(document).ready(function(){
			$('.product').hover(
				function(){
					$(this).find('.price').fadeTo(100);
				},
				function(){
					$(this).find('.price').fadeTo(0);
				}
			);
		});
		Cufon.replace('h1');
		//]]>
	</script>
</head>
<body>
<div id="wrapper">
	<div id="header">
		<h1 class="logo"><?=title?></h1>
	</div><!--header-->
	<?php include('nav.php'); ?>
	<div id="content">
		<p class="blue bold">404 Page Not Found</p>
		<p>The page you requested was not found.</p>
		<p><a href="javascript:history.back()" class="btn continue-shop">back</a></p>
	</div><!--content-->
</div><!--wrapper-->
<?php include('footer.php'); ?>