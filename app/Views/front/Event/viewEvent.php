<?php $this->layout('layoutfront', ['title' => 'Klickit participe à cet évènement', 'meta' => 'collection, evenement, collectionneur, collection playmobil, evenement playmobil, collectionneur playmobil']) ?>

<?php $this->start('main_content') ?>

 <div class="event_etitle">
     évènements
</div>
<div class="event_poster">
	<img class="img-responsive" src="<?=$this->assetUrl('events/'.$event['picture']);?>">
</div>
<div class="event_shareRS">
    <!--https://developers.facebook.com/docs/plugins/share-button/#configurator-->
    <iframe class="event_shareFB" src="https://www.facebook.com/plugins/share_button.php?href=https%3A%2F%2Fdevelopers.facebook.com%2Fdocs%2Fplugins%2F&layout=button&size=large&mobile_iframe=true&width=88&height=28&appId" width="88" height="28" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowTransparency="true"></iframe> 
    <!--https://dev.twitter.com/web/tweet-button/parameters--><iframe class="event_shareTW" src="https://platform.twitter.com/widgets/tweet_button.html?size=l&url=https%3A%2F%2Fdev.twitter.com%2Fweb%2Ftweet-button&via=twitterdev&related=twitterapi%2Ctwitter&text=custom%20share%20text&hashtags=example%2Cdemo" width="88" height="28" style="border:none;overflow:hidden" scrolling="no" title="Twitter Tweet Button" style="border: 0; overflow: hidden;"></iframe>

</div>
<?php $this->stop('main_content') ?>
