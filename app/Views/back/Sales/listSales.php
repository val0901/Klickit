<?php $this->layout('layoutback', ['title' => 'Chiffre d\'affaires']) ?>

<?php $this->start('main_content') ?>

		<form method="post" class="form-inline">
			<div class="form-group">
				<input type="text" class="form-control" id="search" name="search" placeholder="Recherche ...">
			</div>
			<button type="submit" id="submit" class="btn btn-info search_order">Rechercher</button>
			<br><br>
			<div id="viewOrder">
				<table class="table table-responsive">
					<thead>
						<th>Mois</th>
						<th>Année</th>
						<th>Chiffre d'affaire</th>
					</thead>

					<tbody id="result">	
					<th></th>
					<th></th>
					<th><?=$price; var_dump($price);?></th>		
					</tbody>			
				</table>
			</div>
		</form>
				<?php $search = (isset($_GET['search']))? 'search='. $_GET['search'].'&' :'';?>
					<div id="pagination">
						<?= ($page!=1) ? '<a href="?'. $search .'page='. ($page - 1) .'"><i class="fa fa-arrow-left fa-fw"></i></a>':''; ?>
						Page <?= $page; ?> <?= ($nb>=1) ? '/ '.ceil($nb/$max) :''; ?>
						<?= ($nb < 1 ) ? '' : ($page!= ceil($nb/$max) ? '<a href="?'. $search .'page='. ($page + 1) .'"><i class="fa fa-arrow-right fa-fw" aria-hidden="true"></i></a>':''); ?>
					</div>		
		</div>


	

<?php $this->stop('main_content') ?>

