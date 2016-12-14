<?php $this->layout('layoutfront', ['title' => 'catégorie Classics', 'meta' => 'mots clés de la page events']) ?>

<?php $this->start('main_content') ?>

 <div class="event_etitle">
     évenements
</div>
<div class="event_poster">
	<img class="img-responsive" src="<?=$this->assetUrl('/events/expo_2016_noirmoutier.jpg');?>">

</div>
<div class="event_shareRS">
    <!--https://developers.facebook.com/docs/plugins/share-button/#configurator-->
    <iframe class="event_shareFB" src="https://www.facebook.com/plugins/share_button.php?href=https%3A%2F%2Fdevelopers.facebook.com%2Fdocs%2Fplugins%2F&layout=button&size=large&mobile_iframe=true&width=88&height=28&appId" width="88" height="28" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowTransparency="true"></iframe>
</div>
<?php $this->stop('main_content') ?>
