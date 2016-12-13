<?php $this->layout('layoutback', ['title' => 'Liste des articles ']) ?>

<?php $this->start('main_content') ?>
	<?php if(empty($Classic)): ?>
		<p class="alert alert-danger">Aucun article trouvé</p>
	<?php else: ?>
		<form>
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
					<?php foreach($Classic as $value) : ?>
						<tr>
							<td><?=$value['id'];?></td>
							<td><?=$value['name'];?></td>
							<td><?=$value['quantity'];?></td>
							<?php if($value['newPrice'] === 0): ?>
								<td><?=$value['price'];?></td>
							<?php elseif($value['newPrice']) > 0): ?>
								<td><?=$value['newPrice'];?></td>
							<?php endif; ?>
							<td>
								<div class="col-md-4">
								    <select id="selectStatut" name="selectStatut" class="form-control">
								    	<option value="<?=$value['statut'];?>" selected><?=$value['statut'];?></option>
									    <option value="promotion">promotion</option>
									    <option value="nouveauté">nouveauté</option>
									    <option value="par defaut">par defaut</option>
								    </select>
							    </div>
							</td>
							<td><a href="#">Voir le profil</a></td> <!-- Mettre lien pour voir le profil sur le front -->
							<td><a href="<?=$this->url('updatevalue', ['id'=>$value['id']]);?>">Mettre à jour le profil</a></td>
							<td><button class="btn btn-danger">Effacer le profil</button></td>
						</tr>	
					<?php endforeach;?>
				</tbody>
			</table>
		</form>
	<?php endif; ?>
<?php $this->stop('main_content') ?>
