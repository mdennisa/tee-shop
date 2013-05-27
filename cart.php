<?php
require_once 'session.php';
require_once 'config.php';
//print_r($_SESSION);
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
			$('.product').hover(
				function(){
					$(this).find('.price').fadeIn();
				},
				function(){
					$(this).find('.price').fadeOut();
				}
			);
			
			$('.qty').change(function(){
				id = $(this).attr('title');
				qty = $(this).val();
				if (qty == 0 || qty == '') {
					location.href = 'cart_remove.php?id='+id;
				}
				$.ajax({
					url : 'qty_json.php?id='+id+'&qty='+qty,
					dataType : 'json',
					success : function(data){
						$('#qty-'+id).val(data.qty);
						$('.subtotal').html(String(data.subtotal)+'.00');
						$('.items').html(String(data.items));
						$('.price-'+id).html(String(data.qty * data.price)+'.00');
						$('.log').html(data.log).show(400).delay(4000).hide(400);
					},
					error : function(){
						alert("ajax error!");
					}
				})
			});
			
			$('.remove').click(function(){
				id = $(this).attr('title');
				/*$.ajax({
					
				});
				return false;*/
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

	<div class="desc log">
	</div>
	
<?php
	if( !empty($_SESSION['cart']) ) {
?>
	<table cellspacing="0" cellpadding="0" class="cart">
		<thead>
			<tr>
				<th class="left">Name</th>
				<th>Price @</th>
				<th>Qty</th>
				<th>Total</th>
				<th>Action</th>
			</tr>
		</thead>
		<tbody>
	<?php
		$i = 0;
		foreach($_SESSION['cart'] as $cart) {
	?>
			<tr>
				<td> <a href="<?=base_url?>product/<?=$cart['ID']?>"><?=$cart['name']?></a></td>
				<td class="center"><span class="gray">$</span> <?=number_format($cart['price'], 2, ',', '')?></td>
				<td class="center">
					<input type="text" class="qty" id="qty-<?=$cart['ID']?>" title="<?=$cart['ID']?>" value="<?=$cart['qty']?>" />
				</td>
				<td class="center"><span class="gray">$</span> <span class="price-<?=$cart['ID']?>"><?=number_format($cart['price']*$cart['qty'], 2, ',', '')?></span></td>
				<td class="center"><a href="cart_remove.php?id=<?=$cart['ID']?>" class="btn remove" title="<?=$cart['ID']?>">remove</a></td>
			</tr>
	<?php
			$i+=1;
		} //end foreach
	?>
			<tr>
				<td colspan="2"><a href="<?=base_url?>product" class="btn continue-shop">continue shopping</a></td>
				<td class="center bigger">Subtotal <span class="gray">(<span class="items"><?=$_SESSION['items']?></span>)</span></td>
				<td class="center bigger"><span class="gray">$</span> <span class="subtotal blue"><?=number_format($_SESSION['subtotal'], 2, ',', '')?></span></td>
				<td class="center"><a href="<?=base_url?>payment.php" class="btn checkout">check out</a></td>
			</tr>
		</tbody>
	</table>
<?php
	} else {
?>
	<p>You have no item to purchase, we recommend you to look into our <a href="<?=base_url?>product">product directory</a>.</p>
<?php
	} //end if
?>
	</div><!--content-->
</div><!--wrapper-->
<?php include('footer.php'); ?>