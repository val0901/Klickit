<?php $this->layout('layoutfront', ['title' => 'view notre articles']) ?>

<?php $this->start('main_content') ?>
<!--<div class="vignetteEvent_hide">
	<a href="<?=$this->url('front_contact')?>"><img class="img-responsive" src="<?=$this->assetUrl('/img/vignetteEvent1.png');?>" id="vignetteviewart_hover" onmouseover="vignetteviewarthover();" onmouseout="vignetteviewartout();"></a>
</div>-->
<form method="post">
<div class="container_viewart">
	<div class="row">
		<div class="col-md-7">
			<img src="<?=$this->assetUrl('art/'.$items['picture1']);?>" style="width:98%;">
		</div>
		<div class="col-md-5 viewart_fontweight">

			<p class="viewart_fontref">Référence <?=$items['id'] ;?></p>
			<h1 class="viewart_fonttitle"><?=$items['name'] ;?></h1>
			<span class="viewart_fontref"></span> 
			<span class="viewart_fontpro"> 
			<?php if($items['statut'] == 'nouveaute'):?>
				<div class=""><?='Nouveauté';?></div>
			<?php elseif($items['statut'] == 'promotion'):?>
				<div class=""><?='Promotion';?></div>
			<?php elseif($items['statut'] == 'defaut'): ?>
				<div class=""></div>
			<?php endif;  ?></span>
			<br><br>
									
								
									
								
			<span class="viewart_fontsolde">
				<?php if($items['newPrice'] == 0): ?>
					<?=$items['price'];?> €
				<?php elseif($items['newPrice'] > 0): ?>
					<?=$items['newPrice'];?> €
				<?php endif; ?>
			</span>
			<span class="viewart_fontnormal">
				<?php if($items['newPrice'] > 0): ?> 
					<?=$items['price'];?> €
				<?php elseif($items['newPrice'] == 0): ?>

				<?php endif; ?>
			</span>
			<br><br><br><br>
			<form method="post">
				<span class="viewart_fontref">Quantité </span>
				<span>
					<input type="number" name="number" min="1" id="number">
				</span>
				<br><br>
				<div class="">
					<button data-id="<?=$items['id']?>" type="submit" class="btn btn-primary viewcategory_button_size ">ajouter au panier</button>
				</div>
			</form>	
			<br>
			<p>
				<span style="cursor:pointer;">
					<?php if(!empty($_SESSION['user'])): ?>
						<?php if(in_array($items['id'], $favorite)): ?>
							<button class="favorite" type="submit" name="<?=str_replace(' ', '', $items['name']);?>" value="<?=$items['id'];?>" data-id="<?=$items['id'];?>"><i class="fa fa-heart fa-2x" aria-hidden="true" style="color: #c11131;" title="Ajouter à mes favoris"><span class="viewart_fontfamily">Déjà en favoris</span></i></button> 
						<?php else: ?>
							<button class="favorite" type="submit" name="<?=str_replace(' ', '', $items['name']);?>" value="<?=$items['id'];?>" data-id="<?=$items['id'];?>"><i class="fa fa-heart-o fa-2x" aria-hidden="true" style="color: #999;" title="Ajouter à mes favoris"><span class="viewart_fontfamily">Ajouter à mes favoris</span></i></button>
						<?php endif; ?>
					<?php else : ?>
						<a href="<?=$this->url('login');?>"><i class="fa fa-heart-o fa-2x" aria-hidden="true" style="color: #999;" title="Ajouter à mes favoris"><span class="viewart_fontfamily">Ajouter à mes favoris</span></i></a>
					<?php endif; ?>
				</span>
			</p>
			<br><br>
			<i class="fa fa-twitter-square fa-3x fa-fw" aria-hidden="true" style="color:#3fa9f5;"></i>
			<i class="fa fa-facebook-square fa-3x fa-fw" aria-hidden="true" style="color:#335199;"></i>
		</div>
	</div>
	<br><br>
	<div class="row">
		<div class="col-md-3 viewart_savoirboder">
			<div class="col-xs-2 viewart_savoirback">
			</div>
			<div class="col-xs-10">
				<p class="viewart_savoirtitle">EN SAVOIR PLUS</p>
			</div>
		</div>
		<div class="col-md-9 viewart_savoirwidth">
			<p class="viewart_savoirtext"><?=$items['description']?>
			</p>
		</div>
	</div>
	<br><br>
</div>

<!--Slide articles-->
<div class="clear"></div>
<div class="slideartL_title">nouveau!</div>
<!--<div class="slideartR_title">promo!</div>-->

<div class="">
<div class="row-fluid">
<div class="span12">

        
    <div class="carousel slide" id="myCarousel">
        <div class="carousel-inner">
            <div class="item active">
                    <ul class="thumbnails">
                    	<?php foreach ($afficheNewItem as $newProduct) : ?>
	                        <li class="span3">
	                            <div class="thumbnail">
	                                <a href="<?=$this->url('viewArt', ['id' => $newProduct['id']]);?>"><img src="<?=$this->assetUrl('art/'.$newProduct['picture1']);?>" alt=""></a>
	                            </div>
	                            <div class="caption">
	                            	<?php if($newProduct['newPrice'] == 0) : ?>
	                            		<h4><?=$newProduct['price'];?>€</h4>
	                            	<?php elseif($newProduct['newPrice'] > 0) : ?>
	                            		<h4><span class="viewcategoryprixpromo"><?=$product['newPrice'];?>€</span> <span class="viewcategoryprixdelete"><?=$product['price'];?>€</span></h4>
	                            	<?php endif; ?>
	                				<p>
	                					<span style="cursor:pointer;">
										<?php if(!empty($_SESSION['user'])): ?>
											<?php if(in_array($newProduct['id'], $favorite)): ?>
												<button class="favorite" type="submit" name="<?=str_replace(' ', '', $newProduct['name']);?>" value="<?=$newProduct['id']?>"><i class="fa fa-heart-o fa-fw favoriteicon_original favoriteicon_click" aria-hidden="true" style="color: #999;" title="Ajouter à mes favoris"></i>ee</button> <!-- l'icône ne change pas de couleur, pour ça que j'ai mis 'ee' pour voir la différence lors du dev -->
											<?php else: ?>
												<button class="favorite" type="submit" name="<?=str_replace(' ', '', $newProduct['name']);?>" value="<?=$newProduct['id'];?>"><i class="fa fa-heart-o fa-fw favoriteicon_original favoriteicon_click" aria-hidden="true" title="Ajouter à mes favoris"></i></button>
											<?php endif; ?>
										<?php else : ?>
											<a href="<?=$this->url('login');?>"><i class="fa fa-heart-o fa-fw favoriteicon_original favoriteicon_click" aria-hidden="true" title="Ajouter à mes favoris"></i></a>
										<?php endif; ?>
										</span> <?=$newProduct['name'];?>
	                				</p>
									<div class="slidecontent_nouveau"><?=$newProduct['statut'];?></div>
	                                <!--<a class="btn btn-mini" href="#">&raquo; Read More</a>-->
	                            </div>
	                        </li>
	                    <?php endforeach; ?>
                    </ul>
              </div><!-- /Slide1 --> 
            <div class="item">
                    <ul class="thumbnails">
                        <?php foreach ($afficheNewItem as $newProduct) : ?>
                       	    <li class="span3">
                       	        <div class="thumbnail">
                       	            <a href="<?=$this->url('viewArt', ['id' => $newProduct['id']]);?>"><img src="<?=$this->assetUrl('art/'.$newProduct['picture1']);?>" alt=""></a>
                       	        </div>
                       	        <div class="caption">
                       	            <?php if($newProduct['newPrice'] == 0) : ?>
                       	                <h4><?=$newProduct['price'];?>€</h4>
                       	            <?php else : ?>
                       	                <h4><?=$newProduct['newPrice'];?></h4>
                       	            <?php endif; ?>
                       	            <p>
	                					<span style="cursor:pointer;">
										<?php if(!empty($_SESSION['user'])): ?>
											<?php if(in_array($newProduct['id'], $favorite)): ?>
												<button class="favorite" type="submit" name="<?=str_replace(' ', '', $newProduct['name']);?>" value="<?=$newProduct['id']?>"><i class="fa fa-heart-o fa-fw favoriteicon_original favoriteicon_click" aria-hidden="true" style="color: #999;" title="Ajouter à mes favoris"></i>ee</button> <!-- l'icône ne change pas de couleur, pour ça que j'ai mis 'ee' pour voir la différence lors du dev -->
											<?php else: ?>
												<button class="favorite" type="submit" name="<?=str_replace(' ', '', $newProduct['name']);?>" value="<?=$newProduct['id'];?>"><i class="fa fa-heart-o fa-fw favoriteicon_original favoriteicon_click" aria-hidden="true" title="Ajouter à mes favoris"></i></button>
											<?php endif; ?>
										<?php else : ?>
											<a href="<?=$this->url('login');?>"><i class="fa fa-heart-o fa-fw favoriteicon_original favoriteicon_click" aria-hidden="true" title="Ajouter à mes favoris"></i></a>
										<?php endif; ?>
										</span> <?=$newProduct['name'];?>
	                				</p>
                       			<div class="slidecontent_nouveau"><?=$newProduct['statut'];?></div>
                       	        <!--<a class="btn btn-mini" href="#">&raquo; Read More</a>-->
                       	        </div>
                       	    </li>
                       	<?php endforeach; ?>
                    </ul>
              </div><!-- /Slide2 --> 
            <div class="item">
                    <ul class="thumbnails">
                        <?php foreach ($afficheNewItem as $newProduct) : ?>
	                        <li class="span3">
	                            <div class="thumbnail">
	                                <a href="<?=$this->url('viewArt', ['id' => $newProduct['id']]);?>"><img src="<?=$this->assetUrl('art/'.$newProduct['picture1']);?>" alt=""></a>
	                            </div>
	                            <div class="caption">
	                            	<?php if($newProduct['newPrice'] == 0) : ?>
	                            		<h4><?=$newProduct['price'];?>€</h4>
	                            	<?php else : ?>
	                            		<h4><?=$newProduct['newPrice'];?></h4>
	                            	<?php endif; ?>
	                				<p>
	                					<span style="cursor:pointer;">
										<?php if(!empty($_SESSION['user'])): ?>
											<?php if(in_array($newProduct['id'], $favorite)): ?>
												<button class="favorite" type="submit" name="<?=str_replace(' ', '', $newProduct['name']);?>" value="<?=$newProduct['id']?>"><i class="fa fa-heart-o fa-fw favoriteicon_original favoriteicon_click" aria-hidden="true" style="color: #999;" title="Ajouter à mes favoris"></i>ee</button> <!-- l'icône ne change pas de couleur, pour ça que j'ai mis 'ee' pour voir la différence lors du dev -->
											<?php else: ?>
												<button class="favorite" type="submit" name="<?=str_replace(' ', '', $newProduct['name']);?>" value="<?=$newProduct['id'];?>"><i class="fa fa-heart-o fa-fw favoriteicon_original favoriteicon_click" aria-hidden="true" title="Ajouter à mes favoris"></i></button>
											<?php endif; ?>
										<?php else : ?>
											<a href="<?=$this->url('login');?>"><i class="fa fa-heart-o fa-fw favoriteicon_original favoriteicon_click" aria-hidden="true" title="Ajouter à mes favoris"></i></a>
										<?php endif; ?>
										</span> <?=$newProduct['name'];?>
	                				</p>
									<div class="slidecontent_nouveau"><?=$newProduct['statut'];?></div>
	                                <!--<a class="btn btn-mini" href="#">&raquo; Read More</a>-->
	                            </div>
	                        </li>
	                    <?php endforeach; ?>
                    </ul>
              </div><!-- /Slide3 --> 
        </div>
        
        <div class="control-box">                            
            <a data-slide="prev" href="#myCarousel" class="carousel-control left">‹</a>
            <a data-slide="next" href="#myCarousel" class="carousel-control right">›</a>
        </div><!-- /.control-box -->   
                              
    </div><!-- /#myCarousel -->
        
</div><!-- /.span12 -->          
</div><!-- /.row --> 
</div><!-- /.container -->
<br><br>
</form>
<?php $this->stop('main_content') ?>

<?php $this->start('js')?>
	<script>
		$(document).ready(function(){
			$('button[type="submit"]').click(function(e){
				// e.preventDefault();

				var idProduct = $(this).data('id');
				var idQuantity = $('#number').val();

				$.ajax({
  					url: '<?=$this->url('ajax_addToCartView'); ?>',
					type: 'post',
					cache: false,
					data: {id_product: idProduct, id_quantity: idQuantity},  // $_POST['id_product']
					dataType: 'json',
					success: function(out){
						if(out.code == 'ok'){
			  				window.location.href=window.location.href;
						}
					}
  				});
			});

			$('.favorite').click(function(e){
				e.preventDefault();

				var idFavorite = $(this).data('id');

				$.ajax({
					url: '<?=$this->url('ajax_favorite');?>',
					type: 'post',
					cache: false,
					data: {id_item: idFavorite},
					dataType: 'json',
					success: function(add){
						if(add.msg == 'ok'){
							$('body').load('<?=$this->url('viewArt', ['id' => $items['id']]);?>');
						}
					}
				});
			});
		});
	</script>
<?php $this->stop('js')?>
