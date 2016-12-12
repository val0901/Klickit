<?php $this->layout('layoutback', ['title' => 'Liste des clients']) ?>

<?php $this->start('main_content') ?>

<?php if(empty($users)): ?>
	<p class="alert alert-danger">Aucun utilisateur trouvé</p>

<?php else:?>
	<table class="table table-responsive">
		<thead>
			<th>Civilité</th>
			<th>Nom</th>
			<th>Prénom</th>
			<th>Pseudonyme</th>
			<th>Adresse email</th>
			<th>Commandes</th>
			<th colspan="2">Action</th>
		</thead>

		<tbody>
			<?php foreach($users as $user) : ?>
				<tr>
					<td><?=$user['social_title'];?></td>
					<td><?=$user['lastname'];?></td>
					<td><?=$user['firstname'];?></td>
					<td><?=$user['username'];?></td>
					<td><?=$user['email'];?></td>
					<td>Commande ici (avec une super jointure)</td>
					<td><a href="#">Voir le profil</a></td> <!-- Mettre lien pour voir le profil sur le front -->
					<td><a href="<?=$this->url('updateUser', ['id'=>$user['id']]);?>">Mettre à jour le profil</a></td>
					<td><a href="<?=$this->url('deleteUser', ['id'=>$user['id']]);?>">Effacer le profil</a></td>
				</tr>	
			<?php endforeach;?>
		</tbody>
	</table>
<?php endif;?>	

<?php $this->stop('main_content') ?>
