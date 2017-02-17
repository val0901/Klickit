<?php $this->layout('layoutback', ['title' => 'Liste des commandes']) ?>

<?php $this->start('main_content') ?>


	<form method="post" class="form-inline">
		<div class="form-group">
			<input type="text" class="form-control" id="search" name="search" placeholder="Recherche ...">
		</div>
		<button type="submit" id="submit" class="btn btn-info search_order">Rechercher</button>
		<br><br>
		<div id="viewOrder">
			<table class="table table-responsive">
				<thead class="backgthead">
					<th>Numéro</th>
					<th>Client</th>
					<th>Contenu de la commande</th>
					<th>Quantité</th>
					<th>Sous-Total</th>
					<th>Total</th>
					<th>Date de la commande</th>
					<th colspan="2">Statut</th>
					<!-- <th id="thaction">Changer le statut</th> -->
				</thead>

				<tbody id="result" class="backgtbody">
					<?php if(!empty($orders)): ?>
						<?php foreach($orders as $order): ;?>
							<tr>
								<td><?=$order['id']; ?></td>
								<td><?=$order['lastname'].' '.$order['firstname'].'<br>'.$order['address'].'<br>'.$order['zipcode'].' '.$order['city'].'<br>'.$order['country']; ?></td>
								<td>
								<?php 
									$contents = explode(', ', $order['contenu']); 
									$quantity = explode(', ', $order['quantity']);

									for($i=0;$i<count($contents);$i++){
										$content_basket[$order['id']][] = [
											'content' 	=> $contents[$i],
											'quantity' 	=> $quantity[$i],
										];
									}

									foreach ($content_basket[$order['id']] as $basket){
										$list_items = $items->findItems($basket['content']); 

										echo '<a href="'.$this->url('updateItem', ['id'=>$list_items['id']]).'" style="color:white;">'.$list_items['name'].'</a> <br>';
									}
								?>
								</td>
								<td> 
		        				<?php 
		        					foreach ($content_basket[$order['id']] as $basket){
		        						echo $basket['quantity'].'<br>';
		        					} 
		        				?>
								</td>
								<td><?=$order['sub_total'];?></td>
								<td><?=$order['total'];?></td>
								
								<td><?= date('d/m/Y', strtotime($order['date_creation']));?></td>
								<td>
									<?php   if ($order['statut'] == 'enPreparation') : ?>
										 		<p>En préparation</p>
										 		<button type="button" data-id="<?=$order['id']?>" class="order_sent" style="color:black;">Commande expédiée</button>
									<?php	elseif ($order['statut'] == 'commande') : ?>
										  		<p>Commandé</p>
										  		<button type="button" data-id="<?=$order['id']?>" class="order_prepare" style="color:black;">Commande en préparation</button>
									<?php	elseif ($order['statut'] == 'expedie') : ?>
										  		<p>Expédiée</p>
									<?php   endif; ?>
								</td>						
								<td>
									<div> <a href="<?=$this->url('viewOrders', ['id'=>$order['id']]);?>"><i class="fa fa-search-plus fa-2x" aria-hidden="true"></i></a></div>
								</td>
							</tr>
						<?php endforeach; ?>
					<?php else: ?>
						<tr>
							<td colspan="9">Aucune information</td>
						</tr>
					<?php endif; ?>			
				</tbody>			
			</table>
		</div>
	</form>
			
	<?php $search = (isset($_GET['search']))? 'search='. $_GET['search'].'&' :'';?>
	<div id="pagination">
		<?= ($page!=1) ? '<a href="?'. $search .'page='. ($page - 1) .'"><i class="fa fa-arrow-left fa-fw"></i></a>':''; ?>
		Page <?= $page; ?> <?= ($nb>=1) ? '/ '.ceil($nb/$max) :''; ?>
		<?= ($nb < 1 ) ? '' : ($page!= ceil($nb/$max) ? '<a href="?'. $search .'page='. ($page + 1) .'"><i class="fa fa-arrow-right fa-fw" aria-hidden="true"></i></a>':''); ?>
	</div>
				
	



	
<?php $this->stop('main_content') ?>

<?php $this->start('js')?>
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
							$('body').load('<?=$this->url('listOrders');?>');
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
							$('body').load('<?=$this->url('listOrders');?>');
						}
					}
				});
			});
		});
	</script>

	<script>

		$(document).ready(function(){

			var id_order = $(this).data('id');
			var select = $('select').val();

			$('select').change(function(e){
				e.preventDefault();

				$.ajax({
					url: '<?=$this->url('ajax_updateStatus'); ?>',
					type: 'post',
					cache: false,
					data: {id: id_order, status: select},  // $_POST['id']
					dataType: 'json',
					success: function(out){
						if(out.code == 'ok'){
							$('body').load('<?=$this->url('listOrders');?>');	
						}
					}
				});
			});
		});

		// AJAX POUR LA RECHERCHE
		$('.search_order').click(function(e){
			e.preventDefault();

			$.ajax({
				url: '<?=$this->url('ajax_searchOrder');?>',
				type: 'get',
				cache: false,
				data:  $('#search'),
				dataType: 'json',
				success: function(search){
					$('#result').html(search.msg);

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
								        buttons: function(){
								        	$('body').load('<?=$this->url('listOrders');?>');
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
									        	$('body').load('<?=$this->url('listOrders');?>');
									        }
									    }
								    });
								}
							}
						});
					});
				}
			});
		});
	</script>
<?php $this->stop('js')?>
