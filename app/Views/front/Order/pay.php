<?php 

	if($_GET['success'] == true){
		$this->layout('layoutfront', ['title' => 'Paiement réussi']);
	}
	
?>

<?php $this->start('main_content') ?>

<?php $this->stop('main_content') ?>