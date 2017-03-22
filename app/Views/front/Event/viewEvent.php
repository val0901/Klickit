<?php $this->layout('layoutfront', ['title' => 'Klickit participe à cet évènement', 'meta' => 'collection, evenement, collectionneur, collection playmobil, evenement playmobil, collectionneur playmobil']) ?>
<?php $this->start('meta') ?>
        <!-- meta FACEBOOK -->
        <meta property="og:description" content="Venez découvrir la boutique Klickit sur cet évènement...">
        <meta property="og:image" content="<?=$this->assetUrl('events/'.$event['picture']);?>">
        <meta property="og:url" content="http://www.klickit.fr/events">
        <!-- meta TWITTER -->
        <meta name="twitter:card" content="photo">
        <meta name="twitter:description" content="Venez découvrir la boutique Klickit sur cet évènement...">
        <meta name="twitter:image" content="<?=$this->assetUrl('events/'.$event['picture']);?>"> 


<?php $this->stop('meta') ?>

<?php $this->start('main_content') ?>

 <div class="event_etitle">
     évènements
</div>
<div class="event_poster">
	<img class="img-responsive" src="<?=$this->assetUrl('events/'.$event['picture']);?>">
</div>
<div class="event_shareRS">
<!--
    <button class="button share_twitter" data-url="http://....">
    Partager sur twitter
</button>
<button class="button share_facebook" data-url="http://....">
    Partager sur facebook
</button>
-->

    <!--https://developers.facebook.com/docs/plugins/share-button/#configurator-->
    <iframe src="https://www.facebook.com/plugins/share_button.php?href=http%3A%2F%2Fklickit.fr%2Fevents&layout=button&size=large&mobile_iframe=true&width=88&height=28&appId" width="88" height="28" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowTransparency="true"></iframe>
    <!--https://dev.twitter.com/web/tweet-button/parameters--><iframe class="event_shareTW" src="https://platform.twitter.com/widgets/tweet_button.html?size=l&via=Klickit33&text=Venez%20découvrir%20la%20boutique%20Klickit%20sur%20cet%20évènement..." width="88" height="28" style="border:none;overflow:hidden" scrolling="no" title="Twitter Tweet Button" style="border: 0; overflow: hidden;"></iframe>
</div>
<?php $this->stop('main_content') ?>
