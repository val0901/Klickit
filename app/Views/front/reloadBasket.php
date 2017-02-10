<div id="reloadBasket">
	<div id="view" class="row item_cart" style="margin: 10px 10px 0 10px;">
		<?php if(!empty($w_items)): ?>
			<?php foreach($w_items as $item) : ?>
				<div class="col-xs-10">
					<?=$item['name']?>
				</div>

				<?php if($item['newPrice'] == 0) : ?>
					<div class="col-xs-2">
						<?= $item['price'] ?>€
					</div>
				<?php else : ?>
					<div class="col-xs-2">
						<?= $item['newPrice'] ?>€
					</div>
				<?php endif; ?>
			<?php endforeach; ?>
		<?php else : ?>
			<div class="col-xs-12" style="color:red;">
				Vous n'avez pas d'article dans votre panier.
			</div>	
		<?php endif; ?>			
    </div>

	<div class="row" style="margin: 0 10px;border-top:1px dotted #000;padding-top:10px;">
		<div class="col-xs-6 shoppingmenu_total">
			<p>Total:</p>
		</div>
		<div class="col-xs-6 shoppingmenu_total price" style="text-align:right;">
			<!--ajout du prix en AJAX-->
		</div>
	</div>
</div>