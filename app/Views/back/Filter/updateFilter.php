<?php $this->layout('layoutback', ['title' => 'Mise à jour des filtres']) ?>

<?php $this->start('main_content') ?>

	<a href="<?=$this->url('listFilter');?>"><button class="btn btn-info">Retour liste des filtres</button></a>

	<?php if($success):?>
		<p class="alert alert-success">Filtre modifié</p>

	<?php elseif(isset($errors) && !empty($errors)):?>
		<p class="alert alert-danger"><?=implode('<br>', $errors);?></p>
	<?php endif;?>	

	<form class="form-horizontal" method="post">

		<div class="form-group">
		  <label class="col-md-4 control-label" for="name">Filtre</label>  
		  <div class="col-md-4">
		  <input id="name" name="name" placeholder="Nom du filtre" class="form-control input-md" type="text"></div>
		</div>

		<!-- Select Basic -->
		<div class="form-group">
		  <label class="col-md-4 control-label" for="category">Catégorie</label>
		  <div class="col-md-4">
		    <select id="category" name="category" class="form-control">
		      <option value="PlaymobilClassique">Playmobil Classique</option>
		      <option value="PlaymobilCustom">Playmobil Custom</option>
		      <option value="PiecesDetachees">Pièces Detachées</option>
		      <option value="Divers">Divers</option>
		    </select>
		  </div>
		</div>

		<div class="form-group">
		  <label class="col-md-4 control-label" for="id"></label>
		  <div class="col-md-4">
		    <button id="id" name="id" class="btn btn-info">Mettre à jour le filtre</button>
		  </div>
		</div>

	</form>

<?php $this->stop('main_content') ?>