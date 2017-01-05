<?php $this->layout('layoutfront', ['title' => 'Perdu ?']) ?>

<?php $this->start('main_content'); ?>
<div class="row">
	<div class="col-md-2">
	
	</div>
	<div class="col-md-8">
		<img class="img-responsive" src="<?=$this->assetUrl('/img/page404.png');?>" style="width:60%;margin:0 auto;">
	</div>
	<div class="col-md-2">
	
	</div>
</div>

<?php $this->stop('main_content'); ?>
