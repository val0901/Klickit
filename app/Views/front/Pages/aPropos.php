<?php $this->layout('layoutfront', ['title' => 'Klickit - à propos', 'meta' => 'Klickit, Custom Playmobil, Personnalisation Playmobil, ']) ?>

<?php $this->start('main_content') ?>
<div class="apropos_container">

    <h1 class="apropos_title">
    La boutique
    </h1>

    <p class="apropos_text head_apropos"><strong>©Klickit</strong> est une entreprise familiale, née d&#39;un passionné de Playmobil© et d&#39;histoire. Depuis plusieurs années, nous proposons à travers les expositions Playmobils copyright aux quatre coins de la France, de nombreux personnages issus des gammes Playmobil copyright, mais aussi des customs de personnages historiques réalisé par tampographie, créations de pièces en résine, peinture, stickers, pièces détachées, etc... </p>

    <p class="apropos_text">Désormais, nous vous proposons tous ses produits en ligne !</p>

    <p class="apropos_text">Nous nous efforçons de vous proposer le plus large choix possible de personnages ainsi que des nouveautés régulières.</p>

    <p class="apropos_text">Tous nos produits sont neufs ou d&#39;occasion proche du neuf.</p>

    <i class="fa fa-info-circle fa-2x apropospicinfo" aria-hidden="true"></i> <h2 class="apropos_txtinfo">Livraison</h2>

    <p class="apropos_text">Nous faisons notre maximum pour expédier les commandes en un minimum de temps, <strong>généralement 24 à 48h ouvré.</strong></p>

    <p class="apropos_text">Toutes nos expéditions pour la France sont traitées par La Poste. Les délais d&#39;acheminements sont donc ceux de La Poste : 24 à 48h pour une lettre suivie et 48h pour un colissimo.</p>

     <i class="fa fa-info-circle fa-2x apropospicinfo" aria-hidden="true"></i> <h2 class="apropos_txtinfo">Frais de port :</h2>
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
    <br><br>

    
     <i class="fa fa-info-circle fa-2x apropospicinfo" aria-hidden="true"></i> <h2 class="apropos_txtinfo paiement">Paiement</h2>
    <br><br>
    <table class="apropos_containpaie">
        <tr class="apropos_picsortpaie">
            <td class="apropos_td"><img src="<?=$this->assetUrl('img/logo_paypal_moyens_paiement_fr.png');?>" class="fa fa-cc-paypal fa-4x apropos_sortpaie" aria-hidden="true"></td>
            <td class="apropos_td"><img src="<?=$this->assetUrl('img/paypal_logo2.jpg');?>" class="fa fa-cc-paypal fa-4x apropos_sortpaie" aria-hidden="true"></td>
            <td class="apropos_td"><img src="<?=$this->assetUrl('img/paiement_cheque.jpg');?>" class="fa fa-cc-paypal fa-4x apropos_sortpaie" aria-hidden="true"></td>
            <td class="apropos_td"><img src="<?=$this->assetUrl('img/paiement_virement.jpg');?>" class="fa fa-cc-paypal fa-4x apropos_sortpaie" aria-hidden="true"></td>
        </tr>
        <tr class="apropos_sortpaie">
            <td class="apropos_td">CB</td>
            <td class="apropos_td">Paypal</td>
            <td class="apropos_td">Chèque</td>
            <td class="apropos_td">Virement</td>
        </tr>

<!--
        <div class="apropos_sortpaie">
           
            Paiement par carte bancaire<br>

            Paypal<br>

            
            Par chèque (expédition à réception du paiement)<br>

            
            Par virement bancaire<br>
        </div>
-->
    </table>
</div>
<?php $this->stop('main_content') ?>
