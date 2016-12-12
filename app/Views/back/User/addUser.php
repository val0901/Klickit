<?php $this->layout('layoutback', ['title' => 'Ajout client']) ?>

<?php $this->start('main_content') ?>

	<!-- Affichage des messages de réussite ou d'erreurs -->
	<?php if($success): ?>
		<p class="alert alert-success">Client créé</p>
	<?php elseif(isset($errors) && !empty($errors)):?>
		<p class="alert alert-danger"><?=implode('<br>', $errors);?></p>	
	<?php endif;?>

	<form class="form-horizontal" method="post">

		<!-- Form Name -->
		<legend>Création d'un compte client</legend>

		<!-- Select Basic -->
		<div class="form-group">
		  <label class="col-md-4 control-label" for="social_title">Civilité</label>
		  <div class="col-md-1">
		    <select id="social_title" name="social_title" class="form-control">
		      <option value="M">M.</option>
		      <option value="Mme">Mme</option>
		    </select>
		  </div>
		</div>

		<!-- Text input-->
		<div class="form-group">
		  <label class="col-md-4 control-label" for="firstname">Prénom</label>  
		  <div class="col-md-4">
		  <input id="firstname" name="firstname" placeholder="Votre prénom" class="form-control input-md" required="" type="text">
		    
		  </div>
		</div>

		<!-- Text input-->
		<div class="form-group">
		  <label class="col-md-4 control-label" for="lastname">Nom</label>  
		  <div class="col-md-4">
		  <input id="lastname" name="lastname" placeholder="Votre nom" class="form-control input-md" required="" type="text">
		    
		  </div>
		</div>

		<!-- Text input-->
		<div class="form-group">
		  <label class="col-md-4 control-label" for="username">Pseudonyme</label>  
		  <div class="col-md-4">
		  <input id="username" name="username" placeholder="Votre pseudo" class="form-control input-md" required="" type="text">
		    
		  </div>
		</div>

		<!-- Text input-->
		<div class="form-group">
		  <label class="col-md-4 control-label" for="address">Adresse</label>  
		  <div class="col-md-4">
		  <input id="address" name="address" placeholder="Votre adresse" class="form-control input-md" required="" type="text">
		    
		  </div>
		</div>

		<!-- Text input-->
		<div class="form-group">
		  <label class="col-md-4 control-label" for="zipcode">Code postal</label>  
		  <div class="col-md-4">
		  <input id="zipcode" name="zipcode" placeholder="" class="form-control input-md" required="" type="text">
		    
		  </div>
		</div>

		<!-- Text input-->
		<div class="form-group">
		  <label class="col-md-4 control-label" for="city">Ville</label>  
		  <div class="col-md-4">
		  <input id="city" name="city" placeholder="" class="form-control input-md" required="" type="text">
		    
		  </div>
		</div>

		<!-- Text input-->
		<div class="form-group">
		  <label class="col-md-4 control-label" for="email">Adresse email</label>  
		  <div class="col-md-4">
		  <input id="email" name="email" placeholder="example@adresse.com" class="form-control input-md" required="" type="text">
		    
		  </div>
		</div>

		<!-- Password input-->
		<div class="form-group">
		  <label class="col-md-4 control-label" for="password">Mot de passe</label>
		  <div class="col-md-4">
		    <input id="password" name="password" placeholder="" class="form-control input-md" required="" type="password">
		    
		  </div>
		</div>

		<!-- Button -->
		<div class="form-group">
		  <label class="col-md-4 control-label" for="id"></label>
		  <div class="col-md-4">
		    <button id="id" name="id" class="btn btn-info">Créer un compte client</button>
		  </div>
		</div>

		</fieldset>
	</form>
	
<?php $this->stop('main_content') ?>
