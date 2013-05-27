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
			$('.app').click(function() {
				if( $(this).hasClass('checkout') ) {
					var group = prompt('Input usergroup : \n(admin or customer)');
					if(group) {
						location.href = $(this).attr('href') + '&usergroup=' + group;
					}
				} else {
					location.href = $(this).attr('href');
				}
				return false;
			});
			
			$('.delete').click(function() {
				var title = $(this).attr('title');
				var del = confirm('Are you sure want to delete "'+title+'" ?');
				if(del) {
					location.href = $(this).attr('href');
				} else {
					return false;
				}
			});
			
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
				<strong>USER LIST</strong>
			</div>
			<?php
				$st = $db->prepare("SELECT * FROM user");
				$st->execute();
				while($r = $st->fetchObject()) {
			?>
			<div class="separator"></div>
			<p>
				Name : <span class="blue"><?=$r->name?></span><br />
				Email : <span class="blue"><?=$r->email?></span><br />
				Usergroup : <span class="blue"><?=$r->usergroup?></span><br />
				Status : <span class="red"><?=$r->status?></span>
			</p>
			<p class="right">
				<?php
					if(! $r->status) {
				?>
					<a href="user_approve.php?id=<?=$r->ID?>&action=approve" class="btn checkout app">approve</a>
					<a href="user_delete.php?id=<?=$r->ID?>" title="<?=$r->name?>" class="btn red delete">delete</a>
				<?php
					} else {
						if ($r->name != 'admin') {
				?>
					<a href="user_approve.php?id=<?=$r->ID?>&action=block" class="btn cancel app">block</a>
					<a href="user_delete.php?id=<?=$r->ID?>" title="<?=$r->name?>" class="btn red delete">delete</a>
				<?php
						}
					}
				?>
			</p>
			<?php
				}
			?>
		</fieldset>
	</div><!--content-->
</div><!--wrapper-->
<?php include('../footer.php'); ?>