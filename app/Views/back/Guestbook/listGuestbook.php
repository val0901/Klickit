<?php $this->layout('layoutback', ['title' => 'Liste des messages du livre d\'or']) ?>

<?php $this->start('main_content') ?>
	<?php if(empty($messages)): ?>
		<p class="alert alert-danger">Aucun message trouvé</p>
	<?php else:?>
		<form>
			<table class="table table-responsive">
			<thead>
				<th>Prénom</th>
				<th>Nom</th>
				<th>Pseudonyme</th>
				<th>Message</th>				
				<th colspan="2">Action</th>
			</thead>

			<tbody>
				<?php foreach($messages as $message) : ?>
					<tr>
						<td><?=$message['firstname'];?></td>
						<td><?=$message['lastname'];?></td>
						<td><?=$message['username'];?></td>
						<td><?=substr($message['content'],0,20).'...';?></td>
						<td><a href="#">Voir le message</a></td>
						<td><button class="btn btn-danger delete-message" data-id="<?=$user['id']?>">Effacer le message</button></td>
					</tr>	
				<?php endforeach;?>
			</tbody>
		</table>
		</form>	
	<?php endif;?>		
<?php $this->stop('main_content') ?>

<?php $this->start('js')?>
<?php $this->stop('js')?>