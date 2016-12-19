<?php $this->layout('layoutback', ['title' => 'Page d\'accueil']) ?>

<?php $this->start('main_content') ?>

	<!--Derniers messages  -->	
	<h3>Vos dernières commandes</h3>
	<div id="lastorder">
		
		<table class="table">
			<thead>
				<th>Numéro</th>
				<th>Client</th>
				<th>Contenu de la commande</th>
				<th>Date de la commande</th>
				<th>Statut</th>
				<th>Action</th>
			</thead>

			<tbody>
				<?php foreach ($orders as $order): ?>
					<tr>
						<td><?=$order['id']; ?></td>
						<td><?=$order['lastname'].' '.$order['firstname']; ?></td>
						<td>
							<?php $contents = explode(', ', $order['contenu']); ?>

							<?php 
								foreach ($contents as $value) : ?>
									<?php 
										$list_items = $items->findItems($value); 

										echo '<a href="'.$this->url('updateItem', ['id'=>$list_items['id']]).'" style="color:white;">'.$list_items['name'].'</a> <br>';
									?>
							<?php endforeach; ?>
            			</td>
						<td><?= date('d/m/Y', strtotime($order['date_creation']));?></td>
						<td><?=$order['statut']; ?></td>
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

	<!--Dernières Commandes  -->
	<h3>Vos derniers messages</h3>
	<div id="lastMessage">
		<form>	
			<table class="table table-responsive">
				<thead>
					<th>Pseudonyme</th>
					<th>Adresse email</th>
					<th>Date</th>
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
							<td><?= date('d/m/Y', strtotime($order['date_creation']));?></td>
							<td <?=$bold?> ><?=$message['subject'];?></td> 
							<td <?=$bold?> ><?=$message['content'];?></td>
							<td <?=$bold?> ><?=$message['statut'];?></td>
							<td><a href="<?=$this->url('viewMessage', ['id'=>$message['id']]);?>"><i class="fa fa-search-plus fa-2x" aria-hidden="true"></a></td>
						</tr>	
					<?php endforeach;?>
				</tbody>
			</table>
			<div id="voirplus">
				<a href="<?= $this->url('listMessage')?>" >Voir plus</a>
			</div>
		</form>
	</div>	

	<!-- derniers messages guestbook -->
	<h3>Vos derniers commentaires du livre d'or</h3>
	<div id="lastGuestbook">
		<form>
			<table class="table table-responsive">
				<thead>
					<th>Prénom</th>
					<th>Nom</th>
					<th>Pseudonyme</th>
					<th>Commentaire</th>
					<th>Publié</th>				
					<th colspan="2">Action</th>
				</thead>

				<tbody>
					<?php foreach($comments as $comment) : ?>
						<tr>
							<td><?=$comment['firstname'];?></td>
							<td><?=$comment['lastname'];?></td>
							<td><?=$comment['username'];?></td>
							<td><?=substr($comment['content'],0,20).'...';?></td>
							<td><?=ucfirst($comment['published'])?></td>
							<td><a href="<?=$this->url('moderation', ['id'=>$comment['id']])?>"><i class="fa fa-search-plus fa-2x" aria-hidden="true"></a></td>
						</tr>	
					<?php endforeach;?>
				</tbody>
			</table>
		</form>	
		<div id="voirplus">
				<a href="<?= $this->url('listGuestbook')?>" >Voir plus</a>
		</div>

	</div>
	
	
	
<?php $this->stop('main_content') ?>
