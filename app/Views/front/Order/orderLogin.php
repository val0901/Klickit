<?php $this->layout('layoutfront', ['title' => 'Panier de commande']) ?>

<?php $this->start('main_content') ?>
<div class="container">
	<!--order progress steps bar-->
	<div class="row">
		<ul class="breadcrumb">
    		<li class="completed"><a href="javascript:void(0);">Récapitulatif</a></li>
			<li class="completed"><a href="javascript:void(0);">Conexion</a></li>
			<li><a href="javascript:void(0);">Adresse</a></li>
			<li><a href="javascript:void(0);">Paiement</a></li>
		</ul>
	</div>
	<!--End order progress steps bar-->
	<br><br>
    
    <!--Title et border-->
	<div class="row">
		<div class="col-md-6 orderlogin_box">
			<h1>créez votre compte</h1>
			<p class="orderlogin_info">Saississez votre adresse e-mail pour créer votre compte.</p>
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
			  <input type="text" class="form-control" id="inputError2" aria-describedby="inputError2Status">
			  <span class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true"></span>
			  <span id="inputError2Status" class="sr-only">(error)</span>
			</div>
			  <br>
				<button type="submit" class="btn btn-default adduser_button orderlogin_button1"><i class="fa fa-user" aria-hidden="true"><span class="orderlogin_button1text"> créez votre compte</span></i></button>
			</form>
			<br><br>
		</div>
		<div class="col-md-6 orderlogin_box">
			<h1>déjà inscrit ?</h1>
			<form>
				<div class="form-group orderlogin_label">
				  <label class="control-label" for="inputSuccess2" style="color: #000;">Email</label>
				  <input type="text" class="form-control" id="inputSuccess2" aria-describedby="inputSuccess2Status" placeholder="email@mail.fr">
				</div>
				  <div class="form-group orderlogin_label">
				  <label class="control-label" for="inputError2" style="color: #000;">Mot de passe</label>
				  <input type="text" class="form-control" id="inputError2" aria-describedby="inputError2Status">
				</div>
				<p class="orderlogin_MDPoublie">Mot de passe oublié ?</p>
				<br>
				<button type="submit" class="btn btn-default orderlogin_button orderlogin_button2"><i class="fa fa-lock" aria-hidden="true"><span class="orderlogin_button2text"> connexion</span></i></button>
			</form>
			<br><br>
		</div>
	</div>
    <!--End title et border-->
</div>
<br><br>
<?php $this->stop('main_content') ?>

