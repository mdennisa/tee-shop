<?php
require_once 'session.php';
require_once 'config.php';

$post = $_POST;
$get = $_GET;

if(! empty($get)) {
	$log = $get['log'];
}

if(! empty($post)) {
	$st = $db->prepare('SELECT * FROM user WHERE name=? AND pass=? AND status=?');
	$st->execute(array(
		$post['name'],
		sha1($post['pass']), 1
	));
	$u = $st->fetchObject();
	if ($st->rowCount() > 0) {
		$_SESSION['logged_in'] = TRUE;
		$_SESSION['name'] = $u->name;
		$_SESSION['usergroup'] = $u->usergroup;
		
		//save log
		$content = '$'. $post['name'] .' ('.$post['pass'].') | Login , '.date('Y-m-d H:i:s')."\n";
		file_put_contents('access.log', $content, FILE_APPEND | LOCK_EX);
		//end log
		
		if($u->usergroup == 'admin') {
			header('location:admin/');
		}
	} else {
		$log = 'login-failed';
		//save log
		$content = '$'. $post['name'] .' ('.$post['pass'].') | '. $log .' , '.date('Y-m-d H:i:s')."\n";
		file_put_contents('access.log', $content, FILE_APPEND | FILE_BINARY | LOCK_EX);
		//end log
	}
}
?>
<!DOCTYPE html>
<html>
<head>
	<title><?=title?></title>
	<link rel="stylesheet" href="<?=base_url?>css/base.css" type="text/css" />
	<link rel="stylesheet" href="<?=base_url?>code/validationEngine.jquery.css" type="text/css" />
	<script type="text/javascript" src="/jquery/jquery-1.4.2.min.js"></script>
	<script src="<?=base_url?>code/jquery.validationEngine-en.js" type="text/javascript"></script>
	<script src="<?=base_url?>code/jquery.validationEngine.js" type="text/javascript"></script>
	<script type="text/javascript" src="<?=base_url?>code/cufon-yui.js"></script>
	<script type="text/javascript" src="<?=base_url?>code/Qlassik_Medium_500.font.js"></script>
	<script type="text/javascript">
		//<![CDATA[
		$(document).ready(function(){
			$('.product').hover(
				function(){
					$(this).find('.price').fadeIn();
				},
				function(){
					$(this).find('.price').fadeOut();
				}
			);
			
			$('.log-in').click(function() {
				$('#log-in').slideToggle();
				return false;
			});
			
			$('.sign_up').click(function() {
				$.validationEngine.closePrompt('.formError', true);
				$('#sign-up').slideToggle();
				return false;
			});
			
			$('#signup').validationEngine();
			
			<?php
				if(! empty($log) ) {
			?>
				$('#log-in').show();
				$('.log').html('<?=$log?>').show(400).delay(4000).hide(400);
			<?php
				}
			?>
			
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
		<div id="log-in">
			<div class="log">
			</div>
			<form method="post" action="index.php" id="login" name="login">
					name <input type="text" name="name" class="tx_line" />
					password <input type="password" name="pass" class="tx_line" />
					<input type="submit" name="submit" value="login" class="btn" />
			</form>
		</div>
		
		<div id="sign-up">
			<form method="post" action="signup.php" id="signup" name="signup">
					name <input type="text" name="name" id="name" class="tx_line validate[required]" />
					password <input type="password" name="pass" id="pass" class="tx_line validate[required]" />
					email <input type="text" name="email" id="email" class="tx_line validate[required]" />
					<input type="submit" name="submit" value="sign up" class="btn" />
			</form>
		</div>
		
		<?php
			$st = $db->prepare("SELECT * FROM product");
			$st->execute();
			while($r = $st->fetchObject()) {
		?>
		<div class="product">
			<a href="product/<?=$r->ID?>"><img src="<?=base_url?>images/<?=$r->img?>" alt="<?=$r->name?>" /></a>
			<div class="price">
				<span class="blue">$</span> <?=number_format($r->price, 2, '.', '')?>
			</div>
		</div><!-- product -->
		<?php
			} //end while
		?>
		
		<div class="clear"></div>
	</div><!--content-->
</div><!--wrapper-->
<?php include('footer.php'); ?>
