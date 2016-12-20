<?php $this->layout('layoutfront', ['title' => 'Mot de passe oublié ?']) ?>

<?php $this->start('main_content') ?>
<div class="container">
	<br><br>

	<?php if(!empty($error)):?>
		<p class="alert alert-danger"><?=$error?></p>
	<?php elseif($success):?>
		<p class="alert alert-success">Message envoyé. Veuillez regarder votre boîte mail</p>
	<?php endif;?>

	<div class="row">
		<div class="col-md-3">	

		</div>

		<div class="col-md-6 orderlogin_box">
			<h1 style="text-align:center;">Saisissez votre adresse email</h1>		

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
					    <button type="submit" id="submit" name="submit" class="btn btn-primary">Réinitialiser mon mot de passe</button>
					  </div>
				</div>
			</form>
		</div>
		
		<div class="col-md-3">	

		</div>	
	</div>
</div>		
<?php $this->stop('main_content') ?>