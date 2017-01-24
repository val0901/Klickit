<?php $this->layout('layoutfront', ['title' => 'Commande utilisateur']) ?>

<?php $this->start('main_content') ?>
<div class="listorder_back">
 <div class="row">
  <div class="col-md-3">
  	<img class="img-responsive playmo_hide" src="<?=$this->assetUrl('/img/napoLeft.png');?>" id="categorycustoms_hover">
  </div>
  <div class="col-md-6 ordermidia_width">
      <div class="listorder_contenu">
          <div>
              <div class="row">
                  <div class="col-xs-6">
                    <img src="<?=$this->assetUrl('/img/KLICKIT-logo-napoleon.png');?>">
                    <p class="baseline_text">Créez l'histoire !</p>
                  </div>
                  <div class="col-xs-6">
                      <p class="viewuserorder_title">FACTURE</p>      
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
                      <p><strong>No. FACTURE : <?=$order['id']?></strong></p>
                  </div>
              </div>
              <br>
              <p>No. SERET: 753 966 464 00012</p>
              <br><br>
              <p><strong>Facturé a : </strong></p>
          </div>
          
          <!--viewuserorder table-->
          <div class="table-responsive">
              <table class="table table-bordered">
                  <thead style="background-color: #ccc;">
                      <tr>
                          <th>DESCRIPTION</th>
                          <th>Prix U.</th>
                          <th>Qté</th>
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
                          <td colspan="3" style="text-align:right;font-weight:600;"><stong>TOTAL :</stong></td>
                          <td><?=$order['total']?>€</td>
                      </tr>
                  </tbody>
              </table>
              
              <div>
                <p style="text-align:right;">TVA on applicable. art. 293 B du CGI</p>
                <br>
                <div>
                    <p style="line-height: 10px;">Veuillez libellé votre chèque a l'ordre de Lafont Laurent.</p>
                    <p style="line-height: 10px;">Pour toute question concement cette facture.  Merci de me contacter a contact@klickit.fr</p>
                    <br><br>
                    <p style="text-align:center;"><strong>MERCI DE VOTRE CONFIANCE !</strong></p>
                </div>
              </div>
          </div>
        <?php endif; ?>
          <!--End viewuserorder table-->
      </div>
  </div>
  <div class="col-md-3">
  	<img class="img-responsive playmo_hide" src="<?=$this->assetUrl('/img/napoRight.png');?>" id="categorycustoms_hover" style="float:right;">
  </div>
 </div>
 
 
</div>


<?php $this->stop('main_content') ?>
