<?php $this->layout('layoutback', ['title' => 'Liste des clients']) ?>

<?php $this->start('main_content') ?>
<a href="<?=$this->url('addUser');?>"><button class="btn btn-info">Ajout d'un client</button></a>
<br><br>
<?php if(empty($users)): ?>
	<p class="alert alert-danger">Aucun utilisateur trouvé</p>

<?php else:?>
	<form class="form-inline">
		<div class="form-group">
			<input type="text" class="form-control" id="search" name="search" placeholder="Recherche ...">
		</div>
		<button type="submit" id="submit" class="btn btn-info search_user">Rechercher</button>
		<br><br>
		<table class="table table-responsive">
			<thead class="backgthead">
				<th class="title_home_phone">Civilité</th>
				<th class="title_home_phone">Rôle</th>
				<th>Nom</th>
				<th class="title_home_phone">Prénom</th>
				<th class="title_home_phone">Pseudonyme</th>
				<th>Adresse email</th>
				<th colspan="2">Action</th>
			</thead>

			<tbody id="result" class="backgtbody">
				<?php if(!empty($users)): ?>
					<?php foreach($users as $user) : ?>
						<tr>
							<td class="title_home_phone"><?=$user['social_title'];?></td>
							<td class="title_home_phone"><?=$user['role'];?></td>
							<td><?=$user['lastname'];?></td>
							<td class="title_home_phone"><?=$user['firstname'];?></td>
							<td class="title_home_phone"><?=$user['username'];?></td>
							<td><?=$user['email'];?></td>
							<td><a href="<?=$this->url('updateUser', ['id'=>$user['id']]);?>"><i class="fa fa-search-plus fa-2x" aria-hidden="true"></i></a></td>
							<td><button class="btn btn-danger delete-user" data-id="<?=$user['id']?>">Effacer</button></td>
						</tr>	
					<?php endforeach;?>
				<?php else: ?>
					<tr>
						<td colspan="8">Aucune information</td>
					</tr>
				<?php endif; ?>
			</tbody>
		</table>
	</form>	
<?php endif;?>

	<?php $search = (isset($_GET['search']))? 'search='. $_GET['search'].'&' :'';?>
	<div id="pagination">
		<?= ($page!=1) ? '<a href="?'. $search .'page='. ($page - 1) .'"><i class="fa fa-arrow-left fa-fw"></i></a>':''; ?>
		Page <?= $page; ?> <?= ($nb>=1) ? '/ '.ceil($nb/$max) :''; ?>
		<?= ($nb < 1 ) ? '' : ($page!= ceil($nb/$max) ? '<a href="?'. $search .'page='. ($page + 1) .'"><i class="fa fa-arrow-right fa-fw" aria-hidden="true"></i></a>':''); ?>
	</div>

<?php $this->stop('main_content') ?>

<?php $this->start('js')?>

<script>
	$(document).ready(function(){
		
		$('.delete-user').click(function(e){
			e.preventDefault();

			var idUser = $(this).data('id');

			$.confirm({

				title: 'Supprimer un utilisateur',

				content: "Êtes-vous sûr de vouloir supprimer cet utilisateur ?",

				type: 'red',

				theme: 'dark',

				buttons: {
					ok: {
						text: 'Effacer l\'utilisateur',
						btnClass: 'btn-danger',
						keys: ['enter'],
						action: function(){
			  				$.ajax({
			  					url: '<?=$this->url('ajax_deleteUser'); ?>',
								type: 'post',
								cache: false,
								data: {id_user: idUser},  // $_POST['id_user']
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

		// AJAX POUR LA RECHERCHE
		$('.search_user').click(function(e){
			e.preventDefault();

			$.ajax({
				url: '<?=$this->url('ajax_searchUser');?>',
				type: 'get',
				cache: false,
				data:  $('#search'),
				dataType: 'json',
				success: function(search){
					$('#result').html(search.msg);
					$('.delete-user').click(function(e){
						e.preventDefault();

						var idUser = $(this).data('id');

						$.confirm({

							title: 'Supprimer un utilisateur',

							content: "Êtes-vous sûr de vouloir supprimer cet utilisateur ?",

							type: 'red',

							theme: 'dark',

							buttons: {
								ok: {
									text: 'Effacer l\'utilisateur',
									btnClass: 'btn-danger',
									keys: ['enter'],
									action: function(){
						  				$.ajax({
						  					url: '<?=$this->url('ajax_deleteUser'); ?>',
											type: 'post',
											cache: false,
											data: {id_user: idUser},  // $_POST['id_user']
											dataType: 'json',
											success: function(out){
												if(out.code == 'ok'){
									  				$('body').load('<?=$this->url('listUser');?>');		
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
			});
		});
	});
</script>
<?php $this->stop('js')?>