<?php $this->layout('layoutfront', ['title' => 'Compte utilisateur']) ?>

<?php $this->start('main_content') ?>
<div class="listorder_back">
 <div class="row">
  <div class="col-md-3">
  	<img class="img-responsive playmo_hide" src="<?=$this->assetUrl('/img/napoLeft.png');?>" id="categorycustoms_hover">
  </div>
  <div class="col-md-6 ordermidia_width">
   <div class="cptuser_contenu">
	<li style="float: left;">   
   	<img class="img-responsive" src="<?=$this->assetUrl('/img/napoPic.png');?>" id="categorycustoms_hover">
	</li>
	<li>
	   	<h4 class="viewcategory_pages">Mon compte <span>></span> Historique commandes</h4>
	</li>
	<div class="clear"></div>
	<br><br>
	<p class="orderMC_title">MOM COMPTE</p>
	<p class="orderMC_text">Bienvenue sur votre page d'accueil.  Vous pouvez y gérer vos informations personnelles ainsi que visualiser vos commandes.</p>
	<hr>
	<br>
	   <div class="row">
		   <div class="col-md-9">
		   	   <p class="cptuser_textlien">histori<span style="letter-spacing: 0.01em;">q</span>ues de mes commandes</p>
			   <p class="cptuser_textlien">mes informations personnelles</p>   
			   <p class="cptuser_textlien">histori<span style="letter-spacing: 0.01em;">q</span>mes favoris</p> 
		   </div>
		   <div class="col-md-3">
		   	<img class="img-responsive" src="<?=$this->assetUrl('/img/napoRight.png');?>" id="cptuser_hover" style="float:right;"> 
		   </div>
	   </div>
	     

	   
	  
   </div>
  </div>
  <div class="col-md-3">
  	<img class="img-responsive playmo_hide" src="<?=$this->assetUrl('/img/napoRight.png');?>" id="categorycustoms_hover" style="float:right;">
  </div>
 </div>
 
 
</div>


<?php $this->stop('main_content') ?>
