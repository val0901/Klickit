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
						<div class="form-group" id="selectStt">									
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
	</form>
			<?php $search = (isset($_GET['search']))? 'search='. $_GET['search'].'&' :'';?>
			<div>Page <?= $page; ?> / <?= ceil($nb/$max); ?>
				<?= ($page!=1) ? '<a href="?'. $search .'page='. ($page - 1) .'">Page précédente</a>':''; ?>
				<?= $page!= ceil($nb/$max) ? '<a href="?'. $search .'page='. ($page + 1) .'">Page suivante</a>':''; ?>

			</div>

		<!-- <ul class="pagination">
		    <li>
		      <a href="#" aria-label="Previous">
		        <span aria-hidden="true">&laquo;</span>
		      </a>
		    </li>
		    <li><a href="#">1</a></li>
		    <li><a href="#">2</a></li>
		    <li><a href="#">3</a></li>
		    <li><a href="#">4</a></li>
		    <li><a href="#">5</a></li>
		    <li>
		      <a href="#" aria-label="Next">
		        <span aria-hidden="true">&raquo;</span>
		      </a>
		    </li>
		  </ul> -->
		
	</div>



	
<?php $this->stop('main_content') ?>
