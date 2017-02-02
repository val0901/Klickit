<?php $this->layout('layoutfront', ['title' => 'Présentation de l\'équipe']) ?>

<?php $this->start('main_content') ?>

	<div id="titleTeam">
		<h1>Présentation de l'équipe de création</h1>
	</div>

	<div class="containerTeam">

	<div class="childTeam">
		<div class="wrap">
		  <div class="text-part text-color1">
		    Théo Appelius
		  </div>
		  <div class="image-part">
		    <img src="<?=$this->assetUrl('/img/valerie.png');?>">
		  </div>
		</div>
		<div class=text-description>
		  	Développeur Back-End  
		</div>
	</div>

	<div class="childTeam">
		<div class="wrap">
		  <div class="text-part text-color2">
		    Valérie Baldy-Symezac
		  </div>
		  <div class="image-part">
		    <img src="<?=$this->assetUrl('/img/valerie.png');?>">
		  </div>
		</div>
		<div class=text-description>
		  	Développeuse Back-End
		</div>
	</div>

	<div class="childTeam">
		<div class="wrap">
		  <div class="text-part text-color3">
		    Cécile Lafont
		  </div>
		  <div class="image-part">
		    <img src="<?=$this->assetUrl('/img/valerie.png');?>">
		  </div>
		</div>
		<div class=text-description>
		  	Développeuse Front-End
		</div>
	</div>

	<div class="childTeam">
		<div class="wrap">
		  <div class="text-part text-color4">
		    Landy Razafindrabe
		  </div>
		  <div class="image-part">
		    <img src="<?=$this->assetUrl('/img/valerie.png');?>">
		  </div>
		</div>
		<div class=text-description>
		  	Développeur Back-End
		</div>
	</div>

	<div class="childTeam">
		<div class="wrap">
		  <div class="text-part text-color5">
		    Jie Xu
		  </div>
		  <div class="image-part">
		    <img src="<?=$this->assetUrl('/img/valerie.png');?>">
		  </div>
		</div>
		<div class=text-description>
		  	Développeuse Front-End
		</div>
	</div>

	</div> <!-- fin container -->



<?php $this->stop('main_content') ?>
