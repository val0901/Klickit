<?php $this->layout('layoutfront', ['title' => 'Message satisfaction utilisateur']) ?>

<?php $this->start('main_content') ?>
<div class="listorder_back">
 <div class="row">
  <div class="col-md-3">
  	<img class="img-responsive playmo_hide" src="<?=$this->assetUrl('/img/napoLeft.png');?>" id="categorycustoms">
  </div>
  <div class="col-md-6 ordermidia_width">
   <div class="listorder_contenu">
	<li style="float: left;">   
   	<img class="img-responsive" src="<?=$this->assetUrl('/img/napoPic.png');?>" id="categorycustoms">
	</li>
	<li>
	   	<h4 class="viewcategory_pages"><a href="<?=$this->url('front_affcptuser', ['id' => $_SESSION['user']['id']]);?>">Mon compte</a> <span>></span> <a href="<?=$this->url('fGuestbook');?>">Commentaire</a></h4>
	</li>
	<div class="clear"></div>
	<br><br>
	<p class="orderMC_title">Commentaire</p>
	<p class="orderMC_text">Merci d'être arrivé jusqu'ici ! Vous pouvez nous laisser vos commentaires.</p>
	<hr>
	<br>

	<!-- Affichage des messages de réussite ou d'erreurs -->
	<?php if($success): ?>
		<p class="alert alert-success">Message envoyé</p>
	<?php elseif(isset($errors) && !empty($errors)):?>
		<p class="alert alert-danger"><?=implode('<br>', $errors);?></p>	
	<?php endif;?>

	   <!--place of comments-->
	   <form method="post">
	   	<textarea class="form-control" name="content" rows="10" placeholder="votre commentaire..."></textarea>
		<br><br>
		<div style="text-align:center;">
			<button type="submit" class="btn btn-primary guestbook_button"><strong>laissez votre commentaire</strong></button>
		</div>
	   </form>
	   <!--End place of comments-->
	   <!--underform img-->
	   <br><br>
	   <div>
	   	<img class="img-responsive" src="<?=$this->assetUrl('/img/guestbookvalid.jpg');?>" style="margin:0 auto;">
	   </div>
	  <!-- End undeerform img-->
   </div>
  </div>
  <div class="col-md-3">
  	<img class="img-responsive playmo_hide" src="<?=$this->assetUrl('/img/napoRight.png');?>" id="categorycustoms" style="float:right;">
  </div>
 </div>
 
 
</div>


<?php $this->stop('main_content') ?>
