<?php $this->layout('layoutfront', ['title' => 'Recherche']) ?>

<?php $this->start('main_content') ?>
<div class="container_general">
	<div class="row">
	<?php var_dump($_SESSION['general_search']); ?>
		<div class="col-md-3 col-xs-6">
			<?php if($countItem > 1): ?>
				<p><?=$countItem;?> résultats trouvés</p>
			<?php elseif($countItem === 1): ?>
				<p><?=$countItem;?> résultat trouvé</p>
			<?php endif; ?>
		</div>
		<?php foreach ($items as $value) : ?>
			<?php $product = $findItem->findItems($value); ?>
			<div class="col-md-3 col-xs-6 viewcategoryrow2col1_img">
             <a href="<?=$this->url('viewArt', ['id' => $$value['id']]);?>"><img src="<?=$this->assetUrl('art/'.$$value['picture1']);?>" alt="photo de playmobil" class="img-thumbnail" style=""></a>
				<div class="viewcategorycaption">
					<?php if($$value['newPrice'] == 0) : ?>
						<h4><?=$$value['price'];?>€</h4>
					<?php else : ?>
						<h4><span class="viewcategoryprixpromo"><?=$$value['newPrice'];?>€</span> <span class="viewcategoryprixdelete"><?=$$value['price'];?>€</span></h4>
					<?php endif; ?>

					<p class="iconeFavorite">
						<span style="cursor:pointer;">
							<?php if(!empty($_SESSION['user'])): ?>
								<?php if(in_array($$value['id'], $favorite)): ?>
									<button class="favorite" type="submit" name="<?=str_replace(' ', '', $$value['name']);?>" value="<?=$$value['id']?>" data-id="<?=$$value['id'];?>"><i class="fa fa-heart fa-fw favoriteicon_original favoriteicon_click" aria-hidden="true" style="color: #c11131;" title="Ajouter à mes favoris"></i></button>
								<?php else: ?>
									<button class="favorite" type="submit" name="<?=str_replace(' ', '', $$value['name']);?>" value="<?=$$value['id'];?>" data-id="<?=$$value['id'];?>"><i class="fa fa-heart-o fa-fw favoriteicon_original favoriteicon_click" aria-hidden="true" title="Ajouter à mes favoris"></i></button>
								<?php endif; ?>
							<?php else : ?>
								<a href="<?=$this->url('login');?>"><i class="fa fa-heart-o fa-fw favoriteicon_original favoriteicon_click" aria-hidden="true" title="Ajouter à mes favoris"></i></a>
							<?php endif; ?>
						</span> <?=$$value['name'];?>
					</p>

					<?php if($$value['statut'] == 'nouveaute'):?>
						<div class="viewcategory_nouveau"><?=$$value['statut'];?></div>
					<?php elseif($$value['statut'] == 'promotion'):?>
						<div class="viewcategory_promo"><?=$$value['statut'];?></div>
					<?php elseif($$value['statut'] == 'defaut'): ?>
						<div class="viewcategory_defaut"></div>
					<?php endif; ?>
                </div>
				<div class="viewcategory_button">
					<button type="submit" class="btn btn-primary viewcategory_button_size add_to_shopping_cart" data-id="<?=$$value['id']?>">ajouter au panier</button>
				</div>
			</div>
		<?php endforeach; ?>
	</div>
<?php $this->stop('main_content') ?>
