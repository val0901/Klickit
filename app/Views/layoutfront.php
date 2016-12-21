<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="vente de playmobils customisés neuf occasion playmobil napoléon western pirate fée princesses police robots espace animaux sport tampographie customs accessoires  stickers résine">
    <meta name="author" content="Laurent Lafont" />
    <meta name="copyright" content="© Klickit Inc." />


        <meta name="robots" content="index, follow, archive">

         <!-- Méta FB -->
        <meta property="og:title" content="Titre contenuFB">
        <meta property="og:description" content="Description courte et UNIQUE">
        <meta property="og:locale" content="fr_FR">
        <meta property="og:site_name" content="Nom du site web">
        <meta property="og:image" content="http://adressedemonimage600x315.jpg">
        <meta property="og:type" content="website"><!-- voir ogp.me/*types -->
        <!-- FIN Méta FB -->

        <!-- Méta GOOGLE+ -->
        <meta itemprop="name" content="Titre contenu G+">
        <meta itemprop="description" content="Tdescription courte et unique G+">
        <meta itemprop="image" content="http://adressedemonimage400x160.jpg G+">
        <!-- FIN Méta G+ -->

        <!-- Méta TWITTER -->
        <meta name="twitter:card" content="summary"><!-- il faut écrire summary (=résumé) -->
        <meta name="twitter:site" content="@idtwitter"><!-- que si on a un compte twitter actif-->
        <meta name="twitter:title" content="titre de la page">
        <meta name="twitter:description" content="description de la page">
        <meta name="twitter:image" content="url image">
        <!-- FIN Méta TWITTER -->
    
    
    
    
	<title><?= $this->e($title) ?></title>
    
    <!--google fonts-->
    <link href="https://fonts.googleapis.com/css?family=Advent+Pro:400,700" rel="stylesheet"> 
	<link href="https://fonts.googleapis.com/css?family=Roboto:300" rel="stylesheet"> 
    <!--fontawsome style-->
    <link rel="stylesheet" href="<?= $this->assetUrl('css/font-awesome.min.css') ?>">
    <!-- bootstrap style-->
    <link rel="stylesheet" href="<?= $this->assetUrl('css/bootstrap.css') ?>">
    <!-- styles index-->
    <link rel="stylesheet" href="<?= $this->assetUrl('css/style.css') ?>">
    <link rel="stylesheet" href="<?= $this->assetUrl('css/mediaquery.css') ?>">
    <!-- styles page event-->
    <link rel="stylesheet" href="<?= $this->assetUrl('css/stylebis.css') ?>">
    <link rel="stylesheet" href="<?= $this->assetUrl('css/eventmediaquery.css') ?>">

    
</head>
<body>
	<div class="container_general">
		<header>
            <div class="nav_left">
            <a href="<?=$this->url('front_index');?>"><img src="<?=$this->assetUrl('/img/KLICKIT-logo-napoleon.png');?>"></a>
            <p class="baseline_text">Créez l'histoire !</p>
            </div>
            
            <div class="nav_right">
                <ul>
                    <!--icon-cog menu-->
                    <li class="span_float">
                        <i class="fa fa-cog fa-5x icon_cursor navR_color" aria-hidden="true" id="cogicon_click"></i>
                        <div class="cogsoumenu_hidden">
                            <div class="soumenu_text">
                                <select class="form-control">
                                    <option selected disabled>--Language--</option>
                                    <option>English</option>
                                    <option>French</option>
                                    <option>Spanish</option>
                                    <option>Germony</option>
                                </select>
                            </div>
                            <div class="soumenu_text">
                            <select>
                                    <option selected disabled>--Currency--</option>
                                    <option>Dollar(USD)</option>
                                    <option>Euro(EUR)</option>
                                </select>
                            </div>
                        </div>
                    </li>
                    <!--End icon-cog menu-->
                    
                    <!--icon-user menu-->
                    <li class="span_float">
                    	<?php if(empty($_SESSION['user']) && !isset($_SESSION['user'])) : ?>
                        	<a href="<?=$this->url('login');?>"><i class="fa fa-user fa-5x icon_cursor navR_color" aria-hidden="true" id="usericon_click"></i></a>
                        <?php elseif(isset($_SESSION['user']) && !empty($_SESSION['user'])) : ?>
                        	<a href="<?=$this->url('front_affcptuser', ['id' => $_SESSION['user']['id']]);?>"><i class="fa fa-user fa-5x icon_cursor navR_color" aria-hidden="true" id="usericon_click"></i></a>
                    	<?php endif; ?>
                    </li>
                    <!--End icon-user menu-->
                    
                    <!--icon-shoppingcart-->
                    <li class="span_float">
                        <i class="fa fa-shopping-cart fa-5x icon_cursor navR_color fa-fw" aria-hidden="true" id="shoppingicon_click"></i>
						<!--<span class="shoppingcart_quantity">1</span>-->
						<div class="shoppingsoumenu_hidden">
							<div class="row item_cart" style="margin: 10px 10px 0 10px;">
							<!-- Mise à jour du panier avec AJAX-->
							</div>
							<br><br>
							<div class="row" style="margin: 0 10px;border-top:1px dotted #000;padding-top:10px;">
								<div class="col-xs-6 shoppingmenu_total">
									<p>Expédition:</p>
								</div>
								<div class="col-xs-6 shoppingmenu_total" style="text-align:right;">
									<p>2.60 €</p>
								</div>
							</div>
							<div class="row" style="margin: 0 10px;">
								<div class="col-xs-6 shoppingmenu_total">
									<p>Total:</p>
								</div>
								<div class="col-xs-6 shoppingmenu_total" style="text-align:right;">
									<p>11.60 €</p>
								</div>
							</div>
							<div>
								<button type="button" class="btn btn-primary shoppingmenu_button">VOIR PANIER</button>
							</div>
                        </div>
                    </li>
                    <!--End icon-shoppingcart-->
					
					<!--icon-cog menu-->
                    <li class="span_float">
                    	<?php if(!empty($_SESSION['user']) && isset($_SESSION['user'])): ?>
                        	<form><button id="logout" type="submit" data-id="login_out"><i class="fa fa-sign-out fa-5x icon_cursor navR_color" aria-hidden="true" id="cogicon_click" title="Deconnexion" style="color: #ea2229;"></i></button></form>
                        <?php endif; ?>
                    </li>
                    <!--End icon-cog menu-->
                </ul>
            </div>      
        </header>
</div>
	
<div class="clear"></div>
<!--nav-->
<nav class="navbar navbar-default">
<div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
    </div>
    
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
    <ul style="margin:0;padding:0;">
		<!--menu icon home-->
        <li class="navlicon_width HM_bgcolor"><a href="<?=$this->url('front_index');?>"><i class="fa fa-home" aria-hidden="true"></i><span class="sr-only">(current)</span></a></li>
		<!--End menu icon home-->
        
        <!--menu tous les articles-->
		<li class="navli_width TLA_bgcolor">
          <a href="#" class="dropdown-toggle slidetoggle linknav" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" style="padding: 15px;">Tous les articles
          </a>
          <ul class="dropdown-menu TLA_dropdownbox_width">
			  <div class="row">
				  <div class="col-lg-3 col-md-6 soumenu_TLA_height">
					  <div class="soumenu_TLA_text">
						  <li style="float:left;">Classic<li>
						  <li style="float:right;"><i class="fa fa-plus faplus_color plus_classic" aria-hidden="true" id="plusclassic_hide"></i><i class="fa fa-minus faminus_color minus_classic" aria-hidden="true" id="faminus_hide"></i></li>
						  <div class="clear"></div>
						  <ul class="soumenu_classics_text">
							  <li>Chevaliers</li>
							  <li>Pirates</li>
							  <li>Antique</li>
							  <li>Western</li>
							  <li>Fantasy</li>
							  <li>XVIIIe</li>
							  <li>Fées & Princesses</li>
							  <li>Police</li>
							  <li>Animaux</li>
							  <li>Sport</li>
							  <li>Divers</li>
					  	  </ul>
					  </div>
				  </div>
				  <div class="col-lg-3 col-md-6 soumenu_TLA_height">
					  <div class="soumenu_TLA_text">
						  <li style="float:left;"><a href="<?=$this->url('listItemCustomFull');?>">Customs<li>
						  <li style="float:right;"><i class="fa fa-plus faplus_color plus_customs" aria-hidden="true" id="pluscustoms_hide"></i><i class="fa fa-minus faminus_color minus_customs" aria-hidden="true" id="faminus1_hide"></i></li>
						  <div class="clear"></div>
						  <ul class="soumenu_customs_text">
							  <li><a id="customsmenu_scat" href="<?=$this->url('listItemCustoms', ['sub_category'=>'CustomsTampographies']);?>" style="color:#000;">Customs Tampographiés</a></li>
							  <li><a id="customsmenu_scat" href="<?=$this->url('listItemCustoms', ['sub_category'=>'CustomsPeints']);?>" style="color:#000;">Customs peints</a></li>
							  <li><a id="customsmenu_scat" href="<?=$this->url('listItemCustoms', ['sub_category'=>'BustesTampographies']);?>" style="color:#000;">Bustes Tampographiés</a></li>
							  <li><a id="customsmenu_scat" href="<?=$this->url('listItemCustoms', ['sub_category'=>'PiecesEnResine']);?>" style="color:#000;">Pièces en résine</a></li>
							  <li><a id="customsmenu_scat" href="<?=$this->url('listItemCustoms', ['sub_category'=>'Stickers']);?>" style="color:#000;">Stickers</a></li>
					  	  </ul>
					  </div>
				  </div>
				  <div class="col-lg-3 col-md-6 soumenu_TLA_height">
					  <div class="soumenu_TLA_text">
						  <li style="float:left;">Pieces détachées<li>
						  <li style="float:right;"><i class="fa fa-plus faplus_color plus_pieces" aria-hidden="true" id="pluspieces_hide"></i><i class="fa fa-minus faminus_color minus_pieces" aria-hidden="true" id="faminus2_hide"></i></li>
						  <div class="clear"></div>
						  <ul class="soumenu_pieces_text">
							  <li>Armes</li>
							  <li>Coiffes</li>
							  <li>Manchettes</li>
							  <li>Cols</li>
							  <li>Ceinturons</li>
							  <li>Têtes</li>
							  <li>Cheveux</li>
							  <li>Divers</li>
					  	  </ul>
					  </div>
				  </div>
				  <div class="col-lg-3 col-md-6 soumenu_TLA_height">
					  <div class="soumenu_TLA_text">
						  <li style="float:left;">Boites/Set<li>
						  <li style="float:right;"><i class="fa fa-plus faplus_color plus_boites" aria-hidden="true" id="plusboites_hide"></i><i class="fa fa-minus faminus_color minus_boites" aria-hidden="true" id="faminus3_hide"></i></li>
						  <div class="clear"></div>
						  <ul class="soumenu_boites_text">
							  <!--<li>fadsfdsf</li>
							  <li>fadsfdsf</li>
							  <li>fadsfdsf</li>
							  <li>fadsfdsf</li>-->
					  	  </ul>
					  </div>
				  </div>
			  </div>
          </ul>
        </li>
		<!--End menu tous les articles-->
        
        <!--menu a propos-->
		<li class="navli_width AP_bgcolor"><a class=" linknav" href="<?=$this->url('front_aPropos');?>">A propos</a></li>
		<!--End menu a propos-->
		
		<!--menu eventmentiel-->
        <li class="navli_width EVT_bgcolor"><a class=" linknav" href="<?=$this->url('front_events');?>">Evènementiel</a></li>
		<!--End menu eventmentiel-->
        
		<!--menu contact--> 
        <li class="navli_width CT_bgcolor"><a class=" linknav" href="<?=$this->url('front_contact');?>">Contact</a></li>
		<!--End menu contact-->
		
		<!--menu icon search-->
		<ul class="navbar-right search_dropdownbox_width" style="width: 100%; padding: 0; margin: 0;">
			<li class="navlicon_width dropdown">
			  <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fa fa-search search_padding" aria-hidden="true"></i>
			  </a>
			  <ul class="dropdown-menu soumenu_search">
				  <div class="row" style="margin:0;padding:0;">
					  <div class="col-md-3 col3_back">
						  <div class="colmarginL colLtitle_fontsize">Résultat :</div>
						  <p class="colLtext_fontsize"><span class="colmarginL colLtitle_fontsize">10 articles </span>correspondent à votre recherche</p>
					  </div>
					  <div class="col-md-9 colmarginL colR_back">
						  <div class="colmarginL ipad_padding"> <div class="form-group">
								<div class="input-group searchbar_margin">
									<input type="text" class="form-control" placeholder="Cherchez de filtres..." name="search" id="search" value="">
									<div class="input-group-addon btn btn-primary">
									<button type="submit" name="submit" id="submit" style="background:transparent;border:none;">
									<i class="fa fa-search" aria-hidden="true"></i>	
									</button>
								  </div>
								</div>
  							</div>  
						  </div>
						  <!--search details-->
						  <div class="row colmarginL">
							  <!--search detail col1-->
							  <div class="col-lg-4 col-md-6">
								  <form class="form-horizontal">
									  <div class="form-group">
										<div class="col-sm-offset-2 col-sm-10 checkbox_height">
											<label class="checkbox_border">
												<input type="checkbox"> <span class="checkbox_font"> Customs Tampographiés</span>
											</label>
										</div>
										<div class="col-sm-offset-2 col-sm-10 checkbox_height">
											<label class="checkbox_border">
												<input type="checkbox"> <span class="checkbox_font"> Customs peints</span>
											</label>
										</div>
										<div class="col-sm-offset-2 col-sm-10 checkbox_height">
											<label class="checkbox_border">
												<input type="checkbox"> <span class="checkbox_font"> Bustes tampographiés</span>
											</label>
										</div>
										<div class="col-sm-offset-2 col-sm-10 checkbox_height">
											<label class="checkbox_border">
												<input type="checkbox"> <span class="checkbox_font"> Pièces en résine</span>
											</label>
										</div>
										<div class="col-sm-offset-2 col-sm-10 checkbox_height">
											<label class="checkbox_border">
												<input type="checkbox"> <span class="checkbox_font"> Stickers</span>
											</label>
										</div>
									  </div>
								  </form>
							  </div>
							  <!--End search detail col1-->
							  
							  <!--search detail col2-->
							  	<div class="col-lg-4 col-md-6">
								  <form class="form-horizontal">
									  <div class="form-group">
										<div class="col-sm-offset-2 col-sm-10 checkbox_height">
											<label class="checkbox_border">
												<input type="checkbox"> <span class="checkbox_font"> Customs Tampographiés</span>
											</label>
										</div>
										<div class="col-sm-offset-2 col-sm-10 checkbox_height">
											<label class="checkbox_border">
												<input type="checkbox"> <span class="checkbox_font"> Customs peints</span>
											</label>
										</div>
										<div class="col-sm-offset-2 col-sm-10 checkbox_height">
											<label class="checkbox_border">
												<input type="checkbox"> <span class="checkbox_font"> Bustes tampographiés</span>
											</label>
										</div>
										<div class="col-sm-offset-2 col-sm-10 checkbox_height">
											<label class="checkbox_border">
												<input type="checkbox"> <span class="checkbox_font"> Pièces en résine</span>
											</label>
										</div>
										<div class="col-sm-offset-2 col-sm-10 checkbox_height">
											<label class="checkbox_border">
												<input type="checkbox"> <span class="checkbox_font"> Stickers</span>
											</label>
										</div>
									  </div>
								  </form>
							  </div>
							  <!--End search detail col2-->
							  
							  <!--search detail col3-->
							  <div class="col-lg-4 col-md-6">
								  <form class="form-horizontal">
									  <div class="form-group">
										<div class="col-sm-offset-2 col-sm-10 checkbox_height">
											<label class="checkbox_border">
												<input type="checkbox"> <span class="checkbox_font"> Customs Tampographiés</span>
											</label>
										</div>
										<div class="col-sm-offset-2 col-sm-10 checkbox_height">
											<label class="checkbox_border">
												<input type="checkbox"> <span class="checkbox_font"> Customs peints</span>
											</label>
										</div>
										<div class="col-sm-offset-2 col-sm-10 checkbox_height">
											<label class="checkbox_border">
												<input type="checkbox"> <span class="checkbox_font"> Bustes tampographiés</span>
											</label>
										</div>
										<div class="col-sm-offset-2 col-sm-10 checkbox_height">
											<label class="checkbox_border">
												<input type="checkbox"> <span class="checkbox_font"> Pièces en résine</span>
											</label>
										</div>
										<div class="col-sm-offset-2 col-sm-10 checkbox_height">
											<label class="checkbox_border">
												<input type="checkbox"> <span class="checkbox_font"> Stickers</span>
											</label>
										</div>
									  </div>
								  </form>
							  </div>
							  <!--End search detail col3-->
						  </div>
					  </div>
				  </div>
			  </ul>
			</li>
		</ul>
		<!--End nav icon search-->
    </ul>
    </div>
</div>
</nav>
<!--End nav-->
		<section>
			<?= $this->section('main_content') ?>
		</section>

	<!--footer-->
	<footer>
	<div class="footer_largestyle">
	<br>
		<div class="container_general footercontainer_height">
			<li class="footercol1_float">
			<div class="row footerrow_margin">
				<div class="col-md-4 etiq_width">
					<img src="<?=$this->assetUrl('/img/etiq1large.png');?>" alt="" style="margin: 10px 0;">
				</div>
				<div class="col-md-4 etiq_width">
					<img src="<?=$this->assetUrl('/img/etiq2large.png');?>" alt="">
				</div>
				<div class="col-md-4 etiq_width">
					<img src="<?=$this->assetUrl('/img/etiq3large.png');?>" alt="">
				</div>
			</div>
			</li>
			
			<li class="footercol2_margin">
			<div class="row footerrow_margin">
				<div class="col-md-4 etiq_width">
					<p class="footertitle">Société</p>
						<a href="<?=$this->url('front_legalMention');?>"><p class="footertext">Mentions légales</p></a>				
						<a href="<?=$this->url('front_cgv');?>"><p class="footertext">Condition Générales de Ventes</p></a>
						<a href="<?=$this->url('front_createEvent');?>"><p class="footertext">Création d'évènement Playmobil</p></a>
						<a href="<?=$this->url('front_contact');?>"><p class="footertext">Contact</p></a>
						<a href="<?=$this->url('front_team');?>"><p class="footertext">Equipe de création</p></a>
						<a href="<?=$this->url('fGuestbook');?>"><p class="footertext">Laissez nous votre avis</p></a>
					</div>
					<div class="col-md-4 etiq_width">
						<p class="footertitle">Suivez-nous</p>
						<a href="https://www.facebook.com/Klickit-787164048000917/" target="_blank"><i class="fa fa-facebook-square fa-2x footer_neticon" aria-hidden="true"> <span class="footertext">Sur Facebook</span></i></a>
						<a href=" https://twitter.com/Klickit33" target="_blank"><i class="fa fa-twitter-square fa-2x footer_neticon" aria-hidden="true"> <span class="footertext">Sur Twitter</span></i></a>
					
				</div>
				<div class="col-md-4 etiq_width">
					<img src="<?=$this->assetUrl('/img/napoleonlarge.png');?>" alt="" class="footerimg_hide">
				</div>
			</div>
			</li>
			
			<!--copyright-->
			<div class="footertext">&copy; Klickit, Tous droits réservés</div>
    	</div>
	</div>
		
	<div class="footer_smallstyle">
	<br>
		<div class="container_general footercontainer_height">
			<div class="row">
				<div class="col-xs-6 etiq_width_small">
					<img src="<?=$this->assetUrl('/img/etiq1large.png');?>" alt="" style="margin: 10px 0;">
					<img src="<?=$this->assetUrl('/img/etiq2large.png');?>" alt="">
					<img src="<?=$this->assetUrl('/img/etiq3large.png');?>" alt="">
				</div>
				<div class="col-xs-6 etiq_width_small">
					<p class="footertitle">Société</p>
					<a href="<?=$this->url('front_legalMention');?>"><p class="footertext">Mentions légales</p></a>
					<a href="<?=$this->url('front_cgv');?>"><p class="footertext">Condition Générales de Ventes</p></a>
					<a href="<?=$this->url('front_createEvent');?>"><p class="footertext">Création d'évènement Playmobil</p></a>
					<a href="<?=$this->url('front_contact');?>"><p class="footertext">Contact</p></a>
					<a href="<?=$this->url('front_team');?>"><p class="footertext">Equipe de création</p></a>
					<a href="<?=$this->url('fGuestbook');?>"><p class="footertext">Laissez nous votre avis</p></a>
					<br>
					<p class="footertitle">Suivez-nous</p>
					<a href="https://www.facebook.com/Klickit-787164048000917/" target="_blank"><i class="fa fa-facebook-square fa-2x footer_neticon" aria-hidden="true"> <span class="footertext">Sur Facebook</span></i></a>
					<a href=" https://twitter.com/Klickit33" target="_blank"><i class="fa fa-twitter-square fa-2x footer_neticon" aria-hidden="true"> <span class="footertext">Sur Twitter</span></i></a>
				</div>
			</div>
			
			<!--copyright-->
			<br><br>
			<div class="footertext">&copy; Klickit, Tous droits réservés</div>
		</div>
	</div>
    </footer>
	<!--End footer-->

	<!--jquery js-->
    <script src="<?= $this->assetUrl('js/jquery-3.1.1.min.js') ?>"></script>   
    <!--Plugin Jquery, confirm -->
    <script src="<?= $this->assetUrl('js/jquery-confirm.min.js') ?>"></script>
    <!--bootstrap js-->
   <script src="<?= $this->assetUrl('js/bootstrap.min.js') ?>"></script>

    <?= $this->section('js')?>

	<!--Script-->
	<script>

	/*ICONE DE DECONNEXION*/
$(document).ready(function(){
	$('#logout').click(function(e){
		e.preventDefault();
		var logout = $(this).data('id');
	$.confirm({

		title: 'Déconnexion',

		content: "Êtes-vous sûr de vouloir vous déconnecter ?",

		theme: 'supervan',

		buttons: {
			ok: {
				text: 'Se déconnecter',
				btnClass: 'btn-danger',
				keys: ['enter'],
				action: function(){
	  				$.ajax({
	  					url: '<?=$this->url('ajax_Flogout');?>',
						type: 'post',
						cache: false,
						data: {id_logout: logout},
						dataType: 'json',
						success: function(out){
							if(out.code == 'ok'){
				  				window.location.reload(true);	
							}
						}
	  				});
	  				
  				}
				},
				cancel: function(button) {
			   
			}
		}
		});

	});
});

	/*soumenu 4 categories*/
    $(document).ready(function(){
    $("#cogicon_click").click(function(){
        $(".cogsoumenu_hidden").slideToggle();
    })
    /*$(document).click(function(){
        $(".cogsoumenu_hidden").hide();
    })*/
})
    /*$(document).ready(function(){
    $("#usericon_click").click(function(){
        $(".usersoumenu_hidden").slideToggle();
    })
})*/
	/*place de classics*/
	$(document).ready(function(){
    $("#shoppingicon_click").click(function(){
        $(".shoppingsoumenu_hidden").slideToggle();
    })
})	
	
	$(document).ready(function(){
		$(".slidetoggle").click(function(){
			$(".TLA_dropdownbox_width").slideToggle();
		})
		$(".plus_classic").click(function(){
			$(".soumenu_classics_text li").show();
			$(".soumenu_customs_text li").hide();
			$(".soumenu_pieces_text li").hide();
			$(".soumenu_boites_text li").hide();
			$("#plusclassic_hide").hide();
			$("#pluscustoms_hide").show();
			$("#pluspieces_hide").show();
			$("#plusboites_hide").show();
			$("#faminus_hide").show();
			$("#faminus1_hide").hide();
			$("#faminus2_hide").hide();
			$("#faminus3_hide").hide();
			$(".TLA_dropdownbox_width").css("display", "block");
		})
	})
	
	$(document).ready(function(){
		$(".minus_classic").click(function(){
			$(".soumenu_classics_text li").hide();
			$(".soumenu_customs_text li").hide();
			$(".soumenu_pieces_text li").hide();
			$(".soumenu_boites_text li").hide();
			$("#plusclassic_hide").show();
			$("#pluscustoms_hide").show();
			$("#pluspieces_hide").show();
			$("#plusboites_hide").show();
			$("#faminus_hide").hide();
			$("#faminus1_hide").hide();
			$("#faminus2_hide").hide();
			$("#faminus3_hide").hide();
			$(".TLA_dropdownbox_width").css("display", "block");
		})
	})
	/*End place de classics*/
	
	/*place de customs*/
	$(document).ready(function(){
		$(".plus_customs").click(function(){
			$(".soumenu_customs_text li").show();
			$(".soumenu_classics_text li").hide();
			$(".soumenu_pieces_text li").hide();
			$(".soumenu_boites_text li").hide();
			$("#pluspieces_hide").show();
			$("#pluscustoms_hide").hide();
			$("#plusclassic_hide").show();
			$("#plusboites_hide").show();
			$("#faminus_hide").hide();
			$("#faminus1_hide").show();
			$("#faminus2_hide").hide();
			$("#faminus3_hide").hide();
			$(".TLA_dropdownbox_width").css("display", "block");
		})
	})
	
	$(document).ready(function(){
		$(".minus_customs").click(function(){
			$(".soumenu_customs_text li").hide();
			$(".soumenu_classics_text li").hide();
			$(".soumenu_pieces_text li").hide();
			$(".soumenu_boites_text li").hide();
			$("#pluspieces_hide").show();
			$("#pluscustoms_hide").show();
			$("#plusclassic_hide").show();
			$("#plusboites_hide").show();
			$("#faminus_hide").hide();
			$("#faminus1_hide").show();
			$("#faminus2_hide").hide();
			$("#faminus3_hide").hide();
			$(".TLA_dropdownbox_width").css("display", "block");
		})
	})
	/*End place de customs*/
	
	/*place de pieces*/
	$(document).ready(function(){
		$(".plus_pieces").click(function(){
			$(".soumenu_customs_text li").hide();
			$(".soumenu_classics_text li").hide();
			$(".soumenu_boites_text li").hide();
			$(".soumenu_pieces_text li").show();
			$("#pluspieces_hide").hide();
			$("#pluscustoms_hide").show();
			$("#plusclassic_hide").show();
			$("#plusboites_hide").show();
			$("#faminus_hide").hide();
			$("#faminus1_hide").hide();
			$("#faminus3_hide").hide();
			$("#faminus2_hide").show();
			$(".TLA_dropdownbox_width").css("display", "block");
		})
	})
	
	$(document).ready(function(){
		$(".minus_pieces").click(function(){
			$(".soumenu_customs_text li").hide();
			$(".soumenu_classics_text li").hide();
			$(".soumenu_boites_text li").hide();
			$(".soumenu_pieces_text li").hide();
			$("#pluspieces_hide").show();
			$("#pluscustoms_hide").show();
			$("#plusclassic_hide").show();
			$("#plusboites_hide").show();
			$("#faminus_hide").hide();
			$("#faminus1_hide").hide();
			$("#faminus3_hide").hide();
			$("#faminus2_hide").hide();
			$(".TLA_dropdownbox_width").css("display", "block");
		})
	})
	/*End place de pieces*/
	
	/*place de boits*/
	$(document).ready(function(){
		$(".plus_boites").click(function(){
			$(".soumenu_customs_text li").hide();
			$(".soumenu_classics_text li").hide();
			$(".soumenu_pieces_text li").hide();
			$(".soumenu_boites_text li").show();
			$("#plusboites_hide").hide();
			$("#pluscustoms_hide").show();
			$("#plusclassic_hide").show();
			$("#pluspieces_hide").show();
			$("#faminus_hide").hide();
			$("#faminus1_hide").hide();
			$("#faminus2_hide").hide();
			$("#faminus3_hide").show();
			$(".TLA_dropdownbox_width").css("display", "block");
		})
	})
	
	$(document).ready(function(){
		$(".minus_boites").click(function(){
			$(".soumenu_customs_text li").hide();
			$(".soumenu_classics_text li").hide();
			$(".soumenu_pieces_text li").hide();
			$(".soumenu_boites_text li").show();
			$("#plusboites_hide").show();
			$("#pluscustoms_hide").show();
			$("#plusclassic_hide").show();
			$("#pluspieces_hide").show();
			$("#faminus_hide").hide();
			$("#faminus1_hide").hide();
			$("#faminus2_hide").hide();
			$("#faminus3_hide").hide();
			$(".TLA_dropdownbox_width").css("display", "block");
		})
	})
	/*End place de boits*/
	/*End soumenu 4 categories*/
	
	/*4 categories hover background-color change*/
	$(document).ready(function(){
		$("#categoryclassic_hover").hover(function () { $(".classic_text").hide(); $(".classic_text_show").show() }, function () { $(".classic_text").show(); $(".classic_text_show").hide() }); 
	})
	
	$(document).ready(function(){
		$("#categorycustoms_hover").hover(function () { $(".customs_text").hide(); $(".customs_text_show").show() }, function () { $(".customs_text").show(); $(".customs_text_show").hide() }); 
	})
	
	$(document).ready(function(){
		$("#categorypieces_hover").hover(function () { $(".pieces_text").hide(); $(".pieces_text_show").show() }, function () { $(".pieces_text").show(); $(".pieces_text_show").hide() }); 
	})
	
	$(document).ready(function(){
		$("#categorydivers_hover").hover(function () { $(".divers_text").hide(); $(".divers_text_show").show() }, function () { $(".divers_text").show(); $(".divers_text_show").hide() }); 
	})
	/*End 4 categories hover background-color change*/
	
	/*vignetteEvent position*/
	/*$(document).ready(function(){
		$(".vignetteEvent_hide > img").hover(function () { $(this).attr("src", "<?=$this->assetUrl('/img/vignetteEvent2.png');?>") }, function () { $(this).attr("src", "<?=$this->assetUrl('/img/vignetteEvent1.png');?>") }); 
	})*/
	
	/*$(document).ready(function(){
		$("#vignette_hover").hover(function(){
			alert("dfafdsf");
		})
	})*/
	
	function vignettehover() {
		$(document).ready(function(){

			$("#vignette_hover").hover(function(){
			$(this).attr("src", "<?=$this->assetUrl('/img/vignetteEvent1.png');?>");
		})			
	})
}
		
	function vignetteout() {
		$(document).ready(function(){

			$("#vignette_hover").hover(function(){
			$(this).attr("src", "<?=$this->assetUrl('/img/vignetteEvent2.png');?>");
		})			
	})
}
		
		function vignetteviewarthover() {
		$(document).ready(function(){

			$("#vignetteviewart_hover").hover(function(){
			$(this).attr("src", "<?=$this->assetUrl('/img/vignetteEvent1.png');?>");
		})			
	})
}
		
	function vignetteviewartout() {
		$(document).ready(function(){

			$("#vignetteviewart_hover").hover(function(){
			$(this).attr("src", "<?=$this->assetUrl('/img/vignetteEvent2.png');?>");
		})			
	})
}
	/*End vignetteEvent position*/
	
	/*contact button send*/
	$(document).ready(function(){
		$(".contactbutton > img").hover(function () { $(this).attr("src", "<?=$this->assetUrl('/img/formcontactsubmithover2.png');?>") }, function () { $(this).attr("src", "<?=$this->assetUrl('/img/formcontactsubmit.png');?>") }); 
	})
	/*End contact button send*/

	/*index.php slide article*/
	$(document).ready(function() {
    $('.carousel').carousel({
      interval: 6000
    })
  });
	/*End index.php slide article*/
		
	/*cptuser.php image change*/
	/*$(document).ready(function(){
		$("#cptuser_hover").hover(function () { $(this).attr("src", "<?=$this->assetUrl('/img/gestbookvignhover.jpg');?>") }, function () { $(this).attr("src", "<?=$this->assetUrl('/img/gestbookvign.jpg');?>") }); 
	})*/
		
	function imghover() {
		$(document).ready(function(){

			$("#cptuser_hover").hover(function(){
			$(this).attr("src", "<?=$this->assetUrl('/img/gestbookvign.jpg');?>");
		})			
	})
}
		
	function imgout() {
		$(document).ready(function(){

			$("#cptuser_hover").hover(function(){
			$(this).attr("src", "<?=$this->assetUrl('/img/gestbookvignhover.jpg');?>");
		})			
	})
}
	/*End cptuser.php image change*/
		
  /*orderpayment radio click photo change*/
/*$(document).ready(function(){
	   $("#orderpaypal_hover").click(function(){
		  $("input.orderpayment_checked1").attr("checked","checked");
		  $("#orderpaypal_hover").attr("src", "<?=$this->assetUrl('/img/paypal.png');?>") }, function () { $(this).attr("src", "<?=$this->assetUrl('/img/paypalHover.png');?>")
	  	  $("input.orderpayment_checked2").removeAttr("checked","checked");	
						$("input.orderpayment_checked3").removeAttr("checked","checked");

																							});
				});
	  
$(document).ready(function(){
	   $("#ordercheque_hover").click(function(){
		  $("input.orderpayment_checked2").attr("checked","checked");
		  $("#orderpaypal_hover").attr("src", "<?=$this->assetUrl('/img/paychq.png');?>") }, function () { $(this).attr("src", "<?=$this->assetUrl('/img/paychqhover.png');?>")
	  	  $("input.orderpayment_checked1").prop("checked",false);	
						$("input.orderpayment_checked3").removeAttr("checked","checked");

																							});
					});
				
$(document).ready(function(){
	   $("#ordervirement_hover").click(function(){
		  $("input.orderpayment_checked3").attr("checked","checked");
		  $("#orderpaypal_hover").attr("src", "<?=$this->assetUrl('/img/payvir.png');?>") }, function () { $(this).attr("src", "<?=$this->assetUrl('/img/payvirhover.png');?>")
						$("input.orderpayment_checked1").removeAttr("checked","checked");
						$("input.orderpayment_checked2").removeAttr("checked","checked");

																							});

  })		*/
  /*End orderpayment radio click photo change*/
	
    </script>
</body>
</html>