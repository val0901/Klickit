<?php $this->layout('layoutback', ['title' => 'Page d\'accueil']) ?>

<?php $this->start('main_content') ?>

	<div id="lastorder">
		<table class="table">
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
								<td><?=$value['lastname'].' '.$value['firstname']; ?></td>
								<td><?php ?>Gérer la liste des articles</td>
								<td><?= date('d/m/Y', strtotime($value['date_creation']));?></td>
								<td><?=$value['statut']; ?></td>
								<td>
									<div> <a href="<?=$this->url('viewOrders')?>"><i class="fa fa-search-plus fa-2x" aria-hidden="true"></i></a></div>
								</td>
							</tr>
						<?php endforeach; ?>			
						</tbody>			
					</table>
					<div id="voirplus">
					<a href="<?= $this->url('listOrders')?>" >Voir plus</a>
					</div>	
	</div>
	
<?php $this->stop('main_content') ?>
