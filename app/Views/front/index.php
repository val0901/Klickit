<?php $this->layout('layoutfront', ['title' => 'Klickit Napoléon Playmobil Western Pirate Fée Princesses Police Robots Espace Animaux Sport Tampographie Customs Accessoires Stickers Résine']) ?>

<?php $this->start('main_content') ?>
<!--section 4 categories-->
<div class="">
	<div class="row">
        <a href="<?=$this->url('listItemClassicsFull');?>">
    		<div class="col-lg-3 col-xs-6" style="position:relative;" id="categoryclassic_hover">
    			<div class="classic_text"><span>Classics</span></div>
    			<img class="img-responsive" src="<?=$this->assetUrl('/img/art_classic_divers_000001.jpg');?>" id="categoryclassic_hover">
    			<div class="classic_text_show"><span style="font-weight: 600;">Classics</span></div>
    		</div>
        </a>

        <a href="<?=$this->url('listItemCustomFull');?>">
    		<div class="col-lg-3 col-xs-6" id="categorycustoms_hover">
    			<div class="customs_text"><span>Customs</span></div>
    			<img class="img-responsive" src="<?=$this->assetUrl('/img/art_classic_divers_000002.jpg');?>" id="categorycustoms_hover">
    			<div class="customs_text_show" style="font-weight: 600;">Customs</div>
    		</div>
        </a>
        
        <a href="<?=$this->url('listItemPiecesFull');?>">
    		<div class="col-lg-3 col-xs-6" id="categorypieces_hover">
    			<div class="pieces_text"><span>Pièces</span></div>
    			<img class="img-responsive" src="<?=$this->assetUrl('/img/art_classic_divers_000003.jpg');?>" id="categorypieces_hover">
    			<div class="pieces_text_show" style="font-weight: 600;">Pièces</div>
    		</div>
        </a>

        <a href="<?=$this->url('listItemDiversFull');?>">
    		<div class="col-lg-3 col-xs-6" id="categorydivers_hover">
    			<div class="divers_text"><span>Divers</span></div>
    			<img class="img-responsive" src="<?=$this->assetUrl('/img/art_divers_bte000001.jpg');?>" id="categorydivers_hover">
    			<div class="divers_text_show" style="font-weight: 600;">Divers</div>
    		</div>
        </a>
	</div>
</div>
<!--End section 4 categories-->

<!--La derniere commentaire-->
<div class="vignetteEvent_hide">
	<a href="<?=$this->url('front_contact')?>"><img class="img-responsive" src="<?=$this->assetUrl('/img/vignetteEvent1.png');?>" id="vignette_hover" onmouseover="vignettehover();" onmouseout="vignetteout();"></a>
</div>
<div class="row commtaire_back">
  <div class="col-md-2"></div>
  <div class="col-md-10 col2_commentaireback my-slider">
            <ul>
                <?php foreach($comments as $value) :?>    
                    <?php if($value['published'] == 'oui'):?> 
                        <li>      
                            <div class="commentaire">    
                            	<img class="img-responsive-tete" src="<?=$this->assetUrl('/img/avatarBoylarge.png');?>" style="float: left;">
                            	  <span class="col2commtaire_margin commentaire_title"><?=$value['subject']?><span style="float:right;" class="quote_hide"><i class="fa fa-quote-right fa-4x" aria-hidden="true" style="color: #7bc942;"></i></span><span style="padding-left:50px;font-size:25px;font-weight:400;"><?=$value['content'].' '?></span><span style="font-size:25px;font-weight:400;"><?=' ...'.$value['firstname'].' '.ucfirst(substr($value['lastname'],0,1))?></span>
                            	  </span>
                            </div> 
                        </li>     
                    <?php endif;?>          
                <?php endforeach;?>
            </ul>     
  </div>
</div>
<!--End La derniere commentaire-->

<!--La derniere evenement-->
<div class="event_title">évènements</div>
<div class="evenement_img">
<!--
    ../../../app/Views/front/Event/viewEvent.php
-->
	<a href="<?=$this->url('front_events');?>"> <img class="img-responsive" src="<?=$this->assetUrl('/img/slideEvent1.jpg');?>"></a>
</div>
<!--End La derniere evenement-->

<!--Slide articles-->
<div class="clear"></div>
<div class="slideartL_title">nouveau!</div>
<div class="slideartR_title">promo!</div>

<div class="">
<div class="row-fluid">
<div class="span12">

        
    <div class="carousel slide" id="myCarousel">
        <div class="carousel-inner">
            <div class="item active">
                    <ul class="thumbnails">
                        <?php foreach ($statut as $newProduct) : ?>
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
                                    <p><?=$newProduct['name'];?></p>

                                    <?php if($newProduct['statut'] == 'nouveaute'):?>
                                        <div class="viewcategory_nouveau"><?=$newProduct['statut'];?></div>
                                    <?php elseif($newProduct['statut'] == 'promotion'):?>
                                        <div class="viewcategory_promo"><?=$newProduct['statut'];?></div>
                                    <?php elseif($newProduct['statut'] == 'defaut'): ?>
                                        <div class="viewcategory_defaut"></div>
                                    <?php endif; ?>
                                    <!--<a class="btn btn-mini" href="#">&raquo; Read More</a>-->
                                </div>
                            </li>
                        <?php endforeach; ?>
                    </ul>
              </div><!-- /Slide1 --> 
            <div class="item">
                    <ul class="thumbnails">
                        <?php foreach ($statut as $newProduct) : ?>
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
                                    <p><?=$newProduct['name'];?></p>

                                    <?php if($newProduct['statut'] == 'nouveaute'):?>
                                        <div class="viewcategory_nouveau"><?=$newProduct['statut'];?></div>
                                    <?php elseif($newProduct['statut'] == 'promotion'):?>
                                        <div class="viewcategory_promo"><?=$newProduct['statut'];?></div>
                                    <?php elseif($newProduct['statut'] == 'defaut'): ?>
                                        <div class="viewcategory_defaut"></div>
                                    <?php endif; ?>
                                    <!--<a class="btn btn-mini" href="#">&raquo; Read More</a>-->
                                </div>
                            </li>
                        <?php endforeach; ?>
                    </ul>
              </div><!-- /Slide2 --> 
            <div class="item">
                    <ul class="thumbnails">
                       <?php foreach ($statut as $newProduct) : ?>
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
                                    <p><?=$newProduct['name'];?></p>

                                    <?php if($newProduct['statut'] == 'nouveaute'):?>
                                        <div class="viewcategory_nouveau"><?=$newProduct['statut'];?></div>
                                    <?php elseif($newProduct['statut'] == 'promotion'):?>
                                        <div class="viewcategory_promo"><?=$newProduct['statut'];?></div>
                                    <?php elseif($newProduct['statut'] == 'defaut'): ?>
                                        <div class="viewcategory_defaut"></div>
                                    <?php endif; ?>
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
<!--End Slide articles-->
<br><br>
<?php $this->stop('main_content') ?>
<?php $this->start('js') ?>
    <script src="<?= $this->assetUrl('js/unslider.js') ?>"></script>
    <script>
        $(document).ready(function(){
            $('.my-slider').unslider({
                animation: 'fade',
                autoplay: true,
                arrows: false,
            });
        });
    </script>
<?php $this->stop('js') ?>