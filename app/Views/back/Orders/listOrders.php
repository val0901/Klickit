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
					<th id="thaction">Changer le statut</th>
				</thead>

				<tbody>
				<?php foreach ($data as $value): ;?>
					<tr>
						<td><?=$value['id']; ?></td>
						<td><?=$value['lastname'].' '.$value['firstname'].'<br>'.$value['adress'].'<br>'.$value['zipcode'].' '.$value['city']; ?></td>
						<td><?php ?>Gérer la liste des articles</td>
						<td><?= date('d/m/Y', strtotime($value['date_creation']));?></td>
						<td><?=$value['statut']; ?></td>
						<td>
							<div class="form-group" id="selectStt">									<!-- <form method="post"> -->
								  <div class="col-md-4">
								    <select id="selectStatut" name="selectStatut" class="form-control">
								    	<option value="Changer le statut" selected disabled>Changer le statut</option>
								    	<option value="commandé">En attente de paiement</option>
								    	<option value="en préparation">En cours de préparation</option>
								    	<option value="expédié">Expédiée</option>
								    </select>
								  </div>
								  <input type="submit" style="display:none;" data-id="<?=$value['id']?>">
								<!-- </form> -->
							</div></td>
						<td>
							<div> <a href="<?=$this->url('viewOrders', ['id'=>$value['id']]);?>"><i class="fa fa-search-plus fa-2x" aria-hidden="true"></i></a></div>
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
