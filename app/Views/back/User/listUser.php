<?php $this->layout('layoutback', ['title' => 'Liste des clients']) ?>

<?php $this->start('main_content') ?>

<?php if(empty($users)): ?>
	<p class="alert alert-danger">Aucun utilisateur trouvé</p>

<?php else:?>
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
					<td><form id="form-<?=$user['id']?>"><button id="<?=$user['id']?>" class="btn btn-danger">Effacer le profil</button></form></td>
				</tr>	
			<?php endforeach;?>
		</tbody>
	</table>
<?php endif;?>	

<?php $this->stop('main_content') ?>

<?php $this->start('js')?>

<script>
	$(document).ready(function(){
		
		$('#'+'<?=$user['id']?>').click(function(e){
			e.preventDefault();

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
			  					url: '<?=$this->url('ajax_deleteUser', ['id'=>$user['id']]); ?>',
								type: 'post',
								cache: false,
								data: $('form').serialize(),
								dataType: 'json',
								success: function(out){
									if(out.code == 'ok'){
						  					
									}
								}
			  				});
			  				setInterval(function(){
								$('body').load($(location).attr('href'));
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