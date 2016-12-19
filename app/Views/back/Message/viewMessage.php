<?php $this->layout('layoutback', ['title' => 'Message de '.$message['firstname'].' '.$message['lastname']]) ?>

<?php $this->start('main_content') ?>
	<?php if(empty($message)):?>
		<p class="alert alert-danger">Aucun message trouvé</p>
	<?php else : ?>	

		<h3>Sujet : <?=$message['subject']?></h3>
		<h3>Contenu : </h3>
		<div class="jumbotron ">
			<?=nl2br($message['content'])?>	
		</div>

		<form method="get">
			<button class="btn btn-success" name="read">Marquer comme lu</button>
			<button class="btn btn-warning" name="not-read">Marquer comme non-lu</button>
			<button class="btn btn-primary" id="answer-show">Répondre</button>
		</form>	

		<!-- message de réussite ou d'erreur pour l'envoi de la réponse -->
		<div class="message" style="margin-top:20px;">
			<?php if($success):?>
				<p class="alert alert-success">Votre message est envoyé</p>	
			<?php elseif(!empty($errors)):?>
				<p class="alert alert-danger"><?=$errors?></p>
			<?php endif;?>	
		</div>	

		<form method="post" id="answer" class="form-horizontal" style="margin-top:10px;display:none;">

		<h3> Répondre au message de <?=$message['firstname'].' '.$message['lastname']?></h3>

			<div class="form-group">
		  		<label class="col-md-4 control-label" for="email">Votre adresse email</label>  
		  		<div class="col-md-4">
		  			<input id="email" name="email" placeholder="Sujet du message" class="form-control input-md" required="" type="text"> 
		  		</div>
			</div>

			<div class="form-group">
		  		<label class="col-md-4 control-label" for="subject">Sujet du message</label>  
		  		<div class="col-md-4">
		  			<input id="subject" name="subject" placeholder="Sujet du message" class="form-control input-md" required="" type="text"> 
		  		</div>
			</div>

			<div class="form-group">
				<label class="col-md-4 control-label" for="content">Votre message</label>  
				<div class="col-md-4">
		 			<textarea class="form-control input-md" id="content" name="content" placeholder="Votre message" required=""></textarea>
		  		</div>
			</div>

			<div class="form-group">
		 		<label class="col-md-4 control-label" for="id"></label>
		 	 	<div class="col-md-4">
		    		<button id="send" name="send_mail" type="submit" class="btn btn-success">Envoyer le message</button>
		  		</div>
			</div>

		</form>

<?php endif;?>
<?php $this->stop('main_content') ?>

<?php $this->start('js')?>
	<script>
		$(document).ready(function(){

			$('#answer-show').click(function(e){
				e.preventDefault();
				$('#answer').slideToggle('slow');
				$('.message').fadeOut();
			});
			
		});
	</script>
<?php $this->stop('js')?>
