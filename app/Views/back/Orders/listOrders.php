<?php $this->layout('layoutback', ['title' => 'Liste des commandes']) ?>

<?php $this->start('main_content') ?>

	<div id="viewOrder">
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
			<?php foreach ($data as $value): ?>
				<tr>
					<td><?=$value['id']; ?></td>
					<td><?=$value['lastname'].' '.$value['firstname'].'<br>'.$value['adress'].'<br>'.$value['zipcode'].' '.$value['city']; ?></td>
					<td><?php ?>Gérer la liste des articles</td>
					<td><?= date('d/m/Y', strtotime($value['date_creation']));?></td>
					<td><?=$value['statut']; ?></td>
					<td>
						<div class="form-group" id="selectStt">
							<form>									
							  <div class="col-md-4">
							    <select id="selectStatut" name="selectStatut" class="form-control">
							      <option value="1">En attente de paiement</option>
							      <option value="2">En cours de préparation</option>
							      <option value="3">Expédiée</option>
							    </select>
							  </div>
							</form>
						</div></td>
					<td>
						<div> <a href=""><i class="fa fa-search-plus fa-2x" aria-hidden="true"></i></a></div>
					</td>
				</tr>
			<?php endforeach; ?>			
			</tbody>			
		</table>
		
	</div>



	
<?php $this->stop('main_content') ?>
