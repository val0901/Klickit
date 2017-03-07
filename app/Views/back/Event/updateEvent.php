<?php $this->layout('layoutback', ['title' => 'Mettre à jour l\'évènement']) ?>

<?php $this->start('main_content') ?>
	<a href="<?=$this->url('listEvent');?>"><button class="btn btn-info">Retour liste des évènements</button></a>
	<h3 class="titleItem">Vu de l'évènement</h3>
	<div id="view" class="row col-lg-12">
		<div class="preview">
			
            <div class="preview-pic row">
                <div class="tab-pane active col-sm-12 vignevent" id="pic-1">
                    <img class="imgevent" src="<?=$this->assetUrl('events/'.$affichage['picture']);?>">
                </div>
            </div>
			
		</div>
					
		<div class="details">
			<h3 class="titleArt"><?=$affichage['title'];?></h3>
		</div>
	</div>

	<br class="optimphone"><br class="optimphone">

	<h3>Modification de l'évènement</h3>

	<br class="optimphone"><br class="optimphone">
		<?php if($success): ?>
			<p id="reload" class="alert alert-success">Évènement modifié</p>
		<?php elseif(isset($errors) && !empty($errors)):?>
			<p class="alert alert-danger"><?=implode('<br>', $errors);?></p>	
		<?php endif;?>
	<br class="optimphone"><br class="optimphone">
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
		  <label class="col-md-4 control-label" for="picture">Affiche de l'évènement</label>
		  <div class="col-md-4">
		    <input id="picture" name="picture" class="input-file" type="file">
		  </div>
		</div>

		<!-- Button -->
		<div class="form-group">
		  <label class="col-md-4 control-label" for="submit"></label>
		  <div class="col-md-4">
		    <button id="submit" name="submit" class="btn btn-info">Enregistrer l'évènement</button>
		  </div>
		</div>
	</form>
<?php $this->stop('main_content') ?>

<?php $this->start('js') ?>
	<script>
		
	</script>
<?php $this->stop('js') ?>