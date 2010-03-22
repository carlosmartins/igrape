<h1>Your cart has</h1>
<?php if(count($cart_contents) == 0): ?>
<p>No Items | <a href="<?=url('/products') ?>">Continue Shopping</a></p>
<?php 
else: 
foreach($cart_contents as $product) {
	echo "<p>$product</p>";
}
?>
<p><a href="<?=url('/cart/checkout') ?>">Proceed to checkout</a> | <a href="<?=url('/products') ?>">Continue Shopping</a></p>
<?php
endif;
?>

