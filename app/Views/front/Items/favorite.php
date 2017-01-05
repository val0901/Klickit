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
          <?php $favorite = explode(', ', $user['favorites']); ?>
          <?php foreach($favorite as $value): ?>
                <?php $list_items = $items->findItems($value); ?>
                <div class="col-lg-3 col-sm-6">
                    <div class="thumbnail">
                        <a href="<?=$this->url('viewArt', ['id' => $list_items['id']]);?>"><img src="<?=$this->assetUrl('art/'.$list_items['picture1']);?>" alt=""></a>
                    </div>
                    <div class="caption">
                        <?php if($list_items['newPrice'] == 0) : ?>
                          <h4><?=$list_items['price'];?>€</h4>
                        <?php else : ?>
                          <h4><span class="viewcategoryprixpromo"><?=$list_items['newPrice'];?>€</span> <span class="viewcategoryprixdelete"><?=$list_items['price'];?>€</span></h4>
                        <?php endif; ?>

                        <p><?=$list_items['name'];?></p>

                        <?php if($list_items['statut'] == 'nouveaute'):?>
                          <div class="viewcategory_nouveau"><?=$list_items['statut'];?></div>
                        <?php elseif($list_items['statut'] == 'promotion'):?>
                          <div class="viewcategory_promo"><?=$list_items['statut'];?></div>
                        <?php elseif($list_items['statut'] == 'defaut'): ?>
                          <div class="viewcategory_defaut"></div>
                        <?php endif; ?>
                    </div>
                        <div class="viewcategory_button">
        				          <button type="button" class="btn btn-primary favorite_button_size ">ajouter au panier</button>
        				        </div>
                        <p class="favorite_voirplus">Voir même catégorie</p>
                </div>
          <?php endforeach; ?> <!-- fin du foreach $favorite -->
      </div>
   </div>
  </div>
  <div class="col-md-3">
  	<img class="img-responsive playmo_hide" src="<?=$this->assetUrl('/img/napoRight.png');?>" id="categorycustoms_hover" style="float:right;">
  </div>
 </div>
 
 
</div>


<?php $this->stop('main_content') ?>
