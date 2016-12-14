<?php $this->layout('layoutback', ['title' => 'Modération du livre d\'or']) ?>

<?php $this->start('main_content') ?>
	<?php if(empty($message)):?>
		<p class="alert alert-danger">Aucun message trouvé</p>
	<?php else:?>

		<h3>Message de <?=$message['firstname'].' '.$message['lastname']?></h3>
		<h3 id="moderation-left">Contenu : </h3>
		<div class="jumbotron ">
			<?=nl2br($message['content']).'<br>'.$message['firstname'].' '.ucfirst(substr($message['lastname'],0,1)).'.'?>	
		</div>

		<form method="post">
			<?php if($message['published'] == 'non'):?>
				<button class="btn btn-success" name="publish">Publier</button>
			<?php elseif($message['published'] == 'oui'):?>	
				<button class="btn btn-warning" name="no-publish">Ne pas publier</button>
			<?php endif;?>	
		</form>	

<?php endif;?>	
<?php $this->stop('main_content') ?>