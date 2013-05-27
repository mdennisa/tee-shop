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
				<strong>PRODUCT UPDATE</strong>
			</div>
			<div class="separator"></div>
			<?php
				$get= $_GET;
				$st = $db->prepare("SELECT * FROM product WHERE ID=?");
				$st->execute(array($get['id']));
				$r = $st->fetchObject();
			?>
			<p><a href="javascript:history.back()" class="btn continue-shop">back</a>
			<?php
				$get = $_GET;
				if(! empty ($get['log'])) {
			?>
				<span class="btn blue">Product <?=$get['log']?> !</span>
			<?php
				}
			?>
			</p>
			<div class="separator"></div>
			<img src="<?=base_url?>images/<?=$r->img?>" class="pic" />
			<form method="post" action="product_update_exec.php">
			<input type="hidden" name="id" value="<?=$r->ID?>" />
			<p>Category : <input type="text" name="category" value="<?=$r->category?>" /></p>
			<p>Name : <input type="text" name="name" value="<?=$r->name?>" /></p>
			<p>Price : <span class="blue">$</span> <input type="text" name="price" value="<?=$r->price?>" /></p>
			<p>Stock : <input type="text" name="stock" value="<?=$r->stock?>" /></p>
			<p>Info : <br /><textarea name="info"><?=$r->info?></textarea></p>
			<p><input type="submit" name="update" value="update" class="btn" /></p>
			</form>
		</fieldset>
	</div><!--content-->
</div><!--wrapper-->
<?php include('../footer.php'); ?>