<?php $this->layout('layoutback', ['title' => 'Mettre à jour client']) ?>

<?php $this->start('main_content') ?>

<?php if (empty($user)) :?>
	<p class="alert alert-danger">Aucun utilisateur trouvé</p>
<?php else :?>

	<?php if(!empty($errors)):?>
		<p class="alert alert-danger">
			<?=implode('<br>',$errors);?>
		</p>	
	<?php elseif($success):?>
		<p class="alert alert-success">Utilisateur mis à jour</p>
	<?php endif;?>
			
	<form class="form-horizontal" method="post">

		<!-- Form Name -->
		<legend>Création d'un compte client</legend>

		<!-- Select Basic -->
		<div class="form-group">
		  <label class="col-md-4 control-label" for="social_title">Civilité</label>
		  <div class="col-md-1">
		    <select id="social_title" name="social_title" class="form-control">
		       	<?php if($user['social_title'] == 'M'):?>
			      	<option value="M" selected>M.</option>
			      	<option value="Mme">Mme</option>
		       	<?php elseif($user['social_title'] == 'Mme'):?>
		       		<option value="M">M.</option>
			      	<option value="Mme" selected>Mme</option>
			   	<?php endif;?>   	
		    </select>
		  </div>
		</div>

		<!-- Select Basic -->
		<div class="form-group">
		  <label class="col-md-4 control-label" for="role">Rôle</label>
		  <div class="col-md-4">
		    <select id="role" name="role" class="form-control">
		      	<?php if($user['role'] == 'Admin'):?>	
			      	<option value="Admin" selected>Admin</option>
			      	<option value="Utilisateur">Utilisateur</option>
			  	<?php elseif($user['role'] == 'Utilisateur'):?>
			  	  	<option value="Admin">Admin</option>
			      	<option value="Utilisateur" selected>Utilisateur</option>	
			  	<?php endif;?>   
		    </select>
		  </div>
		</div>

		<!-- Text input-->
		<div class="form-group">
		  <label class="col-md-4 control-label" for="firstname">Prénom</label>  
		  <div class="col-md-4">
		  <input id="firstname" name="firstname" value="<?=$user['firstname'];?>" class="form-control input-md" required="" type="text">
		    
		  </div>
		</div>

		<!-- Text input-->
		<div class="form-group">
		  <label class="col-md-4 control-label" for="lastname">Nom</label>  
		  <div class="col-md-4">
		  <input id="lastname" name="lastname" value="<?=$user['lastname'];?>" class="form-control input-md" required="" type="text">
		    
		  </div>
		</div>

		<!-- Text input-->
		<div class="form-group">
		  <label class="col-md-4 control-label" for="username">Pseudonyme</label>  
		  <div class="col-md-4">
		  <input id="username" name="username" value="<?=$user['username'];?>" class="form-control input-md" required="" type="text">
		    
		  </div>
		</div>

		<!-- Text input-->
		<div class="form-group">
		  <label class="col-md-4 control-label" for="address">Adresse</label>  
		  <div class="col-md-4">
		  <input id="address" name="address" value="<?=$user['adress'];?>" class="form-control input-md" required="" type="text">
		    
		  </div>
		</div>

		<!-- Text input-->
		<div class="form-group">
		  <label class="col-md-4 control-label" for="zipcode">Code postal</label>  
		  <div class="col-md-4">
		  <input id="zipcode" name="zipcode" value="<?=$user['zipcode'];?>" class="form-control input-md" required="" type="text">
		    
		  </div>
		</div>

		<!-- Text input-->
		<div class="form-group">
		  <label class="col-md-4 control-label" for="city">Ville</label>  
		  <div class="col-md-4">
		  <input id="city" name="city" value="<?=$user['city'];?>" class="form-control input-md" required="" type="text">
		    
		  </div>
		</div>

		<!-- Text input-->
		<div class="form-group">
		  <label class="col-md-4 control-label" for="email">Adresse email</label>  
		  <div class="col-md-4">
		  <input id="email" name="email" value="<?=$user['email'];?>" class="form-control input-md" required="" type="text">
		    
		  </div>
		</div>

		<!-- Password input-->
		<div class="form-group">
		  <label class="col-md-4 control-label" for="password">Mot de passe</label>
		  <div class="col-md-4">
		    <input id="password" name="password" class="form-control input-md" required="" type="password">
		    
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
<?php endif;?>	
<?php $this->stop('main_content') ?>
