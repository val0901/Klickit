<?php $this->layout('layoutfront', ['title' => 'Mise à jour compte utilisateur']) ?>

<?php $this->start('main_content') ?>
<div class="listorder_back">
 <div class="row">
  <div class="col-md-3">
  	<img class="img-responsive playmo_hide" src="<?=$this->assetUrl('/img/napoLeft.png');?>" id="categorycustoms">
  </div>
  <div class="col-md-6 ordermidia_width">
   <div class="listorder_contenu">
	<li style="float: left;">   
   	<img class="img-responsive" src="<?=$this->assetUrl('/img/napoPic.png');?>" id="categorycustoms">
	</li>
	<li>
	   	<h4 class="viewcategory_pages"><a href="<?=$this->url('front_affcptuser', ['id' => $_SESSION['user']['id']]);?>">Mon compte </a><span>></span><a href="<?=$this->url('front_fUpdateUser', ['id' => $_SESSION['user']['id']]);?>"> Mettre à jour</a></h4>
	</li>
	<div class="clear"></div>
	<br><br>
	<p class="orderMC_title"></p>
	
	
	   
	<div class="row">
		<div class="updateuser_box">
			<h1>mes informations personnelles</h1>
			<p class="orderMC_text">Vous pouvez modifier ici vos informations personnelles.</p>
			<hr>

			<?php if($success) : ?>
				<p class="alert alert-success">Compte mis à jour</p>
			<?php elseif(isset($errors) && !empty($errors)) :?>
				<p class="alert alert-danger"><?=implode('<br>',$errors)?></p>
			<?php endif;?>	

			<form method="post">

			  <div class="form-group adduser_label">
			  <label for="exampleInputName2">Civilité</label>
			    <select id="social_title" name="social_title" class="form-control">
			      <option value="M">M.</option>
			      <option value="Mme">Mme</option>
			    </select>
			  </div>

			  <div class="form-group adduser_label">
				<label for="exampleInputName2">Nom</label>
    			<input type="text" class="form-control" id="exampleInputName2" value="<?=$user['lastname']?>" name="lastname">
			  </div>
			  <div class="form-group adduser_label">
				<label for="exampleInputName2">Prénom</label>
    			<input type="text" class="form-control" id="exampleInputName2" value="<?=$user['firstname']?>" name="firstname">
			  </div>
			  <div class="form-group adduser_label">
				<label for="exampleInputName2">Pseudo</label>
    			<input type="text" class="form-control" id="exampleInputName2" value="<?=$user['username']?>" name="username">
			  </div>
			  <div class="form-group adduser_label">
				<label for="exampleInputName2">Adresse</label>
    			<input type="text" class="form-control" id="exampleInputName2" value="<?=$user['adress']?>" name="address">
			  </div>
			  <div class="form-group adduser_label">
				<label for="exampleInputName2">Code postal</label>
    			<input type="text" class="form-control" id="exampleInputName2" value="<?=$user['zipcode']?>" name="zipcode">
			  </div>
			  <div class="form-group adduser_label">
				<label for="exampleInputName2">Ville</label>
    			<input type="text" class="form-control" id="exampleInputName2" value="<?=$user['city']?>" name="city">
			  </div>
			  <div class="form-group adduser_label">
				<label for="exampleInputEmail1">Email</label>
				<input type="email" class="form-control" id="exampleInputEmail1" value="<?=$user['email']?>" name="email">
			  </div>
			  <div class="form-group adduser_label">
				<label for="exampleInputPassword1">Mot de passe</label>
				<input type="password" class="form-control" id="exampleInputPassword1" placeholder="votre mot de passe" name="password">
			  </div>
			  <button type="submit" class="btn btn-default adduser_button">Valider</button>
			</form>
			<br><br>
		</div>
	   </div>
	   
	  
   </div>
  </div>
  <div class="col-md-3">
  	<img class="img-responsive playmo_hide" src="<?=$this->assetUrl('/img/napoRight.png');?>" id="categorycustom" style="float:right;">
  </div>
 </div>
 
 
</div>


<?php $this->stop('main_content') ?>
