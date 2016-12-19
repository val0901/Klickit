<?php $this->layout('layoutback', ['title' => 'Mettre à jour un article ']) ?>

<?php $this->start('main_content') ?>
	<a href="<?=$this->url('listItem');?>"><button class="btn btn-info">Retour liste article</button></a>
	<h3 class="titleItem">Vu du produit</h3>
	<div id="view" class="row">
		<div class="preview col-lg-6">
			
				<div class="preview-pic row">
					<div class="tab-pane active col-sm-6" id="pic-1"><img src="<?=$this->assetUrl('art/'.$affichage['picture1']);?>" /></div>
					<div class="tab-pane active col-sm-6" id="pic-2"><img src="<?=$this->assetUrl('art/'.$affichage['picture2']);?>" /></div>
				</div>
			
		</div>
		
					
						<div class="details col-lg-6">
							<h3 class="titleArt"><?=$affichage['name'];?></h3>
							
							<p class="price"><?=$affichage['description'];?></p>
							<p class="price"><span>Prix d'origine : </span> <?=$affichage['price'];?> €</p>
							<?php if($affichage['newPrice'] > 0) : ?>
								<p class="price"><span>Nouveau prix : </span><?=$affichage['newPrice'];?> €</p>
							<?php elseif($affichage['newPrice'] == 0) : ?>
								<p class="price"><span>Nouveau prix :</span> Pas de nouveau prix</p>
							<?php endif; ?>
							
							<p class="price"><span>Statut du produit : </span> <?=$affichage['statut'];?></p>
							<p class="price"><span>Catégorie du produit : </span> <?=$affichage['category'];?></p>
						</div>
	</div>
	<br><br>

	<h3>Modification du produit</h3>

	<br><br>
		<?php if($success): ?>
			<p id="reload" class="alert alert-success">Produit modifié</p>
		<?php elseif(isset($errors) && !empty($errors)):?>
			<p class="alert alert-danger"><?=implode('<br>', $errors);?></p>	
		<?php endif;?>
	<br><br>
	<form class="form-horizontal" method="post" enctype="multipart/form-data">
		<!-- Text input-->
		<div class="form-group">
		  <label class="col-md-4 control-label" for="name">Nom du produit</label>  
		  <div class="col-md-4">
		  <input id="name" name="name" placeholder="" class="form-control input-md" type="text">
		    
		  </div>
		</div>

		<!-- Textarea -->
		<div class="form-group">
		  <label class="col-md-4 control-label" for="description">Description</label>
		  <div class="col-md-4">                     
		    <textarea class="form-control" id="description" name="description"></textarea>
		  </div>
		</div>

		<!-- Text input-->
		<div class="form-group">
		  <label class="col-md-4 control-label" for="quantity">Quantité</label>  
		  <div class="col-md-4">
		  <input id="quantity" name="quantity" placeholder="" class="form-control input-md" type="text">
		    
		  </div>
		</div>

		<!-- Text input-->
		<div class="form-group">
		  <label class="col-md-4 control-label" for="newPrice">Nouveau Prix</label>  
		  <div class="col-md-4">
		  <input id="newPrice" name="newPrice" placeholder="" class="form-control input-md" type="text">
		    
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
		      <option selected disabled></option>
		      <option value="promotion">promotion</option>
		      <option value="nouveaute">nouveauté</option>
		      <option value="defaut">par defaut</option>
		    </select>
		  </div>
		</div>

		<!-- Select Basic -->
		<div class="form-group">
		  <label class="col-md-4 control-label" for="category">Catégorie</label>
		  <div class="col-md-4">
		    <select id="category" name="category" class="form-control">
		      <option selected disabled></option>
		      <option value="PlaymobilClassique">Playmobil Classique</option>
		      <option value="PlaymobilCustom">Playmobil Custom</option>
		      <option value="PiecesDetachees">Pièces Detachées</option>
		      <option value="Divers">Divers</option>
		    </select>
		  </div>
		</div>

		<!-- Select Basic -->
		<div class="form-group">
		  <label class="col-md-4 control-label" for="subCategory">Sous-catégorie</label>
		  <div class="col-md-4">
		    <select id="subCategory" name="subCategory" class="form-control">
		    	  <option selected disabled></option>
			      <option value="Chevaliers">Chevaliers</option>
			      <option value="Pirates">Pirates</option>
			      <option value="Antique">Antique</option>
			      <option value="Western">Western</option>
			      <option value="Fantasy">Fantasy</option>
			      <option value="XVIIIe">XVIIIe</option>
			      <option value="Fées Princesses">Fées et Princesses</option>
			      <option value="Police">Police</option>
			      <option value="Animaux">Animaux</option>
			      <option value="Sport">Sport</option>
			      <option value="Divers">Divers</option>
			  	  <option value="CustomsTampographies">Customs tampographiés</option>
			  	  <option value="CustomsPeints">Customs peints</option>
			  	  <option value="BustesTampographies">Bustes tampographiés</option>
			  	  <option value="PiecesEnResine">Pièces en résine</option>
			  	  <option value="Stickers">Stickers</option>
			  	  <option value="Armes">Armes</option>
			  	  <option value="Coiffes">Coiffes</option>
			  	  <option value="Manchettes">Manchettes</option>
			  	  <option value="Cols">Cols</option>
			  	  <option value="Ceinturons">Ceinturons</option>
			  	  <option value="Têtes">Têtes</option>
			  	  <option value="Cheveux">Cheveux</option>
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

<?php $this->start('js') ?>
	<script>
		var affichage = document.getElementById('view');

		if (document.getElementById('reload')) {
			affichage.location.href=affichage.location.href;
		}
	</script>
<?php $this->stop('js') ?>