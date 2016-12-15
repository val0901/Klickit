<?php $this->layout('layoutback', ['title' => 'Login']) ?>

<?php $this->start('main_content') ?>

	<!-- affichage des erreurs lors de la connexion -->
	<?php if(!empty($error)):?>
		<p class="alert alert-danger"><?=$error?></p>
	<?php endif;?>	

	<form method="POST" class="form-horizontal">
		<fieldset>

		<!-- Text input-->
		<div class="form-group">
		  <label class="col-md-4 control-label" for="pseudo">Pseudo</label>  
		  <div class="col-md-4">
		  <input id="pseudo" name="pseudo" placeholder="" class="form-control input-md" type="text">
		    
		  </div>
		</div>

		<!-- Password input-->
		<div class="form-group">
		  <label class="col-md-4 control-label" for="password">Mot de passe </label>
		  <div class="col-md-4">
		    <input id="password" name="password" placeholder="" class="form-control input-md" type="password">
		    
		  </div>
		</div>

		<!-- Button (Double) -->
		<div class="form-group">
		  <label class="col-md-4 control-label" for="submit"></label>
		  <div class="col-md-8">
		    <button type="submit" id="submit" name="submit" class="btn btn-primary">Se connecter</button>
		    <button id="forget" name="forget" class="btn btn-danger">Mot de passe oublié</button>
		  </div>
		</div>

		</fieldset>
	</form>
<?php $this->stop('main_content') ?>

<?php $this->start('js')?>
	<!-- redirection si on clique sur mot de passe oublié -->
	<script>
		$(document).ready(function(){
			$('#forget').click(function(e){
				e.preventDefault();
				window.location.href = "<?=$this->url('back_forgot_pwd')?>";
			});
		});
	</script>
<?php $this->stop('js')?>