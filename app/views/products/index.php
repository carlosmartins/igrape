<table width="100%" border="1">
<?php
foreach($products as $product):
?>
<tr><td><?=$product ?></td><td><a href="<?=url("/cart/add/$product") ?>">Add to Cart</a></td></tr>
<?php
endforeach;
?>
</table>
<p><a href="<?=url("/cart") ?>">Show cart contents</a></p>