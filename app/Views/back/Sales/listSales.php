<?php $this->layout('layoutback', ['title' => 'Chiffre d\'affaires']) ?>

<?php $this->start('main_content') ?>
		<div id="errorUpdate" style="color:white;"></div>
		<form method="post" class="form-inline">
			<div class="form-group">
				<button id="salesRevenu" type="button" class="btn btn-info">Mettre à jour le chiffre d'affaire</button>
			</div>
			<br><br>
			<div class="form-group">
				<input type="text" class="form-control" id="search" name="search" placeholder="Recherche ...">
			</div>
			<button type="submit" id="submit" class="btn btn-info search_sales">Rechercher</button>
			<br><br>
			<div id="viewOrder">
				<table class="table table-responsive">
					<thead>
						<th>Mois</th>
						<th>Année</th>
						<th>Chiffre d'affaire</th>
					</thead>

					<tbody id="result">
						<?php foreach($sales as $salesValue) : ?>
							<tr>
								<td><?=$salesValue['month'];?></td>
								<td><?=$salesValue['year'];?></td>
								<td><?=$salesValue['revenue'];?>€</td>
							</tr>
						<?php endforeach; ?>	
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

<?php $this->start('js') ?>
	<script>
		$(document).ready(function(){
			$('#salesRevenu').click(function(e){
				e.preventDefault();

				var ok = '';

				$.ajax({
					url: '<?=$this->url('ajax_salesRevenu');?>',
					type: 'post',
					cache: false,
					data: {update: ok},
					dataType: 'json',
					success: function(ok){
						if(ok.code == 'ok'){
							$('body').load('<?=$this->url('listSales');?>');
						}
						else if(ok.code == 'no'){
							$('#errorUpdate').html(ok.msg);
						}
					}
				});
			});

		/**** RECHERCHE EN AJAX ****/
			$('.search_sales').click(function(e){
				e.preventDefault();

				$.ajax({
					url: '<?=$this->url('ajax_searchSales');?>',
					type: 'get',
					cache: false,
					data: $('#search'),
					dataType: 'json',
					success: function(search){
						$('#result').html(search.msg);
					}
				});
			});
		});
	</script>
<?php $this->stop('js') ?>