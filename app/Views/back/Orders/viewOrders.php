<?php $this->layout('layoutback', ['title' => 'Vue d\'une commande']) ?>

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
					<th id="thaction" colspan="2">Action</th>
				</thead>

				<tbody>
				<?php foreach ($orders as $value): ;?>
					<tr>
						<td><?=$value['id']; ?></td>
						<td><?=$value['lastname'].' '.$value['firstname'].'<br>'.$value['adress'].'<br>'.$value['zipcode'].' '.$value['city']; ?></td>
						<td><?php ?>Gérer la liste des articles</td>
						<td><?= date('d/m/Y', strtotime($value['date_creation']));?></td>
						<td><?=$value['statut']; ?></td>
						<td>
							<div class="form-group" id="selectStt">									
								  <div class="col-md-4">
								    <select id="selectStatut" name="selectStatut" class="form-control">
								    	<option value="Changer le statut" selected disabled>Changer le statut</option>
								    	<option value="commandé">En attente de paiement</option>
								    	<option value="en préparation">En cours de préparation</option>
								    	<option value="expédié">Expédiée</option>
								    </select>
								  </div>
								  <input type="submit" style="display:none;" data-id="<?=$value['id']?>">
							</div></td>
						<td><button class="btn btn-danger delete-item" data-id="<?=$value['id']?>">Effacer la commande</button>
	
						</td>
					</tr>
				<?php endforeach; ?>			
				</tbody>			
			</table>
	
<?php $this->stop('main_content') ?>
