<?php $this->layout('layoutback', ['title' => 'Mettre à jour un article ']) ?>

<?php $this->start('main_content') ?>
	<a href="<?=$this->url('listItem');?>"><button class="btn btn-info">Retour liste article</button></a>

	<div class="preview col-lg-6">
		<div class="preview-pic tab-content row">
			<div class="tab-pane active col-md-6" id="pic-1"><img src="<?=$affichage['picture1'];?>" /></div>
			<div class="tab-pane active col-md-6" id="pic-2"><img src="<?=$affichage['picture2'];?>" /></div>
		</div>
	</div>
	<div class="container">
		<div class="card">
			<div class="container-fliud">
				<div class="wrapper row">
					<div class="details col-md-6">
						<h3 class="product-title"><?=$affichage['name'];?></h3>
						
						<p class="product-description"><?=$affichage['description'];?></p>
						<h4 class="price">Prix d'origine : <span><?=$affichage['price'];?></span></h4>
						<?php if($affichage['newPrice'] > 0) : ?>
							<h4 class="price">Nouveau prix: <span><?=$affichage['newPrice'];?></span></h4>
						<?php elseif($affichage['newPrice'] == 0) : ?>
							<h4 class="price">Nouveau prix: <span>Pas de nouveau prix</span></h4>
						<?php endif; ?>
						
						<p>Statut du produit : <span><?=$affichage['statut'];?><span></p>
						<p>Catégorie du produit : <span><?=$affichage['category'];?><span></p>
					</div>
				</div>
			</div>
		</div>
	</div>
	<br><br>
		<?php if($success): ?>
			<p class="alert alert-success">Produit modifié</p>
		<?php elseif(isset($errors) && !empty($errors)):?>
			<p class="alert alert-danger"><?=implode('<br>', $errors);?></p>	
		<?php endif;?>
	<br><br>
	<form class="form-horizontal" method="post" enctype="multipart/form-data">
		<!-- Text input-->
		<div class="form-group">
		  <label class="col-md-4 control-label" for="name">Nom du produit</label>  
		  <div class="col-md-4">
		  <input id="name" name="name" placeholder="" class="form-control input-md" type="text" value="<?=$affichage['name'];?>">
		    
		  </div>
		</div>

		<!-- Textarea -->
		<div class="form-group">
		  <label class="col-md-4 control-label" for="description">Description</label>
		  <div class="col-md-4">                     
		    <textarea class="form-control" id="description" name="description" value="<?=$affichage['description'];?>"></textarea>
		  </div>
		</div>

		<!-- Text input-->
		<div class="form-group">
		  <label class="col-md-4 control-label" for="quantity">Quantité</label>  
		  <div class="col-md-4">
		  <input id="quantity" name="quantity" placeholder="" class="form-control input-md" type="text" value="<?=$affichage['quantity'];?>">
		    
		  </div>
		</div>

		<!-- Text input-->
		<div class="form-group">
		  <label class="col-md-4 control-label" for="newPrice">Nouveau Prix</label>  
		  <div class="col-md-4">
		  <input id="newPrice" name="newPprice" placeholder="" class="form-control input-md" type="text" value="<?=$affichage['newPrice'];?>">
		    
		  </div>
		</div>

		<!-- File Button --> 
		<div class="form-group">
		  <label class="col-md-4 control-label" for="picture1">Image 1</label>
		  <div class="col-md-4">
		    <input id="picture1" name="picture1" class="input-file" type="file">
		  </div>
		</div>

		<!-- File Button --> 
		<div class="form-group">
		  <label class="col-md-4 control-label" for="picture2">Image 2</label>
		  <div class="col-md-4">
		    <input id="picture2" name="picture2" class="input-file" type="file">
		  </div>
		</div>

		<!-- Select Basic -->
		<div class="form-group">
		  <label class="col-md-4 control-label" for="statut">Statut</label>
		  <div class="col-md-4">
		    <select id="statut" name="statut" class="form-control">
		      <option value="<?=$affichage['statut'];?>" selected disabled></option>
		      <option value="promotion">promotion</option>
		      <option value="nouveauté">nouveauté</option>
		      <option value="par defaut">par defaut</option>
		    </select>
		  </div>
		</div>

		<!-- Select Basic -->
		<div class="form-group">
		  <label class="col-md-4 control-label" for="category">Catégorie</label>
		  <div class="col-md-4">
		    <select id="category" name="category" class="form-control">
		      <option value="<?=$affichage['category'];?>" selected disabled></option>
		      <option value="PlaymobilClassique">Playmobil Classique</option>
		      <option value="PlaymobilCustom">Playmobil Custom</option>
		      <option value="PiecesDetachees">Pièces Detachées</option>
		      <option value="Divers">Divers</option>
		    </select>
		  </div>
		</div>

		<!-- Button -->
		<div class="form-group">
		  <label class="col-md-4 control-label" for="submit"></label>
		  <div class="col-md-4">
		    <button id="submit" name="submit" class="btn btn-info">Modifier le produit</button>
		  </div>
		</div>
	</form>
<?php $this->stop('main_content') ?>
