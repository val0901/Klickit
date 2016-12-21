<?php $this->layout('layoutfront', ['title' => 'Formulaire de Contact']) ?>

<?php $this->start('main_content') ?>
<div class="contactbanner">
	<img class="img-responsive" src="<?=$this->assetUrl('/img/formcontactbanner.png');?>">
</div>
<div class="container_general">
	<div class="row" style="margin:0;padding:0;">
		<!--contact col1-->
		<div class="col-xs-3 contactnuage">
			<img class="img-responsive" src="<?=$this->assetUrl('/img/formcontactnuage.png');?>">
		</div>
		<!--End contact col1-->
		
		<!--contact col2-->
		<div class="col-xs-7">
			<i class="fa fa-phone" aria-hidden="true"> <span class="telnumber" style="font-family: 'Advent Pro', sans-serif;">06 11 82 17 71</span></i><br>

			<?php  if($success) : ?>
				<p class="alert alert-success">Merci pour votre message. Nous vous répondrons dans les plus brefs délais</p>
			<?php elseif(!empty($errors)) : ?>
				<p class="alert alert-danger"><?=implode('<br>',$errors)?></p>
			<?php endif;?>

			<form style="margin-top:30px;" method="post">

			  <?php if(empty($_SESSION)):?>
			  	<div class="form-group">
					<label for="firstname" class="formlabel">Prénom</label>
					<input type="text" class="form-control" id="firstname" placeholder="votre prénom" name="firstname">
			  	</div>

			  	<div class="form-group">
					<label for="lastname" class="formlabel">Nom</label>
					<input type="text" class="form-control" id="lastname" placeholder="votre prénom" name="lastname">
			  	</div>
			  <?php endif;?>
			  		
			  <div class="form-group">
				<label for="exampleInputEmail1" class="formlabel">Email</label>
				<input type="email" class="form-control" id="exampleInputEmail1" placeholder="email@mail.fr" name="email">
			  </div>
			  <div class="form-group">
				<label for="exampleInputPassword1" class="formlabel">Objet</label>
				<input type="text" class="form-control" id="exampleInputPassword1" placeholder="demande de renseignement" name="subject">
			  </div>
			  <div class="form-group">
				<label for="text" class="formlabel">Message</label>
				<textarea id="text" class="form-control" rows="10" placeholder="Bonjour, je souhaiterais savoir..." name="message"></textarea>
			  </div>	
				
			  <!--contact submit-->
			  <!--<button type="submit" class="btn btn-default">Send</button>-->
			  <div>
				  <button type="submit" class="contactbutton"><img class="img-responsive" src="<?=$this->assetUrl('/img/formcontactsubmit.png');?>" title="Envoyer"></button>
			  </div>
			  <br><br>
			  <!--End contact submit-->
			</form>
		</div>
		<!--End contact col2-->
	</div>
</div>

<?php $this->stop('main_content') ?>
