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
                    <?php foreach($w_items as $item) :?> 
                        <tr> 
                            <td scope="row"><img class="img-responsive" src="<?=$this->assetUrl('art/'.$item['picture1']);?>" style="width: 15vw;margin:0 auto;"></td> 
                            <td>
                                <li class="ordertable_title"><?=$item['name']?><li>
                                <li class="ordertable_text">Référence: <?=$item['id']?><li>
                                <input type="hidden" name="id" value="<?=$item['id'].', '?>">
                            </td>

                            <?php if($item['newPrice'] == 0) :?> 
                                <td><p class="ordertable_title"><?=$item['price']?> €<p></td>
                            <?php elseif($item['newPrice'] > 0) :?>
                                <td><p class="ordertable_title"><?=$item['newPrice']?> €<p></td>
                            <?php endif;?> 

                            <td><p class="ordertable_title"><input type="number" name="quantity" id="number" value="<?=$item['qt'].', '?>"><p></td>

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
    		</div>
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
    
    <!--order buttons-->
    <br><br>
    <div class="row">
        <div class="col-md-6 order_buttonscapL">
            <button type="button" class="btn btn-primary order_buttonpadding ordercontinu_color">CONTINUER MES ACHATS</button>
        </div>
        <div class="col-md-6 order_buttonscapR">
            <button type="button" class="btn btn-primary order_buttonpadding ordercommander_color get-order">COMMANDER</button>
        </div>
    </div>
    <!--End order buttons-->
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
                            window.location.href= window.location.href;
                        }
                    }
                });
            });
        });
    </script>

    <script>
        $(document).ready(function(){
            $('.get-order').click(function(e){
                e.preventDefault();

                $.ajax({
                    url: '<?=$this->url('ajax_newOrder'); ?>',
                    type: 'post',
                    cache: false,
                    data: $('form').serialize(),  // $_POST['id_product']
                    dataType: 'json',
                    success: function(out){
                        if(out.code == 'ok'){
                            //window.location.assign('<?=//$this->url('front_orderAddress');?>');
                            $('body').load('<?=$this->url('front_orderAddress');?>');
                        }
                    }
                });
            });
        });
    </script>
<?php $this->stop('js') ?>
