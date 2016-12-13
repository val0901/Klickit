<?php $this->layout('layoutback', ['title' => 'Page d\'accueil']) ?>

<?php $this->start('main_content') ?>

	<div id="lastorder">
		<table class="table ">
			<thead>
				<th>Numéro</th>
				<th>Client</th>
				<th>Contenu de la commande</th>
				<th>Date de la commande</th>
				<th>Statut</th>
				<th>Action</th>
			</thead>

			<tbody>
			<?php foreach ($data as $value): ?>
				<td><?=$value['id']; ?></td>
				<td><?=$value['firstname'].' '.$value['lastname']; ?></td>
				<td><?php ?>Gérer la liste des articles</td>
				<td><?= date('d/m/Y', strtotime($value['date_creation']));?></td>
				<td><?=$value['statut']; ?></td>
				<td>
					<form>
						<div class="form-group">
						  <label class="col-md-4 control-label" for="selectStatut">Changer le statut</label>
						  <div class="col-md-4">
						    <select id="selectStatut" name="selectStatut" class="form-control">
						      <option value="1">En attente de paiement</option>
						      <option value="2">En cours de préparation</option>
						      <option value="3">Expédiée</option>
						    </select>
						  </div>
						</div>
					</form></td>
			<?php endforeach; ?>			
			</tbody>			
		</table>
		<div id="voirplus">
		<a href="<?= $this->url('listOrders')?>" >Voir plus</a>
		</div>	
	</div>


	
<?php $this->stop('main_content') ?>
