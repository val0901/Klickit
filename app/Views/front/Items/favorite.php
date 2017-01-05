<?php $this->layout('layoutfront', ['title' => 'favorite']) ?>

<?php $this->start('main_content') ?>
<div class="listorder_back">
 <div class="row">
  <div class="col-md-3">
  	<img class="img-responsive playmo_hide" src="<?=$this->assetUrl('/img/napoLeft.png');?>" id="categorycustoms_hover">
  </div>
  <div class="col-md-6 ordermidia_width">
   <div class="listorder_contenu">
	<li style="float: left;">   
   	<img class="img-responsive" src="<?=$this->assetUrl('/img/napoPic.png');?>" id="categorycustoms_hover">
	</li>
	<li>
	   	<h4 class="viewcategory_pages">Mon compte <span>></span> Favoris</h4>
	</li>
	<div class="clear"></div>
	<br><br>
	<p class="orderMC_title">MOM COMPTE</p>
	<p class="orderMC_text">Vous trouverez ici tous vos favoris que vous pouvez ajouter directement dans votre panier. Vous serez averti par mail si un de vos articles préféré est en promotion.</p>
	<hr>
	<br>
	   <p class="orderMC_title">MES FAVORIS</p>
	   
       <div class="row">
           <div class="col-lg-3 col-sm-6">
                <div class="thumbnail">
                    <a href="#"><img src="<?=$this->assetUrl('/img/art_classic_espacerobots_000002.jpg');?>" alt=""></a>
                </div>
                <div class="caption">
                    <div class="favorite_price">8 € <span class="favorite_pricenormal">10 €</span></div>
                    <p>Princess Playmo</p>
                 <div class="slidecontent_promo">promo !</div>
                </div>
                <div class="viewcategory_button">
				    <button type="button" class="btn btn-primary favorite_button_size ">ajouter au panier</button>
				</div>
                <p class="favorite_voirplus">Voir meme catégorie</p>
           </div>
           <div class="col-lg-3 col-sm-6">
            <div class="thumbnail">
                    <a href="#"><img src="<?=$this->assetUrl('/img/art_classic_espacerobots_000002.jpg');?>" alt=""></a>
                </div>
                <div class="caption">
                    <div class="favorite_price">8 € <span class="favorite_pricenormal">10 €</span></div>
                    <p>Princess Playmo</p>
                    <div class="slidecontent_promo">promo !</div>
                </div>
                <div class="viewcategory_button">
				    <button type="button" class="btn btn-primary favorite_button_size ">ajouter au panier</button>
				</div>
                <p class="favorite_voirplus">Voir meme catégorie</p>
           </div>
           <div class="col-lg-3 col-sm-6">
            <div class="thumbnail">
                    <a href="#"><img src="<?=$this->assetUrl('/img/art_classic_espacerobots_000002.jpg');?>" alt=""></a>
                </div>
                <div class="caption">
                    <div class="favorite_price">8 € <span class="favorite_pricenormal">10 €</span></div>
                    <p>Princess Playmo</p>
                    <div class="slidecontent_promo">promo !</div>
                </div>
                <div class="viewcategory_button">
				    <button type="button" class="btn btn-primary favorite_button_size ">ajouter au panier</button>
				</div>
                <p class="favorite_voirplus">Voir meme catégorie</p>
           </div>
           <div class="col-lg-3 col-sm-6">
            <div class="thumbnail">
                    <a href="#"><img src="<?=$this->assetUrl('/img/art_classic_espacerobots_000002.jpg');?>" alt=""></a>
                </div>
                <div class="caption">
                    <div class="favorite_price">8 € <span class="favorite_pricenormal">10 €</span></div>
                    <p>Princess Playmo</p>
                    <div class="slidecontent_promo">promo !</div>
                </div>
                <div class="viewcategory_button">
				    <button type="button" class="btn btn-primary favorite_button_size ">ajouter au panier</button>
				</div>
                <p class="favorite_voirplus">Voir meme catégorie</p>
           </div>
       </div>
   </div>
  </div>
  <div class="col-md-3">
  	<img class="img-responsive playmo_hide" src="<?=$this->assetUrl('/img/napoRight.png');?>" id="categorycustoms_hover" style="float:right;">
  </div>
 </div>
 
 
</div>


<?php $this->stop('main_content') ?>
