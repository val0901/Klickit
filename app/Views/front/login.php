<?php $this->layout('layoutfront', ['title' => 'login']) ?>

<?php $this->start('main_content') ?>
<div class="container">
	<br><br>
	<?php if(!empty($error)):?>
		<p class="alert alert-danger"><?=$error?></p>
	<?php endif;?>	
    
    <!--Title et border-->
	<div class="row">
		<div class="col-md-3">
		
		</div>
		<div class="col-md-6 orderlogin_box">
			<h1>LOGIN</h1>
			<form method="POST">
			  <div class="form-group orderlogin_label">
				<label for="pseudo">Pseudo</label>
    			<input type="text" class="form-control" id="pseudo" name="pseudo" placeholder="votre pseudo">
			  </div>
			  <div class="form-group orderlogin_label">
				<label for="password">Mot de passe</label>
				<input type="password" class="form-control" id="password" name="password">
			  </div>
			  <a href="<?=$this->url('front_faddUser');?>"><p>Créer un compte</p></a>
              <a href=""><p>Vous avez oublié votre mot de passe?</p></a>
			  <br>
				<button type="submit" class="btn btn-default adduser_button orderlogin_button1"><span class="orderlogin_button1text"> Se connecter</span></button>
			</form>
			<br><br>
		</div>
		<div class="col-md-3">
		
		</div>
	</div>
    <!--End title et border-->
</div>
<br><br>
<?php $this->stop('main_content') ?>


