<?php $this->layout('layoutfront', ['title' => 'Paiement réussi']); ?>

<?php $this->start('main_content') ?>
<div class="container">
	<div class="row">
		<div class="col-lg-12 col-md-12 ordermidia_width">
		<p> Merci pour votre commande. Vous pourrez consulter cette facture dans votre <a href="<?=$this->url('front_listOrders')?>" class="hoverlinkorange">historique de commandes.</a></p><br>
            <div class="infopay">
                <p>Vous avez souhaité régler par chèque ou virement. Afin de finaliser votre commande, merci de prendre note de ses informations :</p><br>
                <p>Pour <strong>régler par chèque</strong>. Merci de le libeller à l'ordre de <strong>"KLICKIT"</strong> et d'inscrire au dos du chèque, le numéro de votre <span style="color:#ef820b;">commande N° <?=$idOrder['id']?></span>.</p>
                <p>Il sera à adresser à :<br>	
                <strong>KLICKIT<br>
                1, résidence beau pré<br>
                33650 Saucats</strong>
                </p>
                <br>
                <p>Pour <strong>régler par virement bancaire</strong>, merci d'indiquer lors de votre virement bancaire, le numéro de votre <span style="color:#ef820b;">commande N° <?=$idOrder['id']?></span>.</p>
                <p>Il sera à adresser à :<br>
                <strong>Laurent Lafont<br>
                IBAN : FR23 1001 1000 2003 3506 1893 K88<br>
                BIC : PSSTFRPPCNE</strong>
                </p>
                <br>
                <p class="bg-danger">Nous vous rappelons que le ou les produits vous sont réservés pour une période de 10 jours ouvrés suivant la date de validation de votre commande sur le site. Au delà de cette période, la non réception du règlement entraine l'annulation de la commande.</p>
            </div>    
	      <div class="listorder_contenu">
	          <div>
	              <div class="row">
	                  <div class="col-xs-6">
	                    <img src="<?=$this->assetUrl('/img/KLICKIT-logo-napoleon.png');?>">
	                    <p class="baseline_text">Créez l'histoire !</p>
	                  </div>
	                  <div class="col-xs-6">
	                      <p class="viewuserorder_title">COMMANDE</p>      
	                  </div>      
	              </div>
	              <br><br>
	              <div class="row">
	                  <div class="col-xs-6">
	                      <p>Laurent Lafont</p>
	                      <p>1, résidence beau pré</p>
	                      <p>33650 Saucats</p>
	                      <p>Téléphone 06 11 82 17 71</p>
	                  </div>
	                  <div class="col-xs-6">
	                  <?php if(!empty($order)) : ?>
	                      <p><strong>DATE : 
	                            <?php
	                              $date = date_create($order['date_creation']);
	                              echo date_format($date, 'd-m-Y');
	                            ?>   
	                          </strong></p>
	                      <p><strong>COMMANDE N° <?=$idOrder['id']?></strong></p>
	                  </div>
	              </div>
	              <br>
	              <p>N° SIRET : 753 966 464 00012</p>
	              <br><br>
	              <p><strong>Facturé à : <?=$user['firstname'].'&emsp;'.$user['lastname']?></strong></p>
	          </div>
	          
	          <!--viewuserorder table-->
	          <div class="table-responsive">
	              <table class="table table-bordered">
	                  <thead style="background-color: #ccc;">
	                      <tr>
	                          <th>DESCRIPTION</th>
	                          <th>Prix Unitaire</th>
	                          <th>Quantité</th>
	                          <th>MONTANT</th>
	                      </tr>
	                  </thead>
	                  <tbody>
	                  <?php $content =  explode(', ', $order['contenu']);?>
	                  <?php $qte = explode(', ', $order['quantity']); ?>
	  
	                  <?php foreach($content as $key => $value) : ?>
	                      <tr>
	                          
	                        <?php $item = $get->findItems($value)?>
	                        
	                        <td><?= $item['name'] ?> </td> 

	                        <?php if($item['newPrice'] == 0 ) : ?>
	                          <td><?=$item['price'] ?></td>

	                        <?php elseif($item['newPrice'] > 0 ) : ?> 
	                          <td><?=$item['newPrice']?></td>
	                        <?php endif; ?> 

	                        
	                        <td><?=$qte[$key]?></td>

	                        <?php if($item['newPrice'] == 0 ) : ?>
	                          <td><?=$item['price']*$qte[$key] ?></td>

	                        <?php elseif($item['newPrice'] > 0 ) : ?> 
	                          <td><?=$item['newPrice']*$qte[$key]?></td>
	                        <?php endif; ?> 

	                      </tr>
	                  <?php endforeach; ?>
	                       <tr>
	                          <td colspan="3" style="text-align:right;"><strong>Frais de port : </strong></td>
	                          <td><?=$order['shipping']?>€</td>
	                      </tr> 
	                      <tr>
	                          <td colspan="3" style="text-align:right;"><strong>TOTAL : </strong></td>
	                          <td><?=$order['total']?>€</td>
	                      </tr>
	                  </tbody>
	              </table>
	              
	              <div>
	                <p style="text-align:right;">TVA non applicable, art. 293 B du CGI</p>
	                <br>
	                <div>
	                    <p>Veuillez libeller <strong>votre chèque</strong> à l'ordre de Klickit.</p>
	                    <p>Veuillez adresser <strong>votre virement</strong> à IBAN : FR23 1001 1000 2003 3506 1893 K88 - BIC : PSSTFRPPCNE.</p>
	                    <p>Pour toutes questions concernant cette facture, merci de me contacter à <a class="hoverlinkorange" id=" linknav-order" href="<?=$this->url('front_contact');?>">  contact@klickit.fr</a></p>
	                    <br><br>
	                    <p style="text-align:center;"><strong>MERCI DE VOTRE CONFIANCE !</strong></p>
	                </div>
	              </div>
	          </div>
	        <?php endif; ?>
	          <!--End viewuserorder table-->
	      </div>
	  </div> 
	</div>	
</div>
<?php $this->stop('main_content') ?>