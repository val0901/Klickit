<?php $this->layout('layoutfront', ['title' => 'view notre articles']) ?>

<?php $this->start('main_content') ?>
<div class="vignetteEvent_hide">
	<a href="<?=$this->url('front_contact')?>"><img class="img-responsive" src="<?=$this->assetUrl('/img/vignetteEvent1.png');?>" id="vignetteviewart_hover" onmouseover="vignetteviewarthover();" onmouseout="vignetteviewartout();"></a>
</div>
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
			<span class="viewart_fontref">Quantité </span>
			<span>
				<input type="number" name="number" id="number">
			</span>
			<br><br>
			<div class="">
				<button type="submit" class="btn btn-primary viewcategory_button_size ">ajouter au panier</button>
			</div>
			<br>
			<i class="fa fa-heart-o fa-2x" aria-hidden="true" style="color:#999;"> <span class="viewart_fontfamily">Ajouter à mes favoris</span></i>
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
			<p class="viewart_savoirtext"><?=$items['description']?>His cognitis Gallus ut serpens adpetitus telo vel saxo iamque spes extremas opperiens et succurrens saluti suae quavis ratione colligi omnes iussit armatos et cum starent attoniti, districta dentium acie stridens adeste inquit viri fortes mihi periclitanti vobiscum.
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
<?php $this->stop('main_content') ?>
