<?php $this->layout('layoutback', ['title' => 'Réinitialisation de votre mot de passe']) ?>

<?php $this->start('main_content') ?>

	<form method="POST" class="form-horizontal">

		<div class="form-group">
			<label class="col-md-4 control-label" for="password"></label>  
				<div class="col-md-4">
					<input id="password" name="password" placeholder="" class="form-control input-md" type="password">
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