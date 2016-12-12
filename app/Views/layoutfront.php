<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<title><?= $this->e($title) ?></title>
    
    <!-- bootstrap style-->
    <link rel="stylesheet" href="<?= $this->assetUrl('css/bootstrap.css') ?>">
    <!-- mon propre style-->
    <link rel="stylesheet" href="<?= $this->assetUrl('css/style.css') ?>">
    <!-- mon propre mediaquery-->
    <link rel="stylesheet" href="<?= $this->assetUrl('css/mediaquery.css') ?>">
    <!--google fonts-->
    <link href="https://fonts.googleapis.com/css?family=Advent+Pro:400,700" rel="stylesheet"> 
    <!--fontawsome style-->
    <link rel="stylesheet" href="<?= $this->assetUrl('css/font-awesome.min.css') ?>">
    <!--jquery js-->
    <script src="<?= $this->assetUrl('js/jquery-3.1.1.min.js') ?>"></script>   
    <!--bootstrap js-->
    <script src="<?= $this->assetUrl('js/bootstrap.min.js') ?>"></script>

    <script>
    $(document).ready(function(){
    $("#cogicon_click").click(function(){
        $(".cogsoumenu_hidden").slideToggle();
    })
    /*$(document).click(function(){
        $(".cogsoumenu_hidden").hide();
    })*/
})
    $(document).ready(function(){
    $("#usericon_click").click(function(){
        $(".usersoumenu_hidden").slideToggle();
    })
})
	
	$(document).ready(function(){
		$(".plus_classic").click(function(){
			$(".soumenu_classics_text li").show();
			$(".soumenu_customs_text li").hide();
			$(".TLA_dropdownbox_width").css("display", "block");
			$(".dropdown-toggle").click(function(){
				$(".TLA_dropdownbox_width").slideToggle();
			})
		})
	})
	
	$(document).ready(function(){
		$(".plus_customs").click(function(){
			$(".soumenu_customs_text li").show();
			$("#plusclassic_hide").toggle();
			$("#faminus_hide").toggle();
			$(".soumenu_classics_text li").hide();
			$(".TLA_dropdownbox_width").css("display", "block");
			$(".dropdown-toggle").click(function(){
				$(".TLA_dropdownbox_width").slideToggle();
			})
		})
	})
	
	/*$(document).ready(function(){
		if(".plus_customs".bind("click") == true) {
			alert("dfadsf");
		}
	})*/
    

    </script>
</head>
<body>
	<div class="container_general">
		<header>
            <div class="nav_left">
            <img src="<?=$this->assetUrl('/img/KLICKIT-logo-napoleon.png');?>">
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
                        <i class="fa fa-user fa-5x icon_cursor navR_color" aria-hidden="true" id="usericon_click"></i>
                        <div class="usersoumenu_hidden">
                          <form class="form_iconuser">
                              <div class="form-group">
                                <label for="exampleInputEmail1">Email address</label>
                                <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Email">
                              </div>
                              <div class="form-group">
                                <label for="exampleInputPassword1">Password</label>
                                <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
                              </div>
                              <button type="submit" class="btn btn-default">Submit</button>
                              <p>Creat an account?</p>
                              <p>Forget your password?</p>
                        </form>
                        </div>
                    </li>
                    <!--End icon-user menu-->
                    
                    <!--icon-shoppingcart-->
                    <li class="span_float">
                        <i class="fa fa-shopping-cart fa-5x icon_cursor navR_color" aria-hidden="true"></i>
                    </li>
                    <!--End icon-shoppingcart-->
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
        <a href="#"><li class="navlicon_width HM_bgcolor"><i class="fa fa-home" aria-hidden="true"></i><span class="sr-only">(current)</span></li></a>
		<!--End menu icon home-->
        
        <!--menu tous les articles-->
		<li class="navli_width TLA_bgcolor">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" style="padding: 15px;">Tous les articles
          </a>
          <ul class="dropdown-menu TLA_dropdownbox_width">
			  <div class="row">
				  <div class="col-lg-3 col-md-6 soumenu_TLA_height">
					  <div class="soumenu_TLA_text">
						  <li style="float:left;">Classic<li>
						  <li style="float:right;"><i class="fa fa-plus faplus_color plus_classic" aria-hidden="true" id="plusclassic_hide"></i><i class="fa fa-minus" aria-hidden="true" id="faminus_hide"></i></li>
						  <div class="clear"></div>
						  <ul class="soumenu_classics_text">
							  <li>fadsfdsf</li>
							  <li>fadsfdsf</li>
							  <li>fadsfdsf</li>
							  <li>fadsfdsf</li>
					  	  </ul>
					  </div>
				  </div>
				  <div class="col-lg-3 col-md-6 soumenu_TLA_height">
					  <div class="soumenu_TLA_text">
						  <li style="float:left;">Customs<li>
						  <li style="float:right;"><i class="fa fa-plus faplus_color plus_customs" aria-hidden="true" id="pluscustoms_hide"></i></li>
						  <div class="clear"></div>
						  <ul class="soumenu_customs_text">
							  <li>fadsfdsf</li>
							  <li>fadsfdsf</li>
							  <li>fadsfdsf</li>
							  <li>fadsfdsf</li>
					  	  </ul>
					  </div>
				  </div>
				  <div class="col-lg-3 col-md-6 soumenu_TLA_height">
					  <p class="soumenu_TLA_text">Pieces détachées</p>
				  </div>
				  <div class="col-lg-3 col-md-6">
					  <p class="soumenu_TLA_text">Boites/Set</p>
				  </div>
			  </div>
          </ul>
        </li>
		<!--End menu tous les articles-->
        
        <!--menu a propos-->
		<a href="#"><li class="navli_width AP_bgcolor">A propos</li></a>
		<!--End menu a propos-->
		
		<!--menu eventmentiel-->
        <a href="#"><li class="navli_width EVT_bgcolor">Evènementiel</li></a>
		<!--End menu eventmentiel-->
        
		<!--menu contact--> 
        <a href="#"><li class="navli_width CT_bgcolor">Contact</li></a>
		<!--End menu contact-->
		
		<!--menu icon search-->
		<ul class="navbar-right" style="width: 100%; padding: 0; margin: 0;">
			<li class="navlicon_width dropdown">
			  <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fa fa-search search_padding" aria-hidden="true"></i>
			  </a>
			  <ul class="dropdown-menu soumenu_search">
				<form class="form-inline">
				<div class="form-group">
				<input type="text" class="form-control" placeholder="Text input">
				</div>
				<div class="form-group">
				<input class="btn btn-primary" type="submit" value="Search">
				</div>
				</form>
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

    <footer>
    </footer>
    
</body>
</html>