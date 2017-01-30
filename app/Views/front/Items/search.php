<?php $this->layout('layoutfront', ['title' => 'Recherche']) ?>

<?php $this->start('main_content') ?>
<div class="container_general">
	<div class="row">
	<?php var_dump($_SESSION['general_search']); ?>
		<?php foreach ($items as $value) : ?>
			<?php $product = $findItem->findItems($value); ?>
			<div class="col-md-3 col-xs-6 viewcategoryrow2col1_img">
             <a href="<?=$this->url('viewArt', ['id' => $product['id']]);?>"><img src="<?=$this->assetUrl('art/'.$product['picture1']);?>" alt="photo de playmobil" class="img-thumbnail" style=""></a>
				<div class="viewcategorycaption">
					<?php if($product['newPrice'] == 0) : ?>
						<h4><?=$product['price'];?>€</h4>
					<?php else : ?>
						<h4><span class="viewcategoryprixpromo"><?=$product['newPrice'];?>€</span> <span class="viewcategoryprixdelete"><?=$product['price'];?>€</span></h4>
					<?php endif; ?>

					<p class="iconeFavorite">
						<span style="cursor:pointer;">
							<?php if(!empty($_SESSION['user'])): ?>
								<?php if(in_array($product['id'], $favorite)): ?>
									<button class="favorite" type="submit" name="<?=str_replace(' ', '', $product['name']);?>" value="<?=$product['id']?>" data-id="<?=$product['id'];?>"><i class="fa fa-heart fa-fw favoriteicon_original favoriteicon_click" aria-hidden="true" style="color: #c11131;" title="Ajouter à mes favoris"></i></button>
								<?php else: ?>
									<button class="favorite" type="submit" name="<?=str_replace(' ', '', $product['name']);?>" value="<?=$product['id'];?>" data-id="<?=$product['id'];?>"><i class="fa fa-heart-o fa-fw favoriteicon_original favoriteicon_click" aria-hidden="true" title="Ajouter à mes favoris"></i></button>
								<?php endif; ?>
							<?php else : ?>
								<a href="<?=$this->url('login');?>"><i class="fa fa-heart-o fa-fw favoriteicon_original favoriteicon_click" aria-hidden="true" title="Ajouter à mes favoris"></i></a>
							<?php endif; ?>
						</span> <?=$product['name'];?>
					</p>

					<?php if($product['statut'] == 'nouveaute'):?>
						<div class="viewcategory_nouveau"><?=$product['statut'];?></div>
					<?php elseif($product['statut'] == 'promotion'):?>
						<div class="viewcategory_promo"><?=$product['statut'];?></div>
					<?php elseif($product['statut'] == 'defaut'): ?>
						<div class="viewcategory_defaut"></div>
					<?php endif; ?>
                </div>
				<div class="viewcategory_button">
					<button type="submit" class="btn btn-primary viewcategory_button_size add_to_shopping_cart" data-id="<?=$product['id']?>">ajouter au panier</button>
				</div>
			</div>
		<?php endforeach; ?>
	</div>
<?php $this->stop('main_content') ?>
