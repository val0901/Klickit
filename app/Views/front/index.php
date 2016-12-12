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

<?php $this->stop('main_content') ?>
