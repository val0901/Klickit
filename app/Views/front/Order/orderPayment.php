<?php $this->layout('layoutfront', ['title' => 'Choix du paiement']) ?>

<?php $this->start('main_content') ?>
<div class="container">
	<!--order progress steps bar-->
	<div class="row">
		<ul class="breadcrumb">
    		<li class="completed"><a id="breadcrumb" href="javascript:void(0);">Récapitulatif</a></li>
			<li class="completed"><a id="breadcrumb" href="javascript:void(0);">Connexion</a></li>
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
			<br><br>
			<form>
			  <div class="orderpaymentradio_margin">
			  <div class="radio">
				  <label>
					<input type="radio" name="optionsRadios" id="optionsRadios1" value="option1" class="orderpayment_checked1">
					  <div class="clear"></div>
					<li style="float: left;margin:0 20px;">
					  <img class="img-responsive" src="<?=$this->assetUrl('/img/paypal.png');?>" id="orderpaypal_hover">
					 </li>
					<li class="orderpayment_text" style="float:left;">Paypal</li>
				  </label>
			</div>	
			<br>
			<div class="radio">
				  <label>
					<input type="radio" name="optionsRadios" id="optionsRadios1" value="option1" class="orderpayment_checked2">
					  <div class="clear"></div>
					<li style="float: left;margin:0 20px;">
					  <img class="img-responsive" src="<?=$this->assetUrl('/img/paychq.png');?>" id="ordercheque_hover">
					 </li>
					<li class="orderpayment_text" style="float:left;">Chèque</li>
				  </label>
			</div>	
			<br>
			<div class="radio">
				  <label>
					<input type="radio" name="optionsRadios" id="optionsRadios1" value="option1" class="orderpayment_checked3">
					  <div class="clear"></div>
					<li style="float: left;margin:0 20px;">
					  <img class="img-responsive" src="<?=$this->assetUrl('/img/payvir.png');?>" id="ordervirement_hover">
					 </li>
					<li class="orderpayment_text" style="float:left;">Virement</li>
				  </label>
			</div>
		    </div>
			  <br>
				<div style="text-align:center;">
					<button type="submit" class="btn btn-default orderlogin_button2 orderpayment_button"><span class="orderpayment_buttontext"> PAYER</span></button>
				</div>
			</form>
			<br><br>
		</div>
		<div class="col-md-3">
		
		</div>
	</div>
    <!--End title et border-->
	
	<!--prix total-->
	<br><br>
	<div class="row">
		<div class="col-md-7">
			<div class="orderlist_total">
			<ul  style="float:right;">
				<li>
					<p>17.00 €</p>
					<p>2.60 €</p>
					<p><strong>19.60 €</strong></p>
				</li>
			</ul>
			<ul>
				<li>
					<p>Total articles :</p>
					<p>frais de port :</p>
					<p>TOTAL COMMANDE :</p>
				</li>
			</ul>
		</div>
		</div>
		<div class="col-md-3">
			
		</div>
		<div class="col-md-3">
		</div>
	</div>
	
	<!--End prix total-->
</div>
<br><br>
<?php $this->stop('main_content') ?>



