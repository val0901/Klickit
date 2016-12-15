<?php $this->layout('layoutback', ['title' => 'Ajouter des options d\'envoi']) ?>

<?php $this->start('main_content') ?>

	<?php if($success):?>
		<p class="alert alert-success">Option d'envoi ajoutée</p>
	<?php elseif(isset($errors) && !empty($errors)):?>
		<p class="alert alert-danger"><?=implode('<br>', $errors);?></p>
	<?php endif;?>	

	<form class="form-horizontal" method="post">

		<!-- Text input-->
		<div class="form-group">
		  <label class="col-md-4 control-label" for="title">Option d'envoi</label>  
		  <div class="col-md-4">
		  <input id="title" name="title" placeholder="Nom de l'option" class="form-control input-md" required="" type="text">
		    
		  </div>
		</div>

		<!-- Textarea -->
		<div class="form-group">
		  <label class="col-md-4 control-label" for="content">Description</label>  
		  <div class="col-md-4">
		 <textarea class="form-control input-md" id="content" name="content" placeholder="Description de l'option d'envoi" required=""></textarea>
		    
		  </div>
		</div>

		<!-- Text input-->
		<div class="form-group">
		  <label class="col-md-4 control-label" for="price">Prix</label>  
		  <div class="col-md-4">
		  <input id="price" name="price" placeholder="Prix de l'option d'envoi" class="form-control input-md" required="" type="text">
		    
		  </div>
		</div>

		<div class="form-group">
		  <label class="col-md-4 control-label" for="id"></label>
		  <div class="col-md-4">
		    <button id="id" name="id" class="btn btn-info">Rajouter cette option d'envoi</button>
		  </div>
		</div>

		</fieldset>
	</form>
<?php $this->stop('main_content') ?>
