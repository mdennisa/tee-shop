	<div id="nav">
		<ul class="main">
			<li>
				<a href="<?=base_url?>admin">home</a>
			</li>
			<li>
				<a href="<?=base_url?>admin/product.php">product</a>
			</li>
			<li>
				<a href="<?=base_url?>admin/purchase.php">purchase</a>
			</li>
			<li class="separator"></li>
			<li><a href="<?=base_url?>admin/user.php">user</a></li>
		</ul>
		
		<ul class="sub">
		<?php
			if(! empty($_SESSION['logged_in'])) {
		?>
			<li>
				<a href="" class="user"><?=$_SESSION['name']?></a>
			</li>
			<li>
				<a href="<?=base_url?>signout.php" class="sign-out">sign out</a>
			</li>
		<?php
			}
		?>

		</ul>
		
		<div class="clear"></div>
	</div><!--nav-->