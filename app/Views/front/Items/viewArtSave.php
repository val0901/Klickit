<?php $this->layout('layoutfront', ['title' => 'Boutique Klickit']) ?>

<?php $this->start('main_content') ?>
<!--<div class="vignetteEvent_hide">
<a href="<?=$this->url('front_contact')?>"><img class="img-responsive" src="<?=$this->assetUrl('/img/vignetteEvent1.png');?>" id="vignetteviewart_hover" onmouseover="vignetteviewarthover();" onmouseout="vignetteviewartout();"></a>
</div>--> 
<form method="post">
    <div class="container_viewart"><!---->
        <div class="row containviewart">
            <!--slideviewart-->
            <?php if(!empty($items['picture2'])): ?>
            <div id="slider">
                <ul class="bjqs">
                    <li><img src="<?=$this->assetUrl('art/'.$items['picture1']);?>"></li>
                    <li><img src="<?=$this->assetUrl('art/'.$items['picture2']);?>"></li>
                </ul>
            </div>

            <?php else : ?>
            <div id="slider">
                <ul class="bjqs">
                    <li><img src="<?=$this->assetUrl('art/'.$items['picture1']);?>"></li>
                </ul>
            </div>

            <?php endif; ?>




            <!--
<?php if(!empty($items['picture2'])): ?>
<div id="slideviewart">
<a href="#" class="control_next">></a>
<a href="#" class="control_prev"><</a>
<ul>
<li>
<img class="img-thumbnail" src="<?=$this->assetUrl('art/'.$items['picture1']);?>">
</li>
<li style="background: #fff;">
<img class="img-thumbnail"  src="<?=$this->assetUrl('art/'.$items['picture2']);?>">
</li>
</ul>
</div>
<?php else : ?>
<div id="slideviewart">
<ul>
<li>
<img class="img-thumbnail"  src="<?=$this->assetUrl('art/'.$items['picture1']);?>">
</li>
<li style="background: #fff; z-index: -1000;">
<img class="img-thumbnail"  src="<?=$this->assetUrl('art/'.$items['picture2']);?>">
</li>
</ul>
</div>
<?php endif; ?>
-->
            <!--fin slideviewart-->
            <div class="col-md-5 viewart_fontweight"><!---->

                <p class="viewart_fontref">Référence <?=$items['id'] ;?></p>
                <h1 class="viewart_fonttitle"><?=$items['name'] ;?></h1>
                <span class="viewart_fontref"></span> 
                <span class="viewart_fontpro"> 
                    <?php if($items['statut'] == 'nouveaute'):?>
                    <div class=""><?='Nouveauté';?></div>
                    <?php elseif($items['statut'] == 'promotion'):?>
                    <div class=""><?='Promotion';?></div>
                    <?php elseif($items['statut'] == 'defaut'): ?>
                    <div class=""></div>
                    <?php endif;  ?></span>
                <br><br>




                <span class="viewart_fontsolde salesItems">
                    <?php if($items['newPrice'] == 0): ?>
                    <?=$items['price'];?> €
                    <?php elseif($items['newPrice'] > 0): ?>
                    <?=$items['newPrice'];?> €
                    <?php endif; ?>
                </span>
                <span class="viewart_fontnormal salesItems">
                    <?php if($items['newPrice'] > 0): ?> 
                    <?=$items['price'];?> €
                    <?php elseif($items['newPrice'] == 0): ?>

                    <?php endif; ?>
                </span>
                <br><br><br><br>
                <span class="viewart_fontref">Quantité </span>
                <span>
                    <input type="number" name="number" min="1" id="number" placeholder="1">
                </span>
                <br><br>
                <!-- container +1 -->
                <div id="<?=$product['id'];?>" class="item--helper">
                    <span id="plus1">+1</span>
                </div>

                <div class="ajoutpanier item"><!---->
                    <?php if(!empty($_SESSION['user'])): ?>
                    <button data-id="<?=$items['id']?>" type="button" class="btn btn-primary viewcategory_button_size addBasket">  <span class="name">
                        Ajouter au panier
                        </span>
                    </button>
                    <?php else : ?>
                    <a href="<?=$this->url('login');?>" target="_blank"><button data-id="<?=$items['id']?>" type="button" class="btn btn-primary viewcategory_button_size addBasket">  <span class="name">
                        Ajouter au panier
                        </span>
                        </button></a>
                    <?php endif; ?>
                </div><!--fin ajoutpanier-->
                <br>
                <p>
                    <span style="cursor:pointer;">
                        <?php if(!empty($_SESSION['user'])): ?>
                        <?php if(in_array($items['id'], $favorite)): ?>
                        <button class="favorite" type="submit" name="<?=str_replace(' ', '', $items['name']);?>" value="<?=$items['id'];?>" data-id="<?=$items['id'];?>"><i class="fa fa-heart fa-2x pictoheart" aria-hidden="true" style="color: #c11131;" title="Ajouter à mes favoris"><span class="viewart_fontfamily">Déjà en favoris</span></i></button> 
                        <?php else: ?>
                        <button class="favorite" type="submit" name="<?=str_replace(' ', '', $items['name']);?>" value="<?=$items['id'];?>" data-id="<?=$items['id'];?>"><i class="fa fa-heart-o fa-2x pictoheart" aria-hidden="true" style="color: #999;" title="Ajouter à mes favoris"><span class="viewart_fontfamily">Ajouter à mes favoris</span></i></button>
                        <?php endif; ?>
                        <?php else : ?>
                        <a href="<?=$this->url('login');?>"><i class="fa fa-heart-o fa-2x pictoheart" aria-hidden="true" style="color: #999;" title="Ajouter à mes favoris"><span class="viewart_fontfamily">Ajouter à mes favoris</span></i></a>
                        <?php endif; ?>
                    </span>
                </p>

                <!-- BOUTON DE PARTAGE SOCIAUX -->
                <br>

                <!-- Bouton Facebook statique -->

                <button class="button share_twitter" data-url="http://www.klickit/viewArt/<?=$items['id'];?>">

                    <button class="button share_twitter" data-url="http://www.klickit.fr<?=$this->url('viewArt' , ['id' => $items['id']]);?>">

                        <i class="fa fa-twitter-square fa-3x fa-fw" aria-hidden="true" style="color:#3fa9f5;"></i>
                    </button>

                    <!-- Bouton Facebook statique -->
                    <button class="button share_facebook" data-url="http://www.klickit.fr<?=$this->url('viewArt' , ['id' => $items['id']]);?>">
                        <i class="fa fa-facebook-square fa-3x fa-fw" aria-hidden="true" style="color:#335199;"></i>
                    </button>


                    </div><!--fin viewart_fontweight-->
            </div><!--fin row-->
            <br><br>
            <div class="row">
                <div class="col-md-3 viewart_savoirboder">
                    <div class="col-xs-2 viewart_savoirback">
                    </div>
                    <div class="col-xs-10">
                        <p class="viewart_savoirtitle">EN SAVOIR PLUS</p>
                    </div>
                </div><!--fin viewart_savoirboder-->
                <div class="col-md-9 viewart_savoirwidth">
                    <p class="viewart_savoirtext"><?=$items['description']?>
                    </p>
                </div><!--fin viewart_savoirwidth-->
            </div><!--fin row-->
            <br><br>
        </div><!--fin container_viewart-->

        <!--nouveaute slideshow-->
        <!--Slide articles-->
        <div class="clear"></div>
        <div class="slideartL_title">nouveau!</div>
        <!--<div class="slideartR_title">promo!</div>-->

        <div class="">
            <div class="row-fluid">
                <div class="span12">


                    <div class="carousel slide" id="myCarousel">
                        <div class="carousel-inner">
                            <div class="item active">
                                <ul class="thumbnails">
                                    <?php foreach ($afficheNewItem1 as $newProduct) : ?>
                                    <li class="span4">
                                        <div class="thumbnail">
                                            <a href="<?=$this->url('viewArt', ['id' => $newProduct['id']]);?>"><img class="ahoveron" src="<?=$this->assetUrl('art/'.$newProduct['picture1']);?>" alt=""></a>
                                        </div>
                                        <div class="caption">
                                            <?php if($newProduct['newPrice'] == 0) : ?>
                                            <h4><?=$newProduct['price'];?>€</h4>
                                            <?php else : ?>
                                            <h4><span class="viewcategoryprixpromo"><?=$newProduct['newPrice'];?>€</span> <span class="viewcategoryprixdelete"><?=$newProduct['price'];?>€</span></h4>
                                            <?php endif; ?>
                                            <p>
                                                <span style="cursor:pointer;">
                                                    <?php if(!empty($_SESSION['user'])): ?>
                                                    <?php if(in_array($newProduct['id'], $favorite)): ?>
                                                    <button class="favorite2" type="submit" name="<?=str_replace(' ', '', $newProduct['name']);?>" value="<?=$newProduct['id']?>" data-id="<?=$newProduct['id'];?>"><span class="<?=$newProduct['id'];?> fa fa-heart fa-fw favoriteicon_original favoriteicon_click" aria-hidden="true" style="color: #c11131;" title="Retirer de mes favoris"></span></button>
                                                    <?php else: ?>
                                                    <button class="favorite2" type="submit" name="<?=str_replace(' ', '', $newProduct['name']);?>" value="<?=$newProduct['id'];?>" data-id="<?=$newProduct['id'];?>"><span class="<?=$newProduct['id'];?> fa fa-heart-o fa-fw favoriteicon_original favoriteicon_click" aria-hidden="true" title="Ajouter à mes favoris"></span></button>
                                                    <?php endif; ?>
                                                    <?php else : ?>
                                                    <a href="<?=$this->url('login');?>"><i class="fa fa-heart-o fa-fw favoriteicon_original favoriteicon_click" aria-hidden="true" title="Ajouter à mes favoris"></i></a>
                                                    <?php endif; ?>
                                                </span> <?=$newProduct['name'];?>
                                            </p>
                                            <div class="slidecontent_nouveau"><?=$newProduct['statut'];?></div>
                                            <!--<a class="btn btn-mini" href="#">&raquo; Read More</a>-->
                                        </div>
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
                                        <br><br>                                    
                                    </li>
                                    <?php endforeach; ?>
                                </ul>
                            </div><!-- /Slide1 --> 
                            <div class="item">
                                <ul class="thumbnails">
                                    <?php foreach ($afficheNewItem2 as $newProduct) : ?>
                                    <li class="span4">
                                        <div class="thumbnail">
                                            <a href="<?=$this->url('viewArt', ['id' => $newProduct['id']]);?>"><img class="ahoveron" src="<?=$this->assetUrl('art/'.$newProduct['picture1']);?>" alt=""></a>
                                        </div>
                                        <div class="caption">
                                            <?php if($newProduct['newPrice'] == 0) : ?>
                                            <h4><?=$newProduct['price'];?>€</h4>
                                            <?php else : ?>
                                            <h4><span class="viewcategoryprixpromo"><?=$newProduct['newPrice'];?>€</span> <span class="viewcategoryprixdelete"><?=$newProduct['price'];?>€</span></h4>
                                            <?php endif; ?>
                                            <p>
                                                <span style="cursor:pointer;">
                                                    <?php if(!empty($_SESSION['user'])): ?>
                                                    <?php if(in_array($newProduct['id'], $favorite)): ?>
                                                    <button class="favorite2" type="submit" name="<?=str_replace(' ', '', $newProduct['name']);?>" value="<?=$newProduct['id']?>" data-id="<?=$newProduct['id'];?>"><span class="<?=$newProduct['id'];?> fa fa-heart fa-fw favoriteicon_original favoriteicon_click" aria-hidden="true" style="color: #c11131;" title="Retirer de mes favoris"></span></button>
                                                    <?php else: ?>
                                                    <button class="favorite2" type="submit" name="<?=str_replace(' ', '', $newProduct['name']);?>" value="<?=$newProduct['id'];?>" data-id="<?=$newProduct['id'];?>"><span class="<?=$newProduct['id'];?> fa fa-heart-o fa-fw favoriteicon_original favoriteicon_click" aria-hidden="true" title="Ajouter à mes favoris"></span></button>
                                                    <?php endif; ?>
                                                    <?php else : ?>
                                                    <a href="<?=$this->url('login');?>"><i class="fa fa-heart-o fa-fw favoriteicon_original favoriteicon_click" aria-hidden="true" title="Ajouter à mes favoris"></i></a>
                                                    <?php endif; ?>
                                                </span> <?=$newProduct['name'];?>
                                            </p>
                                            <div class="slidecontent_nouveau"><?=$newProduct['statut'];?></div>
                                            <!--<a class="btn btn-mini" href="#">&raquo; Read More</a>-->
                                        </div>
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
                                        <br><br>                                    
                                    </li>
                                    <?php endforeach; ?>
                                </ul>
                            </div><!-- /Slide2 --> 
                            <div class="item">
                                <ul class="thumbnails">
                                    <?php foreach ($afficheNewItem3 as $newProduct) : ?>
                                    <li class="span4">
                                        <div class="thumbnail">
                                            <a href="<?=$this->url('viewArt', ['id' => $newProduct['id']]);?>"><img class="ahoveron" src="<?=$this->assetUrl('art/'.$newProduct['picture1']);?>" alt=""></a>
                                        </div>
                                        <div class="caption">
                                            <?php if($newProduct['newPrice'] == 0) : ?>
                                            <h4><?=$newProduct['price'];?>€</h4>
                                            <?php else : ?>
                                            <h4><span class="viewcategoryprixpromo"><?=$newProduct['newPrice'];?>€</span> <span class="viewcategoryprixdelete"><?=$newProduct['price'];?>€</span></h4>
                                            <?php endif; ?>
                                            <p>
                                                <span style="cursor:pointer;">
                                                    <?php if(!empty($_SESSION['user'])): ?>
                                                    <?php if(in_array($newProduct['id'], $favorite)): ?>
                                                    <button class="favorite2" type="submit" name="<?=str_replace(' ', '', $newProduct['name']);?>" value="<?=$newProduct['id']?>" data-id="<?=$newProduct['id'];?>"><span class="<?=$newProduct['id'];?> fa fa-heart fa-fw favoriteicon_original favoriteicon_click" aria-hidden="true" style="color: #c11131;" title="Retirer de mes favoris"></span></button>
                                                    <?php else: ?>
                                                    <button class="favorite2" type="submit" name="<?=str_replace(' ', '', $newProduct['name']);?>" value="<?=$newProduct['id'];?>" data-id="<?=$newProduct['id'];?>"><span class="<?=$newProduct['id'];?> fa fa-heart-o fa-fw favoriteicon_original favoriteicon_click" aria-hidden="true" title="Ajouter à mes favoris"></span></button>
                                                    <?php endif; ?>
                                                    <?php else : ?>
                                                    <a href="<?=$this->url('login');?>"><i class="fa fa-heart-o fa-fw favoriteicon_original favoriteicon_click" aria-hidden="true" title="Ajouter à mes favoris"></i></a>
                                                    <?php endif; ?>
                                                </span> <?=$newProduct['name'];?>
                                            </p>
                                            <div class="slidecontent_nouveau"><?=$newProduct['statut'];?></div>
                                            <!--<a class="btn btn-mini" href="#">&raquo; Read More</a>-->
                                        </div>
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
                                        <br><br>                                    
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
        <br><br>
        <!--End Slide articles-->
        <!--End nouveute slideshow-->

        </form>
    <?php $this->stop('main_content') ?>

    <?php $this->start('js')?>
    <script type="text/javascript">
        jQuery(document).ready(function($) {
            $('#slider').bjqs({
                'height' : 626,
                'width' : 626,
                'responsive' : true
            });
        });
    </script>
    <script>
    /*
 * Basic jQuery Slider plug-in v.1.3
 *
 * http://www.basic-slider.com
 *
 * Authored by John Cobb
 * http://www.johncobb.name
 * @john0514
 *
 * Copyright 2011, John Cobb
 * License: GNU General Public License, version 3 (GPL-3.0)
 * http://www.opensource.org/licenses/gpl-3.0.html
 *
 */

;(function($) {

    "use strict";

    $.fn.bjqs = function(o) {
        
        // slider default settings
        var defaults        = {

            // w + h to enforce consistency
            width           : 626,
            height          : 626,

            // transition valuess
            animtype        : 'fade',
            animduration    : 450,      // length of transition
            animspeed       : 4000,     // delay between transitions
            automatic       : true,     // enable/disable automatic slide rotation

            // control and marker configuration
            showcontrols    : true,     // enable/disable next + previous UI elements
            centercontrols  : true,     // vertically center controls
            nexttext        : '>',   // text/html inside next UI element
            prevtext        : '<',   // text/html inside previous UI element
            showmarkers     : true,     // enable/disable individual slide UI markers
            centermarkers   : true,     // horizontally center markers

            // interaction values
            keyboardnav     : true,     // enable/disable keyboard navigation
            hoverpause      : true,     // enable/disable pause slides on hover

            // presentational options
            usecaptions     : true,     // enable/disable captions using img title attribute
            randomstart     : false,     // start from a random slide
            responsive      : false     // enable responsive behaviour

        };

        // create settings from defauls and user options
        var settings        = $.extend({}, defaults, o);

        // slider elements
        var $wrapper        = this,
            $slider         = $wrapper.find('ul.bjqs'),
            $slides         = $slider.children('li'),

            // control elements
            $c_wrapper      = null,
            $c_fwd          = null,
            $c_prev         = null,

            // marker elements
            $m_wrapper      = null,
            $m_markers      = null,

            // elements for slide animation
            $canvas         = null,
            $clone_first    = null,
            $clone_last     = null;

        // state management object
        var state           = {
            slidecount      : $slides.length,   // total number of slides
            animating       : false,            // bool: is transition is progress
            paused          : false,            // bool: is the slider paused
            currentslide    : 1,                // current slide being viewed (not 0 based)
            nextslide       : 0,                // slide to view next (not 0 based)
            currentindex    : 0,                // current slide being viewed (0 based)
            nextindex       : 0,                // slide to view next (0 based)
            interval        : null              // interval for automatic rotation
        };

        var responsive      = {
            width           : null,
            height          : null,
            ratio           : null
        };

        // helpful variables
        var vars            = {
            fwd             : 'forward',
            prev            : 'previous'
        };
            
        // run through options and initialise settings
        var init = function() {

            // differentiate slider li from content li
            $slides.addClass('bjqs-slide');

            // conf dimensions, responsive or static
            if( settings.responsive ){
                conf_responsive();
            }
            else{
                conf_static();
            }

            // configurations only avaliable if more than 1 slide
            if( state.slidecount > 1 ){

                // enable random start
                if (settings.randomstart){
                    conf_random();
                }

                // create and show controls
                if( settings.showcontrols ){
                    conf_controls();
                }

                // create and show markers
                if( settings.showmarkers ){
                    conf_markers();
                }

                // enable slidenumboard navigation
                if( settings.keyboardnav ){
                    conf_keynav();
                }

                // enable pause on hover
                if (settings.hoverpause && settings.automatic){
                    conf_hoverpause();
                }

                // conf slide animation
                if (settings.animtype === 'slide'){
                    conf_slide();
                }

            } else {
                // Stop automatic animation, because we only have one slide! 
                settings.automatic = false;
            }

            if(settings.usecaptions){
                conf_captions();
            }

            // TODO: need to accomodate random start for slide transition setting
            if(settings.animtype === 'slide' && !settings.randomstart){
                state.currentindex = 1;
                state.currentslide = 2;
            }

            // slide components are hidden by default, show them now
            $slider.show();
            $slides.eq(state.currentindex).show();

            // Finally, if automatic is set to true, kick off the interval
            if(settings.automatic){
                state.interval = setInterval(function () {
                    go(vars.fwd, false);
                }, settings.animspeed);
            }

        };

        var conf_responsive = function() {

            responsive.width    = $wrapper.outerWidth();
            responsive.ratio    = responsive.width/settings.width,
            responsive.height   = settings.height * responsive.ratio;

            if(settings.animtype === 'fade'){

                // initial setup
                $slides.css({
                    'height'        : settings.height,
                    'width'         : '100%'
                });
                $slides.children('img').css({
                    'height'        : settings.height,
                    'width'         : '100%'
                });
                $slider.css({
                    'height'        : settings.height,
                    'width'         : '100%'
                });
                $wrapper.css({
                    'height'        : settings.height,
                    'max-width'     : settings.width,
                    'position'      : 'relative'
                });

                if(responsive.width < settings.width){

                    $slides.css({
                        'height'        : responsive.height
                    });
                    $slides.children('img').css({
                        'height'        : responsive.height
                    });
                    $slider.css({
                        'height'        : responsive.height
                    });
                    $wrapper.css({
                        'height'        : responsive.height
                    });

                }

                $(window).resize(function() {

                    // calculate and update dimensions
                    responsive.width    = $wrapper.outerWidth();
                    responsive.ratio    = responsive.width/settings.width,
                    responsive.height   = settings.height * responsive.ratio;

                    $slides.css({
                        'height'        : responsive.height
                    });
                    $slides.children('img').css({
                        'height'        : responsive.height
                    });
                    $slider.css({
                        'height'        : responsive.height
                    });
                    $wrapper.css({
                        'height'        : responsive.height
                    });

                });

            }

            if(settings.animtype === 'slide'){

                // initial setup
                $slides.css({
                    'height'        : settings.height,
                    'width'         : settings.width
                });
                $slides.children('img').css({
                    'height'        : settings.height,
                    'width'         : settings.width
                });
                $slider.css({
                    'height'        : settings.height,
                    'width'         : settings.width * settings.slidecount
                });
                $wrapper.css({
                    'height'        : settings.height,
                    'max-width'     : settings.width,
                    'position'      : 'relative'
                });

                if(responsive.width < settings.width){

                    $slides.css({
                        'height'        : responsive.height
                    });
                    $slides.children('img').css({
                        'height'        : responsive.height
                    });
                    $slider.css({
                        'height'        : responsive.height
                    });
                    $wrapper.css({
                        'height'        : responsive.height
                    });

                }

                $(window).resize(function() {

                    // calculate and update dimensions
                    responsive.width    = $wrapper.outerWidth(),
                    responsive.ratio    = responsive.width/settings.width,
                    responsive.height   = settings.height * responsive.ratio;

                    $slides.css({
                        'height'        : responsive.height,
                        'width'         : responsive.width
                    });
                    $slides.children('img').css({
                        'height'        : responsive.height,
                        'width'         : responsive.width
                    });
                    $slider.css({
                        'height'        : responsive.height,
                        'width'         : responsive.width * settings.slidecount
                    });
                    $wrapper.css({
                        'height'        : responsive.height
                    });
                    $canvas.css({
                        'height'        : responsive.height,
                        'width'         : responsive.width
                    });

                    resize_complete(function(){
                        go(false,state.currentslide);
                    }, 200, "some unique string");

                });

            }

        };

        var resize_complete = (function () {
            
            var timers = {};
            
            return function (callback, ms, uniqueId) {
                if (!uniqueId) {
                    uniqueId = "Don't call this twice without a uniqueId";
                }
                if (timers[uniqueId]) {
                    clearTimeout (timers[uniqueId]);
                }
                timers[uniqueId] = setTimeout(callback, ms);
            };

        })();

        // enforce fixed sizing on slides, slider and wrapper
        var conf_static = function() {

            $slides.css({
                'height'    : settings.height,
                'width'     : settings.width
            });
            $slider.css({
                'height'    : settings.height,
                'width'     : settings.width
            });
            $wrapper.css({
                'height'    : settings.height,
                'width'     : settings.width,
                'position'  : 'relative'
            });

        };

        var conf_slide = function() {

            // create two extra elements which are clones of the first and last slides
            $clone_first    = $slides.eq(0).clone();
            $clone_last     = $slides.eq(state.slidecount-1).clone();

            // add them to the DOM where we need them
            $clone_first.attr({'data-clone' : 'last', 'data-slide' : 0}).appendTo($slider).show();
            $clone_last.attr({'data-clone' : 'first', 'data-slide' : 0}).prependTo($slider).show();

            // update the elements object
            $slides             = $slider.children('li');
            state.slidecount    = $slides.length;

            // create a 'canvas' element which is neccessary for the slide animation to work
            $canvas = $('<div class="bjqs-wrapper"></div>');

            // if the slider is responsive && the calculated width is less than the max width
            if(settings.responsive && (responsive.width < settings.width)){

                $canvas.css({
                    'width'     : responsive.width,
                    'height'    : responsive.height,
                    'overflow'  : 'hidden',
                    'position'  : 'relative'
                });

                // update the dimensions to the slider to accomodate all the slides side by side
                $slider.css({
                    'width'     : responsive.width * (state.slidecount + 2),
                    'left'      : -responsive.width * state.currentslide
                });

            }
            else {

                $canvas.css({
                    'width'     : settings.width,
                    'height'    : settings.height,
                    'overflow'  : 'hidden',
                    'position'  : 'relative'
                });

                // update the dimensions to the slider to accomodate all the slides side by side
                $slider.css({
                    'width'     : settings.width * (state.slidecount + 2),
                    'left'      : -settings.width * state.currentslide
                });

            }

            // add some inline styles which will align our slides for left-right sliding
            $slides.css({
                'float'         : 'left',
                'position'      : 'relative',
                'display'       : 'list-item'
            });

            // 'everything.. in it's right place'
            $canvas.prependTo($wrapper);
            $slider.appendTo($canvas);

        };

        var conf_controls = function() {

            // create the elements for the controls
            $c_wrapper  = $('<ul class="bjqs-controls"></ul>');
            $c_fwd      = $('<li class="bjqs-next"><a href="#" data-direction="'+ vars.fwd +'">' + settings.nexttext + '</a></li>');
            $c_prev     = $('<li class="bjqs-prev"><a href="#" data-direction="'+ vars.prev +'">' + settings.prevtext + '</a></li>');

            // bind click events
            $c_wrapper.on('click','a',function(e){

                e.preventDefault();
                var direction = $(this).attr('data-direction');

                if(!state.animating){

                    if(direction === vars.fwd){
                        go(vars.fwd,false);
                    }

                    if(direction === vars.prev){
                        go(vars.prev,false);
                    }

                }

            });

            // put 'em all together
            $c_prev.appendTo($c_wrapper);
            $c_fwd.appendTo($c_wrapper);
            $c_wrapper.appendTo($wrapper);

            // vertically center the controls
            if (settings.centercontrols) {

                $c_wrapper.addClass('v-centered');

                // calculate offset % for vertical positioning
                var offset_px   = ($wrapper.height() - $c_fwd.children('a').outerHeight()) / 2,
                    ratio       = (offset_px / settings.height) * 100,
                    offset      = ratio + '%';

                $c_fwd.find('a').css('top', offset);
                $c_prev.find('a').css('top', offset);

            }

        };

        var conf_markers = function() {

            // create a wrapper for our markers
            $m_wrapper = $('<ol class="bjqs-markers"></ol>');

            // for every slide, create a marker
            $.each($slides, function(key, slide){

                var slidenum    = key + 1,
                    gotoslide   = key + 1;
                
                if(settings.animtype === 'slide'){
                    // + 2 to account for clones
                    gotoslide = key + 2;
                }

                var marker = $('<li><a href="#">'+ slidenum +'</a></li>');

                // set the first marker to be active
                if(slidenum === state.currentslide){ marker.addClass('active-marker'); }

                // bind the click event
                marker.on('click','a',function(e){
                    e.preventDefault();
                    if(!state.animating && state.currentslide !== gotoslide){
                        go(false,gotoslide);
                    }
                });

                // add the marker to the wrapper
                marker.appendTo($m_wrapper);

            });

            $m_wrapper.appendTo($wrapper);
            $m_markers = $m_wrapper.find('li');

            // center the markers
            if (settings.centermarkers) {
                $m_wrapper.addClass('h-centered');
                var offset = (settings.width - $m_wrapper.width()) / 2;
                $m_wrapper.css('left', offset);
            }

        };

        var conf_keynav = function() {

            $(document).keyup(function (event) {

                if (!state.paused) {
                    clearInterval(state.interval);
                    state.paused = true;
                }

                if (!state.animating) {
                    if (event.keyCode === 39) {
                        event.preventDefault();
                        go(vars.fwd, false);
                    } else if (event.keyCode === 37) {
                        event.preventDefault();
                        go(vars.prev, false);
                    }
                }

                if (state.paused && settings.automatic) {
                    state.interval = setInterval(function () {
                        go(vars.fwd);
                    }, settings.animspeed);
                    state.paused = false;
                }

            });

        };

        var conf_hoverpause = function() {

            $wrapper.hover(function () {
                if (!state.paused) {
                    clearInterval(state.interval);
                    state.paused = true;
                }
            }, function () {
                if (state.paused) {
                    state.interval = setInterval(function () {
                        go(vars.fwd, false);
                    }, settings.animspeed);
                    state.paused = false;
                }
            });

        };

        var conf_captions = function() {

            $.each($slides, function (key, slide) {

                var caption = $(slide).children('img:first-child').attr('title');

                // Account for images wrapped in links
                if(!caption){
                    caption = $(slide).children('a').find('img:first-child').attr('title');
                }

                if (caption) {
                    caption = $('<p class="bjqs-caption">' + caption + '</p>');
                    caption.appendTo($(slide));
                }

            });

        };

        var conf_random = function() {

            var rand            = Math.floor(Math.random() * state.slidecount) + 1;
            state.currentslide  = rand;
            state.currentindex  = rand-1;

        };

        var set_next = function(direction) {

            if(direction === vars.fwd){
                
                if($slides.eq(state.currentindex).next().length){
                    state.nextindex = state.currentindex + 1;
                    state.nextslide = state.currentslide + 1;
                }
                else{
                    state.nextindex = 0;
                    state.nextslide = 1;
                }

            }
            else{

                if($slides.eq(state.currentindex).prev().length){
                    state.nextindex = state.currentindex - 1;
                    state.nextslide = state.currentslide - 1;
                }
                else{
                    state.nextindex = state.slidecount - 1;
                    state.nextslide = state.slidecount;
                }

            }

        };

        var go = function(direction, position) {

            // only if we're not already doing things
            if(!state.animating){

                // doing things
                state.animating = true;

                if(position){
                    state.nextslide = position;
                    state.nextindex = position-1;
                }
                else{
                    set_next(direction);
                }

                // fade animation
                if(settings.animtype === 'fade'){

                    if(settings.showmarkers){
                        $m_markers.removeClass('active-marker');
                        $m_markers.eq(state.nextindex).addClass('active-marker');
                    }

                    // fade out current
                    $slides.eq(state.currentindex).fadeOut(settings.animduration);
                    // fade in next
                    $slides.eq(state.nextindex).fadeIn(settings.animduration, function(){

                        // update state variables
                        state.animating = false;
                        state.currentslide = state.nextslide;
                        state.currentindex = state.nextindex;

                    });

                }

                // slide animation
                if(settings.animtype === 'slide'){

                    if(settings.showmarkers){
                        
                        var markerindex = state.nextindex-1;

                        if(markerindex === state.slidecount-2){
                            markerindex = 0;
                        }
                        else if(markerindex === -1){
                            markerindex = state.slidecount-3;
                        }

                        $m_markers.removeClass('active-marker');
                        $m_markers.eq(markerindex).addClass('active-marker');
                    }

                    // if the slider is responsive && the calculated width is less than the max width
                    if(settings.responsive && ( responsive.width < settings.width ) ){
                        state.slidewidth = responsive.width;
                    }
                    else{
                        state.slidewidth = settings.width;
                    }

                    $slider.animate({'left': -state.nextindex * state.slidewidth }, settings.animduration, function(){

                        state.currentslide = state.nextslide;
                        state.currentindex = state.nextindex;

                        // is the current slide a clone?
                        if($slides.eq(state.currentindex).attr('data-clone') === 'last'){

                            // affirmative, at the last slide (clone of first)
                            $slider.css({'left': -state.slidewidth });
                            state.currentslide = 2;
                            state.currentindex = 1;

                        }
                        else if($slides.eq(state.currentindex).attr('data-clone') === 'first'){

                            // affirmative, at the fist slide (clone of last)
                            $slider.css({'left': -state.slidewidth *(state.slidecount - 2)});
                            state.currentslide = state.slidecount - 1;
                            state.currentindex = state.slidecount - 2;

                        }

                        state.animating = false;

                    });

                }

            }

        };

        // lets get the party started :)
        init();

    };

})(jQuery);
    </script>
<!--
    <script>

        jQuery(document).ready(function ($) {

            var slideCount = $('#slideviewart ul li').length;
            var slideWidth = $('#slideviewart ul li').width();
            var slideHeight = $('#slideviewart ul li').height();
            var sliderUlWidth = slideCount * slideWidth;

            $('#slideviewart').css({ width: slideWidth, height: slideHeight });

            $('#slideviewart ul').css({ width: sliderUlWidth, marginLeft: - slideWidth });

            $('#slideviewart ul li:last-child').prependTo('#slideviewart ul');

            function moveLeft() {
                $('#slideviewart ul').animate({
                    left: + slideWidth
                }, 200, function () {
                    $('#slideviewart ul li:last-child').prependTo('#slideviewart ul');
                    $('#slideviewart ul').css('left', '');
                });
            };

            function moveRight() {
                $('#slideviewart ul').animate({
                    left: - slideWidth
                }, 200, function () {
                    $('#slideviewart ul li:first-child').appendTo('#slideviewart ul');
                    $('#slideviewart ul').css('left', '');
                });
            };

            $('a.control_prev').click(function () {
                moveLeft();
            });

            $('a.control_next').click(function () {
                moveRight();
            });

        });



    </script>
-->

    <script>
        $(document).ready(function(){
            $('.addBasket').click(function(e){
                e.preventDefault();

                var idProduct = $(this).data('id');
                var idQuantity = $('#number').val();

                $.ajax({
                    url: '<?=$this->url('ajax_addToCartView'); ?>',
                    type: 'post',
                    cache: false,
                    data: {id_product: idProduct, id_quantity: idQuantity},  // $_POST['id_product']
                    dataType: 'json',
                    success: function(out){
                        if(out.code == 'ok'){
                            $('body').load('<?=$this->url('viewArt', ['id' => $items['id']]);?>');
                        }
                    }
                });
            });

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
                            $('body').load('<?=$this->url('viewArt', ['id' => $items['id']]);?>');
                        }
                    }
                });
            });

            $('.favorite2').click(function(e){
                e.preventDefault();

                var idFavorite = $(this).data('id');

                function favIcon() // Change l'îcone favoris sans recharger la page
                {
                    if($('.'+idFavorite).hasClass('fa-heart-o')){ // On vérifie que l'élement avec l'ID contenu dans idFavorite a la class fa-heart-o
                        $('.'+idFavorite).removeClass('fa-heart-o'); // On vire la class
                        $('.'+idFavorite).addClass('fa-heart'); // On rajoute une nouvelle
                        $('.'+idFavorite).css('color', '#c11131'); // On change la couleur
                    }
                    else if($('.'+idFavorite).hasClass('fa-heart')){ // On vérifie que l'élement avec l'ID contenu dans idFavorite a la class fa-heart
                        $('.'+idFavorite).removeClass('fa-heart'); // On vire la class
                        $('.'+idFavorite).addClass('fa-heart-o'); // On rajoute une nouvelle
                        $('.'+idFavorite).css('color', '#999999'); // On change la couleur
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
        });
    </script>

    <!-- SCRIPT PARTAGE MEDIAS SOCIAUX -->
    <!--TWITTER-->
    <script>

        (function(){

            var popupCenter = function(url, title, width, height){

                var popupWidth = width || 640;

                var popupHeight = height || 320;

                var windowLeft = window.screenLeft || window.screenX;

                var windowTop = window.screenTop || window.screenY;

                var windowWidth = window.innerWidth || document.documentElement.clientWidth;

                var windowHeight = window.innerHeight || document.documentElement.clientHeight;

                var popupWidth = 640;

                var popupHeight = 320;

                var popupLeft = windowLeft + windowWidth / 2 - popupWidth / 2;

                var popupTop = windowTop + windowHeight / 2 - popupHeight / 2;

                window.open(url, title, 'scrollbar=yes, width= ' + popupWidth + ', height=' + popupHeight +', top='+ popupTop +', left='+ popupLeft +'');

            };


            document.querySelector('.share_twitter').addEventListener('click', function(e){
                e.preventDefault();

                var url = this.getAttribute('data-url');

                var shareUrl = "https://twitter.com/intent/tweet?text=" + encodeURIComponent(document.title) + 
                    "&via=Klickit33" + 
                    "&url=" + encodeURIComponent(url);

                popupCenter(shareUrl, "Partager sur Twitter")
            });    




            /*<!--FACEBOOK-->*/



            document.querySelector('.share_facebook').addEventListener('click', function(e){
                e.preventDefault();

                var url = this.getAttribute('data-url');

                var shareUrl = "https://www.facebook.com/sharer/sharer.php?u=" + encodeURIComponent(url);

                popupCenter(shareUrl, "Partagez sur facebook");

            });    

        })();

    </script>
    <?php $this->stop('js')?>