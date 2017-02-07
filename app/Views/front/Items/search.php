<?php $this->layout('layoutfront', ['title' => 'Recherche']) ?>

<?php $this->start('main_content') ?>
<form>
	<div class="container_general">
		<?php if($countItem === 0): ?>
			<div class="row">
				<h2 class="no_result">Aucun résultat trouvé !</h2>
			</div>
		<?php elseif($countItem > 0): ?>
			<div class="row">
				<div>
					<?php if($countItem > 1): ?>
						<p class="result"><?=$countItem;?> résultats trouvés</p>
					<?php elseif($countItem === 1): ?>
						<p class="result"><?=$countItem;?> résultat trouvé</p>
					<?php endif; ?>
				</div>
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
											<button class="favorite" type="button" name="<?=str_replace(' ', '', $product['name']);?>" data-id="<?=$product['id'];?>" value="<?=$product['id']?>"><span id="<?=$product['id'];?>" class="fa fa-heart fa-fw favoriteicon_original favoriteicon_click favHeart" aria-hidden="true" style="color: #c11131;" title="Retirer de mes favoris"></span></button>
										<?php else: ?>
											<button class="favorite" type="button" name="<?=str_replace(' ', '', $product['name']);?>" data-id="<?=$product['id'];?>" value="<?=$product['id']?>"><span id="<?=$product['id'];?>" class="fa fa-heart-o fa-fw favoriteicon_original favoriteicon_click favHeart" aria-hidden="true" title="Ajouter à mes favoris"></span></button>
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
		<?php endif; ?>
	</div>
</form>
<?php $this->stop('main_content') ?>

<?php $this->start('js') ?>
	<script>
		$(document).ready(function(){
			$('.favorite').click(function(e){
				e.preventDefault();

				var idFavorite = $(this).data('id');

				function favIcon() // Change l'îcone favoris sans recharger la page
				{
					if($('#'+idFavorite).hasClass('fa-heart-o')){ // On vérifie que l'élement avec l'ID contenu dans idFavorite a la class fa-heart-o
						$('#'+idFavorite).removeClass('fa-heart-o'); // On vire la class
						$('#'+idFavorite).addClass('fa-heart'); // On rajoute une nouvelle
						$('#'+idFavorite).css('color', '#c11131'); // On change la couleur
					}
					else if($('#'+idFavorite).hasClass('fa-heart')){ // On vérifie que l'élement avec l'ID contenu dans idFavorite a la class fa-heart
						$('#'+idFavorite).removeClass('fa-heart'); // On vire la class
						$('#'+idFavorite).addClass('fa-heart-o'); // On rajoute une nouvelle
						$('#'+idFavorite).css('color', '#999999'); // On change la couleur
					}
				}

				$.ajax({
					url: '<?=$this->url('ajax_favorite');?>',
					type: 'post',
					cache: false,
					data: {id_item: idFavorite},
					dataType: 'json',
					success: function(add){
						if(add.msg == 'ok'){
							favIcon();
						}
					}
				});
			});
		});
	</script>
<?php $this->stop('js') ?>