<?php $this->layout('layoutfront', ['title' => 'favorite']) ?>

<?php $this->start('main_content') ?>
<form method="post">
<div class="listorder_back">
 <div class="row">
  <div class="col-md-3">
  	<img class="img-responsive playmo_hide" src="<?=$this->assetUrl('/img/napoLeft.png');?>" id="categorycustoms">
  </div>
  <div class="col-md-6 ordermidia_width">
   <div class="listorder_contenu">
	<li style="float: left;">   
   	<img class="img-responsive" src="<?=$this->assetUrl('/img/napoPic.png');?>" id="categorycustoms">
	</li>
	<li>
	   	<h4 class="viewcategory_pages"><a href="<?=$this->url('front_affcptuser', ['id' => $_SESSION['user']['id']]);?>">Mon compte </a> <span>></span><a href="<?=$this->url('favorite', ['id'=> $_SESSION['user']['id']]);?>"> Favoris</a></h4>
	</li>
	<div class="clear"></div>
	<br><br>
	<p class="orderMC_title">MES FAVORIS</p>
	<p class="orderMC_text">Vous trouverez ici tous vos favoris que vous pouvez ajouter directement dans votre panier. Vous serez averti par mail si un de vos articles préféré est en promotion.</p>
	<hr>
	<br>
	   
	   
       <div class="row">
           <!--<div class="row">-->
               <!--<div class="col-lg-3 col-sm-6">-->
          <?php foreach($favorite as $value): ?>
            <?php $list_items = $items->findItems($value['id_item']); ?>
                <div class="col-lg-3 col-sm-6">
                    <div class="thumbnail">
                        <a href="<?=$this->url('viewArt', ['id' => $list_items['id']]);?>"><img src="<?=$this->assetUrl('art/'.$list_items['picture1']);?>" alt=""></a>
                    </div>
                    <div class="caption">
                        <?php if($list_items['newPrice'] == 0) : ?>
                          <h4><span style="cursor:pointer;"><button class="favorite" type="submit" name="<?=str_replace(' ', '', $list_items['name']);?>" value="<?=$list_items['id'];?>"><i class="fa fa-heart-o fa-fw favoriteicon_original favoriteicon_click" aria-hidden="true" title="Ajouter à mes favoris"></i></button></span> <?=$list_items['price'];?>€</h4>
                        <?php else : ?>
                          <h4><span style="cursor:pointer;"><button class="favorite" type="submit" name="<?=str_replace(' ', '', $list_items['name']);?>" value="<?=$list_items['id'];?>"><i class="fa fa-heart-o fa-fw favoriteicon_original favoriteicon_click" aria-hidden="true" title="Ajouter à mes favoris"></i></button></span> <span class="viewcategoryprixpromo"><?=$list_items['newPrice'];?>€</span> <span class="viewcategoryprixdelete"><?=$list_items['price'];?>€</span></h4>
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
                        <p class="favorite_voirplus">
                          <?php if($list_items['category'] == 'PlaymobilClassique'): ?>
                            <a href="<?=$this->url('listItemClassicsFull');?>">Voir même catégorie</a>
                          <?php elseif($list_items['category'] == 'PlaymobilCustom'): ?>
                            <a href="<?=$this->url('listItemCustomFull');?>">Voir même catégorie</a>
                          <?php elseif($list_items['category'] == 'PiecesDetachees'): ?>
                            <a href="<?=$this->url('listItemPiecesFull');?>">Voir même catégorie</a>
                          <?php elseif($list_items['category'] == 'Divers'): ?>
                            <a href="<?=$this->url('listItemDiversFull');?>">Voir même catégorie</a>
                          <?php endif; ?>
                        </p>
              </div>
              <?php endforeach; ?> <!-- fin du foreach $favorite -->
              <div class="favoritedelete_button">
                <button type="submit" name="allDelete" class="btn btn-primary favoritedelete_button_size">Supprimer tous mes favoris</button>
              </div>
       </div>
   </div>
  </div>
  <div class="col-md-3">
  	<img class="img-responsive playmo_hide" src="<?=$this->assetUrl('/img/napoRight.png');?>" id="categorycustoms" style="float:right;">
  </div>
 </div>
 
 
</div>
</form>

<?php $this->stop('main_content') ?>
