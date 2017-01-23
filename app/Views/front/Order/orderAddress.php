<?php $this->layout('layoutfront', ['title' => 'Adresse de livraison']) ?>

<?php $this->start('main_content') ?>
<div class="container">
	<!--order progress steps bar-->
	<div class="row">
		<ul class="breadcrumb">
    		<li class="completed"><a id="breadcrumb" href="<?=$this->url('front_orderList');?>">Récapitulatif</a></li>
			<!-- <li class="completed"><a id="breadcrumb" href="javascript:void(0);">Connexion</a></li> -->
			<li class="completed"><a id="breadcrumb" href="javascript:void(0);">Adresse</a></li>
			<li><a id="breadcrumb" href="javascript:void(0);">Paiement</a></li>
		</ul>
	</div>
	<!--End order progress steps bar-->
	<br><br>
    
    <!--Title et border-->
	<div class="row">
		<div class="col-md-3">
		
		</div>
		<div class="col-md-6 orderlogin_box">
			<h1>VOTRE ADRESSE DE LIVRAISON</h1>
			<form>
				<div class="form-group orderlogin_label">
				<label for="exampleInputName2">Adresse</label>
    			<input type="text" class="form-control" name="address" id="address" value="<?=$order['address'];?>">
			  </div>
			  <div class="form-group orderlogin_label">
				<label for="exampleInputName2">Complément adresse</label>
    			<input type="text" class="form-control" name="address_complement" id="address_complement">
			  </div>
			  <div class="form-group orderlogin_label">
				<label for="exampleInputName2">Code Postal</label>
    			<input type="text" class="form-control" name="zipcode" id="zipcode" value="<?=$order['zipcode'];?>">
			  </div>
			  <div class="form-group orderlogin_label">
				<label for="exampleInputName2">Pays</label>
    			<input type="text" class="form-control" name="country" id="country" value="<?=$order['country'];?>">
			  </div>
			  <div class="form-group orderlogin_label">
				<label for="exampleInputName2">Ville</label>
    			<input type="text" class="form-control" name="city" id="city" value="<?=$order['city'];?>">
			  </div>
			  <br>
				<button type="submit" class="btn btn-default adduser_button orderlogin_button1"><i class="fa fa-car" aria-hidden="true"><span class="orderlogin_button1text address_valid"> valider votre adresse</span></i></button>
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

<?php $this->start('js') ?>
<script>
	$(document).ready(function(){
		$('.address_valid').click(function(e){
			e.preventDefault();
		});
	});
</script>
<?php $this->stop('js') ?>