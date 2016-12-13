<!DOCTYPE html>
	<html lang="fr">
		<head>
			<meta charset="UTF-8">
			<title><?= $this->e($title) ?></title>

			<link href="https://fonts.googleapis.com/css?family=Advent+Pro|Roboto:400,700" rel="stylesheet">

			<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
			<link rel="stylesheet" href="<?= $this->assetUrl('css/font-awesome.min.css') ?>">
			<link rel="stylesheet" href="<?= $this->assetUrl('css/styleback.css') ?>">
			<link rel="stylesheet" href="<?= $this->assetUrl('css/jquery-confirm.min.css') ?>">
		</head>

		<body>
			<div class="cont">
				<header>

					<nav class="navbar navbar-default">
					        <!-- Brand and toggle get grouped for better mobile display -->
					        <div class="navbar-header">
					          <a class="navbar-brand" href="#">Klickit</a>
					        </div>
					        <div class="navbar navbar-right">
						        <ul>
						        	<?php if(!empty($_SESSION)): ?>
							        	<li><a href="">Bonjour <?=$_SESSION['user']['firstname'].' '.$_SESSION['user']['lastname'];?></a></li>
							        	<li><form><button id="logout" type="submit">Se déconnecter</button></form></li>
							        <?php endif; ?>
						        </ul>
					        </div>	     
					    </nav><!-- /.navbar -->
					  

				<!-- MENU NAVIGATION -->
					<div class="container-fluid">
					    <!-- Second navbar for categories -->
					    <nav class="navbar navbar-default">
					      <div class="container">		     
					    	
					        <!-- Collect the nav links, forms, and other content for toggling -->
					        <div class="collapse navbar-collapse" id="navbar-collapse-1">
					          <ul class="nav navbar-nav navbar-justified
					          ">
					            <li><a href="#">Accueil</a></li>
					            <li><a href="#">Admin</a></li>
					            <li><a href="#">Utilisateur</a></li>
					            <li><a href="#">Message</a></li>
					            <li><a href="#">Evènement</a></li>
					            <li><a href="#">Slide</a></li>
					            <li><a href="#">Article</a></li>
					            <li><a href="#">Commande</a></li>
					            <li><a href="#">Option d'envoi</a></li>
					            <li><a href="#">Livre d'Or</a></li>
					          </ul>
					        </div><!-- /.navbar-collapse -->
					      </div><!-- /.container -->
					    </nav><!-- /.navbar -->
					</div><!-- /.container-fluid -->
					
				</header>

				<div class="container">
					<section>
						<?= $this->section('main_content') ?>
					</section>
				</div>

				<footer>
					<script src="https://code.jquery.com/jquery-3.1.1.min.js" integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8=" crossorigin="anonymous"></script>
					<script src="<?= $this->assetUrl('js/jquery-confirm.min.js') ?>"></script>
				  	<script>
				  		$(document).ready(function(){
				  			$('#logout').click(function(e){
				  				e.preventDefault();

							$.confirm({

								title: 'Déconnexion',

								content: "Êtes-vous sûr de vouloir vous déconnecter ?",

								type: 'red',

								theme: 'dark',

								buttons: {
	    							ok: {
	    								text: 'Se déconnecter',
	    								btnClass: 'btn-danger',
            							keys: ['enter'],
	    								action: function(){
							  				$.ajax({
							  					url: '<?=$this->url('ajax_logout'); ?>',
												type: 'post',
												cache: false,
												data: $('form').serialize(),
												dataType: 'json',
												success: function(out){
													if(out.code == 'ok'){
										  					
													}
												}
							  				});
							  				setInterval(function(){
												$('body').load($(location).attr('href'));
											});
						  				}
					  				},
					  				cancel: function(button) {
									   
									}
								}
				  			});

				  			});
				  		});
				  	</script>
				  	<?= $this->section('js') ?>
				</footer>
			</div>
		</body>
	</html>