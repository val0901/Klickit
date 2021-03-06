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
	<p class="orderMC_text">Vous trouverez ici tous vos favoris que vous pouvez ajouter directement dans votre panier.</p>
	<hr>
	<br>
	   
	   
       <div class="row">
           <!--<div class="row">-->
               <!--<div class="col-lg-3 col-sm-6">-->
          <?php foreach($favorite as $value): ?>
            <?php $list_items = $items->findItems($value['id_item']); ?>
                <div class="col-lg-4 col-sm-6 artfav">
                    <div class="thumbnail">
                        <a href="<?=$this->url('viewArt', ['id' => $list_items['id']]);?>"><img class="ahoveron" src="<?=$this->assetUrl('art/'.$list_items['picture1']);?>" alt=""></a>
                    </div>
                    <div class="caption">
                        <?php if($list_items['newPrice'] == 0) : ?>
                          <h4 class="salesItems"><span style="cursor:pointer;"><button class="favorite" type="submit" name="<?=str_replace(' ', '', $list_items['name']);?>" value="<?=$list_items['id'];?>" data-id="<?=$list_items['id'];?>"><i class="fa fa-heart fa-fw favoriteicon_original favoriteicon_click" aria-hidden="true" style="color: #c11131;" title="Supprimer de mes favoris"></i></button></span> <?=str_replace('.', ',', $list_items['price']);?>€</h4>
                        <?php else : ?>
                          <h4 class="salesItems"><span style="cursor:pointer;"><button class="favorite" type="submit" name="<?=str_replace(' ', '', $list_items['name']);?>" value="<?=$list_items['id'];?>" data-id="<?=$list_items['id'];?>"><i class="fa fa-heart fa-fw favoriteicon_original favoriteicon_click" aria-hidden="true" style="color: #c11131;" title="Supprimer de mes favoris"></i></button></span> <span class="viewcategoryprixpromo"><?=str_replace('.', ',', $list_items['newPrice']);?>€</span> <span class="viewcategoryprixdelete"><?=str_replace('.', ',', $list_items['price']);?>€</span></h4>
                        <?php endif; ?>

                        <p class="caption h4"><?=$list_items['name'];?></p>

                        <?php if($list_items['statut'] == 'nouveaute'):?>
                          <div class="viewcategory_nouveau"><?=$list_items['statut'];?></div>
                        <?php elseif($list_items['statut'] == 'promotion'):?>
                          <div class="viewcategory_promo"><?=$list_items['statut'];?></div>
                        <?php elseif($list_items['statut'] == 'defaut'): ?>
                          <div class="viewcategory_defaut"></div>
                        <?php endif; ?>
                    </div>
                        <?php if($list_items['quantity'] == 0): ?>
                                    <p class="ruptureQte">RUPTURE DE STOCK</p>
                        <?php elseif($list_items['quantity'] > 0): ?>
                            <!-- ajouter au panier -->
                            <div id="<?=$list_items['id'];?>" class="item--helper">
                                <span id="plus1">+1</span>
                            </div>
                            <div class="viewcategory_button item">
                              <button type="button" class="btn btn-primary favorite_button_size add_to_shopping_cart ahoveroff add-to-basket" data-id="<?=$list_items['id']?>">  <span class="name">
                                        Ajouter au panier
                                        </span>
                                    </button>
                            </div>
                        <?php endif; ?>
                        <p class="favorite_voirplus">
                          <?php if($list_items['category'] == 'PlaymobilClassique'): ?>
                            <a class="hoverlinkred" href="<?=$this->url('listItemClassicsFull');?>">Voir même catégorie</a>
                          <?php elseif($list_items['category'] == 'PlaymobilCustom'): ?>
                            <a class="hoverlinkred" href="<?=$this->url('listItemCustomFull');?>">Voir même catégorie</a>
                          <?php elseif($list_items['category'] == 'PiecesDetachees'): ?>
                            <a href="<?=$this->url('listItemPiecesFull');?>">Voir même catégorie</a>
                          <?php elseif($list_items['category'] == 'Divers'): ?>
                            <a href="<?=$this->url('listItemDiversFull');?>">Voir même catégorie</a>
                          <?php endif; ?>
                        </p>
              </div>
              <?php endforeach; ?> <!-- fin du foreach $favorite -->
              <br><br>
 </div>

              <div class="favoritedelete_button">
                <button type="submit" id="allDelete" name="allDelete" value="<?=$_SESSION['user']['id'];?>" class="btn btn-primary favoritedelete_button_size">Supprimer tous mes favoris</button>
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

<?php $this->start('js') ?>
  <script>
    $(document).ready(function(){
      // Suppression d'un seul favoris
      $('.favorite').click(function(e){
        e.preventDefault();

        var idFavorite = $(this).data('id');

        $.ajax({
          url: '<?=$this->url('ajax_favorite');?>',
          type: 'post',
          cache: false,
          data: {id_item: idFavorite},
          dataType: 'json',
          success: function(add){
            if(add.msg == 'ok'){
              $('body').load('<?=$this->url('favorite', ['id' => $_SESSION['user']['id']]);?>');
            }
          }
        });
      });

      // Suppression de TOUT les favoris
      $('#allDelete').click(function(e){
        e.preventDefault();

        $.ajax({
          url: '<?=$this->url('ajax_deleteAllFavorite');?>',
          type: 'post',
          cache: false,
          data: $('#allDelete'),
          dataType: 'json',
          success: function(del){
            if(del.msg == 'ok'){
              $('body').load('<?=$this->url('favorite', ['id' => $_SESSION['user']['id']]);?>');
            }
          }
        });
      });

      /* Début dé sécurisation pour vérifier que l'URL est bien un chiffre après le / ... à voir plus tard. 
      var number = [];
      locationOk = true;

      for(var i = 1; i <= 99999; i++){
        number.push(i);
      }*/

    });
  </script>
<?php $this->stop('js') ?>