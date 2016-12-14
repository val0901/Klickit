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
				<th>Action</th>
			</thead>

			<tbody>
						<?php foreach ($orders as $order): ?>
							<tr>
								<td><?=$order['id']; ?></td>
								<td><?=$order['lastname'].' '.$order['firstname']; ?></td>
								<td><?php ?>Gérer la liste des articles</td>
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

	<div id="lastMessage">
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
			<div id="voirplus">
				<a href="<?= $this->url('listMessage')?>" >Voir plus</a>
			</div>	
		</form>
		
	</div>
	
<?php $this->stop('main_content') ?>
