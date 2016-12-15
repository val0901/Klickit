<?php $this->layout('layoutback', ['title' => 'Options d\'envoi']) ?>

<?php $this->start('main_content') ?>
	<a href="<?=$this->url('addShipping');?>"><button class="btn btn-info">Ajout d'une option d'envoi</button></a>

	<?php if(empty($options)):?>
		<p class="alert alert-danger">Aucune option d'envoi trouvée</p>
	<?php else:?>
		<form>	
			<table class="table table-responsive">
				<thead>
					<th>Nom de l'option</th>
					<th>Prix</th>
					<th>Détails</th>
					<th colspan="2">Action</th>
				</thead>

				<tbody>
					<?php foreach($options as $option) : ?>
						<tr>
							<td><?=$option['title'];?></td>
							<td><?=$option['price'];?></td>
							<td><?=nl2br($option['content']);?></td>
							<td><button class="btn btn-danger delete-option" data-id="<?=$option['id']?>">Effacer l'option d'envoi</button></td>
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
		
		$('.delete-option').click(function(e){
			e.preventDefault();

			var idShipping = $(this).data('id');

			$.confirm({

				title: 'Supprimer une option d\'envoi',

				content: "Êtes-vous sûr de vouloir supprimer cet option ?",

				type: 'red',

				theme: 'dark',

				buttons: {
					ok: {
						text: 'Effacer l\'option',
						btnClass: 'btn-danger',
						keys: ['enter'],
						action: function(){
			  				$.ajax({
			  					url: '<?=$this->url('ajax_deleteShipping'); ?>',
								type: 'post',
								cache: false,
								data: {id_shipping: idShipping},  // $_POST['id_user']
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
