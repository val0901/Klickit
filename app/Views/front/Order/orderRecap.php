<?php $this->layout('layoutfront', ['title' => 'Commande']) ?>

<?php $this->start('main_content') ?>
<div class="container">
	<!--order progress steps bar-->
	<div class="row">
		<ul class="breadcrumb">
    		<li class="completed"><a href="javascript:void(0);">Récapitulatif</a></li>
			<li><a href="javascript:void(0);">Conexion</a></li>
			<li><a href="javascript:void(0);">Adresse</a></li>
			<li><a href="javascript:void(0);">Livraison</a></li>
			<li><a href="javascript:void(0);">Paiement</a></li>
		</ul>
	</div>
	<!--End order progress steps bar-->
	<br><br>
	<table class="table">
		<thead> 
			<tr> 
				<th>Product</th> 
				<th>Description</th> 
				<th>Prix unitaire</th> 
				<th>Quantité</th>
				<th>Total</th>
				<th></th>
			</tr> 
		</thead> 
		<tbody> 
			<tr> 
				<td scope="row"><img class="img-responsive" src="<?=$this->assetUrl('/img/orderimg_example.png');?>" style="width: 15vw;"></td> 
				<td>
					<li class="ordertable_title">Princess Playmo<li>
					<li class="ordertable_text">Référence: 0001<li>
				</td> 
				<td><p class="ordertable_title">5 €<p></td>  
				<td><p class="ordertable_title">Mark<p></td> 
				<td><p class="ordertable_title">5 €<p></td>
				<td><p class="ordertable_title">Mark<p></td>
			</tr>
			<tr> 
				<td scope="row">1</td> 
				<td>Mark</td> 
				<td>Otto</td> 
				<td>@mdo</td>
				<td>@mdo</td> 
			</tr>
		</tbody> 
	</table>
</div>

<?php $this->stop('main_content') ?>
