<?php $this->layout('layoutfront', ['title' => 'Panier de commande']) ?>

<?php $this->start('main_content') ?>
<div class="container">
	<!--order progress steps bar-->
	<div class="row">
		<ul class="breadcrumb">
    		<li class="completed"><a id="breadcrumb" href="javascript:void(0);">Récapitulatif</a></li>
			<!-- <li><a id="breadcrumb" href="javascript:void(0);">Connexion</a></li> -->
			<li><a id="breadcrumb" href="javascript:void(0);">Adresse</a></li>
			<li><a id="breadcrumb" href="javascript:void(0);">Paiement</a></li>
		</ul>
	</div>
	<!--End order progress steps bar-->
	<br><br>
    
    <!--Title et border-->
    <form>
        <div class="order_box">
            <h1 class="order_title">Récapitulatif de commande</h1>
            <hr>
            <!-- ******************************************** SI COMMANDE DEJA EN COURS **************************************** -->
            <?php if($order['order_process'] == 'EnCours'): ?>
                <table class="table">
                    <thead> 
                        <tr> 
                            <th>Article</th> 
                            <th>Description</th> 
                            <th>Prix unitaire</th> 
                            <th>Quantité</th>
                            <th>Total</th>
                            <th></th>
                        </tr> 
                    </thead> 
                    <tbody>
                        <?php 
                            $content = ''; 
                            $qyt = '';

                            foreach ($quantity as $allQuantity) { 
                                foreach ($allQuantity as $all) { 
                                    $qyt.= $all.', '; 
                                }
                            }
                        ?>
                        <?php foreach($w_items as $item) :?> 
                            <?php $content.= $item['id'].', '; ?> 
                            <tr> 
                                <td scope="row"><img class="img-responsive" src="<?=$this->assetUrl('art/'.$item['picture1']);?>" style="width: 15vw;margin:0 auto;"></td> 
                                <td>
                                    <li class="ordertable_title"><?=$item['name']?><li>
                                    <li class="ordertable_text">Référence: <?=$item['id']?><li>
                                </td>

                                <?php if($item['newPrice'] == 0) :?> 
                                    <td><p class="ordertable_title"><?=$item['price']?> €<p></td>
                                <?php elseif($item['newPrice'] > 0) :?>
                                    <td><p class="ordertable_title"><?=$item['newPrice']?> €<p></td>
                                <?php endif;?> 

                                <td><p class="ordertable_title"><input type="number" name="u_quantityBasket" id="number" value="<?=$item['qt']?>"><p><button type="button" class="quantity_item">nvll quantité</button><p></td>

                                <?php if($item['newPrice'] == 0) :?>  
                                    <td><p class="ordertable_title"><?=$item['qt']*$item['price']?> €<p></td>
                                <?php elseif($item['newPrice'] > 0) :?>
                                    <td><p class="ordertable_title"><?=$item['qt']*$item['newPrice']?> €<p></td>
                                <?php endif; ?>       
                                <td><p class="ordertable_title"><i class="fa fa-trash" aria-hidden="true" style="color: #000;" data-id="<?=$item['id']?>"></i><p></td>
                            </tr>
                        <?php endforeach; ?>              
                    </tbody> 
                </table>
                <div class="orderlist_total">
                    <input type="hidden" name="u_id" value="<?=$content;?>">
                    <input type="hidden" name="u_quantity" value="<?=$qyt;?>">
                    <?php if($country['0']['country'] == ''): ?>
                        <li>
                            <select class="country_choice" name="country_choice">
                                <option value="France">France</option>
                                <option value="Belgique">Belgique</option>
                                <option value="Suisse">Suisse</option>
                                <option value="Chine">Chine</option>
                                <option value="Etat-Unis">Etat-Unis</option>
                            </select>
                            <br>
                            <button type="button" class="selectCountry">Enregistrer le pays</button>
                        </li>
                    <?php elseif($country['0']['country'] == 'France'): ?>
                        <input type="hidden" name="u_country" value="<?=$country['0']['country']?>">
                        <ul  style="float:right;">
                                <li>
                                    <p><?=$total?> €</p>
                                    <input type="hidden" name="u_sub_total" value="<?=$total?>">
                                    <p><?=$fdp?> €</p>
                                    <input type="hidden" name="u_shipping" value="<?=$fdp?>">
                                    <p><strong><?=$fdp + $total?> €</strong></p>
                                    <input type="hidden" name="u_total" value="<?=$fdp+$total?>">
                                </li>
                        </ul>
                        <ul>
                            <li>
                                <p>Total articles :</p>
                                <p>Frais de port :</p>
                                <p>TOTAL COMMANDE :</p>
                            </li>
                        </ul>
                    <?php endif; ?>
                </div>
                    <!-- *************************************************************************************************** -->
                    <!-- ************************************* SI NOUVELLE COMMANDE **************************************** -->
            <?php else: ?>
                <table class="table">
                    <thead> 
                        <tr> 
                            <th>Article</th> 
                            <th>Description</th> 
                            <th>Prix unitaire</th> 
                            <th>Quantité</th>
                            <th>Total</th>
                            <th></th>
                        </tr> 
                    </thead> 
                    <tbody>
                        <?php 
                            $content = ''; // J'instancie la variable qui contiendra tout les id des articles
                            $qyt = ''; // J'instancie la variable qui contiendra toute les quantités des articles

                            foreach ($quantity as $allQuantity) { // Ici grâce à la fonction que j'ai crée dans le BasketModel je récupère toute les quantité dans la table Basket en fonction de l'utilisateur, je la foreach une fois ... Tableau multidimensionnel oblige
                                foreach ($allQuantity as $all) { // Je foreach une deuxième fois pour contenir le tout sous forme de sring dans la BDD avec pour séparateur ', ' ... la fonction trim enlèvera le dernier espèce  
                                    $qyt.= $all.', '; // Et donc la variable $qyt contient toute les quantités séparé par ', ' 
                                }
                            }
                        ?>
                        <?php foreach($w_items as $item) :?> 
                            <?php $content.= $item['id'].', '; // Et la, comme au dessus, le foreach me permet de stock tout les id des articles sous forme de string avec comme séparateur ', '?> 
                            <tr> 
                                <td scope="row"><img class="img-responsive" src="<?=$this->assetUrl('art/'.$item['picture1']);?>" style="width: 15vw;margin:0 auto;"></td> 
                                <td>
                                    <li class="ordertable_title"><?=$item['name']?><li>
                                    <li class="ordertable_text">Référence: <?=$item['id']?><li>
                                </td>

                                <?php if($item['newPrice'] == 0) :?> 
                                    <td><p class="ordertable_title"><?=$item['price']?> €<p></td>
                                <?php elseif($item['newPrice'] > 0) :?>
                                    <td><p class="ordertable_title"><?=$item['newPrice']?> €<p></td>
                                <?php endif;?> 

                                <td><p class="ordertable_title"><?=$item['qt']?></p><button type="button" data-id="<?=$item['id']?>" class="plus_quantity"><i class="fa fa-plus" style="color:black;" aria-hidden="true"></i></button><button type="button" data-id="<?=$item['id']?>" class="moins_quantity"><i class="fa fa-minus" style="color:black;" aria-hidden="true"></i></td>

                                <?php if($item['newPrice'] == 0) :?>  
                                    <td><p class="ordertable_title"><?=$item['qt']*$item['price']?> €<p></td>
                                <?php elseif($item['newPrice'] > 0) :?>
                                    <td><p class="ordertable_title"><?=$item['qt']*$item['newPrice']?> €<p></td>
                                <?php endif; ?>       
                                <td><p class="ordertable_title"><i class="fa fa-trash" aria-hidden="true" style="color: #000;" data-id="<?=$item['id']?>"></i><p></td>
                            </tr>
                        <?php endforeach; ?>                  
                    </tbody> 
                </table>
        		<div class="orderlist_total">
                    <!-- Et donc ici on met les deux input hidden, en dehors du foreach au dessus, avec pour value les variables qui stock tout les ID des articles ainsi que toute les quantités liées  -->
                    <input type="hidden" name="id" value="<?=$content;?>">
                    <input type="hidden" name="quantity" value="<?=$qyt;?>">
                    <?php if($country['0']['country'] == ''): ?>
                        <li>
                            <select class="country_choice" name="country_choice">
                                <option value="France">France</option>
                                <option value="Belgique">Belgique</option>
                                <option value="Suisse">Suisse</option>
                                <option value="Chine">Chine</option>
                                <option value="Etat-Unis">Etat-Unis</option>
                            </select>
                            <br>
                            <button type="button" class="selectCountry">Enregistrer le pays</button>
                        </li>
                    <?php elseif($country['0']['country'] == 'France'): ?>
                        <input type="hidden" name="country" value="<?=$country['0']['country']?>">
                        <ul  style="float:right;">
                				<li>
                					<p><?=$total?> €</p>
                                    <input type="hidden" name="sub_total" value="<?=$total?>">
                					<p><?=$fdp?> €</p>
                                    <input type="hidden" name="shipping" value="<?=$fdp?>">
                					<p><strong><?=$fdp + $total?> €</strong></p>
                                    <input type="hidden" name="total" value="<?=$fdp+$total?>">
                				</li>
                        </ul>
                        <ul>
                            <li>
                                <p>Total articles :</p>
                                <p>Frais de port :</p>
                                <p>TOTAL COMMANDE :</p>
                            </li>
                        </ul>
                <?php endif; ?>
        		</div>
            <?php endif; ?>
        </div>
    </form>  
    <!--End title et border-->

    <!--Frais de port-->
    <div class="container_general">
        <div class="orderfrais_border">
            <p class="orderfrais_title">Information frais de port</p>
            <ol class="orderfrais_list">
                <h3><i class="fa fa-globe" aria-hidden="true" style="color:#000;"> <span class="orderfraislist_title">France Métropolitaine</span></i></h3>
                <li>1 à 3 personnages ( <span class="orderfrais_price">+ 2,50€</span> )</li>
                <li>4 à 8 personnages ( <span class="orderfrais_price">+ 3,90€</span> )</li>
                <li>au dela de 8 personnages ( <span class="orderfrais_price">+ 6.90€</span> )</li>
                <li>pièces & customs en rèsine ou peints ( <span class="orderfrais_price">+ 6.90€</span> )</li>
            </ol>
        </div>
    </div>
    <!--End frais de port-->
    
    <?php if($order['order_process'] == 'EnCours'): ?> <!-- ***************** SI L'UTILISATEUR A UNE COMMANDE EN COURS ***************** -->
        <!--order buttons-->
        <br><br>
        <div class="row">
            <div class="col-md-6 order_buttonscapL">
                <button type="button" class="btn btn-primary order_buttonpadding ordercontinu_color">CONTINUER MES ACHATS</button>
            </div>
            <div class="col-md-6 order_buttonscapR">
                <?php if($country['0']['country'] == ''): ?>
                    <button type="button" disabled="disabled" class="btn btn-primary order_buttonpadding ordercommander_color poursuit-order">POURSUIVRE MA COMMANDE</button>
                <?php else: ?>
                    <button type="button" class="btn btn-primary order_buttonpadding ordercommander_color poursuit-order">POURSUIVRE MA COMMANDE</button>
                <?php endif; ?>
            </div>
        </div>
        <!--End order buttons-->
    <?php else: ?> <!-- **************** SI L'UTILISATEUR N'A PAS DE COMMANDE EN COURS *************** -->
        <!--order buttons-->
        <br><br>
        <div class="row">
            <div class="col-md-6 order_buttonscapL">
                <button type="button" class="btn btn-primary order_buttonpadding ordercontinu_color">CONTINUER MES ACHATS</button>
            </div>
            <div class="col-md-6 order_buttonscapR">
                <?php if($country['0']['country'] == ''): ?>
                    <button type="button" disabled="disabled" class="btn btn-primary order_buttonpadding ordercommander_color get-order">COMMANDER</button>
                <?php else: ?>
                    <button type="button" class="btn btn-primary order_buttonpadding ordercommander_color get-order">COMMANDER</button>
                <?php endif; ?>
            </div>
        </div>
        <!--End order buttons-->
    <?php endif; ?>
</div>
<br><br>
<?php $this->stop('main_content') ?>

<?php $this->start('js') ?>
    <script>
        $(document).ready(function(){
            $('.fa-trash').click(function(e){
                e.preventDefault();

                var idDelete = $(this).data('id');

                $.ajax({
                    url: '<?=$this->url('ajax_deleteArt'); ?>',
                    type: 'post',
                    cache: false,
                    data: {id_delete: idDelete},  // $_POST['id_product']
                    dataType: 'json',
                    success: function(out){
                        if(out.code == 'ok'){
                            $('body').load('<?=$this->url('front_orderList');?>');
                        }
                    }
                });
            });
        });
    </script>

    <script>
        //Pour une nouvelle commande
        $(document).ready(function(){
            $('.get-order').click(function(e){
                e.preventDefault();

                $.ajax({
                    url: '<?=$this->url('ajax_newOrder'); ?>',
                    type: 'post',
                    cache: false,
                    data: $('form').serialize(),  
                    dataType: 'json',
                    success: function(out){
                        if(out.code == 'ok'){
                            //window.location.assign('//$this->url('front_orderAddress');');
                            $('body').load('<?=$this->url('front_orderAddress');?>');
                        }
                    }
                });
            });
        });
    </script>

    <script>
        $(document).ready(function(){
            $('.selectCountry').click(function(e){
                e.preventDefault();

                $.ajax({
                    url: '<?=$this->url('ajax_updateCountry');?>',
                    type: 'post',
                    cache: false,
                    data: $('.country_choice'),
                    dataType: 'json',
                    success: function(up){
                        if(up.code == 'ok'){
                            $('body').load('<?=$this->url('front_orderList');?>');
                        }
                    }
                });
            });
        });
    </script>

    <script>
        //Update d'une commande
        $(document).ready(function(){
            $('.poursuit-order').click(function(e){
                e.preventDefault();

                $.ajax({
                    url: '<?=$this->url('ajax_updateOrder');?>',
                    type: 'post',
                    cache: false,
                    data: $('form').serialize(),
                    dataType: 'json',
                    success: function(up){
                        if(up.code == 'ok'){
                            $('body').load('<?=$this->url('front_orderAddress');?>');
                        }
                    }
                });
            });
        });
    </script>

    <script>
        //+1 quantités depuis my_order
        $(document).ready(function(){
            $('.plus_quantity').click(function(e){
                e.preventDefault();

                var idProduct = $(this).data('id');

                $.ajax({
                    url: '<?=$this->url('ajax_updateQuantity');?>',
                    type: 'post',
                    cache: false,
                    data: {id_product: idProduct},
                    dataType: 'json',
                    success: function(up){
                        if(up.code == 'ok'){
                           $('body').load('<?=$this->url('front_orderList');?>');
                        }else if(up.code == 'no'){
                            console.log('nooooooooo');
                        }
                    }
                });
            });
        });
    </script>

    <script>
        // -1 quantités depuis my_order 
        $(document).ready(function(){
            $('.moins_quantity').click(function(e){
                e.preventDefault();

                var idProduct = $(this).data('id');

                $.ajax({
                    url: '<?=$this->url('ajax_updateQuantitySubtraction');?>',
                    type: 'post',
                    cache: false,
                    data: {id_product: idProduct},
                    dataType: 'json',
                    success: function(up){
                        if(up.code == 'ok'){
                           $('body').load('<?=$this->url('front_orderList');?>');
                        }else if(up.code == 'no'){
                            console.log('nooooooooo');
                        }
                    }
                });
            });
        });
    </script>
<?php $this->stop('js') ?>
