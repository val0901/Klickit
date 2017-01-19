<?php $this->layout('layoutback', ['title' => 'ajout des filtres']) ?>

<?php $this->start('main_content') ?>

<?php if($success):?>
	<p class="alert alert-success">Filtre ajouté</p>
<?php elseif(isset($errors) && !empty($errors)):?>
	<p class="alert alert-danger"><?=implode('<br>', $errors);?></p>
<?php endif;?>	

<form class="form-horizontal" method="post">

	<div class="form-group">
	  <label class="col-md-4 control-label" for="name">Filtre</label>  
	  <div class="col-md-4">
	  <input id="name" name="name" placeholder="Nom du filtre" class="form-control input-md" required="" type="text">
	    
	  </div>
	</div>

	<div class="form-group">
	  <label class="col-md-4 control-label" for="id"></label>
	  <div class="col-md-4">
	    <button id="id" name="id" class="btn btn-info">Ajouter un filtre</button>
	  </div>
	</div>
	
</form>

<?php $this->stop('main_content') ?>