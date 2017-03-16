<?php $this->layout('layoutfront', ['title' => 'Klickit participe à cet évènement', 'meta' => 'collection, evenement, collectionneur, collection playmobil, evenement playmobil, collectionneur playmobil']) ?>
<?php $this->start('meta') ?>
        <meta property="og:description" content="Venez découvrir la boutique Klickit sur cet évènement...">
        <meta property="og:image" content="<?=$this->assetUrl('events/'.$event['picture']);?>">
<!--
        <meta property="og:description" content="Découvre toi aussi la boutique Klickit : Playmobil Customisés, pièces, accessoires, boites et autres...">
        <meta property="og:image" content="http://www.klickit.fr/assets/img/KLICKIT-logo-napoleon-rect.jpg">
-->
<?php $this->stop('meta') ?>

<?php $this->start('main_content') ?>

 <div class="event_etitle">
     évènements
</div>
<div class="event_poster">
	<img class="img-responsive" src="<?=$this->assetUrl('events/'.$event['picture']);?>">
</div>
<div class="event_shareRS">
    <!--https://developers.facebook.com/docs/plugins/share-button/#configurator-->
    <iframe src="https://www.facebook.com/plugins/share_button.php?href=http%3A%2F%2Fklickit.fr%2Fhome&layout=button&size=large&mobile_iframe=true&width=88&height=28&appId" width="88" height="28" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowTransparency="true"></iframe>    
    <!--https://dev.twitter.com/web/tweet-button/parameters--><iframe class="event_shareTW" src="https://platform.twitter.com/widgets/tweet_button.html?size=l&url=https%3A%2F%2Fdev.twitter.com%2Fweb%2Ftweet-button&via=twitterdev&related=twitterapi%2Ctwitter&text=custom%20share%20text&hashtags=example%2Cdemo" width="88" height="28" style="border:none;overflow:hidden" scrolling="no" title="Twitter Tweet Button" style="border: 0; overflow: hidden;"></iframe>

</div>
<?php $this->stop('main_content') ?>
