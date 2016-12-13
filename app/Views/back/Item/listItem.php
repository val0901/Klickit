<?php $this->layout('layoutback', ['title' => 'Liste des articles ']) ?>

<?php $this->start('main_content') ?>
	<?php if(empty($items)): ?>
		<p class="alert alert-danger">Aucun article trouvé</p>
	<?php else: ?>
		<table class="table table-responsive">
			<thead>
				<th>N°</th>
				<th>Nom</th>
				<th>Quantité</th>
				<th>Prix</th>
				<th>statut</th>
				<th colspan="2">Action</th>
			</thead>

			<tbody>
				<?php foreach($items as $item) : ?>
					<tr>
						<td><?=$item['social_title'];?></td>
						<td><?=$item['lastname'];?></td>
						<td><?=$item['firstname'];?></td>
						<td><?=$item['itemname'];?></td>
						<td><?=$item['email'];?></td>
						<td><a href="#">Voir le profil</a></td> <!-- Mettre lien pour voir le profil sur le front -->
						<td><a href="<?=$this->url('updateitem', ['id'=>$item['id']]);?>">Mettre à jour le profil</a></td>
						<td><button class="btn btn-danger">Effacer le profil</button></td>
					</tr>	
				<?php endforeach;?>
			</tbody>
		</table>
	<?php endif; ?>
<?php $this->stop('main_content') ?>
