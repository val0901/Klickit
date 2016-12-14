<?php $this->layout('layoutback', ['title' => 'Mettre à jour un article ']) ?>

<?php $this->start('main_content') ?>
	<a href="<?=$this->url('listItem');?>"><button class="btn btn-info">Retour liste article</button></a>

	<div class="container">
		<div class="card">
			<div class="container-fliud">
				<div class="wrapper row">
					<div class="preview col-md-6">
						<div class="preview-pic tab-content">
						  <div class="tab-pane active" id="pic-1"><img src="<?=$affichage['picture1'];?>" /></div>
						  <div class="tab-pane active" id="pic-2"><img src="<?=$affichage['picture2'];?>" /></div>
						</div>
					</div>
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
<?php $this->stop('main_content') ?>
