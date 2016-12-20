<?php $this->layout('layoutfront', ['title' => 'view notre articles']) ?>

<?php $this->start('main_content') ?>
<div class="vignetteEvent_hide">
	<img class="img-responsive" src="<?=$this->assetUrl('/img/vignetteEvent1.png');?>">
</div>
<div class="container_viewart">
	<div class="row">
		<div class="col-md-7">
			<img src="<?=$this->assetUrl('/img/art_classic_divers_000001.jpg');?>" style="width:98%;">
		</div>
		<div class="col-md-5 viewart_fontweight">
			<p class="viewart_fontref">Référance 00016</p>
			<h1 class="viewart_fonttitle">Soldat Playmo</h1>
			<span class="viewart_fontref">Etat</span> 
			<span class="viewart_fontpro"> PROMO !</span>
			<br><br>
			<span class="viewart_fontsolde">8 €</span>
			<span class="viewart_fontnormal"> 10 €</span>
			<br><br><br><br>
			<span class="viewart_fontref">Quantité </span>
			<span>
				<input type="number" name="number" id="number">
			</span>
		</div>
	</div>
</div>

<?php $this->stop('main_content') ?>
