<?php $this->layout('layoutback', ['title' => 'Message de '.$message['firstname'].' '.$message['lastname']]) ?>

<?php $this->start('main_content') ?>
	<?php if(empty($message)):?>
		<p class="alert alert-danger">Aucun message trouvé</p>
	<?php else:?>

		<h3>Sujet : <?=$message['subject']?></h3>
		<h3>Contenu : </h3>
		<div class="jumbotron ">
			<?=$message['content']?>	
		</div>

		<form method="post">
			<button class="btn btn-success" name="read">Marquer comme lu</button>
			<button class="btn btn-warning" name="not-read">Marquer comme non-lu</button>
		</form>	

<?php endif;?>
<?php $this->stop('main_content') ?>
