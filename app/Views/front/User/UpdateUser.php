<?php $this->layout('layoutfront', ['title' => 'Mise à jour compte utilisateur']) ?>

<?php $this->start('main_content') ?>
<div class="listorder_back">
 <div class="row">
  <div class="col-md-3">
  	<img class="img-responsive playmo_hide" src="<?=$this->assetUrl('/img/napoLeft.png');?>" id="categorycustoms">
  </div>
  <div class="col-md-6 ordermidia_width">
   <div class="listorder_contenu">
	<li style="float: left;">   
   	<img class="img-responsive" src="<?=$this->assetUrl('/img/napoPic.png');?>" id="categorycustoms">
	</li>
	<li>
	   	<h4 class="viewcategory_pages"><a href="<?=$this->url('front_affcptuser', ['id' => $_SESSION['user']['id']]);?>">Mon compte </a><span>></span><a href="<?=$this->url('front_listOrders');?>"> Historique commandes</a></h4>
	</li>
	<div class="clear"></div>
	<br><br>
	<p class="orderMC_title"></p>
	
	
	   
	<div class="row">
		<div class="updateuser_box">
			<h1>mes informations personnelles</h1>
			<p class="orderMC_text">Vous pouvez modifier ici vos informations personnelles.</p>
			<hr>
			<form>
				<p>
					<label class="orderlogin_label">Civilité</label>
				</p>
				<label class="radio-inline">
				  <input type="radio" name="inlineRadioOptions" id="inlineRadio1" value="option1"> Homme
				</label>
				<label class="radio-inline">
				  <input type="radio" name="inlineRadioOptions" id="inlineRadio2" value="option2"> Femme
				</label>
				<br><br>
				<div class="form-group orderlogin_label">
				<label for="exampleInputName2">Nom</label>
    			<input type="text" class="form-control" id="exampleInputName2" placeholder="votre nom">
			  </div>
			  <div class="form-group orderlogin_label">
				<label for="exampleInputName2">Prénom</label>
    			<input type="text" class="form-control" id="exampleInputName2" placeholder="votre prénom">
			  </div>
			  <div class="form-group orderlogin_label">
				<label for="exampleInputName2">Pseudo</label>
    			<input type="text" class="form-control" id="exampleInputName2" placeholder="votre pseudo">
			  </div>
			  <div class="form-group orderlogin_label has-success has-feedback">
			  <label class="control-label" for="inputSuccess2" style="color: #000;">Email</label>
			  <input type="text" class="form-control" id="inputSuccess2" aria-describedby="inputSuccess2Status" placeholder="email@mail.fr">
			  <span class="glyphicon glyphicon-ok form-control-feedback" aria-hidden="true"></span>
			  <span id="inputSuccess2Status" class="sr-only">(success)</span>
			</div>
			  <div class="form-group orderlogin_label has-error has-feedback">
			  <label class="control-label" for="inputError2" style="color: #000;">Mot de passe</label>
			  <p style="text-decoration:underline;text-align:center;"><a href="<?=$this->url('back_forgot_pwd')?>">Réinitialisation de mot de passe par mail</a></p>
			  <span id="inputError2Status" class="sr-only">(error)</span>
			</div>
			  <br>
			  <div class="form-group orderlogin_label">
				<label for="exampleInputName2">Adresse</label>
    			<input type="text" class="form-control" id="exampleInputName2" placeholder="votre addresse">
			  </div>
			  <div class="form-group orderlogin_label">
				<label for="exampleInputName2">Complément adresse</label>
    			<input type="text" class="form-control" id="exampleInputName2" placeholder="votre complément adresse">
			  </div>
			  <div class="form-group orderlogin_label">
				<label for="exampleInputName2">Code Postal</label>
    			<input type="text" class="form-control" id="exampleInputName2" placeholder="votre code Postal">
			  </div>
			  <div class="form-group orderlogin_label">
				<label for="exampleInputName2">Pays</label>
    			<select class="form-control">
				  <option selected disabled>--Selectionez--</option>
				  <option>France Métropolitaine</option>
				</select>
			  </div>
			  <div class="form-group orderlogin_label">
				<label for="exampleInputName2">Ville</label>
    			<input type="text" class="form-control" id="exampleInputName2" placeholder="votre ville">
			  </div>
			  <br>
				<button type="submit" class="btn btn-default adduser_button orderlogin_button1"><i class="fa fa-user" aria-hidden="true"><span class="orderlogin_button1text"> mettre à jour</span></i></button>
			</form>
			<br><br>
		</div>
	   </div>
	   
	  
   </div>
  </div>
  <div class="col-md-3">
  	<img class="img-responsive playmo_hide" src="<?=$this->assetUrl('/img/napoRight.png');?>" id="categorycustom" style="float:right;">
  </div>
 </div>
 
 
</div>


<?php $this->stop('main_content') ?>
