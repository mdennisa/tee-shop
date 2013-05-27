	<div id="nav">
		<ul class="main">
			<li>
				<a href="<?=base_url?>">home</a>
			</li>
			<li>
				<a href="<?=base_url?>product">product</a>
			</li>
			<li>
				<a href="">contact</a>
			</li>
			<li class="separator"></li>
			<li>
				<a href="<?=base_url?>cart" class="shopping-cart">shopping cart
				<?php
					if( !empty($_SESSION['cart']) ) {
						echo ' | <span class="items">'. $_SESSION['items'] .'</span> item(s)';
						echo ' &rarr; $ <span class="subtotal">'. number_format($_SESSION['subtotal'], 2, '.', '') .'</span>';
					}
				?>
				</a>
			</li>
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
			} else {
		?>
			<li>
				<a href="" class="log-in">log in</a>
			</li>
			<li>
				<a href="" class="user sign_up">sign up</a>
			</li>
		<?php
			}
		?>
		</ul>
		
		<div class="clear"></div>
	</div><!--nav-->