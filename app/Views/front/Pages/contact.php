<?php $this->layout('layoutfront', ['title' => 'Formulaire de Contact']) ?>

<?php $this->start('main_content') ?>
<div class="contactbanner">
	<img class="img-responsive" src="<?=$this->assetUrl('/img/formcontactbanner.png');?>">
</div>
<div class="container_general">
	<div class="row" style="margin:0;padding:0;">
		<!--contact col1-->
		<div class="col-xs-3 contactnuage">
			<img class="img-responsive" src="<?=$this->assetUrl('/img/formcontactnuage.png');?>">
		</div>
		<!--End contact col1-->
		
		<!--contact col2-->
		<div class="col-xs-7">
			<i class="fa fa-phone" aria-hidden="true"> <span class="telnumber" style="font-family: 'Advent Pro', sans-serif;">06 11 82 17 71</span></i>
			<form style="margin-top:30px;">
			  <div class="form-group">
				<label for="exampleInputEmail1" class="formlabel">Email</label>
				<input type="email" class="form-control" id="exampleInputEmail1" placeholder="email@mail.fr">
			  </div>
			  <div class="form-group">
				<label for="exampleInputPassword1" class="formlabel">Object</label>
				<input type="text" class="form-control" id="exampleInputPassword1" placeholder="demande de renseignement">
			  </div>
			  <div class="form-group">
				<label for="exampleInputPassword1" class="formlabel">Message</label>
				<textarea class="form-control" rows="10" placeholder="Bonjour, je souhaiterais savoir..."></textarea>
			  </div>	
				
			  <!--contact submit-->
			  <!--<button type="submit" class="btn btn-default">Send</button>-->
			  <div class="contactbutton">
			  <img class="img-responsive" src="<?=$this->assetUrl('/img/formcontactsubmit.png');?>" title="Envoyer">
			  </div>
			  <!--End contact submit-->
			</form>
		</div>
		<!--End contact col2-->
	</div>
</div>

<?php $this->stop('main_content') ?>
