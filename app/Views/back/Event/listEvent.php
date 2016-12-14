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
							<td><?=$value['name'];?></td>
							<td><a href="<?=$this->url('updateEvent', ['id'=>$value['id']]);?>">Vu et modification de l'évènement</a></td>
							<td><button class="btn btn-danger delete-item" data-id="<?=$value['id']?>">Effacer l'évènement'</button></td>
						</tr>	
					<?php endforeach;?>
				</tbody>
			</table>
	</form>
<?php $this->stop('main_content') ?>

<?php $this->start('js')?>
	<script>
		
	</script>
<?php $this->stop('js') ?>