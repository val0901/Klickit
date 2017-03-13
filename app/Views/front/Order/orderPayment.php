<?php $this->layout('layoutfront', ['title' => 'Choix du paiement']) ?>

<?php $this->start('main_content') ?>
<div class="container">
    <!--order progress steps bar-->
    <div class="row">
        <ul class="breadcrumb">
            <li class="completed"><a id="breadcrumb" class="js_orderList" href="">Récapitulatif</a></li>
            <!-- <li class="completed"><a id="breadcrumb" href="javascript:void(0);">Connexion</a></li> -->
            <li class="completed"><a id="breadcrumb" class="js_orderAddress" href="">Adresse</a></li>
            <li class="completed"><a id="breadcrumb" href="javascript:void(0);">Paiement</a></li>
        </ul>
    </div>
    <!--End order progress steps bar-->
    <br><br>

    <!--Title et border-->
    <div class="row">
        <div class="col-md-3">

        </div>
        <div class="col-md-6 orderlogin_box">
            <h1>VOTRE ADRESSE DE LIVRAISON</h1>
            <br><br>
            <form>
                <!--
<div class="radio">
<label class="radio myorder">
<input type="radio" name="payment" id="cartebancaire" value="cartebancaire" class="orderpayment_checked2">
<div class="clear"></div>
<li style="float: left;margin:0 20px;">
<i class="fa fa-credit-card-alt fa-4x img-responsive selectCarteBancaire" aria-hidden="true" id="ordercheque_hover"></i>
</li>
<li class="orderpayment_text" style="float:left;">Carte Bancaire</li>
</label>
</div>	
<br>
-->

                <div class="orderpaymentradio_margin">
                    <div class="radio">
                        <label class="radio myorder">
                            <input type="radio" name="payment" data-id="orderpaypal_hover" value="paypal" class="payment orderpayment_checked1">
                            <div class="clear">
                            </div>
                            <li style="float: left;margin:0 20px;">
                                <i class="fa fa-cc-paypal fa-4x img-responsive colorPaymentEmpty payment orderpaypal_hover" id="orderpaypal_hover" aria-hidden="true">
                                </i>

                                <!--
<img class="img-responsive" id="selectPaypal" src="" id="orderpaypal_hover">
-->
                            </li>
                            <li class="orderpayment_text" style="float:left;">Paypal ou</li>
                            <li style="float: left;margin:0 20px;">
                                <i class="fa fa-credit-card fa-4x img-responsive colorPaymentEmpty payment orderpaypal_hover" id="orderpaypal_hover" aria-hidden="true">
                                </i>
                            </li>
                            <li class="orderpayment_text" style="float:left;">Carte Bleue</li>
                            
                        </label>
                    </div>	
                    <br>
                    <div class="radio">
                        <label class="radio myorder">
                            <input type="radio" name="payment" data-id="ordercheque_hover" value="cheque" class="payment orderpayment_checked2">
                            <div class="clear"></div>
                            <li style="float: left;margin:0 20px;">
                                <i class="fa fa-id-card-o fa-4x img-responsive colorPaymentEmpty payment" aria-hidden="true" id="ordercheque_hover"></i>

                                <!--
<img class="img-responsive" id="selectCheque" src="<?/*=$this->assetUrl('/img/paychq.png');*/?>" id="ordercheque_hover">
-->
                            </li>
                            <li class="orderpayment_text" style="float:left;">Chèque</li>
                        </label>
                    </div>	
                    <br>
                    <div class="radio">
                        <label class="radio myorder">
                            <input type="radio" name="payment" data-id="ordervirement_hover" value="virement" class="payment orderpayment_checked3">
                            <div class="clear"></div>
                            <li style="float: left;margin:0 20px;">
                                <i class="fa fa-exchange fa-4x img-responsive colorPaymentEmpty payment" aria-hidden="true" id="ordervirement_hover"></i>

                                <!--
<img class="img-responsive" id="selectVirement" src="<?/*=$this->assetUrl('/img/payvir.png');*/?>" id="ordervirement_hover">
-->
                            </li>
                            <li class="orderpayment_text" style="float:left;">Virement</li>
                        </label>
                    </div>
                </div>
                <br>
                <div style="text-align:center;">
                    <button type="submit" class="btn btn-default orderlogin_button2 orderpayment_button"><span class="orderpayment_buttontext"> PAYER</span></button>
                </div>
            </form>
            <br><br>
        </div>
        <div class="col-md-3">

        </div>
    </div>
    <!--End title et border-->

    <!--prix total-->
    <br><br>
    <div class="row">
        <div class="col-md-7">
            <div class="orderlist_total">
                <ul  style="float:right;">
                    <li>
                        <p><?=$order['sub_total'];?></p>
                        <p><?=$order['shipping'];?></p>
                        <p><strong><?=$order['total'];?></strong></p>
                    </li>
                </ul>
                <ul>
                    <li>
                        <p>Total articles :</p>
                        <p>frais de port :</p>
                        <p>TOTAL COMMANDE :</p>
                    </li>
                </ul>
            </div>
        </div>
        <div class="col-md-3">

        </div>
        <div class="col-md-3">
        </div>
    </div>

    <!--End prix total-->
</div>
<br><br>
<?php $this->stop('main_content') ?>


<!--CHANGE COLOR PAYMENT-->
<?php $this->start('js') ?>
<script>
    // Class paiement a rajouter à toute les méthodes, pour gérer sur quoi nous cliquons quand on active le script
    $('.payment').click(function(){
        // Possibilité de stocker "$(this).data('id')" dans une variable aussi et de mettre la variable en paramètre
        // var idMethod = $(this).data('id');
        var idMethod = $(this).data('id');
        methodIcon(idMethod);

        function methodIcon(idMethod)
        {       
            // On remet toute les méthodes de paiement en gris en modifiant leurs class, on vérifie d'abord si elles sont vert et si elles le sont ont enlève la class vert et rajoute la class gris

            // On vérifie les class pour la méthode de paiement 1
            if($('.orderpaypal_hover').hasClass('colorPaymentCheck')){
                // Et on enlève la class qui met en vert pour la mettre en gris
                $('.orderpaypal_hover').removeClass('colorPaymentCheck');
                $('.orderpaypal_hover').addClass('colorPaymentEmpty');
            }

            // On vérifie les class pour la méthode de paiement 2
            if($('#ordercheque_hover').hasClass('colorPaymentCheck')){
                // Et on enlève la class qui met en vert pour la mettre en gris
                $('#ordercheque_hover').removeClass('colorPaymentCheck');
                $('#ordercheque_hover').addClass('colorPaymentEmpty');
            }

            // On vérifie les class pour la méthode de paiement 3
            if($('#ordervirement_hover').hasClass('colorPaymentCheck')){
                // Et on enlève la class qui met en vert pour la mettre en gris
                $('#ordervirement_hover').removeClass('colorPaymentCheck');
                $('#ordervirement_hover').addClass('colorPaymentEmpty');
            }

            // Ici on prend l'ID dynamiquement pour lui rajouter la class verte
            if(idMethod == 'orderpaypal_hover'){ // Si le paramètre est égale à l'id du choix par paypal alors ...
                // On gère par class pour pouvoir modifier la couleur des deux <i> 
                $('.'+idMethod).addClass('colorPaymentCheck');
            }
            else{ // Sinon on gère par ID pour sélectionner seulement le <i> qui nous intéresse
                $('#'+idMethod).addClass('colorPaymentCheck'); // On rajoute une nouvelle
            }
        }
    });    
</script>


<script>
    $(document).ready(function(){
        $('.orderpayment_button').click(function(e){
            e.preventDefault();

            $.ajax({
                url: '<?=$this->url('ajax_updateOrderPayment'); ?>',
                type: 'post',
                cache: false,
                data: $('form').serialize(),
                dataType: 'json',
                success: function(up){
                    if(up.code == 'paypal'){
                        window.location.href = up.link;
                    }
                    else {
                        window.location.href = "<?=$this->url('front_payNoPayPal');?>";
                    }
                }
            });
        });
    });
</script>

<script>
    $(document).ready(function(){
        $('.js_orderList').click(function(e){
            e.preventDefault();

            $('body').load('<?=$this->url('front_orderList');?>');
        });

        $('.js_orderAddress').click(function(e){
            e.preventDefault();

            $('body').load('<?=$this->url('front_orderAddress');?>');
        });
    });
</script>
<?php $this->stop('js') ?>