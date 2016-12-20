<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="UTF-8">
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
	<div class="">
		<!--<header>
			
		</header>
-->
		<section>
			<?= $this->section('main_content') ?>
		</section>

		<!--<footer>
		</footer>-->
	</div>
	
<!--jquery js-->
    <script src="<?= $this->assetUrl('js/jquery-3.1.1.min.js') ?>"></script>   
    <!--Plugin Jquery, confirm -->
    <script src="<?= $this->assetUrl('js/jquery-confirm.min.js') ?>"></script>
    <!--bootstrap js-->
   <script src="<?= $this->assetUrl('js/bootstrap.min.js') ?>"></script>
</body>
</html>