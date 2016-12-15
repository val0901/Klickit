<?php $this->layout('layoutfront', ['title' => 'Accueil']) ?>

<?php $this->start('main_content') ?>
<!--section 4 categories-->
<div class="">
	<div class="row">
		<!--<div class="classic_text_show"><span style="color: #000;">Classics</span></div>-->
		<div class="col-lg-3 col-xs-6" style="position:relative;" id="categoryclassic_hover">
			<div class="classic_text_show"><span>Classics</span></div>
			<img class="img-responsive" src="<?=$this->assetUrl('/img/art_classic_divers_000001.jpg');?>" id="categoryclassic_hover">
			<div class="classic_text">Classics</div>
		</div>
		<div class="col-lg-3 col-xs-6">
			<img class="img-responsive" src="<?=$this->assetUrl('/img/art_classic_divers_000002.jpg');?>">
			<div class="customs_text">Customs</div>
		</div>
		<div class="col-lg-3 col-xs-6">
			<img class="img-responsive" src="<?=$this->assetUrl('/img/art_classic_divers_000003.jpg');?>">
			<div class="pieces_text">Pièces</div>
		</div>
		<div class="col-lg-3 col-xs-6">
			<img class="img-responsive" src="<?=$this->assetUrl('/img/art_divers_bte000001.jpg');?>">
			<div class="divers_text">Divers</div>
		</div>
	</div>
</div>
<!--End section 4 categories-->

<!--La derniere commentaire-->
<div class="vignetteEvent_hide">
	<img class="img-responsive" src="<?=$this->assetUrl('/img/vignetteEvent1.png');?>">
</div>
<div class="row commtaire_back">
  <div class="col-md-2"></div>
  <div class="col-md-10 col2_commentaireback">
    <?php foreach($comments as $value) :?>
        <?php if($value['published'] == 'oui'):?>
        	<img class="img-responsive" src="<?=$this->assetUrl('/img/avatarBoy.png');?>" style="float: left;">
        	  <span class="col2commtaire_margin commentaire_title"><?=$value['subject']?><span style="float:right;" class="quote_hide"><i class="fa fa-quote-right fa-4x" aria-hidden="true" style="color: #7bc942;"></i></span><li><span style="padding-left:50px;font-size:25px;font-weight:400;"><?=$value['content'].' '?></span><span style="font-size:25px;font-weight:400;"><?=' ...'.$value['firstname'].' '.ucfirst(substr($value['lastname'],0,1))?></span></li>
        	  </span>
        <?php endif;?>          
    <?php endforeach;?>      
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
                        <li class="span3">
                            <div class="thumbnail">
                                <a href="#"><img src="<?=$this->assetUrl('/img/art_classic_divers_000004.jpg');?>" alt=""></a>
                            </div>
                            <div class="caption">
                                <h4>5 €</h4>
                				<p>Princess Playmo</p>
								<div class="slidecontent_nouveau">nouveau !</div>
                                <!--<a class="btn btn-mini" href="#">&raquo; Read More</a>-->
                            </div>
                        </li>
                        <li class="span3">
                            <div class="thumbnail">
                                <a href="#"><img src="<?=$this->assetUrl('/img/art_classic_divers_000005.jpg');?>" alt=""></a>
                            </div>
                            <div class="caption">
                                <h4>4 €</h4>
                				<p>Nullam Condimentum Nibh Etiam Sem</p>
								<div class="slidecontent_promo">promo !</div>
                            </div>
                        </li>
                        <li class="span3">
                            <div class="thumbnail">
                                <a href="#"><img src="<?=$this->assetUrl('/img/art_classic_divers_000006.jpg');?>" alt=""></a>
                            </div>
                            <div class="caption">
                                <h4>8 €</h4>
                				<p>Princess Playmo</p>
								<div class="slidecontent_nouveau">nouveau !</div>
                            </div>
                        </li>
                        <li class="span3">
                            <div class="thumbnail">
                                <a href="#"><img src="<?=$this->assetUrl('/img/art_classic_divers_000007.jpg');?>" alt=""></a>
                            </div>
                            <div class="caption">
                                <h4>3 €</h4>
                				<p>Princess Playmo</p>
								<div class="slidecontent_nouveau">nouveau !</div>
                            </div>
                        </li>
                    </ul>
              </div><!-- /Slide1 --> 
            <div class="item">
                    <ul class="thumbnails">
                        <li class="span3">
                            <div class="thumbnail">
                                <a href="#"><img src="<?=$this->assetUrl('/img/art_classic_divers_000008.jpg');?>" alt=""></a>
                            </div>
                            <div class="caption">
                                <h4>5 €</h4>
                				<p>Princess Playmo</p>
								<div class="slidecontent_nouveau">nouveau !</div>
                            </div>
                        </li>
                        <li class="span3">
                            <div class="thumbnail">
                                <a href="#"><img src="<?=$this->assetUrl('/img/art_classic_espacerobots_000001.jpg');?>" alt=""></a>
                            </div>
                            <div class="caption">
                                <h4>4 €</h4>
                				<p>Princess Playmo</p>
								<div class="slidecontent_promo">promo !</div>
                            </div>
                        </li>
                        <li class="span3">
                            <div class="thumbnail">
                                <a href="#"><img src="<?=$this->assetUrl('/img/art_classic_espacerobots_000002.jpg');?>" alt=""></a>
                            </div>
                            <div class="caption">
                                <h4>8 €</h4>
                				<p>Princess Playmo</p>
								<div class="slidecontent_nouveau">nouveau !</div>
                            </div>
                        </li>
                        <li class="span3">
                            <div class="thumbnail">
                                <a href="#"><img src="<?=$this->assetUrl('/img/art_classic_fantasy_000001.jpg');?>" alt=""></a>
                            </div>
                            <div class="caption">
                                <h4>3 €</h4>
                				<p>Princess Playmo</p>
								<div class="slidecontent_nouveau">nouveau !</div>
                            </div>
                        </li>
                    </ul>
              </div><!-- /Slide2 --> 
            <div class="item">
                    <ul class="thumbnails">
                        <li class="span3">
                            <div class="thumbnail">
                                <a href="#"><img src="<?=$this->assetUrl('/img/art_classic_fantasy_000002.jpg');?>" alt=""></a>
                            </div>
                            <div class="caption">
                                <h4>5 €</h4>
                				<p>Princess Playmo</p>
								<div class="slidecontent_nouveau">nouveau !</div>
                            </div>
                        </li>
                        <li class="span3">
                            <div class="thumbnail">
                                <a href="#"><img src="<?=$this->assetUrl('/img/art_classic_fantasy_000003.jpg');?>" alt=""></a>
                            </div>
                            <div class="caption">
                                <h4>4 €</h4>
                				<p>Princess Playmo</p>
								<div class="slidecontent_promo">promo !</div>
                            </div>
                        </li>
                        <li class="span3">
                            <div class="thumbnail">
                                <a href="#"><img src="<?=$this->assetUrl('/img/art_classic_fantasy_000004.jpg');?>" alt=""></a>
                            </div>
                            <div class="caption">
                                <h4>8 €</h4>
                				<p>Princess Playmo</p>
								<div class="slidecontent_nouveau">nouveau !</div>
                            </div>
                        </li>
                        <li class="span3">
                            <div class="thumbnail">
                                <a href="#"><img src="<?=$this->assetUrl('/img/art_classic_feesprincesses_000001.jpg');?>" alt=""></a>
                            </div>
                            <div class="caption">
                                <h4>3 €</h4>
                				<p>Princess Playmo</p>
								<div class="slidecontent_nouveau">nouveau !</div>
                            </div>
                        </li>
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
<?php $this->stop('main_content') ?>
