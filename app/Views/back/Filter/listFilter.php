<?php $this->layout('layoutback', ['title' => 'Liste des filtres']) ?>

<?php $this->start('main_content') ?>

	<a href="<?=$this->url('addFilter');?>"><button class="btn btn-info">Ajouter un filtre</button></a>

	<?php if(empty($filters)):?>
		<p class="alert alert-danger">Aucun filtre trouvé</p>
	<?php else:?>

		<form>	
			<table class="table table-responsive">
				<thead class="backgthead">
					<th>Nom du filtre</th>
					<th colspan="2">Action</th>
				</thead>

				<tbody class="backgtbody">
					<?php if(!empty($filters)): ?>
						<?php foreach($filters as $filter) : ?>
							<tr>
								<td><?=ucfirst($filter['name']);?></td>
								<td><a href="<?=$this->url('updateFilter', ['id'=>$filter['id']])?>">Mettre à jour le filtre</a></td>
								<td><button class="btn btn-danger delete-filter" data-id="<?=$filter['id']?>">Effacer le filtre</button></td>
							</tr>	
						<?php endforeach;?>
					<?php else: ?>
						<tr>
							<td colspan="3">Aucune information</td>
						</tr>
					<?php endif; ?>
				</tbody>
			</table>
		</form>

	<?php endif;?>

<?php $this->stop('main_content') ?>

<?php $this->start('js')?>
	<script>
		$(document).ready(function(){
			$('.delete-filter').click(function(e){
				e.preventDefault();

				var idFilter = $(this).data('id');

				$.confirm({

					title: 'Supprimer un filtre',

					content: "Êtes-vous sûr de vouloir supprimer ce filtre ?",

					type: 'red',

					theme: 'dark',

					buttons: {
						ok: {
							text: 'Effacer le filtre',
							btnClass: 'btn-danger',
							keys: ['enter'],
							action: function(){
				  				$.ajax({
				  					url: '<?=$this->url('ajax_deleteFilter'); ?>',
									type: 'post',
									cache: false,
									data: {id_filter: idFilter},
									dataType: 'json',
									success: function(out){
										if(out.code == 'ok'){
							  				$('body').load('<?=$this->url('listFilter');?>');	
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
<?php $this->stop('js') ?>