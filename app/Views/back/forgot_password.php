<?php $this->layout('layoutback', ['title' => 'Mot de passe oublié ?']) ?>

<?php $this->start('main_content') ?>
	
	<h3>Veuillez saisir votre adresse mail pour réinitialiser votre mot de passe</h3><br>

	<?php if(!empty($error)):?>
		<p class="alert alert-danger"><?=$error?></p>
	<?php elseif($success):?>
		<p class="alert alert-success">Message envoyé. Veuillez regarder votre boîte mail</p>
	<?php endif;?>		

	<form method="POST" class="form-horizontal">

		<div class="form-group">
			<label class="col-md-4 control-label" for="email"></label>  
				<div class="col-md-4">
					<input id="email" name="email" placeholder="" class="form-control input-md" type="text">
			  	</div>
		</div>

		<div class="form-group">
		  <label class="col-md-4 control-label" for="submit"></label>
			  <div class="col-md-8">
			    <button type="submit" id="submit" name="submit" class="btn btn-info">Récupérer mon mot de passe</button>
			  </div>
		</div>

	</form>
<?php $this->stop('main_content') ?>