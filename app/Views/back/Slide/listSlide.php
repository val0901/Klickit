<?php $this->layout('layoutback', ['title' => 'Liste des slides']) ?>

<?php $this->start('main_content') ?>
	<a href="<?=$this->url('addSlide');?>"><button class="btn btn-info">Ajout de slide</button></a>
	<form>
		<table class="table table-responsive">
				<thead>
					<th>N°</th>
					<th>Titre</th>
					<th colspan="2">Action</th>
				</thead>

				<tbody>
					<?php foreach($slide as $value) : ?>
						<tr>
							<td><?=$value['id'];?></td>
							<td><?=$value['title'];?></td>
							<td><a href="<?=$this->url('updateSlide', ['id'=>$value['id']]);?>">Vu et modification du Slide</a></td>
							<td><button class="btn btn-danger delete-slide" data-id="<?=$value['id']?>">Effacer le slide'</button></td>
						</tr>	
					<?php endforeach;?>
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

					title: 'Supprimer ce Slide',

					content: "Êtes-vous sûr de vouloir supprimer ce slide ?",

					type: 'red',

					theme: 'dark',

					buttons: {
						ok: {
							text: 'Effacer le slide',
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
