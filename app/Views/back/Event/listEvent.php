<?php $this->layout('layoutback', ['title' => 'Liste des évènements']) ?>

<?php $this->start('main_content') ?>
	<a href="<?=$this->url('addEvent');?>"><button class="btn btn-info">Ajout d'évènement</button></a>
	<form>
		<table class="table table-responsive">
				<thead>
					<th>N°</th>
					<th>Titre</th>
					<th colspan="2">Action</th>
				</thead>

				<tbody>
					<?php foreach($event as $value) : ?>
						<tr>
							<td><?=$value['id'];?></td>
							<td><?=$value['title'];?></td>
							<td><a href="<?=$this->url('updateEvent', ['id'=>$value['id']]);?>"><i class="fa fa-search-plus fa-2x" aria-hidden="true"></a></td>
							<td><button class="btn btn-danger delete-event" data-id="<?=$value['id']?>">Effacer l'évènement'</button></td>
						</tr>	
					<?php endforeach;?>
				</tbody>
			</table>
	</form>

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
			$('.delete-event').click(function(e){
				e.preventDefault();

				var idEvent = $(this).data('id');

				$.confirm({

					title: 'Supprimer cet évènement',

					content: "Êtes-vous sûr de vouloir supprimer cet évènement ?",

					type: 'red',

					theme: 'dark',

					buttons: {
						ok: {
							text: 'Effacer l\'évènement',
							btnClass: 'btn-danger',
							keys: ['enter'],
							action: function(){
				  				$.ajax({
				  					url: '<?=$this->url('ajax_deleteEvent'); ?>',
									type: 'post',
									cache: false,
									data: {id_event: idEvent},
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
<?php $this->stop('js') ?>