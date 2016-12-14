<?php $this->layout('layoutback', ['title' => 'Liste des messages reçus ']) ?>

<?php $this->start('main_content') ?>
	<?php if(empty($messages)):?>
		<p class="alert alert-danger">Aucun message trouvé</p>
	<?php else:?>
		<form>	
			<table class="table table-responsive">
				<thead>
					<th>Pseudonyme</th>
					<th>Adresse email</th>
					<th>Sujet</th>
					<th>Contenu</th>
					<th>Statut</th>
					<th colspan="2">Action</th>
				</thead>

				<tbody>
					<?php foreach($messages as $message) : ?>
						<?php 
							if ($message['statut'] == 'Non lu'){
								$bold = ' style="font-weight:bold;" ';
							}else{
								$bold = '';
							}
						?>
						<tr>
							<td <?=$bold?> ><?=$message['username'];?></td>
							<td <?=$bold?> ><?=$message['email'];?></td>
							<td <?=$bold?> ><?=$message['subject'];?></td> 
							<td <?=$bold?> ><?=$message['content'];?></td>
							<td <?=$bold?> ><?=$message['statut'];?></td>
							<td><a href="<?=$this->url('viewMessage', ['id'=>$message['id']]);?>">Voir le message</a></td>
							<td><button class="btn btn-danger delete-message" data-id="<?=$message['id']?>">Effacer le message</button></td>
						</tr>	
					<?php endforeach;?>
				</tbody>
			</table>
		</form>
	<?php endif;?>				
<?php $this->stop('main_content') ?>
