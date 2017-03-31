<?php $this->layout('layoutfront', ['title' => 'Klickit Napoléon Playmobil Western Pirate Fée Princesses Police Robots Espace Animaux Sport Tampographie Customs Accessoires Stickers Résine']) ?>

<?php $this->start('main_content') ?>
<!--section 4 boutons categories-->
<div class="">
    <div class="row">
        <a href="<?=$this->url('listItemClassicsFull');?>" class="ahovercat">
            <div class="col-lg-3 col-xs-6" style="position:relative;" id="categoryclassic_hover">
                <div class="classic_text index"><span>Classics</span></div>
                <img class="img-responsive" src="<?=$this->assetUrl('/img/img_classic.jpg');?>" id="categoryclassic_hover">
                <div class="classic_text_show"><span style="font-weight: 600;">Classics</span></div>
            </div>
        </a>

        <a href="<?=$this->url('listItemCustomFull');?>" class="ahovercat">
            <div class="col-lg-3 col-xs-6" id="categorycustoms_hover">
                <div class="customs_text index"><span>Customs</span></div>
                <img class="img-responsive" src="<?=$this->assetUrl('/img/img_custom.jpg');?>" id="categorycustoms_hover">
                <div class="customs_text_show" style="font-weight: 600;">Customs</div>
            </div>
        </a>

        <a href="<?=$this->url('listItemPiecesFull');?>" class="ahovercat">
            <div class="col-lg-3 col-xs-6" id="categorypieces_hover">
                <div class="pieces_text index"><span>Pièces</span></div>
                <img class="img-responsive" src="<?=$this->assetUrl('/img/img_pieces.jpg');?>" id="categorypieces_hover">
                <div class="pieces_text_show" style="font-weight: 600;">Pièces</div>
            </div>
        </a>

        <a href="<?=$this->url('listItemDiversFull');?>" class="ahovercat">
            <div class="col-lg-3 col-xs-6" id="categorydivers_hover">
                <div class="divers_text index"><span>Divers</span></div>
                <img class="img-responsive" src="<?=$this->assetUrl('/img/img_boitessets.jpg');?>" id="categorydivers_hover">
                <div class="divers_text_show" style="font-weight: 600;">Divers</div>
            </div>
        </a>
    </div>
</div>
<!--End section 4 boutons categories-->

<!--Les derniers commentaires-->
<div class="vignetteEvent_hide">
    <a class="ahoveroff" href="<?=$this->url('front_contact')?>"><img class="img-responsive" src="<?=$this->assetUrl('/img/vignetteEvent1.png');?>" id="vignette_hover" onmouseover="vignettehover();" onmouseout="vignetteout();"></a>
</div>
<div class="row commtaire_back">
    <div class="col-md-2"></div>
    <div class="col-md-10 col2_commentaireback my-slider">
        <div id="myPageContent" class="container-fluid">
            <section id="home">
                <div id="textSlider" class="row">
                    <div class="col-md-9 slideCol">
                        <div class="scroller">
                            <div class="">
                                <ul>
                                    <?php foreach($comments as $value) :?>
                                    <?php if($value['published'] == 'oui'):?>
                                    <li>  
                                        <div class="commentaire">
                                            <?php if($value['social_title'] == 'M'):?>  
                                            <img class="img-responsive-tete" src="<?=$this->assetUrl('/img/avatarBoylarge.png');?>" style="float: left;">
                                            <?php elseif($value['social_title'] == 'Mme'):?>
                                            <img class="img-responsive-tete" src="<?=$this->assetUrl('/img/avatarGirlslarge.png');?>" style="float: left;">
                                            <?php else : ?>
                                            <img class="img-responsive-tete" src="<?=$this->assetUrl('/img/avatarBoylarge.png');?>" style="float: left;">   
                                            <?php endif;?>        
                                            <span class="col2commtaire_margin commentaire_title"><span class="comment_text"><?=$value['content'].' '?></span><span class="comment_username"><?=' ...'.$value['firstname'].' '.ucfirst(substr($value['lastname'],0,1))?></span>
                                            </span>
                                        </div>
                                    </li>      
                                    <?php endif;?>   
                                    <?php endforeach;?>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="quote_hide">
                            <i class="fa fa-quote-right fa-fw" aria-hidden="true" style="color: #7bc942;font-size: 120px;"></i>
                        </div>
                    </div>
                </div>
            </section>
        </div>

    </div>
</div>
<!--End Les derniers commentaires-->

<!--Le dernier évènement-->
<div class="event_title">évènements</div>
<div class="evenement_img">
    <!--
../../../app/Views/front/Event/viewEvent.php
-->
    <a href="<?=$this->url('front_events');?>"> <img class="ahoveron" class="img-responsive" src="<?=$this->assetUrl('slide/'.$slide['picture']);?>"></a>
</div>
<!--End Le dernier évènement-->

<!--Slide articles nouveautés et promos-->
<div class="clear"></div>
<div class="slideartL_title">nouveau!</div>
<div class="slideartR_title">promo!</div>

<div class="">
    <div class="row-fluid">
        <div class="span12">


            <div class="carousel slide" id="myCarousel">
                <div class="carousel-inner">
                    <div class="item active">
                        <ul class="thumbnails">
                            <?php foreach ($statut1 as $newProduct) : ?>
                            <li class="span4">
                                <div>
                                    <div class="thumbnail">
                                        <a href="<?=$this->url('viewArt', ['id' => $newProduct['id']]);?>"><img class="ahoveron" src="<?=$this->assetUrl('art/'.$newProduct['picture1']);?>" alt=""></a>
                                    </div>
                                    <div class="caption">
                                        <?php if($newProduct['newPrice'] == 0) : ?>
                                        <h4><?=str_replace('.', ',', $newProduct['price']);?>€</h4>
                                        <?php else : ?>
                                        <h4><span class="viewcategoryprixpromo"><?=str_replace('.', ',', $newProduct['newPrice']);?>€</span> <span class="viewcategoryprixdelete"><?=str_replace('.', ',', $newProduct['price']);?>€</span></h4>
                                        <?php endif; ?>
                                        <p>
                                            <span style="cursor:pointer;">
                                                <?php if(!empty($_SESSION['user'])): ?>
                                                    <?php if(in_array($newProduct['id'], $favorite)): ?>
                                                        <button class="favorite" type="submit" name="<?=str_replace(' ', '', $newProduct['name']);?>" value="<?=$newProduct['id']?>" data-id="<?=$newProduct['id'];?>"><span id="<?=$newProduct['id'];?>" class="fa fa-heart fa-fw favoriteicon_original favoriteicon_click" aria-hidden="true" style="color: #c11131;" title="Retirer de mes favoris"></span></button>
                                                    <?php else: ?>
                                                        <button class="favorite" type="submit" name="<?=str_replace(' ', '', $newProduct['name']);?>" value="<?=$newProduct['id'];?>" data-id="<?=$newProduct['id'];?>"><span id="<?=$newProduct['id'];?>" class="fa fa-heart-o fa-fw favoriteicon_original favoriteicon_click" aria-hidden="true" title="Ajouter à mes favoris"></span></button>
                                                    <?php endif; ?>
                                                <?php else : ?>
                                                    <a href="<?=$this->url('login');?>"><i class="fa fa-heart-o fa-fw favoriteicon_original favoriteicon_click" aria-hidden="true" title="Ajouter à mes favoris"></i></a>
                                                <?php endif; ?>
                                            </span>
                                        <?=$newProduct['name'];?></p>

                                        <?php if($newProduct['statut'] == 'nouveaute'):?>
                                        <div class="viewcategory_nouveau"><?=$newProduct['statut'];?></div>
                                        <?php elseif($newProduct['statut'] == 'promotion'):?>
                                        <div class="viewcategory_promo"><?=$newProduct['statut'];?></div>
                                        <?php elseif($newProduct['statut'] == 'defaut'): ?>
                                        <div class="viewcategory_defaut"></div>
                                        <?php endif; ?>
                                        <!--<a class="btn btn-mini" href="#">&raquo; Read More</a>-->
                                    </div>
                                </div>

                                <?php if($newProduct['quantity'] == 0): ?>
                                    <p>RUPTURE DE STOCK</p>
                                <?php elseif($newProduct['quantity'] > 0): ?>    
                                    <!-- container +1 -->
                                    <div id="<?=$newProduct['id'];?>" class="item--helper-slide">
                                        <span id="plus1">+1</span>
                                    </div>
                                    <div class="viewcategory_button">
                                        <!--j'ai supprimé .btn-primary dans la class button-->
                                        <?php if(!empty($_SESSION['user'])): ?>
                                            <button id="simple" type="button" class="changeArrow btn viewcategory_button_size add_to_shopping_cart ahoveroff add-to-basket" data-id="<?=$newProduct['id']?>">  <span class="name">
                                                Ajouter au panier
                                                </span>
                                            </button>
                                        <?php else : ?>
                                            <a class="ahoveroff" href="<?=$this->url('login');?>" target="_blank"><button id="simple" type="button" class="changeArrow btn viewcategory_button_size ahoveroff add-to-basket" data-id="<?=$newProduct['id']?>">  <span class="name">
                                                Ajouter au panier
                                                </span>
                                            </button></a>
                                        <?php endif; ?>
                                    </div>
                                <?php endif; ?>
                            <br>
                                
                            </li>
                            <?php endforeach; ?>
                        </ul>
                    </div><!-- /Slide1 --> 

                    <div class="item">
                        <ul class="thumbnails">
                            <?php foreach ($statut2 as $newProduct) : ?>
                            <li class="span4">
                                <div>
                                    <div class="thumbnail">
                                        <a href="<?=$this->url('viewArt', ['id' => $newProduct['id']]);?>"><img class="ahoveron" src="<?=$this->assetUrl('art/'.$newProduct['picture1']);?>" alt=""></a>
                                    </div>

                                    <div class="caption">
                                        <?php if($newProduct['newPrice'] == 0) : ?>
                                        <h4><?=str_replace('.', ',', $newProduct['price']);?>€</h4>
                                        <?php else : ?>
                                        <h4><span class="viewcategoryprixpromo"><?=str_replace('.', ',', $newProduct['newPrice']);?>€</span> <span class="viewcategoryprixdelete"><?=str_replace('.', ',', $newProduct['price']);?>€</span></h4>
                                        <?php endif; ?>
                                        <p>
                                            <span style="cursor:pointer;">
                                                <?php if(!empty($_SESSION['user'])): ?>
                                                <?php if(in_array($newProduct['id'], $favorite)): ?>
                                                <button class="favorite" type="submit" name="<?=str_replace(' ', '', $newProduct['name']);?>" value="<?=$newProduct['id']?>" data-id="<?=$newProduct['id'];?>"><span id="<?=$newProduct['id'];?>" class="fa fa-heart fa-fw favoriteicon_original favoriteicon_click" aria-hidden="true" style="color: #c11131;" title="Retirer de mes favoris"></span></button>
                                                <?php else: ?>
                                                <button class="favorite" type="submit" name="<?=str_replace(' ', '', $newProduct['name']);?>" value="<?=$newProduct['id'];?>" data-id="<?=$newProduct['id'];?>"><span id="<?=$newProduct['id'];?>" class="fa fa-heart-o fa-fw favoriteicon_original favoriteicon_click" aria-hidden="true" title="Ajouter à mes favoris"></span></button>
                                                <?php endif; ?>
                                                <?php else : ?>
                                                <a href="<?=$this->url('login');?>"><i class="fa fa-heart-o fa-fw favoriteicon_original favoriteicon_click" aria-hidden="true" title="Ajouter à mes favoris"></i></a>
                                                <?php endif; ?>
                                            </span>
                                        <?=$newProduct['name'];?></p>

                                        <?php if($newProduct['statut'] == 'nouveaute'):?>
                                        <div class="viewcategory_nouveau"><?=$newProduct['statut'];?></div>
                                        <?php elseif($newProduct['statut'] == 'promotion'):?>
                                        <div class="viewcategory_promo"><?=$newProduct['statut'];?></div>
                                        <?php elseif($newProduct['statut'] == 'defaut'): ?>
                                        <div class="viewcategory_defaut"></div>
                                        <?php endif; ?>
                                        <!--<a class="btn btn-mini" href="#">&raquo; Read More</a>-->
                                    </div>
                                </div>
                                <?php if($newProduct['quantity'] == 0): ?>
                                    <p>RUPTURE DE STOCK</p>
                                <?php elseif($newProduct['quantity'] > 0): ?>    
                                    <!-- container +1 -->
                                    <div id="<?=$newProduct['id'];?>" class="item--helper-slide">
                                        <span id="plus1">+1</span>
                                    </div>
                                    <div class="viewcategory_button">
                                        <!--j'ai supprimé .btn-primary dans la class button-->
                                        <?php if(!empty($_SESSION['user'])): ?>
                                            <button id="simple" type="button" class="changeArrow btn viewcategory_button_size add_to_shopping_cart ahoveroff add-to-basket" data-id="<?=$newProduct['id']?>">  <span class="name">
                                                Ajouter au panier
                                                </span>
                                            </button>
                                        <?php else : ?>
                                            <a class="ahoveroff" href="<?=$this->url('login');?>" target="_blank"><button id="simple" type="button" class="changeArrow btn viewcategory_button_size ahoveroff add-to-basket" data-id="<?=$newProduct['id']?>">  <span class="name">
                                                Ajouter au panier
                                                </span>
                                            </button></a>
                                        <?php endif; ?>
                                    </div>
                                <?php endif; ?>
                                <br>

                            </li>
                            <?php endforeach; ?>
                        </ul>
                    </div><!-- /Slide2 --> 
                    <div class="item">
                        <ul class="thumbnails">
                            <?php foreach ($statut3 as $newProduct) : ?>
                            <li class="span4">
                                <div>
                                    <div class="thumbnail">
                                        <a href="<?=$this->url('viewArt', ['id' => $newProduct['id']]);?>"><img class="ahoveron" src="<?=$this->assetUrl('art/'.$newProduct['picture1']);?>" alt=""></a>
                                    </div>
                                    <div class="caption">
                                        <?php if($newProduct['newPrice'] == 0) : ?>
                                        <h4><?=str_replace('.', ',', $newProduct['price']);?>€</h4>
                                        <?php else : ?>
                                        <h4><span class="viewcategoryprixpromo"><?=str_replace('.', ',', $newProduct['newPrice']);?>€</span> <span class="viewcategoryprixdelete"><?=str_replace('.', ',', $newProduct['price']);?>€</span></h4>
                                        <?php endif; ?>
                                        <p>
                                            <span style="cursor:pointer;">
                                                <?php if(!empty($_SESSION['user'])): ?>
                                                <?php if(in_array($newProduct['id'], $favorite)): ?>
                                                <button class="favorite" type="submit" name="<?=str_replace(' ', '', $newProduct['name']);?>" value="<?=$newProduct['id']?>" data-id="<?=$newProduct['id'];?>"><span id="<?=$newProduct['id'];?>" class="fa fa-heart fa-fw favoriteicon_original favoriteicon_click" aria-hidden="true" style="color: #c11131;" title="Retirer de mes favoris"></span></button>
                                                <?php else: ?>
                                                <button class="favorite" type="submit" name="<?=str_replace(' ', '', $newProduct['name']);?>" value="<?=$newProduct['id'];?>" data-id="<?=$newProduct['id'];?>"><span id="<?=$newProduct['id'];?>" class="fa fa-heart-o fa-fw favoriteicon_original favoriteicon_click" aria-hidden="true" title="Ajouter à mes favoris"></span></button>
                                                <?php endif; ?>
                                                <?php else : ?>
                                                <a href="<?=$this->url('login');?>"><i class="fa fa-heart-o fa-fw favoriteicon_original favoriteicon_click" aria-hidden="true" title="Ajouter à mes favoris"></i></a>
                                                <?php endif; ?>
                                            </span>
                                        <?=$newProduct['name'];?></p>

                                        <?php if($newProduct['statut'] == 'nouveaute'):?>
                                        <div class="viewcategory_nouveau"><?=$newProduct['statut'];?></div>
                                        <?php elseif($newProduct['statut'] == 'promotion'):?>
                                        <div class="viewcategory_promo"><?=$newProduct['statut'];?></div>
                                        <?php elseif($newProduct['statut'] == 'defaut'): ?>
                                        <div class="viewcategory_defaut"></div>
                                        <?php endif; ?>
                                        <!--<a class="btn btn-mini" href="#">&raquo; Read More</a>-->
                                    </div>
                                </div>
                                
                                <?php if($newProduct['quantity'] == 0): ?>
                                    <p>RUPTURE DE STOCK</p>
                                <?php elseif($newProduct['quantity'] > 0): ?>    
                                    <!-- container +1 -->
                                    <div id="<?=$newProduct['id'];?>" class="item--helper-slide">
                                        <span id="plus1">+1</span>
                                    </div>
                                    <div class="viewcategory_button">
                                        <!--j'ai supprimé .btn-primary dans la class button-->
                                        <?php if(!empty($_SESSION['user'])): ?>
                                            <button id="simple" type="button" class="changeArrow btn viewcategory_button_size add_to_shopping_cart ahoveroff add-to-basket" data-id="<?=$newProduct['id']?>">  <span class="name">
                                                Ajouter au panier
                                                </span>
                                            </button>
                                        <?php else : ?>
                                            <a class="ahoveroff" href="<?=$this->url('login');?>" target="_blank"><button id="simple" type="button" class="changeArrow btn viewcategory_button_size ahoveroff add-to-basket" data-id="<?=$newProduct['id']?>">  <span class="name">
                                                Ajouter au panier
                                                </span>
                                            </button></a>
                                        <?php endif; ?>
                                    </div>
                                <?php endif; ?>
                                <br>
                                
                            </li>
                            <?php endforeach; ?>
                        </ul>
                    </div><!-- /Slide3 --> 
                </div>

                <div class="control-box">                            
                    <a data-slide="prev" href="#myCarousel" class="carousel-control left">‹</a>
                    <a data-slide="next" href="#myCarousel" class="carousel-control right">›</a>
                </div><!-- /.control-box -->   

            </div><!-- /#myCarousel -->

        </div><!-- /.span12 -->          
    </div><!-- /.row --> 
</div><!-- /.container -->
<!--End Slide articles nouveautés et promos-->
<br><br>
<?php $this->stop('main_content') ?>
<?php $this->start('js') ?>
<script src="<?= $this->assetUrl('js/unslider.js') ?>"></script>
<script>
    $(document).ready(function(){
        $('.my-slider').unslider({
            autoplay: true,
            arrows: false,
        });
    });
</script>
<script>
    $('.favorite').click(function(e){
            e.preventDefault();

            var idFavorite = $(this).data('id');

            function favIcon() // Change l'îcone favoris sans recharger la page
            {
                if($('#'+idFavorite).hasClass('fa-heart-o')){ // On vérifie que l'élement avec l'ID contenu dans idFavorite a la class fa-heart-o
                    $('#'+idFavorite).removeClass('fa-heart-o'); // On vire la class
                    $('#'+idFavorite).addClass('fa-heart'); // On rajoute une nouvelle
                    $('#'+idFavorite).css('color', '#c11131'); // On change la couleur
                }
                else if($('#'+idFavorite).hasClass('fa-heart')){ // On vérifie que l'élement avec l'ID contenu dans idFavorite a la class fa-heart
                    $('#'+idFavorite).removeClass('fa-heart'); // On vire la class
                    $('#'+idFavorite).addClass('fa-heart-o'); // On rajoute une nouvelle
                    $('#'+idFavorite).css('color', '#999999'); // On change la couleur
                }
            }

            $.ajax({
                url: '<?=$this->url('ajax_favorite');?>',
                type: 'post',
                cache: false,
                data: {id_item: idFavorite},
                dataType: 'json',
                success: function(add){
                    if(add.msg == 'ok'){
                        favIcon(); 
                    }
                }
            });
        });
</script>
<?php $this->stop('js') ?>