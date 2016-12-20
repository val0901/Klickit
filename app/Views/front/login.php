<?php $this->layout('layoutfront', ['title' => 'login']) ?>

<?php $this->start('main_content') ?>
<div class="container">
	<br><br>
    
    <!--Title et border-->
	<div class="row">
		<div class="col-md-3">
		
		</div>
		<div class="col-md-6 orderlogin_box">
			<h1>LOGIN</h1>
			<form>
			  <div class="form-group orderlogin_label">
				<label for="exampleInputName2">Pseudo</label>
    			<input type="text" class="form-control" id="exampleInputName2" placeholder="votre pseudo">
			  </div>
			  <div class="form-group orderlogin_label">
				<label for="exampleInputPassword1">Mot de passe</label>
				<input type="password" class="form-control" id="exampleInputPassword1">
			  </div>
			  <p>Creat an account?</p>
              <p>Forget your password?</p>
			  <br>
				<button type="submit" class="btn btn-default adduser_button orderlogin_button1"><span class="orderlogin_button1text"> ENVOYER</span></button>
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


