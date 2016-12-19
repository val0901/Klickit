<?php $this->layout('layoutback', ['title' => 'Liste des commandes']) ?>

<?php $this->start('main_content') ?>

	<div id="viewOrder">
		<form method="post">
			<table class="table table-responsive">
				<thead>
					<th>Numéro</th>
					<th>Client</th>
					<th>Contenu de la commande</th>
					<th>Date de la commande</th>
					<th>Statut</th>
					<!-- <th id="thaction">Changer le statut</th> -->
				</thead>

				<tbody>
				<?php foreach ($orders as $order): ;?>
					<tr>
						<td><?=$order['id']; ?></td>
						<td><?=$order['lastname'].' '.$order['firstname'].'<br>'.$order['adress'].'<br>'.$order['zipcode'].' '.$order['city']; ?></td>
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
						<!-- <td>
							<div class="form-group" id="selectStt">									
								  <div class="col-md-4">
								    <select id="selectStatut" name="selectStatut" class="form-control">
								    	<option value="Changer le statut" selected disabled>Changer le statut</option>
								    	<option value="commande">En attente de paiement</option>
								    	<option value="enPreparation">En cours de préparation</option>
								    	<option value="expedie">Expédiée</option>
								    </select>
								  </div>
								  <input type="submit" style="display:none;" data-id="<?//=$value['id']?>">
								
							</div></td> -->
						<td>
							<div> <a href="<?=$this->url('viewOrders', ['id'=>$order['id']]);?>"><i class="fa fa-search-plus fa-2x" aria-hidden="true"></i></a></div>
						</td>
					</tr>
				<?php endforeach; ?>			
				</tbody>			
			</table>
		</form>
			<?php $search = (isset($_GET['search']))? 'search='. $_GET['search'].'&' :'';?>
			<div>
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
	</script>
<?php $this->stop('js')?>
