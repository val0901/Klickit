<div id="reloadBasket">
	<div id="view" class="row item_cart" style="margin: 10px 10px 0 10px;">
		<?php if(!empty($w_items)): ?>
			<?php foreach($w_items as $item) : ?>
				<div class="col-xs-8 basketqt">
					<?=$item['name']?>
				</div>

				<?php if($item['newPrice'] == 0) : ?>
					<div class="col-xs-2 text-left">
						x <?=$item['qt'];?>
					</div>
					<div class="col-xs-2 text-right ">
						<?= $item['price'] * $item['qt']?>€
					</div>
				<?php else : ?>
					<div class="col-xs-2 text-left">
						x <?=$item['qt'];?>
					</div>
					<div class="col-xs-2 text-right ">
						<?= $item['newPrice'] * $item['qt']?>€
					</div>
				<?php endif; ?>
			<?php endforeach; ?>
		<?php else : ?>
			<div class="col-xs-12" style="color:red;">
				Vous n'avez pas d'article dans votre panier.
			</div>	
		<?php endif; ?>			
    </div>

	<div class="row sumbacket text-right" >
		<div class="text-left text-uppercase col-xs-6 shoppingmenu_total">
			Total :
		</div>
		<div class="col-xs-6 shoppingmenu_total price text-right">
			<?=$w_total;?>€
		</div>
	</div>
</div>