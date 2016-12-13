<?php $this->layout('layoutback', ['title' => 'Liste des articles ']) ?>
	
<?php $this->start('main_content') ?>
			
			<a href="<?=$this->url('addItem');?>"><button class="btn btn-info">Ajout d'article</button></a>

			<h3>Catégorie Classique</h3>
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
							<?php if($value['newPrice'] == 0) : ?>
								<td><?=$value['price'];?></td>
							<?php elseif($value['newPrice'] > 0) : ?>
								<td><?=$value['newPrice'];?></td>
							<?php endif; ?>
							<td>
								<div class="col-md-4">
								    <select id="selectStatut" name="selectStatut" class="form-control">
								    	<option value="<?=$value['statut'];?>" selected disabled><?=$value['statut'];?></option>
									    <option value="promotion">promotion</option>
									    <option value="nouveauté">nouveauté</option>
									    <option value="par defaut">par defaut</option>
								    </select>
							    </div>
							</td>
							<td><a href="">Mettre à jour le profil</a></td>
							<td><button class="btn btn-danger">Effacer le produit</button></td>
						</tr>	
					<?php endforeach;?>
				</tbody>
			</table>

			<br><br>

			<h3>Catégorie Custom</h3>
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
					<?php foreach($Custom as $value) : ?>
						<tr>
							<td><?=$value['id'];?></td>
							<td><?=$value['name'];?></td>
							<td><?=$value['quantity'];?></td>
							<?php if($value['newPrice'] == 0) : ?>
								<td><?=$value['price'];?></td>
							<?php elseif($value['newPrice'] > 0) : ?>
								<td><?=$value['newPrice'];?></td>
							<?php endif; ?>
							<td>
								<div class="col-md-4">
								    <select id="selectStatut" name="selectStatut" class="form-control">
								    	<option value="<?=$value['statut'];?>" selected disabled><?=$value['statut'];?></option>
									    <option value="promotion">promotion</option>
									    <option value="nouveauté">nouveauté</option>
									    <option value="par defaut">par defaut</option>
								    </select>
							    </div>
							</td>
							<td><a href="">Mettre à jour le profil</a></td>
							<td><button class="btn btn-danger">Effacer le produit</button></td>
						</tr>	
					<?php endforeach;?>
				</tbody>
			</table>

			<br><br>

			<h3>Catégorie Pièces Détachées</h3>
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
					<?php foreach($Piece as $value) : ?>
						<tr>
							<td><?=$value['id'];?></td>
							<td><?=$value['name'];?></td>
							<td><?=$value['quantity'];?></td>
							<?php if($value['newPrice'] == 0) : ?>
								<td><?=$value['price'];?></td>
							<?php elseif($value['newPrice'] > 0) : ?>
								<td><?=$value['newPrice'];?></td>
							<?php endif; ?>
							<td>
								<div class="col-md-4">
								    <select id="selectStatut" name="selectStatut" class="form-control">
								    	<option value="<?=$value['statut'];?>" selected disabled><?=$value['statut'];?></option>
									    <option value="promotion">promotion</option>
									    <option value="nouveauté">nouveauté</option>
									    <option value="par defaut">par defaut</option>
								    </select>
							    </div>
							</td>
							<td><a href="">Mettre à jour le profil</a></td>
							<td><button class="btn btn-danger">Effacer le produit</button></td>
						</tr>	
					<?php endforeach;?>
				</tbody>
			</table>

			<br><br>

			<h3>Catégorie Divers</h3>
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
					<?php foreach($Divers as $value) : ?>
						<tr>
							<td><?=$value['id'];?></td>
							<td><?=$value['name'];?></td>
							<td><?=$value['quantity'];?></td>
							<?php if($value['newPrice'] == 0) : ?>
								<td><?=$value['price'];?></td>
							<?php elseif($value['newPrice'] > 0) : ?>
								<td><?=$value['newPrice'];?></td>
							<?php endif; ?>
							<td>
								<div class="col-md-4">
								    <select id="selectStatut" name="selectStatut" class="form-control">
								    	<option value="<?=$value['statut'];?>" selected disabled><?=$value['statut'];?></option>
									    <option value="promotion">promotion</option>
									    <option value="nouveauté">nouveauté</option>
									    <option value="par defaut">par defaut</option>
								    </select>
							    </div>
							</td>
							<td><a href="">Mettre à jour le profil</a></td>
							<td><button class="btn btn-danger">Effacer le produit</button></td>
						</tr>	
					<?php endforeach;?>
				</tbody>
			</table>
<?php $this->stop('main_content') ?>