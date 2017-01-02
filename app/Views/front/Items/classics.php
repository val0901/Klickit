<?php $this->layout('layoutfront', ['title' => 'catégorie Classics', 'meta' => 'napoleon, Customs playmobil, customs Tampographiés, bustes playmobil, bustes tampographiés, pièces résine, stickers drapeau']) ?>

<?php $this->start('main_content') ?>
<div>
	<!--viewcategory row1 col1,2-->
	<div class="row classics_background">
		<div class="col-md-3" style="position:relative;">
			<div class="classic_text_show"><span>Classics</span></div>
			<img class="img-responsive" src="<?=$this->assetUrl('/img/art_classic_divers_000001.jpg');?>">
			<div class="classic_text">Classics</div>
		</div>
		<div class="col-md-9">
			<div class="container_general">
				<h1 class="viewcategorycol2_title">Classics</h1>
				<p class="viewcategorycol2_text">Ardeo, mihi credite, Patres conscripti (id quod vosmet de me existimatis et facitis ipsi) incredibili quodam amore patriae, qui me amor et subvenire olim impendentibus periculis maximis cum dimicatione capitis, et rursum, cum omnia tela undique esse intenta in patriam viderem, subire coegit atque excipere unum pro universis. Hic me meus in rem publicam animus pristinus ac perennis cum C. Caesare reducit, reconciliat, restituit in gratiam.</p>
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
			<div class="viewcategoryrow2col1_tirer"><a href="<?=$this->url('listItemClassics', ['sub_category'=>'Chevaliers']);?>">Chevaliers</a></div>
			<div class="viewcategoryrow2col1_tirer"><a href="<?=$this->url('listItemClassics', ['sub_category'=>'Pirates']);?>">Pirates</a></div>		
			<div class="viewcategoryrow2col1_tirer"><a href="<?=$this->url('listItemClassics', ['sub_category'=>'Antique']);?>">Antique</a></div>
			<div class="viewcategoryrow2col1_tirer"><a href="<?=$this->url('listItemClassics', ['sub_category'=>'Western']);?>">Western</a></div>
			<div class="viewcategoryrow2col1_tirer"><a href="<?=$this->url('listItemClassics', ['sub_category'=>'Fantasy']);?>">Fantasy</a></div>
			<div class="viewcategoryrow2col1_tirer"><a href="<?=$this->url('listItemClassics', ['sub_category'=>'XVIIIe']);?>">XVIIIe</a></div>
			<div class="viewcategoryrow2col1_tirer"><a href="<?=$this->url('listItemClassics', ['sub_category'=>'FeesPrincesses']);?>">Fée & Pincesses</a></div>
			<div class="viewcategoryrow2col1_tirer"><a href="<?=$this->url('listItemClassics', ['sub_category'=>'Police']);?>">Police</a></div>
			<div class="viewcategoryrow2col1_tirer"><a href="<?=$this->url('listItemClassics', ['sub_category'=>'Animaux']);?>">Animaux</a></div>
			<div class="viewcategoryrow2col1_tirer"><a href="<?=$this->url('listItemClassics', ['sub_category'=>'Sport']);?>">Sport</a></div>
			<div class="viewcategoryrow2col1_tirer"><a href="<?=$this->url('listItemClassics', ['sub_category'=>'Divers']);?>">Divers</a></div>
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
			<h4 class="viewcategory_pages"><a href="<?=$this->url('front_index');?>">Home</a><span>></span><a href="<?=$this->url('listItemClassicsFull');?>"> Classics </a><span>></span>
				<?php if($affiche == 'Chevaliers'): ?>
							<a href="<?=$this->url('listItemClassics', ['sub_category'=>'Chevaliers']);?>">Chevaliers</a> <span></span>
				<?php elseif($affiche == 'Pirates'): ?>
							<a href="<?=$this->url('listItemClassics', ['sub_category'=>'Pirates']);?>">Pirates</a> <span></span>
				<?php elseif($affiche == 'Antique'): ?>
							<a href="<?=$this->url('listItemClassics', ['sub_category'=>'Antique']);?>">Antique</a> <span></span>
				<?php elseif($affiche == 'Western'): ?>
							<a href="<?=$this->url('listItemClassics', ['sub_category'=>'Western']);?>">Western</a> <span></span>
				<?php elseif($affiche == 'Fantasy'): ?>
							<a href="<?=$this->url('listItemClassics', ['sub_category'=>'Fantasy']);?>">Fantasy</a> <span></span>
				<?php elseif($affiche == 'XVIIIe'): ?>
							<a href="<?=$this->url('listItemClassics', ['sub_category'=>'XVIIIe']);?>">XVIIIe</a> <span></span>
				<?php elseif($affiche == 'FeesPrincesses'): ?>
							<a href="<?=$this->url('listItemClassics', ['sub_category'=>'FeesPrincesses']);?>">Fées & Princesses</a> <span></span>
				<?php elseif($affiche == 'Police'): ?>
							<a href="<?=$this->url('listItemClassics', ['sub_category'=>'Police']);?>">Police</a> <span></span>
				<?php elseif($affiche == 'Animaux'): ?>
							<a href="<?=$this->url('listItemClassics', ['sub_category'=>'Animaux']);?>">Animaux</a> <span></span>
				<?php elseif($affiche == 'Sport'): ?>
							<a href="<?=$this->url('listItemClassics', ['sub_category'=>'Sport']);?>">Sport</a> <span></span>
				<?php elseif($affiche == 'Divers'): ?>
							<a href="<?=$this->url('listItemClassics', ['sub_category'=>'Divers']);?>">Divers</a> <span></span>
				<?php endif; ?>
			</h4>
			<div class="row">
				<?php foreach ($affiche as $product) : ?>
					<div class="col-md-3 col-xs-6 viewcategoryrow2col1_img">
						<a href="<?=$this->url('viewArt', ['id' => $product['id']]);?>"><img src="<?=$this->assetUrl('art/'.$product['picture1']);?>" alt="photo de playmobil" class="img-thumbnail"></a>
						<div class="viewcategorycaption">
							<?php if($product['newPrice'] == 0) : ?>
								<h4><?=$product['price'];?>€</h4>
							<?php else : ?>
								<h4><span class="viewcategoryprixpromo"><?=$product['newPrice'];?>€</span> <span class="viewcategoryprixdelete"><?=$product['price'];?>€</span></h4>
							<?php endif; ?>

							<p><?=$product['name'];?></p>

							<?php if($product['statut'] == 'nouveaute'):?>
								<div class="viewcategory_nouveau"><?=$product['statut'];?></div>
							<?php elseif($product['statut'] == 'promotion'):?>
								<div class="viewcategory_promo"><?=$product['statut'];?></div>
							<?php elseif($product['statut'] == 'defaut'): ?>
								<div class="viewcategory_defaut"></div>
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
	                            	<?php if($newProduct['newPrice'] == 0) : ?>
	                            		<h4><?=$newProduct['price'];?>€</h4>
	                            	<?php else : ?>
	                            		<h4><span class="viewcategoryprixpromo"><?=$newProduct['newPrice'];?>€</span> <span class="viewcategoryprixdelete"><?=$newProduct['price'];?>€</span></h4>
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
	                            	<?php if($newProduct['newPrice'] == 0) : ?>
	                            		<h4><?=$newProduct['price'];?>€</h4>
	                            	<?php else : ?>
	                            		<h4><span class="viewcategoryprixpromo"><?=$newProduct['newPrice'];?>€</span> <span class="viewcategoryprixdelete"><?=$newProduct['price'];?>€</span></h4>
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
	                            	<?php if($newProduct['newPrice'] == 0) : ?>
	                            		<h4><?=$newProduct['price'];?>€</h4>
	                            	<?php else : ?>
	                            		<h4><span class="viewcategoryprixpromo"><?=$newProduct['newPrice'];?>€</span> <span class="viewcategoryprixdelete"><?=$newProduct['price'];?>€</span></h4>
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
