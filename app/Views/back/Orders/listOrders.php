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
				<thead>
					<th>Numéro</th>
					<th>Client</th>
					<th>Contenu de la commande</th>
					<th>Quantité</th>
					<th>Sous-Total</th>
					<th>Total</th>
					<th>Date de la commande</th>
					<th>Statut</th>
					<!-- <th id="thaction">Changer le statut</th> -->
				</thead>

				<tbody id="result">
				<?php foreach($orders as $order): ;?>
					<tr>
						<td><?=$order['id']; ?></td>
						<td><?=$order['lastname'].' '.$order['firstname'].'<br>'.$order['adress'].'<br>'.$order['zipcode'].' '.$order['city']; ?></td>
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
						<?php if ($order['statut'] == 'enPreparation') :
							 		echo 'En préparation';
							  elseif ($order['statut'] == 'commande') :
							  		echo 'Commandé';
							  elseif ($order['statut'] == 'expedie') :
							  		echo 'Expédiée';
							 endif; ?>
						</td>						
						<td>
							<div> <a href="<?=$this->url('viewOrders', ['id'=>$order['id']]);?>"><i class="fa fa-search-plus fa-2x" aria-hidden="true"></i></a></div>
						</td>
					</tr>
				<?php endforeach; ?>			
				</tbody>			
			</table>
		</div>
	</form>
			<div>
				<?php $search = (isset($_GET['search']))? 'search='. $_GET['search'].'&' :'';?>
			
				<?= ($page!=1) ? '<a href="?'. $search .'page='. ($page - 1) .'"><i class="fa fa-arrow-left" aria-hidden="true"></i></a>':''; ?>
				Page <?= $page; ?> / <?= ceil($nb/$max); ?>
				<?= $page!= ceil($nb/$max) ? '<a href="?'. $search .'page='. ($page + 1) .'"><i class="fa fa-arrow-right" aria-hidden="true"></i></a>':''; ?>

			</div>		
	</div>



	
<?php $this->stop('main_content') ?>

<?php $this->start('js')?>
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
							window.location.href=window.location.href;	
						}else if(out.code =='no'){

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
				}
			});
		});
	</script>
<?php $this->stop('js')?>
