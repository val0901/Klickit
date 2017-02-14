<?php $this->layout('layoutback', ['title' => 'Liste des articles ']) ?>
	
<?php $this->start('main_content') ?>
		
		<a href="<?=$this->url('addItem');?>"><button class="btn btn-info">Ajout d'article</button></a>
		<form>
			<h3>Catégorie Classique</h3>
			<div class="form-group">
				<input type="text" class="form-control search_classique" name="search" placeholder="Recherche ...">
			</div>
			<button type="submit" id="submit" class="btn btn-info search_item_classique">Rechercher</button>
			<br><br>
			<table class="table table-responsive">
				<thead class="backgthead">
					<th>N°</th>
					<th>Nom</th>
					<th>Quantité</th>
					<th>Prix</th>
					<th>statut</th>
					<th colspan="2">Action</th>
				</thead>

				<tbody id="result_classique" class="backgtbody">
					<?php if(!empty($Classic)): ?>
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
								<td><?=$value['statut'];?></td>
								<td><a href="<?=$this->url('updateItem', ['id'=>$value['id']]);?>"><i class="fa fa-search-plus fa-2x" aria-hidden="true"></a></td>
								<td><button class="btn btn-danger delete-item" data-id="<?=$value['id']?>">Effacer le produit</button></td>
							</tr>	
						<?php endforeach;?>
					<?php else: ?>
						<tr>
							<td colspan="7">Aucune information</td>
						</tr>
					<?php endif; ?>
				</tbody>
			</table>

			<?php $search = (isset($_GET['search']))? 'search='. $_GET['search'].'&' :'';?>
				<div id="pagination">
					<?= ($page!=1) ? '<a href="?'. $search .'page='. ($page - 1) .'"><i class="fa fa-arrow-left fa-fw"></i></a>':''; ?>
					Page <?= $page; ?> <?= ($nb>=1) ? '/ '.ceil($nb/$max) :''; ?>
					<?= ($nb < 1 ) ? '' : ($page!= ceil($nb/$max) ? '<a href="?'. $search .'page='. ($page + 1) .'"><i class="fa fa-arrow-right fa-fw" aria-hidden="true"></i></a>':''); ?>
				</div>	

			<br><br>

			<h3>Catégorie Custom</h3>
			<div class="form-group">
				<input type="text" class="form-control search_custom" name="search" placeholder="Recherche ...">
			</div>
			<button type="submit" id="submit" name="submit" class="btn btn-info search_item_custom">Rechercher</button>
			<br><br>
			<table class="table table-responsive">
				<thead class="backgthead">
					<th>N°</th>
					<th>Nom</th>
					<th>Quantité</th>
					<th>Prix</th>
					<th>statut</th>
					<th colspan="2">Action</th>
				</thead>

				<tbody id="result_custom" class="backgtbody">
					<?php if(!empty($Custom)): ?>
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
								<td><?=$value['statut'];?></td>
								<td><a href="<?=$this->url('updateItem', ['id'=>$value['id']]);?>"><i class="fa fa-search-plus fa-2x" aria-hidden="true"></a></td>
								<td><button class="btn btn-danger delete-item" data-id="<?=$value['id']?>">Effacer le produit</button></td>
							</tr>	
						<?php endforeach;?>
					<?php else: ?>
						<tr>
							<td colspan="7">Aucune information</td>
						</tr>
					<?php endif; ?>
				</tbody>
			</table>
			
				<div id="pagination">
					<?= ($page!=1) ? '<a href="?'. $search .'page='. ($page - 1) .'"><i class="fa fa-arrow-left fa-fw"></i></a>':''; ?>
					Page <?= $page; ?> <?= ($nb1>=1) ? '/ '.ceil($nb1/$max) :''; ?>
					<?= ($nb1 < 1 ) ? '' : ($page!= ceil($nb1/$max) ? '<a href="?'. $search .'page='. ($page + 1) .'"><i class="fa fa-arrow-right fa-fw" aria-hidden="true"></i></a>':''); ?>
				</div>	

			<br><br>

			<h3>Catégorie Pièces Détachées</h3>
			<div class="form-group">
				<input type="text" class="form-control search_piece" name="search" placeholder="Recherche ...">
			</div>
			<button type="submit" id="submit" name="submit" class="btn btn-info search_item_piece">Rechercher</button>
			<br><br>
			<table class="table table-responsive">
				<thead class="backgthead">
					<th>N°</th>
					<th>Nom</th>
					<th>Quantité</th>
					<th>Prix</th>
					<th>statut</th>
					<th colspan="2">Action</th>
				</thead>

				<tbody id="result_piece" class="backgtbody">
					<?php if(!empty($Piece)): ?>
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
								<td><?=$value['statut'];?></td>
								<td><a href="<?=$this->url('updateItem', ['id'=>$value['id']]);?>"><i class="fa fa-search-plus fa-2x" aria-hidden="true"></a></td>
								<td><button class="btn btn-danger delete-item" data-id="<?=$value['id']?>">Effacer le produit</button></td>
							</tr>	
						<?php endforeach;?>
					<?php else: ?>
						<tr>
							<td colspan="7">Aucune information</td>
						</tr>
					<?php endif; ?>
				</tbody>
			</table>

			<div id="pagination">
				<?= ($page!=1) ? '<a href="?'. $search .'page='. ($page - 1) .'"><i class="fa fa-arrow-left fa-fw"></i></a>':''; ?>
				Page <?= $page; ?> <?= ($nb2>=1) ? '/ '.ceil($nb2/$max) :''; ?>
				<?= ($nb2 < 1 ) ? '' : ($page!= ceil($nb2/$max) ? '<a href="?'. $search .'page='. ($page + 1) .'"><i class="fa fa-arrow-right fa-fw" aria-hidden="true"></i></a>':''); ?>
			</div>

			<br><br>

			<h3>Catégorie Divers</h3>
			<div class="form-group">
				<input type="text" class="form-control search_divers" name="search" placeholder="Recherche ...">
			</div>
			<button type="submit" id="submit" name="submit" class="btn btn-info search_item_divers">Rechercher</button>
			<br><br>
			<table class="table table-responsive">
				<thead class="backgthead">
					<th>N°</th>
					<th>Nom</th>
					<th>Quantité</th>
					<th>Prix</th>
					<th>statut</th>
					<th colspan="2">Action</th>
				</thead>

				<tbody id="result_divers" class="backgtbody">
					<?php if(!empty($Divers)): ?>
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
								<td><?=$value['statut'];?></td>
								<td><a href="<?=$this->url('updateItem', ['id'=>$value['id']]);?>"><i class="fa fa-search-plus fa-2x" aria-hidden="true"></a></td>
								<td><button class="btn btn-danger delete-item" data-id="<?=$value['id']?>">Effacer le produit</button></td>
							</tr>	
						<?php endforeach;?>
					<?php else: ?>
						<tr>
							<td colspan="7">Aucune information</td>
						</tr>
					<?php endif; ?>
				</tbody>
			</table>

			<div id="pagination">
				<?= ($page!=1) ? '<a href="?'. $search .'page='. ($page - 1) .'"><i class="fa fa-arrow-left fa-fw"></i></a>':''; ?>
				Page <?= $page; ?> <?= ($nb3>=1) ? '/ '.ceil($nb3/$max) :''; ?>
				<?= ($nb3 < 1 ) ? '' : ($page!= ceil($nb3/$max) ? '<a href="?'. $search .'page='. ($page + 1) .'"><i class="fa fa-arrow-right fa-fw" aria-hidden="true"></i></a>':''); ?>
			</div>

		</form>
			
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
							  				$('body').load('<?=$this->url('listItem');?>');	
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
		
			/*AJAX POUR LA RECHERCHE CLASSIQUE*/
			$('.search_item_classique').click(function(e){
				e.preventDefault();

				var searchContent = $('.search_classique').val();
				var categoryContent = 'PlaymobilClassique';

				$.ajax({
					url: '<?=$this->url('ajax_searchItem');?>',
					type: 'post',
					cache: false,
					data:  {search: searchContent, category: categoryContent},
					dataType: 'json',
					success: function(search){
						if(search.code == 'classique'){
							$('#result_classique').html(search.msg);

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
											  				$('body').load('<?=$this->url('listItem');?>');	
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
						}
					}
				});
			});

			/*AJAX POUR LA RECHERCHE CUSTOM*/
			$('.search_item_custom').click(function(e){
				e.preventDefault();

				var searchContent = $('.search_custom').val();
				var categoryContent = 'PlaymobilCustom';

				$.ajax({
					url: '<?=$this->url('ajax_searchItem');?>',
					type: 'post',
					cache: false,
					data:  {search: searchContent, category: categoryContent},
					dataType: 'json',
					success: function(search){
						if(search.code == 'custom'){
							$('#result_custom').html(search.msg);

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
											  				$('body').load('<?=$this->url('listItem');?>');	
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
						}
					}
				});
			});

			/*AJAX POUR LA RECHERCHE PIECE*/
			$('.search_item_piece').click(function(e){
				e.preventDefault();

				var searchContent = $('.search_piece').val();
				var categoryContent = 'PiecesDetachees';

				$.ajax({
					url: '<?=$this->url('ajax_searchItem');?>',
					type: 'post',
					cache: false,
					data:  {search: searchContent, category: categoryContent},
					dataType: 'json',
					success: function(search){
						if(search.code == 'piece'){
							$('#result_piece').html(search.msg);

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
											  				$('body').load('<?=$this->url('listItem');?>');	
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
						}
					}
				});
			});

			/*AJAX POUR LA RECHERCHE DIVERS*/
			$('.search_item_divers').click(function(e){
				e.preventDefault();

				var searchContent = $('.search_divers').val();
				var categoryContent = 'Divers';

				$.ajax({
					url: '<?=$this->url('ajax_searchItem');?>',
					type: 'post',
					cache: false,
					data:  {search: searchContent, category: categoryContent},
					dataType: 'json',
					success: function(search){
						if(search.code == 'divers'){
							$('#result_divers').html(search.msg);

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
											  				$('body').load('<?=$this->url('listItem');?>');	
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
						}
					}
				});
			});
		});
	</script>
<?php $this->stop('js')?>