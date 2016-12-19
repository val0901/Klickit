<?php $this->layout('layoutback', ['title' => 'Vue d\'une commande']) ?>

<?php $this->start('main_content') ?>
<a href="<?=$this->url('listOrders');?>"><button class="btn btn-info">Retour liste des commandes</button></a>

<div id="viewOrder">
	<form method="post">
		<table class="table">
			<thead>
				<th>Numéro</th>
				<th>Client</th>
				<th>Adresse</th>
				<th>Contenu de la commande</th>
				<th>Date de la commande</th>
				<th>Statut</th>
				<th id="thaction" colspan="2">Action</th>
			</thead>

			<tbody>
			<?php foreach ($orders as $order): ;?>
				<tr>
					<td><?=$order['id']; ?></td>
					<td><?=$order['lastname'].' '.$order['firstname'].'<br>'; ?></td>
					<td><?= $order['adress'].'<br>'.$order['zipcode'].' '.$order['city'] ?></td>
					<td><?php $contents = explode(', ', $order['contenu']); ?>

						<?php 
							foreach ($contents as $value) : ?>
								<?php 
									$list_items = $items->findItems($value); 

									echo '<a href="'.$this->url('updateItem', ['id'=>$list_items['id']]).'" style="color:white;">'.$list_items['name'].'</a> <br>';
								?>
						<?php endforeach; ?></td>
					<td><?= date('d/m/Y', strtotime($order['date_creation']));?></td>
					<td><?=$order['statut']; ?></td>
					<td>
						<div class="form-group" id="selectStt">									
							  <div class="col-md-4">
							    <select id="selectStatut" name="selectStatut" class="form-control">
							    	<option value="Changer le statut" selected disabled>Changer le statut</option>
							    	<option value="commande">En attente de paiement</option>
							    	<option value="enPreparation">En cours de préparation</option>
							    	<option value="expedie">Expédiée</option>
							    </select>
							  </div>
							  <input type="submit" style="display:none;" data-id="<?=$order['id']?>">
						</div></td>
					<td><button class="btn btn-danger delete-order" data-id="<?=$order['id']?>">Effacer la commande</button>

					</td>
				</tr>
			<?php endforeach; ?>			
			</tbody>			
		</table>
	</form>
</div>
	
<?php $this->stop('main_content') ?>

<?php $this->start('js')?>
	<script>
		$(document).ready(function(){
			
			$('.delete-order').click(function(e){
				e.preventDefault();


				$.confirm({

					title: 'Supprimer cette commande',

					content: "Êtes-vous sûr de vouloir supprimer cette commande ?",

					type: 'red',

					theme: 'dark',

					buttons: {
						ok: {
							text: 'Effacer la commande',
							btnClass: 'btn-danger',
							keys: ['enter'],
							action: function(){
				  				$.ajax({
				  					url: '<?=$this->url('ajax_deleteOrder'); ?>',
									type: 'post',
									cache: false,
									data: {id_order: idOrder},
									dataType: 'json',
									success: function(out){
										if(out.code == 'ok'){
							  				window.location.href="<?=$this->url('listOrders');?>";	
										}
									}
				  				});
				  				
			  				}
						},
						cancel: function(button) {
						   
						}
					}
				});

			});
		});
	</script>
<?php $this->stop('js')?>