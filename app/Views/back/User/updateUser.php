<?php $this->layout('layoutback', ['title' => 'Mettre à jour client']) ?>

<?php $this->start('main_content') ?>

<a href="<?=$this->url('listUser');?>"><button class="btn btn-info">Retour à la liste des clients</button></a>
<br><br>

<?php if (empty($user)) :?>
	<p class="alert alert-danger">Aucun utilisateur trouvé</p>
<?php else :?>
	<div class="row">			
		<div class="details col-lg-6">
			<p class="price">Prénom : <?=$user['firstname'];?></p>
			<p class="price">Nom : <?=$user['lastname'];?></p>
			<p class="price">Pseudonyme : <?=$user['username'];?></p>
		</div>
		<div class="details col-lg-6">	
			<p class="price">Adresse email : <?=$user['email'];?></p>
			<p class="price">Adresse postale : <br><?=$user['adress'].'<br>'.$user['zipcode'].'<br>'.$user['city'];?></p>
		</div>
	</div>

	<h3>Modification d'un client</h3>

	<?php if(!empty($errors)):?>
		<p class="alert alert-danger">
			<?=implode('<br>',$errors);?>
		</p>	
	<?php elseif($success):?>
		<p class="alert alert-success">Utilisateur mis à jour</p>
	<?php endif;?>
			
	<form class="form-horizontal" method="post">

		<!-- Select Basic -->
		<div class="form-group">
		  <label class="col-md-4 control-label" for="social_title">Civilité</label>
		  <div class="col-md-1">
		    <select id="social_title" name="social_title" class="form-control">
		    	<option selected disabled></option>
			    <option value="M">M.</option>
			    <option value="Mme">Mme</option>  	
		    </select>
		  </div>
		</div>

		<!-- Select Basic -->
		<div class="form-group">
		  <label class="col-md-4 control-label" for="role">Rôle</label>
		  <div class="col-md-4">
		    <select id="role" name="role" class="form-control">
		    	<option selected disabled></option>	
			    <option value="Admin">Admin</option>
			    <option value="Utilisateur">Utilisateur</option>  
		    </select>
		  </div>
		</div>

		<!-- Text input-->
		<div class="form-group">
		  <label class="col-md-4 control-label" for="firstname">Prénom</label>  
		  <div class="col-md-4">
		  <input id="firstname" name="firstname" class="form-control input-md" type="text">
		    
		  </div>
		</div>

		<!-- Text input-->
		<div class="form-group">
		  <label class="col-md-4 control-label" for="lastname">Nom</label>  
		  <div class="col-md-4">
		  <input id="lastname" name="lastname" class="form-control input-md" type="text">
		    
		  </div>
		</div>

		<!-- Text input-->
		<div class="form-group">
		  <label class="col-md-4 control-label" for="username">Pseudonyme</label>  
		  <div class="col-md-4">
		  <input id="username" name="username" class="form-control input-md" type="text">
		    
		  </div>
		</div>

		<!-- Text input-->
		<div class="form-group">
		  <label class="col-md-4 control-label" for="address">Adresse</label>  
		  <div class="col-md-4">
		  <input id="address" name="address" class="form-control input-md" type="text">
		    
		  </div>
		</div>

		<!-- Text input-->
		<div class="form-group">
		  <label class="col-md-4 control-label" for="zipcode">Code postal</label>  
		  <div class="col-md-4">
		  <input id="zipcode" name="zipcode" class="form-control input-md" type="text">
		    
		  </div>
		</div>

		<!-- Text input-->
		<div class="form-group">
		  <label class="col-md-4 control-label" for="city">Ville</label>  
		  <div class="col-md-4">
		  <input id="city" name="city" class="form-control input-md" type="text">
		    
		  </div>
		</div>

		<!-- Text input-->
		<div class="form-group">
		  <label class="col-md-4 control-label" for="email">Adresse email</label>  
		  <div class="col-md-4">
		  <input id="email" name="email" class="form-control input-md" type="text">
		    
		  </div>
		</div>

		<!-- Password input-->
		<div class="form-group">
		  <label class="col-md-4 control-label" for="password">Mot de passe</label>
		  <div class="col-md-4">
		    <input id="password" name="password" class="form-control input-md" type="password">
		    
		  </div>
		</div>

		<!-- Button -->
		<div class="form-group">
		  <label class="col-md-4 control-label" for="id"></label>
		  <div class="col-md-4">
		    <button id="id" name="id" class="btn btn-info" type="submit">Créer un compte client</button>
		  </div>
		</div>

		</fieldset>
	</form>
	
<?php endif;?>

<?php $this->stop('main_content') ?>
