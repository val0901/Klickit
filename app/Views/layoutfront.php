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
    <link href="https://fonts.googleapis.com/css?family=Dosis" rel="stylesheet">
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
    

    </script>
</head>
<body>
	<div class="container">
		<header>
            <div class="nav_left">
            <img src="<?=$this->assetUrl('/img/KLICKIT-logo2.png');?>">
            <p class="baseline_text">Créez l'histoire !</p>
            </div>
            
            <div class="nav_right">
                <ul>
                    <!--icon-cog menu-->
                    <li class="span_float">
                        <i class="fa fa-cog fa-5x icon_cursor" aria-hidden="true" id="cogicon_click"></i>
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
                        <i class="fa fa-user fa-5x icon_cursor" aria-hidden="true" id="usericon_click"></i>
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
                        <i class="fa fa-shopping-cart fa-5x icon_cursor" aria-hidden="true"></i>
                    </li>
                    <!--End icon-shoppingcart-->
                </ul>
            </div>      
        </header>
</div>
		<section>
			<?= $this->section('main_content') ?>
		</section>

    <footer>
    </footer>
    
</body>
</html>