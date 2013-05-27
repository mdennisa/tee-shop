<?php
session_start();
require_once '../config.php';
require_once 'session_admin.php';
?>
<!DOCTYPE html>
<html>
<head>
	<title><?=title?></title>
	<link rel="stylesheet" href="<?=base_url?>css/base.css" type="text/css" />
	<script type="text/javascript" src="/jquery/jquery-1.4.2.min.js"></script>
	<script type="text/javascript" src="<?=base_url?>code/cufon-yui.js"></script>
	<script type="text/javascript" src="<?=base_url?>code/Qlassik_Medium_500.font.js"></script>
	<script type="text/javascript">
		//<![CDATA[
		$(document).ready(function(){

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
		<fieldset class="info">
			<div class="desc">
				<strong>PRODUCT ADD</strong>
			</div>
			<div class="separator"></div>
			<p><a href="product.php" class="btn continue-shop">back</a>
			</p>
			<div class="separator"></div>
			<form method="post" enctype="multipart/form-data" action="product_add_exec.php">
			<p>Category : <input type="text" name="category" /></p>
			<p>Name : <input type="text" name="name" /></p>
			<p>Price :  <span class="blue">$</span> <input type="text" name="price" /></p>
			<p>Stock : <input type="text" name="stock" /></p>
			<p>Pic : <input type="file" name="img" /></p>
			<p>Info : <br /><textarea name="info"></textarea></p>
			<p><input type="submit" name="submit" value="submit" class="btn" /></p>
			</form>
		</fieldset>
	</div><!--content-->
</div><!--wrapper-->
<?php include('../footer.php'); ?>