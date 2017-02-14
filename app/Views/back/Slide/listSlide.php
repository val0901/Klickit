<?php $this->layout('layoutback', ['title' => 'Liste des slides']) ?>

<?php $this->start('main_content') ?>
	<a href="<?=$this->url('addSlide');?>"><button class="btn btn-info">Ajout d'un bandeau</button></a>
	<form>
		<table class="table table-responsive">
			<thead class="backgthead">
				<th>N°</th>
				<th>Titre</th>
				<th colspan="2">Action</th>
			</thead>

			<tbody class="backgtbody">
				<?php if(!empty($slide)): ?>
					<?php foreach($slide as $value) : ?>
						<tr>
							<td><?=$value['id'];?></td>
							<td><?=$value['title'];?></td>
							<td><a href="<?=$this->url('updateSlide', ['id'=>$value['id']]);?>"><i class="fa fa-search-plus fa-2x" aria-hidden="true"></a></td>
							<td><button class="btn btn-danger delete-slide" data-id="<?=$value['id']?>">Effacer le bandeau</button></td>
						</tr>	
					<?php endforeach;?>
				<?php else: ?>
					<tr>
						<td colspan="4">Aucune information</td>
					</tr>
				<?php endif; ?>
			</tbody>
		</table>
	</form>
<?php $this->stop('main_content') ?>

<?php $this->start('js')?>
	<script>
		$(document).ready(function(){
			$('.delete-slide').click(function(e){
				e.preventDefault();

				var idSlide = $(this).data('id');

				$.confirm({

					title: 'Supprimer ce bandeau',

					content: "Êtes-vous sûr de vouloir supprimer ce bandeau ?",

					type: 'red',

					theme: 'dark',

					buttons: {
						ok: {
							text: 'Effacer le bandeau',
							btnClass: 'btn-danger',
							keys: ['enter'],
							action: function(){
				  				$.ajax({
				  					url: '<?=$this->url('ajax_deleteSlide'); ?>',
									type: 'post',
									cache: false,
									data: {id_slide: idSlide},
									dataType: 'json',
									success: function(out){
										if(out.code == 'ok'){
							  				$('body').load('<?=$this->url('listSlide');?>');
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
