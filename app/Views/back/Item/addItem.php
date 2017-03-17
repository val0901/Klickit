<?php $this->layout('layoutback', ['title' => 'Ajouter un article ']) ?>

<?php $this->start('main_content') ?>
	<?php $_SESSION['filter'] = ''; ?>
	<a href="<?=$this->url('listItem');?>"><button class="btn btn-info">Retour à la liste des articles</button></a>
	<br>
	<?php if($success): ?>
		<p id="insert_filter" class="alert alert-success">Produit créé</p>
	<?php elseif(isset($errors) && !empty($errors)):?>
		<p class="alert alert-danger"><?=implode('<br>', $errors);?></p>	
	<?php endif;?>
	<br>
	<p id="message_filter" class=""></p>

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
		  <label class="col-md-4 control-label" for="price">Prix</label>  
		  <div class="col-md-4">
		  <input id="price" name="price" placeholder="" class="form-control input-md" type="text">
		    
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
		      <option value="promotion">promotion</option>
		      <option value="nouveaute">nouveauté</option>
		      <option value="defaut" selected>par defaut</option>
		    </select>
		  </div>
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

		<!-- Select Basic -->
		<div class="form-group">
		  <label class="col-md-4 control-label" for="subCategory">Sous-catégorie</label>
		  <div class="col-md-4">
		    <select id="subCategory" name="subCategory" class="form-control">
		    	  <option disabled><strong><span>CATÉGORIE CLASSIQUE :</span></strong></option>
			      <option value="Chevaliers">Chevaliers</option>
			      <option value="Pirates">Pirates</option>
			      <option value="Antique">Antique</option>
			      <option value="Western">Western</option>
			      <option value="Fantasy">Fantasy</option>
			      <option value="XVIIIe">XVIIIe</option>
			      <option value="FeesPrincesses">Fées et Princesses</option>
			      <option value="Police">Police</option>
			      <option value="Animaux">Animaux</option>
			      <option value="Sport">Sport</option>
			      <option value="Divers">Divers</option>
			      <option disabled><strong><span>CATÉGORIE CUSTOM :</span></strong></option>
			  	  <option value="CustomsTampographies">Customs tampographiés</option>
			  	  <option value="CustomsPeints">Customs peints</option>
			  	  <option value="BustesTampographies">Bustes tampographiés</option>
			  	  <option value="PiecesEnResine">Pièces en résine</option>
			  	  <option value="Stickers">Stickers</option>
			  	  <option disabled><strong><span>CATÉGORIE PIÈCES :</span></strong></option>
			  	  <option value="Armes">Armes</option>
			  	  <option value="Coiffes">Coiffes</option>
			  	  <option value="Manchettes">Manchettes</option>
			  	  <option value="Cols">Cols</option>
			  	  <option value="Ceinturons">Ceinturons</option>
			  	  <option value="Tetes">Têtes</option>
			  	  <option value="Cheveux">Cheveux</option>
			  	  <option value="Divers">Divers</option>
		    </select>
		  </div>
		</div>
		<p style="color:red;">/!\ Pensez à ajouter les filtres AVANT d'enregistrer le produit (dans le cas ou vous n'avez pas de filtre, veuillez les créer dans la catégorie "Filtres") /!\</p>
		<!-- Multiple Checkboxes -->
		<div class="form-group">
		  <label class="col-md-4 control-label" for="checkboxes">Filtre :</label>
		  <div class="col-md-4">
		  <?php foreach($filter as $value): ?>
			  <div class="checkbox">
			    <label for="checkboxes-0">
			      <input name="checkboxe" class="checkboxe" value="<?=$value['name'];?>" type="checkbox">
			      <?=$value['name'];?>
			    </label>
			  </div>
		  <?php endforeach; ?>
		  </div>
		  <div class="col-md-4">
		  	<button id="addFilter" style="color:black;" type="button">Ajouter les filtres</button>
		  </div>
		</div>

		<!-- Button -->
		<div class="form-group">
		  <label class="col-md-4 control-label" for="submit"></label>
		  <div class="col-md-4">
		    <button id="submit" name="submit" class="btn btn-info">Enregistrer le produit</button>
		  </div>
		</div>
	</form>

<?php $this->stop('main_content') ?>

<?php $this->start('js') ?>
	<script>
		$(document).ready(function(){
			$('#addFilter').click(function(e){
				e.preventDefault();

				var filter = '';

				var idCheck = new Array();
				$("input:checked").each(function (i) {
					idCheck[i] = $(this).val();
				});

				for (let i of idCheck) {
				    filter += i+', ';
				}

				$.ajax({
  					url: '<?=$this->url('ajax_addFilter'); ?>',
					type: 'post',
					cache: false,
					data: {filters: filter},
					dataType: 'json',
					success: function(out){
						if(out.code == 'ok'){
							$('#message_filter').addClass('#message_filter');
			  				$('#message_filter').html(out.msg);	
						}
					}
	  			});
			});

			var filterSession = '<?=$_SESSION['filter'];?>';

			var existInsertFilter = $('#insert_filter');

			if(existInsertFilter.length > 0){
				$.ajax({
  					url: '<?=$this->url('ajax_UpdateItemFilter'); ?>',
					type: 'post',
					cache: false,
					data: {fil: filterSession},
					dataType: 'json',
					success: function(out){
						if(out.code == 'ok'){
			  				console.log('yessssss');	
						}else{
							console.log('nooooooo');
						}
					}
  				});
			}
		});
	</script>
<?php $this->stop('js') ?>