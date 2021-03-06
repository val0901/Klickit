<?php $this->layout('layoutback', ['title' => 'Liste des messages reçus ']) ?>

<?php $this->start('main_content') ?>
	<?php if(empty($messages)):?>
		<p class="alert alert-danger">Aucun message trouvé</p>
	<?php else:?>
		<form class="form-inline">
			<div class="form-group">
				<input type="text" class="form-control" id="search" name="search" placeholder="Recherche ...">
			</div>
			<button type="submit" id="submit" class="btn btn-info search_message">Rechercher</button>
			<br><br>	
			<table class="table table-responsive">
				<thead class="backgthead">
					<th class="title_home_phone">Pseudonyme</th>
					<th class="title_home_phone">Adresse email</th>
					<th>Sujet</th>
					<th class="title_home_phone">Contenu</th>
					<th>Statut</th>
					<th colspan="2">Action</th>
				</thead>

				<tbody id="result" class="backgtbody">
					<?php if(!empty($messages)): ?>
						<?php foreach($messages as $message) : ?>
							<?php 
								if ($message['statut'] == 'NonLu'){
									$bold = ' style="font-weight:bold;" ';
								}else{
									$bold = '';
								}
							?>
							<tr>
								<td <?=$bold?> class="title_home_phone"><?=$message['username'];?></td>
								<td <?=$bold?> class="title_home_phone"><?=$message['email'];?></td>
								<td <?=$bold?> ><?=$message['subject'];?></td> 
								<td <?=$bold?> class="title_home_phone"><?=substr($message['content'], 0, 30).'...';?></td>
								<td <?=$bold?> ><?=$message['statut'];?></td>
                                <td><a href="<?=$this->url('viewMessage', ['id'=>$message['id']]);?>"><i class="fa fa-search-plus fa-2x" aria-hidden="true"></i></a></td>
								<td><button class="btn btn-danger delete-message" data-id="<?=$message['id']?>">Effacer</button></td>
							</tr>	
						<?php endforeach;?>
					<?php else: ?>
						<tr>
							<td colspan="7">Aucune information</td>
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
		
		$('.delete-message').click(function(e){
			e.preventDefault();

			var idMessage = $(this).data('id');

			$.confirm({

				title: 'Supprimer un message',

				content: "Êtes-vous sûr de vouloir supprimer cet message ?",

				type: 'red',

				theme: 'dark',

				buttons: {
					ok: {
						text: 'Effacer le message',
						btnClass: 'btn-danger',
						keys: ['enter'],
						action: function(){
			  				$.ajax({
			  					url: '<?=$this->url('ajax_deleteMessage'); ?>',
								type: 'post',
								cache: false,
								data: {id_message: idMessage},  // $_POST['id_message']
								dataType: 'json',
								success: function(out){
									if(out.code == 'ok'){
						  				window.location.reload();	
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
		$('.search_message').click(function(e){
			e.preventDefault();

			$.ajax({
				url: '<?=$this->url('ajax_searchMessage');?>',
				type: 'get',
				cache: false,
				data:  $('#search'),
				dataType: 'json',
				success: function(search){
					$('#result').html(search.msg);
					$('.delete-message').click(function(e){
						e.preventDefault();

						var idMessage = $(this).data('id');

						$.confirm({

							title: 'Supprimer un message',

							content: "Êtes-vous sûr de vouloir supprimer cet message ?",

							type: 'red',

							theme: 'dark',

							buttons: {
								ok: {
									text: 'Effacer le message',
									btnClass: 'btn-danger',
									keys: ['enter'],
									action: function(){
						  				$.ajax({
						  					url: '<?=$this->url('ajax_deleteMessage'); ?>',
											type: 'post',
											cache: false,
											data: {id_message: idMessage},  // $_POST['id_message']
											dataType: 'json',
											success: function(out){
												if(out.code == 'ok'){
									  				window.location.reload();	
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
