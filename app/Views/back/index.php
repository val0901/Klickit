<?php $this->layout('layoutback', ['title' => 'Page d\'accueil']) ?>

<?php $this->start('main_content') ?>
	
	<h4>Chiffre d'affaire</h4>
	<div>
		<table class="table">
			<thead class="backgthead">
				<th>Mois</th>
				<th>Année</th>
				<th>Revenue</th>
			</thead>
			<tbody class="backgtbody">
				<?php if(!empty($sales)): ?>
					<?php foreach ($sales as $salesValue): ?>
						<tr>
							<td>
								<?php if($salesValue['month'] == '1'):?>
									Janvier
								<?php elseif($salesValue['month'] == '2'):?>
									Février
								<?php elseif($salesValue['month'] == '3'):?>
									Mars
								<?php elseif($salesValue['month'] == '4'):?>
									Avril
								<?php elseif($salesValue['month'] == '5'):?>
									Mai
								<?php elseif($salesValue['month'] == '6'):?>
									Juin
								<?php elseif($salesValue['month'] == '7'):?>
									Juillet
								<?php elseif($salesValue['month'] == '8'):?>
									Août
								<?php elseif($salesValue['month'] == '9'):?>
									Septembre
								<?php elseif($salesValue['month'] == '10'):?>
									Octobre
								<?php elseif($salesValue['month'] == '11'):?>
									Novembre
								<?php elseif($salesValue['month'] == '12'):?>
									Décembre
								<?php endif; ?>
							</td>
							<td><?=$salesValue['year'];?></td>
							<td><?=$salesValue['revenue'];?>€</td>
						</tr>
					<?php endforeach ?>
				<?php else: ?>
					<tr>
						<td colspan="3">Aucune information</td>
					</tr>
				<?php endif; ?>
			</tbody>
			<tfoot id="voirplus">
			    <tr>
			        <td colspan="9">
			            <a href="<?= $this->url('listSales')?>" >Voir plus</a>
			        </td>
			    </tr>
			</tfoot>
		</table>
	</div>
	<!--Derniers messages  -->	
	<h3>Vos dernières commandes</h3>
	<div id="lastorder">
		
		<table class="table">
			<thead class="backgthead">
				<th>Numéro</th>
				<th>Client</th>
				<th>Contenu de la commande</th>
				<th>Quantité</th>
				<th>Sous-Total</th>
				<th>Total</th>
				<th>Date de la commande</th>
				<th>Statut</th>
				<th>Action</th>
			</thead>

			<tbody class="backgtbody">
				<?php if(!empty($orders)): ?>
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
	            			<td>
	            				<?php $quantity = explode(', ', $order['quantity']); ?>
	            				<?php foreach ($quantity as $value):?>
	            					<?php
	            						echo $value.'<br>';
	            					?>
	            				<?php endforeach;?>	
	            			</td>
	            			<td><?=$order['sub_total'];?></td>
	            			<td><?=$order['total'];?></td>
							<td><?= date('d/m/Y', strtotime($order['date_creation']));?></td>
							<td>
							<?php if ($order['statut'] == 'enPreparation') :
								 		echo 'En préparation';
								  elseif ($order['statut'] == 'commande') :
								  		echo 'Commandé';
								  elseif ($order['statut'] == 'expedie') :
								  		echo 'Expédiée';
								 endif; ?>
							</td>						
							<td>
								<div> <a href="<?=$this->url('viewOrders', ['id'=>$order['id']]);?>"><i class="fa fa-search-plus fa-2x" aria-hidden="true"></i></a></div>
							</td>
						</tr>
					<?php endforeach; ?>
				<?php else: ?>
					<tr>
						<td colspan="9">Aucune information</td>
					</tr>
				<?php endif; ?>			
			</tbody>			
            <tfoot id="voirplus">
                <tr>
                    <td colspan="9">
                        <a href="<?= $this->url('listOrders')?>" >Voir plus</a>
                    </td>
                   
                </tr>
            </tfoot>	

		</table>
	</div>

	<!--Dernières Commandes  -->
	<h3>Vos derniers messages</h3>
	<div id="lastMessage">
		<form>	
			<table class="table table-responsive">
				<thead class="backgthead">
					<th>Pseudonyme</th>
					<th>Adresse email</th>
					<th>Date</th>
					<th>Sujet</th>
					<th>Contenu</th>
					<th>Statut</th>
					<th colspan="2">Action</th>
				</thead>

				<tbody class="backgtbody">
					<?php if(!empty($messages)): ?>
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
					<?php else: ?>
						<tr>
							<td colspan="7">Aucune information</td>
						</tr>
					<?php endif; ?>
				</tbody>
			<tfoot id="voirplus">
				<tr>
                    <td colspan="7"><a href="<?= $this->url('listMessage')?>" >Voir plus</a>
                    </td>
                </tr>    
			</tfoot>
            </table>
		</form>
	</div>	

	<!-- derniers messages guestbook -->
	<h3>Vos derniers commentaires du livre d'or</h3>
	<div id="lastGuestbook">
		<form>
			<table class="table table-responsive">
				<thead class="backgthead">
					<th>Prénom</th>
					<th>Nom</th>
					<th>Pseudonyme</th>
					<th>Commentaire</th>
					<th>Publié</th>				
					<th colspan="2">Action</th>
				</thead>

				<tbody class="backgtbody">
					<?php if(!empty($comments)): ?>
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
					<?php else: ?>
						<tr>
							<td colspan="7">Aucune information</td>
						</tr>
					<?php endif; ?>
				</tbody>
			<tfoot id="voirplus">
				<tr>
                    <td colspan="6"><a href="<?= $this->url('listGuestbook')?>" >Voir plus</a>
                    </td>    
                </tr>
            </tfoot>
		</div>

			</table>
		</form>	

	</div>
	
	
	
<?php $this->stop('main_content') ?>
