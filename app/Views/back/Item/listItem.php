<?php $this->layout('layoutback', ['title' => 'Liste des articles ']) ?>
	
<?php $this->start('main_content') ?>
		
		<a href="<?=$this->url('addItem');?>"><button class="btn btn-info">Ajout d'article</button></a>
		<form>
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
							<td><a href="<?=$this->url('updateItem', ['id'=>$value['id']]);?>"><i class="fa fa-search-plus fa-2x" aria-hidden="true"></a></td>
							<td><button class="btn btn-danger delete-item" data-id="<?=$value['id']?>">Effacer le produit</button></td>
						</tr>	
					<?php endforeach;?>
				</tbody>
			</table>

			<?php $search = (isset($_GET['search']))? 'search='. $_GET['search'].'&' :'';?>
			<div>
				<?= ($page!=1) ? '<a href="?'. $search .'page='. ($page - 1) .'"><i class="fa fa-arrow-left" aria-hidden="true"></i></a>':''; ?>
				Page <?= $page; ?> / <?= ceil($nb/$max);
				 ?>
				<?= $page!= ceil($nb/$max) ? '<a href="?'. $search .'page='. ($page + 1) .'"><i class="fa fa-arrow-right" aria-hidden="true"></i></a>':''; ?>
			</div>	

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
							<td><a href="<?=$this->url('updateItem', ['id'=>$value['id']]);?>"><i class="fa fa-search-plus fa-2x" aria-hidden="true"></a></td>
							<td><button class="btn btn-danger delete-item" data-id="<?=$value['id']?>">Effacer le produit</button></td>
						</tr>	
					<?php endforeach;?>
				</tbody>
			</table>
			<?php $search = (isset($_GET['search']))? 'search='. $_GET['search'].'&' :'';?>
			<div>
				<?= ($page1!=1) ? '<a href="?'. $search .'page='. ($page1 - 1) .'"><i class="fa fa-arrow-left" aria-hidden="true"></i></a>':''; ?>
				Page <?= $page1; ?> / <?= ceil($nb1/$max); ?>
				<?= $page1!= ceil($nb1/$max) ? '<a href="?'. $search .'page='. ($page1 + 1) .'"><i class="fa fa-arrow-right" aria-hidden="true"></i></a>':''; ?>
			</div>	

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
							<td><a href="<?=$this->url('updateItem', ['id'=>$value['id']]);?>"><i class="fa fa-search-plus fa-2x" aria-hidden="true"></a></td>
							<td><button class="btn btn-danger delete-item" data-id="<?=$value['id']?>">Effacer le produit</button></td>
						</tr>	
					<?php endforeach;?>
				</tbody>
			</table>
			<?php $search = (isset($_GET['search']))? 'search='. $_GET['search'].'&' :'';?>
			<div>
				<?= ($page!=1) ? '<a href="?'. $search .'page='. ($page - 1) .'"><i class="fa fa-arrow-left" aria-hidden="true"></i></a>':''; ?>
				Page <?= $page; ?> / <?= ceil($nb2/$max); ?>
				<?= $page!= ceil($nb2/$max) ? '<a href="?'. $search .'page='. ($page + 1) .'"><i class="fa fa-arrow-right" aria-hidden="true"></i></a>':''; ?>
			</div>	

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
							<td><a href="<?=$this->url('updateItem', ['id'=>$value['id']]);?>"><i class="fa fa-search-plus fa-2x" aria-hidden="true"></a></td>
							<td><button class="btn btn-danger delete-item" data-id="<?=$value['id']?>">Effacer le produit</button></td>
						</tr>	
					<?php endforeach;?>
				</tbody>
			</table>
		</form>
		<?php $search = (isset($_GET['search']))? 'search='. $_GET['search'].'&' :'';?>
		<div>
			<?= ($page!=1) ? '<a href="?'. $search .'page='. ($page - 1) .'"><i class="fa fa-arrow-left" aria-hidden="true"></i></a>':''; ?>
			Page <?= $page; ?> / <?= ceil($nb3/$max); ?>
			<?= $page!= ceil($nb3/$max) ? '<a href="?'. $search .'page='. ($page + 1) .'"><i class="fa fa-arrow-right" aria-hidden="true"></i></a>':''; ?>
		</div>	
<?php $this->stop('main_content') ?>

<?php $this->start('js')?>
	<script>
		$(document).ready(function(){
			
			$('.delete-item').click(function(e){
				e.preventDefault();

				var idItem = $(this).data('id');

				$.confirm({

					title: 'Supprimer cet article',

					content: "Êtes-vous sûr de vouloir supprimer cet article ?",

					type: 'red',

					theme: 'dark',

					buttons: {
						ok: {
							text: 'Effacer l\'article',
							btnClass: 'btn-danger',
							keys: ['enter'],
							action: function(){
				  				$.ajax({
				  					url: '<?=$this->url('ajax_deleteItem'); ?>',
									type: 'post',
									cache: false,
									data: {id_item: idItem},
									dataType: 'json',
									success: function(out){
										if(out.code == 'ok'){
							  				window.location.href=window.location.href;	
										}
									}
				  				});
				  				
			  				}
						},
						cancel: function(button) {

						}
					}
				});

			});
		});
	</script>
<?php $this->stop('js')?>