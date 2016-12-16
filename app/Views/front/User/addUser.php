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
	
			<form>
			  <div class="form-group adduser_label">
				<label for="exampleInputName2">Nom</label>
    			<input type="text" class="form-control" id="exampleInputName2" placeholder="votre nom">
			  </div>
			  <div class="form-group adduser_label">
				<label for="exampleInputName2">Prénom</label>
    			<input type="text" class="form-control" id="exampleInputName2" placeholder="votre prénom">
			  </div>
			  <div class="form-group adduser_label">
				<label for="exampleInputName2">Pseudo</label>
    			<input type="text" class="form-control" id="exampleInputName2" placeholder="votre pseudo">
			  </div>
			  <div class="form-group adduser_label">
				<label for="exampleInputName2">Adresse</label>
    			<input type="text" class="form-control" id="exampleInputName2" placeholder="votre addresse">
			  </div>
			  <div class="form-group adduser_label">
				<label for="exampleInputName2">Code postale</label>
    			<input type="text" class="form-control" id="exampleInputName2" placeholder="ex: 33000">
			  </div>
			  <div class="form-group adduser_label">
				<label for="exampleInputName2">Ville</label>
    			<input type="text" class="form-control" id="exampleInputName2" placeholder="ex: bordeaux">
			  </div>
			  <div class="form-group adduser_label">
				<label for="exampleInputEmail1">Email</label>
				<input type="email" class="form-control" id="exampleInputEmail1" placeholder="email@mail.fr">
			  </div>
			  <div class="form-group adduser_label">
				<label for="exampleInputPassword1">Mot de passe</label>
				<input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
			  </div>
			  <button type="submit" class="btn btn-default adduser_button">Ajouter</button>
			</form>
		</div>
	</div>
</div>
<br><br>
<?php $this->stop('main_content') ?>
