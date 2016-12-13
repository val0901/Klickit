<?php $this->layout('layoutfront', ['title' => 'Accueil']) ?>

<?php $this->start('main_content') ?>
<!--section 4 categories-->
<div class="">
	<div class="row">
		<div class="col-lg-3 col-xs-6" style="position:relative;">
			<img class="img-responsive" src="<?=$this->assetUrl('/img/art_classic_divers_000001.jpg');?>">
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
	<img class="img-responsive" src="<?=$this->assetUrl('/img/avatarBoy.png');?>" style="float: left;">
	  <span class="col2commtaire_margin commentaire_title">J'adore trop vos customs<span style="float:right;" class="quote_hide"><i class="fa fa-quote-right fa-4x" aria-hidden="true" style="color: #000;"></i></span><li><span style="padding-left:50px;font-size:25px;font-weight:400;">Mon père a beaucoup aimé le Napoléon ...</span><span style="font-size:25px;font-weight:400;">Emile S .</span></li>
	  </span>
  </div>
</div>
<!--End La derniere commentaire-->

<!--La derniere evenement-->
<div class="evenement_img">
	<img class="img-responsive" src="<?=$this->assetUrl('/img/slideEvent1.jpg');?>">
</div>
<!--End La derniere evenement-->
<?php $this->stop('main_content') ?>
