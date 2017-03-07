<?php $this->layout('layoutback', ['title' => 'Vue d\'une commande']) ?>

<?php $this->start('main_content') ?>
<a href="<?=$this->url('listOrders');?>"><button class="btn btn-info">Retour liste des commandes</button></a>

<form>
	<div id="viewOrder">
			<table class="table vieworder table-responsive">
				<thead class="backgthead">
					<th class="optimphone">Numéro</th>
					<th class="optimphone">Client</th>
					<th class="optimphone">Adresse</th>
					<th>Contenu de la commande</th>
					<th>Quantité</th>
					<th class="optimphone">Sous-Total</th>
					<th class="optimphone">Frais de port</th>
					<th>Total</th>
					<th class="optimphone">Date de la commande</th>
					<th>Statut</th>
					<th>Type de paiement</th>
					<th class="optimphone" id="thaction">Action</th>
				</thead>

				<tbody class="backgtbody">
				<?php foreach ($orders as $order): ;?>
					<tr>
						<td class="optimphone"><?=$id_order; ?></td>
						<td class="optimphone"><?=$order['lastname'].' '.$order['firstname'].'<br>'; ?></td>
						<td class="optimphone"><?= $order['adress'].'<br>'.$order['zipcode'].' '.$order['city'] ?></td>
						<td>
							<?php $contents = explode(', ', $order['contenu']); ?>
							<?php 
								foreach ($contents as $value) : ?>
									<?php 
										$list_items = $items->findItems($value); 

										echo '<a href="'.$this->url('updateItem', ['id'=>$list_items['id']]).'" style="color:white;">'.$list_items['name'].'</a> <br>';
									?>
							<?php endforeach; ?>
						</td>
						<td>
							<?php $quantity = explode(', ', $order['quantity']);?>
							<?php foreach ($quantity as $quanti) :?>
								<p><?=$quanti;?></p><br>
							<?php endforeach; ?>
						</td>
						<td class="optimphone"><?=$order['sub_total'];?></td>
						<td class="optimphone"><?=$order['shipping'];?></td>
						<td><?=$order['total'];?></td>
						<td class="optimphone"><?= date('d/m/Y', strtotime($order['date_creation']));?></td>
						<td>
							<div class="form-group" id="selectStt">									
								<?php   if ($order['statut'] == 'enPreparation') : ?>
							 		<p>En préparation</p>
							 		<button type="button" data-id="<?=$id_order?>" class="order_sent" style="color:black;">Commande expédiée</button>
								<?php	elseif ($order['statut'] == 'commande') : ?>
							  		<p>Commandé</p>
							  		<button type="button" data-id="<?=$id_order?>" class="order_prepare" style="color:black;">Commande en préparation</button>
								<?php	elseif ($order['statut'] == 'expedie') : ?>
							  		<p>Expédiée</p>
								<?php   endif; ?>

							</div>
						</td>
						<td><?=$order['payment'];?></td>
						<td class="optimphone"><button class="btn btn-danger delete-order" data-id="<?=$id_order?>">Effacer</button></td>
					</tr>
				<?php endforeach; ?>			
				</tbody>			
			</table>
	</div>
	
</form>
	
<?php $this->stop('main_content') ?>

<?php $this->start('js')?>
	<script>
		$(document).ready(function(){
			
			$('.delete-order').click(function(e){
				e.preventDefault();

				var idOrder = $(this).data('id');

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

		var affichage = document.getElementById('viewOrder');

		if (document.getElementById('reload')) {
			affichage.location.href=affichage.location.href;
		}
	</script>

	<script>
		$(document).ready(function(){
			// Code pour passer le statut d'une commande de commandé à En préparation
			$('.order_prepare').click(function(e){
				e.preventDefault();

				var id_statut = $(this).data('id');
				var statut_proccess = 'enPreparation';

				$.ajax({
					url: '<?=$this->url('ajax_orderUpdateStatut');?>',
					type: 'post',
					cache: false,
					data: {id: id_statut, statut: statut_proccess},
					dataType: 'json',
					success: function(order){
						if(order.code == 'ok'){
							$.alert({
						        title: 'Email Envoyé',
						        content: 'Le client a été averti du changement de statut de sa commande',
						        theme: 'dark',
						        buttons: {
						        	Ok: function(){
							        	window.location.href="<?=$this->url('listOrders');?>";
							        }
							    }
						    });
						}
					}
				});
			});

			// Code pour passer le statut d'une commande de En préparation à Expédiée
			$('.order_sent').click(function(e){
				e.preventDefault();

				var id_statut2 = $(this).data('id');
				var statut_proccess2 = 'expedie';

				$.ajax({
					url: '<?=$this->url('ajax_orderUpdateStatut');?>',
					type: 'post',
					cache: false,
					data: {id: id_statut2, statut: statut_proccess2},
					dataType: 'json',
					success: function(order){
						if(order.code == 'ok'){
						    $.alert({
						        title: 'Email Envoyé',
						        content: 'Le client a été averti du changement de statut de sa commande',
						        theme: 'dark',
						        buttons: {
						        	Ok: function(){
							        	window.location.href="<?=$this->url('listOrders');?>";
							        }
							    }
						    });
							
						}
					}
				});
			});
		});
	</script>
<?php $this->stop('js')?>