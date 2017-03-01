<?php $this->layout('layoutfront', ['title' => 'Compte utilisateur']) ?>

<?php $this->start('main_content') ?>
<div class="listorder_back">
 <div class="row">
  <div class="col-md-3">
  	<img class="img-responsive playmo_hide" src="<?=$this->assetUrl('/img/napoLeft.png');?>" id="categorycustoms">
  </div>
  <div class="col-md-6 ordermidia_width">
   <div class="cptuser_contenu">
	<li style="float: left;">   
   	<img class="img-responsive" src="<?=$this->assetUrl('/img/napoPic.png');?>" id="categorycustoms">
	</li>
	<li>
	   	<h4 class="viewcategory_pages"><a href="<?=$this->url('front_affcptuser', ['id' => $_SESSION['user']['id']]);?>">Mon compte</a> </h4>
	</li>
	<div class="clear"></div>
	<br><br>
	<p class="orderMC_title">MON COMPTE</p>
	<p class="orderMC_text">Bienvenue sur votre page d'accueil.  Vous pouvez y gérer vos informations personnelles ainsi que visualiser vos commandes.</p>
	<hr>
	<br>
	   <div id="colcptuser" class="row">
		   <div id="rowcptuser" class="col-md-9">
		   	   <p class="cptuser_textlien"><a href="<?=$this->url('front_listOrders');?>">histori<span style="letter-spacing: 0.01em;">q</span>ue de mes commandes</a></p>
			   <p class="cptuser_textlien"><a href="<?=$this->url('front_fUpdateUser', ['id' => $_SESSION['user']['id']]);?>">mes informations personnelles</a></p>   
			   <p class="cptuser_textlien"><a href="<?=$this->url('favorite', ['id'=> $_SESSION['user']['id']]);?>">mes favoris</a></p> 
		   </div>
		   <div id="rowcptuser" class="col-md-3">
		   	<a href="<?=$this->url('fGuestbook');?>"><img class="img-responsive center-block" src="<?=$this->assetUrl('/img/gestbookvign.jpg');?>" id="cptuser_hover" style="cursor: pointer" onmouseover="imghover();" onmouseout="imgout();"></a> 
		   </div>
	   </div>
	     

	   
	  
   </div>
  </div>
  <div class="col-md-3">
  	<img class="img-responsive playmo_hide" src="<?=$this->assetUrl('/img/napoRight.png');?>" id="categorycustoms" style="float:right;">
  </div>
 </div>
 
 
</div>


<?php $this->stop('main_content') ?>

<?php $this->start('js') ?>

<?php $this->stop('js') ?>
