<?php $this->layout('layoutfront', ['title' => 'Address de livraison']) ?>

<?php $this->start('main_content') ?>
<div class="container">
	<!--order progress steps bar-->
	<div class="row">
		<ul class="breadcrumb">
    		<li class="completed"><a href="javascript:void(0);">Récapitulatif</a></li>
			<li class="completed"><a href="javascript:void(0);">Conexion</a></li>
			<li class="completed"><a href="javascript:void(0);">Adresse</a></li>
			<li><a href="javascript:void(0);">Paiement</a></li>
		</ul>
	</div>
	<!--End order progress steps bar-->
	<br><br>
    
    <!--Title et border-->
	<div class="row">
		<div class="col-md-3">
		
		</div>
		<div class="col-md-6 orderlogin_box">
			<h1>VOTRE ADDRESSE DE LIVRAISON</h1>
			<form>
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
			  <div class="form-group orderlogin_label">
				<label for="exampleInputName2">Nom</label>
    			<input type="text" class="form-control" id="exampleInputName2" placeholder="votre nom">
			  </div>
			  <div class="form-group orderlogin_label">
				<label for="exampleInputName2">Prénom</label>
    			<input type="text" class="form-control" id="exampleInputName2" placeholder="votre prénom">
			  </div>
			  <br>
				<button type="submit" class="btn btn-default adduser_button orderlogin_button1"><i class="fa fa-car" aria-hidden="true"><span class="orderlogin_button1text"> valider votre addresse</span></i></button>
			</form>
			<br><br>
		</div>
		<div class="col-md-3">
		
		</div>
	</div>
    <!--End title et border-->
</div>
<br><br>
<?php $this->stop('main_content') ?>


