<?php $this->layout('layoutfront', ['title' => 'Ajout utilisateur']) ?>

<?php $this->start('main_content') ?>
<div class="">
	<div class="row">
		<div class="col-md-3 addusercol1img_hide">
			<img class="img-responsive" src="<?=$this->assetUrl('/img/perso2.jpg');?>">
		</div>
		
		<div class="col-md-9 addusercol2_padding">
			<div class="fausers_align">
				<p class="adduserscol1_text">inscription</p>
			</div>
		
		<?php if($success) : ?>
			<p class="alert alert-success">Compte crée</p>
		<?php elseif(isset($errors) && !empty($errors)) :?>
			<p class="alert alert-danger"><?=implode('<br>',$errors)?></p>
		<?php endif;?>			

			<form method="post">

			  <div class="form-group adduser_label">
			  <label for="exampleInputName2">Civilité</label>
			    <select id="social_title" name="social_title" class="form-control">
			      <option value="M">M.</option>
			      <option value="Mme">Mme</option>
			    </select>
			  </div>

			  <div class="form-group adduser_label">
				<label for="exampleInputName2">Nom</label>
    			<input type="text" class="form-control" id="exampleInputName2" placeholder="votre nom" name="lastname">
			  </div>
			  <div class="form-group adduser_label">
				<label for="exampleInputName2">Prénom</label>
    			<input type="text" class="form-control" id="exampleInputName2" placeholder="votre prénom" name="firstname">
			  </div>
			  <div class="form-group adduser_label">
				<label for="exampleInputName2">Pseudo</label>
    			<input type="text" class="form-control" id="exampleInputName2" placeholder="votre pseudo" name="username">
			  </div>
			  <div class="form-group adduser_label">
				<label for="exampleInputName2">Adresse</label>
    			<input type="text" class="form-control" id="exampleInputName2" placeholder="votre adresse" name="address">
			  </div>
			  <div class="form-group adduser_label">
				<label for="exampleInputName2">Code postal</label>
    			<input type="text" class="form-control" id="exampleInputName2" placeholder="ex : 33000" name="zipcode">
			  </div>
			  <div class="form-group adduser_label">
				<label for="exampleInputName2">Ville</label>
    			<input type="text" class="form-control" id="exampleInputName2" placeholder="ex : Bordeaux" name="city">
			  </div>
			  <div class="form-group adduser_label">
				<label for="exampleInputEmail1">Email</label>
				<input type="email" class="form-control" id="exampleInputEmail1" placeholder="email@mail.fr" name="email">
			  </div>
			  <div class="form-group adduser_label">
				<label for="exampleInputPassword1">Mot de passe</label>
				<input type="password" class="form-control" id="exampleInputPassword1" placeholder="votre mot de passe" name="password">
			  </div>
			  <button type="submit" class="btn btn-default adduser_button">S'inscrire</button>
			</form>
		</div>
	</div>
</div>
<br><br>
<?php $this->stop('main_content') ?>
