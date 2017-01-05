<?php $this->layout('layoutfront', ['title' => 'catégorie Customs', 'meta' => 'napoleon, Customs playmobil, customs Tampographiés, bustes playmobil, bustes tampographiés, pièces résine, stickers drapeau']) ?>

<?php $this->start('main_content') ?>
<div>
	<!--viewcategory row1 col1,2-->
	<div class="row customs_background">
		<div class="col-md-3" style="position:relative;">
			<div class="classic_text_show"><span>Customs</span></div>
			<img class="img-responsive" src="<?=$this->assetUrl('/img/art_classic_divers_000002.jpg');?>">
			<div class="customs_text">Customs</div>
		</div>
		<div class="col-md-9">
			<div class="container_general">
				<h1 class="viewcategorycol2customs_title">Customs</h1>
				<p class="viewcategorycol2_text">Les customs vendus dans la boutique KLICKIT sont des figurines de la marque PLAYMOBIL qui ont été modifiées. Ces transformations sont faites à l'aide de pièces en résine, tampographie, peinture, stickers... Les personnages modifiés par tampographie sont jouables comme des figurines d'origine. Les personnages modifiées à partir de pièces en résine et peinture ne sont plus considérées comme des jouets, mais comme des figurines de collection.
				Vous trouverez également des pièces détachées d'origine de la marque PLAYMOBIL, des pièces en résine à peindre soit même, des stickers, pour réaliser vous même vos customs.</p>
			</div>
		</div>
	</div>
	<!--End viewcategory row1 col1,2-->

<!--vignetteEvent-->
<!--<div class="vignetteEvent_hide">
	<a href="<?=$this->url('front_contact')?>"><img class="img-responsive" src="<?=$this->assetUrl('/img/vignetteEvent1.png');?>" id="vignettecustomsfull_hover" onmouseover="vignettecustomsfullhover();" onmouseout="vignettecustomsfullout();"></a>
</div>-->
<!--End vignetteEvent-->
	
	<!--viewcategory row2 col1-->
	<div class="row">
		<div class="col-md-3">
			<h3 class="viewcategoryrow2col1_title">sous-catégories</h3>
			<div class="viewcategoryrow2col1customs_tirer"><a id="customsmenu_scat" href="<?=$this->url('listItemCustoms', ['sub_category'=>'CustomsTampographies']);?>">Customs tampographiés</a></div>
			<div class="viewcategoryrow2col1customs_tirer"><a id="customsmenu_scat" href="<?=$this->url('listItemCustoms', ['sub_category'=>'CustomsPeints']);?>">Customs peints</a></div>		
			<div class="viewcategoryrow2col1customs_tirer"><a id="customsmenu_scat" href="<?=$this->url('listItemCustoms', ['sub_category'=>'BustesTampographies']);?>">Bustes tampographiés</a></div>
			<div class="viewcategoryrow2col1customs_tirer"><a id="customsmenu_scat" href="<?=$this->url('listItemCustoms', ['sub_category'=>'PiecesEnResine']);?>">Pièces en résine</a></div>
			<div class="viewcategoryrow2col1customs_tirer"><a id="customsmenu_scat" href="<?=$this->url('listItemCustoms', ['sub_category'=>'Stickers']);?>">Stickers</a></div>
			<li>
				<h3 class="viewcategoryrow2col1_title">filtres</h3>
				<div class="form-group viewcategory_checkboxmargin">
					<label class="viewcategorycheckbox_border">
					<input type="checkbox"> <span class="viewcategorycheckbox_font"> 1er empire</span>
					</label>
					<div class="clear"></div>
					<label class="viewcategorycheckbox_border">
					<input type="checkbox"> <span class="viewcategorycheckbox_font"> Sudistes</span>
					</label>
					<div class="clear"></div>
					<label class="viewcategorycheckbox_border">
					<input type="checkbox"> <span class="viewcategorycheckbox_font"> Nordistes</span>
					</label>
				</div>
			</li>
			<li>
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
			</li>
		</div>
		<!--End viewcategory row2 col1-->
		
		<!--viewcategory row2 col2-->
		<div class="col-md-9">
			<h4 class="viewcategory_pages"><a href="<?=$this->url('front_index');?>">Home </a><span>></span><a href="<?=$this->url('listItemCustomFull');?>"> Customs</a></h4>
			<div class="row">
				<form method="post">
					<?php foreach ($items as $product) : ?>
						<div class="col-md-3 col-xs-6 viewcategoryrow2col1_img">
							<a href="<?=$this->url('viewArt', ['id' => $product['id']]);?>"><img src="<?=$this->assetUrl('art/'.$product['picture1']);?>" alt="photo de playmobil" class="img-thumbnail"></a>
							<div class="viewcategorycaption">
								<?php if($product['newPrice'] == 0) : ?>
									<h4><?=$product['price'];?>€</h4>
								<?php else : ?>
									<h4><span class="viewcategoryprixpromo"><?=$product['newPrice'];?>€</span> <span class="viewcategoryprixdelete"><?=$product['price'];?>€</span></h4>
								<?php endif; ?>

                             <p><span style="cursor:pointer;"><i class="fa fa-heart-o fa-fw favoriteicon_original favoriteicon_click" aria-hidden="true" title="Ajouter à mes favoris"></i></span> <?=$product['name'];?></p>

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
					</form>
			</div>
		</div>
		
		
		<div class="row">
			<div class="col-md-3">
			
			</div>
			<div class="col-md-9">
				<!--viewcategory row3 col1,2,3-->
				<div class="row">
					<div class="col-md-3 viewcategorypage_center">
						
					</div>
					<div class="col-md-6 viewcategorypage_center">
					<?php $search = (isset($_GET['search']))? 'search='. $_GET['search'].'&' :'';?>
					<div id="pagination">
						<?= ($page!=1) ? '<a href="?'. $search .'page='. ($page - 1) .'"><i class="fa fa-arrow-left fa-fw" style="color:black;"></i></a>':''; ?>
						Page <?= $page; ?> / <?= ceil($nb/$max); ?>
						<?= $page!= ceil($nb/$max) ? '<a href="?'. $search .'page='. ($page + 1) .'"><i class="fa fa-arrow-right fa-fw" aria-hidden="true" style="color:black;"></i></a>':''; ?>
					</div>
					</div>
					<div class="col-md-3 viewcategorypage_center">
						<button type="button" class="btn btn-primary viewcategorypage_button">afficher tout</button>
					</div>
				</div>
				<!--End viewcategory row3 col1,2,3-->
			</div>
		</div>
		
		</div>
		<!--End viewcategory row2 col2-->
	</div>
	
	<!--nouveute slideshow-->
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
	                            	<?php else : ?>
	                            		<h4><span class="viewcategoryprixpromo"><?=$newProduct['newPrice'];?>€</span> <span class="viewcategoryprixdelete"><?=$newProduct['price'];?>€</span></h4>
	                            	<?php endif; ?>
	                				<p><span style="cursor:pointer;"><i class="fa fa-heart-o fa-fw favoriteicon_original favoriteicon_click" aria-hidden="true" title="Ajouter à mes favoris"></i></span> <?=$newProduct['name'];?></p>
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
                       	                <h4><span class="viewcategoryprixpromo"><?=$newProduct['newPrice'];?>€</span> <span class="viewcategoryprixdelete"><?=$newProduct['price'];?>€</span></h4>
                       	            <?php endif; ?>
                       	            <p><span style="cursor:pointer;"><i class="fa fa-heart-o fa-fw favoriteicon_original favoriteicon_click" aria-hidden="true" title="Ajouter à mes favoris"></i></span> <?=$newProduct['name'];?></p>
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
	                            		<h4><span class="viewcategoryprixpromo"><?=$newProduct['newPrice'];?>€</span> <span class="viewcategoryprixdelete"><?=$newProduct['price'];?>€</span></h4>
	                            	<?php endif; ?>
	                				<p><span style="cursor:pointer;"><i class="fa fa-heart-o fa-fw favoriteicon_original favoriteicon_click" aria-hidden="true" title="Ajouter à mes favoris"></i></span> <?=$newProduct['name'];?></p>
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
<!--End Slide articles-->
	<!--End nouveute slideshow-->
</div>

<?php $this->stop('main_content') ?>