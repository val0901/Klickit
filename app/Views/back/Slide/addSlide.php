<?php $this->layout('layoutback', ['title' => 'Ajouter des slides']) ?>

<?php $this->start('main_content') ?>
	<a href="<?=$this->url('listSlide');?>"><button class="btn btn-info">Retour à la liste des slides</button></a>
	<br>
	<?php if($success): ?>
		<p class="alert alert-success">Slide créé</p>
	<?php elseif(isset($errors) && !empty($errors)):?>
		<p class="alert alert-danger"><?=implode('<br>', $errors);?></p>	
	<?php endif;?>

	<form class="form-horizontal" method="post" enctype="multipart/form-data">
		<!-- Text input-->
		<div class="form-group">
		  <label class="col-md-4 control-label" for="title">Titre</label>  
		  <div class="col-md-4">
		  <input id="title" name="title" placeholder="" class="form-control input-md" type="text">
		    
		  </div>
		</div>

		<!-- File Button --> 
		<div class="form-group">
		  <label class="col-md-4 control-label" for="picture">Image</label>
		  <div class="col-md-4">
		    <input id="picture" name="picture" class="input-file" type="file">
		  </div>
		</div>

		<!-- File Button --> 
		<div class="form-group">
		  <label class="col-md-4 control-label" for="link">Url de l'évènement lié</label>
		  <div class="col-md-4">
		    <input id="link" name="link" class="input-file" type="text" style="color:black;">
		  </div>
		</div>

		<!-- Button -->
		<div class="form-group">
		  <label class="col-md-4 control-label" for="submit"></label>
		  <div class="col-md-4">
		    <button id="submit" name="submit" class="btn btn-info">Enregistrer le Slide</button>
		  </div>
		</div>
	</form>

<?php $this->stop('main_content') ?>
