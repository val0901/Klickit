<?php $this->layout('layoutfront', ['title' => 'catégorie Customs', 'meta' => 'napoleon, Customs playmobil, customs Tampographiés, bustes playmobil, bustes tampographiés, pièces résine, stickers drapeau']) ?>

<?php $this->start('main_content') ?>
<div>
	<!--viewcategory row1 col1,2-->
	<div class="row classics_background">
		<div class="col-md-3" style="position:relative;">
			<div class="classic_text_show"><span>Customs</span></div>
			<img class="img-responsive" src="<?=$this->assetUrl('/img/art_classic_divers_000002.jpg');?>">
			<div class="customs_text">Customs</div>
		</div>
		<div class="col-md-9">
			<div class="container_general">
				<h1 class="viewcategorycol2customs_title">Customs</h1>
				<p class="viewcategorycol2_text">Les customs vendus dans la boutique KLICKIT sont des figurines de la marque PLAYMOBIL qui ont était modifiées. Ces transformations sont faites à l'aide de pièces en résine, tampographie, peinture, stickers... Les personnages modifiés par tampographie sont jouables comme des figurines d'origine. Les personnages modifiées à partir de pièces en résine et peinture ne sont plus considérées comme des jouets, mais comme des figurines de collection.
Vous trouverez également des pièces détachées d'origine de la marque PLAYMOBIL, des pièces en résine à peindre sois même, des stickers, pour réaliser vous même vos customs.</p>
			</div>
		</div>
	</div>
	<!--End viewcategory row1 col1,2-->

<!--vignetteEvent-->
<div class="vignetteEvent_hide">
	<img class="img-responsive" src="<?=$this->assetUrl('/img/vignetteEvent1.png');?>">
</div>
<!--End vignetteEvent-->
	
	<!--viewcategory row2 col1-->
	<div class="row">
		<div class="col-md-3">
			<h3 class="viewcategoryrow2col1_title">sous-catégories</h3>
			<div class="viewcategoryrow2col1customs_tirer"><a href="#">Customs tampographiés</a></div>
			<div class="viewcategoryrow2col1customs_tirer"><a href="#">Customs peints</a></div>		
			<div class="viewcategoryrow2col1customs_tirer"><a href="#">Bustes tampographiés</a></div>
			<div class="viewcategoryrow2col1customs_tirer"><a href="#">Pièces en résine</a></div>
			<div class="viewcategoryrow2col1customs_tirer"><a href="#">Stickers</a></div>
			<li>
				<h3 class="viewcategoryrow2col1_title">fitres</h3>
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
			<h4 class="viewcategory_pages">Home <span>></span> Customs</h4>
			<div class="row">
				<?php foreach ($items as $product) : ?>
					<div class="col-md-3 col-xs-6 viewcategoryrow2col1_img">
						<a href="#"><img src="<?=$this->assetUrl('art/'.$product['picture1']);?>" alt="photo de playmobil" class="img-thumbnail"></a>
						<div class="viewcategorycaption">
							<?php if($product['newPrice'] === 0) : ?>
								<h4><?=$product['price'];?>€</h4>
							<?php else : ?>
								<h4><?=$product['newPrice'];?>€</h4>
							<?php endif; ?>

							<p><?=$product['name'];?></p>

							<?php if($product['statut'] == 'nouveaute'):?>
								<div class="viewcategory_nouveau"><?=$product['statut'];?></div>
							<?php elseif($product['statut'] == 'promotion'):?>
								<div class="viewcategory_promo"><?=$product['statut'];?></div>
							<?php elseif($product['statut'] == 'defaut'): ?>
								<div class="viewcategory_defaut"><?=$product['statut'];?></div>
							<?php endif; ?>
	                    </div>
						<div class="viewcategory_button">
							<button type="button" class="btn btn-primary viewcategory_button_size ">ajouter au panier</button>
						</div>
					</div>
				<?php endforeach; ?>
			</div>
		</div>
		
		
		<div class="col-md-9">
				<!--viewcategory row3 col1,2,3-->
				<div class="row">
					<div class="col-md-3 viewcategorypage_center">
						<h4 class="viewcategory_pages">Résultats 1-6 sur 20</h4>
					</div>
					<div class="col-md-6 viewcategorypage_center">
						<nav aria-label="...">
						  <ul class="pagination">
							<li class="disabled"><a href="#" aria-label="Previous"><span aria-hidden="true">&laquo;</span></a></li>
							<li class="active"><a href="#">1 <span class="sr-only">(current)</span></a></li>
							<li><a href="#">2 </a></li>
							  <li><a href="#">3 </a></li>
							  <li><a href="#">4 </a></li>
							  <li><a href="#">5 </a></li>
							  <li class="disabled"><a href="#" aria-label="Next"><span aria-hidden="true">&raquo;</span></a></li>
						  </ul>
						</nav>
					</div>
					<div class="col-md-3 viewcategorypage_center">
						<button type="button" class="btn btn-primary viewcategorypage_button">afficher tout</button>
					</div>
				</div>
				<!--End viewcategory row3 col1,2,3-->
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
	                                <a href="#"><img src="<?=$this->assetUrl('art/'.$newProduct['picture1']);?>" alt=""></a>
	                            </div>
	                            <div class="caption">
	                            	<?php if($newProduct['newPrice'] === 0) : ?>
	                            		<h4><?=$newProduct['price'];?></h4>
	                            	<?php else : ?>
	                            		<h4><?=$newProduct['newPrice'];?></h4>
	                            	<?php endif; ?>
	                				<p><?=$newProduct['name'];?></p>
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
                       	            <a href="#"><img src="<?=$this->assetUrl('art/'.$newProduct['picture1']);?>" alt=""></a>
                       	        </div>
                       	        <div class="caption">
                       	            <?php if($newProduct['newPrice'] === 0) : ?>
                       	                <h4><?=$newProduct['price'];?></h4>
                       	            <?php else : ?>
                       	                <h4><?=$newProduct['newPrice'];?></h4>
                       	            <?php endif; ?>
                       	            <p><?=$newProduct['name'];?></p>
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
	                                <a href="#"><img src="<?=$this->assetUrl('art/'.$newProduct['picture1']);?>" alt=""></a>
	                            </div>
	                            <div class="caption">
	                            	<?php if($newProduct['newPrice'] === 0) : ?>
	                            		<h4><?=$newProduct['price'];?></h4>
	                            	<?php else : ?>
	                            		<h4><?=$newProduct['newPrice'];?></h4>
	                            	<?php endif; ?>
	                				<p><?=$newProduct['name'];?></p>
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

