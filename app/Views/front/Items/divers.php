<?php $this->layout('layoutfront', ['title' => 'catégorie Divers']) ?>

<?php $this->start('main_content') ?>
<form method="post">
<div>
	<!--viewcategory row1 col1,2-->
	<div class="row divers_background">
		<div class="col-md-3" style="position:relative;">
			<div class="classic_text_show"><span>Divers</span></div>
			<img class="img-responsive" src="<?=$this->assetUrl('/img/img_boitessets.jpg');?>">
			<div class="divers_text"><a href="<?=$this->url('listItemDiversFull');?>" style="color:white;">Boites/Set</a></div>
		</div>
		<div class="col-md-9">
			<div class="container_general">
				<h1 class="viewcategorycol2divers_title">Divers</h1>
				<p class="viewcategorycol2_text">Retrouvez dans cette rubrique, des boites et sets PLAYMOBIL&reg; neufs et d'occasions ainsi que des produits dérivés.</p>
			</div>
		</div>
	</div>
	<!--End viewcategory row1 col1,2-->

<!--vignetteEvent-->
<!--<div class="vignetteEvent_hide">
	<img class="img-responsive" src="<?=$this->assetUrl('/img/vignetteEvent1.png');?>">
</div>-->
<!--End vignetteEvent-->
	
	<!--viewcategory row2 col1-->
	<div class="row">
		<div class="col-md-3">
			<h3 class="viewcategoryrow2col1_title">sous-catégories</h3>
			<!-- <div class="viewcategoryrow2col1customs_tirer"><a class="btnscatclic" href="#"></a></div> --> <!-- à activer (ainsi qu'à dupliquer au nombre de sous-catégorie que nous aurons) lorsqu'on aura des sous-catégories pour cette catégorie -->
			<li>
				<?php if(!empty($filters)) : ?>
					<h3 class="viewcategoryrow2col1_title">filtres</h3>
					<div class="form-group viewcategory_checkboxmargin">
						<div class="form-group viewcategory_checkboxmargin">
							<?php foreach ($filters as $filter) : ?>
								<label class="viewcategorycheckbox_border">
								<input type="checkbox" class="filter_value" value='<?=$filter['name'];?>'> <span class="viewcategorycheckbox_font"><?=ucfirst($filter['name']);?></span>
								</label>
							<?php endforeach; ?>
							<button type="button" id="searchFilter"class="changeArrow divers">Rechercher</button>
						</div>
					</div>
				<?php endif; ?>
			</li>
			<!-- <li>
				<h3 class="viewcategoryrow2col1_title">état</h3>
				<div class="form-group viewcategory_checkboxmargin">
					<label class="viewcategorycheckbox_border">
					<input type="checkbox"> <span class="viewcategorycheckbox_font"> Nouveau</span>
					</label>
					<div class="clear"></div>
					<label class="viewcategorycheckbox_border">
					<input type="checkbox"> <span class="viewcategorycheckbox_font"> Promo</span>
					</label>
				</div>
			</li> -->
		</div>
		<!--End viewcategory row2 col1-->
		
		<!--viewcategory row2 col2-->
		<div class="col-md-9">
			<h4 class="viewcategory_pages"><a href="<?=$this->url('front_index');?>">Home </a> <span>></span> <a href="<?=$this->url('listItemDiversFull');?>"> Boites/Set </a><span>></span> <!-- sous-catégorie si un jour il y en a --></h4>
			<div class="row" id="replace">
				<?php foreach ($items as $product) : ?>
					<div class="col-md-3 col-xs-6 viewcategoryrow2col1_img">
						<a href="<?=$this->url('viewArt', ['id' => $product['id']]);?>"><img src="<?=$this->assetUrl('art/'.$product['picture1']);?>" alt="photo de playmobil" class="img-thumbnail"></a>
						<div class="viewcategorycaption">
							<?php if($product['newPrice'] == 0) : ?>
								<h4 class="salesItems"><?=str_replace('.', ',', $product['price']);?>€</h4>
							<?php else : ?>
								<h4 class="salesItems"><span class="viewcategoryprixpromo"><?=str_replace('.', ',', $product['newPrice']);?>€</span> <span class="viewcategoryprixdelete"><?=str_replace('.', ',', $product['price']);?>€</span></h4>
							<?php endif; ?>

							<p class="paraphItem">
								<span style="cursor:pointer;">
									<?php if(!empty($_SESSION['user'])): ?>
										<?php if(in_array($product['id'], $favorite)): ?>
											<button class="favorite" type="submit" name="<?=str_replace(' ', '', $product['name']);?>" value="<?=$product['id']?>" data-id="<?=$product['id'];?>"><span class="<?=$product['id'];?> fa fa-heart fa-fw favoriteicon_original favoriteicon_click favHeart" aria-hidden="true" style="color: #c11131;" title="Retirer de mes favoris"></span></button>
										<?php else: ?>
											<button class="favorite" type="submit" name="<?=str_replace(' ', '', $product['name']);?>" value="<?=$product['id'];?>" data-id="<?=$product['id'];?>"><span class="<?=$product['id'];?> fa fa-heart-o fa-fw favoriteicon_original favoriteicon_click favHeart" aria-hidden="true" title="Ajouter à mes favoris"></span></button>
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
								<div class="viewcategory_defaut"><?=$product['statut'];?></div>
							<?php endif; ?>
	                    </div>

	                    <!-- container +1 -->
	                    <div id="<?=$product['id'];?>" class="item--helper">
	                        <span id="plus1">+1</span>
	                    </div>
						<div class="viewcategory_button">
							<?php if(!empty($_SESSION['user'])): ?>
                                <button type="button" class="changeArrow btn viewcategory_button_size add_to_shopping_cart ahoveroff add-to-basket" data-id="<?=$product['id']?>">  <span class="name">
                                    Ajouter au panier
                                    </span>
                                </button>
                            <?php else : ?>
                                <a class="ahoveroff" href="<?=$this->url('login');?>" target="_blank"><button id="simple" type="button" class="changeArrow btn viewcategory_button_size ahoveroff add-to-basket" data-id="<?=$product['id']?>">  <span class="name">
                                    Ajouter au panier
                                    </span>
                                </button></a>
                            <?php endif; ?>
						</div>
					</div>
				<?php endforeach; ?>
			</div>
		</div>		
		</div>
		<!--End viewcategory row2 col2-->

		<div class="row">
			<div class="col-md-3">
			
			</div>
			<div class="col-md-9">
				<!--viewcategory row3 col1,2,3-->
				<div class="row">
					<div class="col-md-3 viewcategorypage_center">
						
					</div>
					<div class="col-md-6 viewcategorypage_center viewPagination">
					<?php $search = (isset($_GET['search']))? 'search='. $_GET['search'].'&' :'';?>
					<div id="pagination">
						<?= ($page!=1) ? '<a href="?'. $search .'page='. ($page - 1) .'"><i class="fa fa-arrow-left fa-fw" style="color:black;"></i></a>':''; ?>
						Page <?= $page; ?> <?= ($nb>=1) ? '/'.ceil($nb/$max) :''; ?>
						<?= ($nb < 1 ) ? '' : ($page!= ceil($nb/$max) ? '<a href="?'. $search .'page='. ($page + 1) .'"><i class="fa fa-arrow-right fa-fw" aria-hidden="true" style="color:black;"></i></a>':''); ?>
					</div>
					</div>
					
				</div>
				<!--End viewcategory row3 col1,2,3-->
			</div>
		</div>
	</div>
	
    <!--nouveaute slideshow-->
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
                                <?php foreach ($afficheNewItem1 as $newProduct) : ?>
                                <li class="span4">
                                    <div class="thumbnail">
                                        <a href="<?=$this->url('viewArt', ['id' => $newProduct['id']]);?>"><img class="ahoveron" src="<?=$this->assetUrl('art/'.$newProduct['picture1']);?>" alt=""></a>
                                    </div>
                                    <div class="caption">
                                        <?php if($newProduct['newPrice'] == 0) : ?>
                                        <h4><?=str_replace('.', ',', $newProduct['price']);?>€</h4>
                                        <?php else : ?>
                                        <h4><span class="viewcategoryprixpromo"><?=str_replace('.', ',', $newProduct['newPrice']);?>€</span> <span class="viewcategoryprixdelete"><?=str_replace('.', ',', $newProduct['price']);?>€</span></h4>
                                        <?php endif; ?>
                                        <p>
                                            <span style="cursor:pointer;">
                                                <?php if(!empty($_SESSION['user'])): ?>
                                                	<?php if(in_array($newProduct['id'], $favorite)): ?>
                                                		<button class="favorite" type="submit" name="<?=str_replace(' ', '', $newProduct['name']);?>" value="<?=$newProduct['id']?>" data-id="<?=$newProduct['id'];?>"><span class="<?=$newProduct['id'];?> fa fa-heart fa-fw favoriteicon_original favoriteicon_click" aria-hidden="true" style="color: #c11131;" title="Retirer de mes favoris"></span></button>
                                                	<?php else: ?>
                                                		<button class="favorite" type="submit" name="<?=str_replace(' ', '', $newProduct['name']);?>" value="<?=$newProduct['id'];?>" data-id="<?=$newProduct['id'];?>"><span class="<?=$newProduct['id'];?> fa fa-heart-o fa-fw favoriteicon_original favoriteicon_click" aria-hidden="true" title="Ajouter à mes favoris"></span></button>
                                                	<?php endif; ?>
                                                <?php else : ?>
                                                	<a href="<?=$this->url('login');?>"><i class="fa fa-heart-o fa-fw favoriteicon_original favoriteicon_click" aria-hidden="true" title="Ajouter à mes favoris"></i></a>
                                                <?php endif; ?>
                                            </span> <?=$newProduct['name'];?>
                                        </p>
                                        <div class="slidecontent_nouveau"><?=$newProduct['statut'];?></div>
                                        <!--<a class="btn btn-mini" href="#">&raquo; Read More</a>-->
                                    </div>
                                <!-- container +1 -->
                                <div id="<?=$newProduct['id'];?>" class="item--helper-slide">
                                    <span id="plus1">+1</span>
                                </div>
                                <div class="viewcategory_button">
                                    <!--j'ai supprimé .btn-primary dans la class button-->
                                    <?php if(!empty($_SESSION['user'])): ?>
                                        <button id="simple" type="button" class="changeArrow btn viewcategory_button_size add_to_shopping_cart ahoveroff add-to-basket" data-id="<?=$newProduct['id']?>">  <span class="name">
                                            Ajouter au panier
                                            </span>
                                        </button>
                                    <?php else : ?>
                                        <a class="ahoveroff" href="<?=$this->url('login');?>" target="_blank"><button id="simple" type="button" class="changeArrow btn viewcategory_button_size ahoveroff add-to-basket" data-id="<?=$newProduct['id']?>">  <span class="name">
                                            Ajouter au panier
                                            </span>
                                        </button></a>
                                    <?php endif; ?>
                                </div>
                            <br><br>                                    
                                </li>
                                <?php endforeach; ?>
                            </ul>
                        </div><!-- /Slide1 --> 
                        <div class="item">
                            <ul class="thumbnails">
                                <?php foreach ($afficheNewItem2 as $newProduct) : ?>
                                <li class="span4">
                                    <div class="thumbnail">
                                        <a href="<?=$this->url('viewArt', ['id' => $newProduct['id']]);?>"><img class="ahoveron" src="<?=$this->assetUrl('art/'.$newProduct['picture1']);?>" alt=""></a>
                                    </div>
                                    <div class="caption">
                                        <?php if($newProduct['newPrice'] == 0) : ?>
                                        <h4><?=str_replace('.', ',', $newProduct['price']);?>€</h4>
                                        <?php else : ?>
                                        <h4><span class="viewcategoryprixpromo"><?=str_replace('.', ',', $newProduct['newPrice']);?>€</span> <span class="viewcategoryprixdelete"><?=str_replace('.', ',', $newProduct['price']);?>€</span></h4>
                                        <?php endif; ?>
                                        <p>
                                            <span style="cursor:pointer;">
                                                <?php if(!empty($_SESSION['user'])): ?>
                                                	<?php if(in_array($newProduct['id'], $favorite)): ?>
                                                		<button class="favorite" type="submit" name="<?=str_replace(' ', '', $newProduct['name']);?>" value="<?=$newProduct['id']?>" data-id="<?=$newProduct['id'];?>"><span class="<?=$newProduct['id'];?> fa fa-heart fa-fw favoriteicon_original favoriteicon_click" aria-hidden="true" style="color: #c11131;" title="Retirer de mes favoris"></span></button>
                                                	<?php else: ?>
                                                		<button class="favorite" type="submit" name="<?=str_replace(' ', '', $newProduct['name']);?>" value="<?=$newProduct['id'];?>" data-id="<?=$newProduct['id'];?>"><span class="<?=$newProduct['id'];?> fa fa-heart-o fa-fw favoriteicon_original favoriteicon_click" aria-hidden="true" title="Ajouter à mes favoris"></span></button>
                                                	<?php endif; ?>
                                                <?php else : ?>
                                                	<a href="<?=$this->url('login');?>"><i class="fa fa-heart-o fa-fw favoriteicon_original favoriteicon_click" aria-hidden="true" title="Ajouter à mes favoris"></i></a>
                                                <?php endif; ?>
                                            </span> <?=$newProduct['name'];?>
                                        </p>
                                        <div class="slidecontent_nouveau"><?=$newProduct['statut'];?></div>
                                        <!--<a class="btn btn-mini" href="#">&raquo; Read More</a>-->
                                    </div>
                                <!-- container +1 -->
                                <div id="<?=$newProduct['id'];?>" class="item--helper-slide">
                                    <span id="plus1">+1</span>
                                </div>
                                <div class="viewcategory_button">
                                    <!--j'ai supprimé .btn-primary dans la class button-->
                                    <?php if(!empty($_SESSION['user'])): ?>
                                        <button id="simple" type="button" class="changeArrow btn viewcategory_button_size add_to_shopping_cart ahoveroff add-to-basket" data-id="<?=$newProduct['id']?>">  <span class="name">
                                            Ajouter au panier
                                            </span>
                                        </button>
                                    <?php else : ?>
                                        <a class="ahoveroff" href="<?=$this->url('login');?>" target="_blank"><button id="simple" type="button" class="changeArrow btn viewcategory_button_size ahoveroff add-to-basket" data-id="<?=$newProduct['id']?>">  <span class="name">
                                            Ajouter au panier
                                            </span>
                                        </button></a>
                                    <?php endif; ?>
                                </div>
                            <br><br>                                    
                                </li>
                                <?php endforeach; ?>
                            </ul>
                        </div><!-- /Slide2 --> 
                        <div class="item">
                            <ul class="thumbnails">
                                <?php foreach ($afficheNewItem3 as $newProduct) : ?>
                                <li class="span4">
                                    <div class="thumbnail">
                                        <a href="<?=$this->url('viewArt', ['id' => $newProduct['id']]);?>"><img class="ahoveron" src="<?=$this->assetUrl('art/'.$newProduct['picture1']);?>" alt=""></a>
                                    </div>
                                    <div class="caption">
                                        <?php if($newProduct['newPrice'] == 0) : ?>
                                        <h4><?=str_replace('.', ',', $newProduct['price']);?>€</h4>
                                        <?php else : ?>
                                        <h4><span class="viewcategoryprixpromo"><?=str_replace('.', ',', $newProduct['newPrice']);?>€</span> <span class="viewcategoryprixdelete"><?=str_replace('.', ',', $newProduct['price']);?>€</span></h4>
                                        <?php endif; ?>
                                        <p>
                                            <span style="cursor:pointer;">
                                                <?php if(!empty($_SESSION['user'])): ?>
                                                	<?php if(in_array($newProduct['id'], $favorite)): ?>
                                                		<button class="favorite" type="submit" name="<?=str_replace(' ', '', $newProduct['name']);?>" value="<?=$newProduct['id']?>" data-id="<?=$newProduct['id'];?>"><span class="<?=$newProduct['id'];?> fa fa-heart fa-fw favoriteicon_original favoriteicon_click" aria-hidden="true" style="color: #c11131;" title="Retirer de mes favoris"></span></button>
                                                	<?php else: ?>
                                                		<button class="favorite" type="submit" name="<?=str_replace(' ', '', $newProduct['name']);?>" value="<?=$newProduct['id'];?>" data-id="<?=$newProduct['id'];?>"><span class="<?=$newProduct['id'];?> fa fa-heart-o fa-fw favoriteicon_original favoriteicon_click" aria-hidden="true" title="Ajouter à mes favoris"></span></button>
                                                	<?php endif; ?>
                                                <?php else : ?>
                                                	<a href="<?=$this->url('login');?>"><i class="fa fa-heart-o fa-fw favoriteicon_original favoriteicon_click" aria-hidden="true" title="Ajouter à mes favoris"></i></a>
                                                <?php endif; ?>
                                            </span> <?=$newProduct['name'];?>
                                        </p>
                                        <div class="slidecontent_nouveau"><?=$newProduct['statut'];?></div>
                                        <!--<a class="btn btn-mini" href="#">&raquo; Read More</a>-->
                                    </div>
                                <!-- container +1 -->
                                <div id="<?=$newProduct['id'];?>" class="item--helper-slide">
                                    <span id="plus1">+1</span>
                                </div>
                                <div class="viewcategory_button">
                                    <!--j'ai supprimé .btn-primary dans la class button-->
                                    <?php if(!empty($_SESSION['user'])): ?>
                                        <button id="simple" type="button" class="changeArrow btn viewcategory_button_size add_to_shopping_cart ahoveroff add-to-basket" data-id="<?=$newProduct['id']?>">  <span class="name">
                                            Ajouter au panier
                                            </span>
                                        </button>
                                    <?php else : ?>
                                        <a class="ahoveroff" href="<?=$this->url('login');?>" target="_blank"><button id="simple" type="button" class="changeArrow btn viewcategory_button_size ahoveroff add-to-basket" data-id="<?=$newProduct['id']?>">  <span class="name">
                                            Ajouter au panier
                                            </span>
                                        </button></a>
                                    <?php endif; ?>
                                </div>
                            <br><br>                                    
                                </li>
                                <?php endforeach; ?>
                            </ul>
                        </div><!-- /Slide3 --> 
                    </div>

                    <div class="control-box slider">                            
                        <a data-slide="prev" href="#myCarousel" class="carousel-control left slider">‹</a>
                        <a data-slide="next" href="#myCarousel" class="carousel-control right slider">›</a>
                    </div><!-- /.control-box -->   

                </div><!-- /#myCarousel -->

            </div><!-- /.span12 -->          
        </div><!-- /.row --> 
    </div><!-- /.container -->
    <br><br>
    <!--End Slide articles-->
    <!--End nouveute slideshow-->
</form>
</div>
<?php $this->stop('main_content') ?>

<?php $this->start('js') ?>
	<script>
		$(document).ready(function(){
			$('.favorite').click(function(e){
				e.preventDefault();

				var idFavorite = $(this).data('id');

				function favIcon() // Change l'îcone favoris sans recharger la page
				{
					if($('.'+idFavorite).hasClass('fa-heart-o')){ // On vérifie que l'élement avec l'ID contenu dans idFavorite a la class fa-heart-o
						$('.'+idFavorite).removeClass('fa-heart-o'); // On vire la class
						$('.'+idFavorite).addClass('fa-heart'); // On rajoute une nouvelle
						$('.'+idFavorite).css('color', '#c11131'); // On change la couleur
					}
					else if($('.'+idFavorite).hasClass('fa-heart')){ // On vérifie que l'élement avec l'ID contenu dans idFavorite a la class fa-heart
						$('.'+idFavorite).removeClass('fa-heart'); // On vire la class
						$('.'+idFavorite).addClass('fa-heart-o'); // On rajoute une nouvelle
						$('.'+idFavorite).css('color', '#999999'); // On change la couleur
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

			// Sécurisation de la page si un jour il y a des sous-catégories, remplacer les ?

			var locationOk = true;

			if(window.location.pathname == '/Divers/?'){
				locationOk = true;
			}
			else if(window.location.pathname == '/Divers/?'){
				locationOk = true;
			}
			else {
				locationOk = false;
			}

			if(locationOk == false){
				document.location.href="<?=$this->url('listItemDiversFull');?>";
			}
		});
	</script>

	<script>
		$(document).ready(function(){
			$('#searchFilter').click(function(e){
				e.preventDefault();

				var filter = '';

				var idCheck = new Array();
				$("input:checked").each(function (i) {
					idCheck[i] = $(this).val();
				});

				for (let i of idCheck) {
				    filter += i+', ';
				}

				$.ajax({
					url: '<?=$this->url('ajax_SearchByFilter');?>',
					type: 'post',
					cache: false,
					data: {filter: filter},
					dataType: 'json',
					success: function(search){
						if(search.code == 'ok'){
							$('#replace').html(search.msg);
							$('.viewPagination').css('display', 'none');
							$('.favorite').click(function(e){
								e.preventDefault();

								var idFavorite = $(this).data('id');

								function favIcon() // Change l'îcone favoris sans recharger la page
								{
									if($('.'+idFavorite).hasClass('fa-heart-o')){ // On vérifie que l'élement avec l'ID contenu dans idFavorite a la class fa-heart-o
										$('.'+idFavorite).removeClass('fa-heart-o'); // On vire la class
										$('.'+idFavorite).addClass('fa-heart'); // On rajoute une nouvelle
										$('.'+idFavorite).css('color', '#c11131'); // On change la couleur
									}
									else if($('.'+idFavorite).hasClass('fa-heart')){ // On vérifie que l'élement avec l'ID contenu dans idFavorite a la class fa-heart
										$('.'+idFavorite).removeClass('fa-heart'); // On vire la class
										$('.'+idFavorite).addClass('fa-heart-o'); // On rajoute une nouvelle
										$('.'+idFavorite).css('color', '#999999'); // On change la couleur
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

							$('.add_to_shopping_cart').click(function(e){
								e.preventDefault();

								var idProduct = $(this).data('id');

								$.ajax({
				  					url: '<?=$this->url('ajax_addToCart'); ?>',
									type: 'post',
									cache: false,
									data: {id_product: idProduct},  // $_POST['id_product']
									dataType: 'json',
									success: function(out){
										if(out.code == 'ok'){
							  				$('#reloadBasket').load('<?=$this->url('reloadBasket');?>');
										}
									}
				  				});
							});

							// effet +1 AJOUTER AU PANIER
							// When we click "Add to Basket"...
							$('.add-to-basket').click(function(){
							    var idProduct = $(this).data('id');

							    // Add the animation class
							    $('#'+idProduct+', .basket').addClass('added');

							    // Remove the animation classes after 1.5s
							    var wait = setTimeout(function(){
							        $('#'+idProduct+', .basket').removeClass('added');
							    }, 1000);
							});
						}
						else if(search.code == 'no'){
							$('#replace').html(search.msg);
						}
					}
				});
			});
		});
	</script>
<?php $this->stop('js') ?>