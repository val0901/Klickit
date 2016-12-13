<?php $this->layout('layoutback', ['title' => 'Liste des clients']) ?>

<?php $this->start('main_content') ?>

<?php if(empty($users)): ?>
	<p class="alert alert-danger">Aucun utilisateur trouvé</p>

<?php else:?>
	<form>	
		<table class="table table-responsive">
			<thead>
				<th>Civilité</th>
				<th>Nom</th>
				<th>Prénom</th>
				<th>Pseudonyme</th>
				<th>Adresse email</th>
				<th>Commandes</th>
				<th colspan="3">Action</th>
			</thead>

			<tbody>
				<?php foreach($users as $user) : ?>
					<tr>
						<td><?=$user['social_title'];?></td>
						<td><?=$user['lastname'];?></td>
						<td><?=$user['firstname'];?></td>
						<td><?=$user['username'];?></td>
						<td><?=$user['email'];?></td>
						<td>Commande ici (avec une super jointure)</td>
						<td><a href="#">Voir le profil</a></td> <!-- Mettre lien pour voir le profil sur le front -->
						<td><a href="<?=$this->url('updateUser', ['id'=>$user['id']]);?>">Mettre à jour le profil</a></td>
						<td><button class="btn btn-danger delete-user" data-id="<?=$user['id']?>">Effacer le profil</button></td>
					</tr>	
				<?php endforeach;?>
			</tbody>
		</table>
	</form>	
<?php endif;?>	

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
	});
</script>

<?php $this->stop('js')?>