<?php $this->layout('layoutfront', ['title' => 'catégorie Classics', 'meta' => 'napoleon, Customs playmobil, customs Tampographiés, bustes playmobil, bustes tampographiés, pièces résine, stickers drapeau']) ?>

<?php $this->start('main_content') ?>
<div>
	<div class="row classics_background">
		<div class="col-md-3" style="position:relative;">
			<div class="classic_text_show"><span>Classics</span></div>
			<img class="img-responsive" src="<?=$this->assetUrl('/img/art_classic_divers_000001.jpg');?>">
			<div class="classic_text">Classics</div>
		</div>
		<div class="col-md-9">
			<div class="container_general">
				<h1 class="viewcategorycol2_title">Classics</h1>
				<p class="viewcategorycol2_text">Ardeo, mihi credite, Patres conscripti (id quod vosmet de me existimatis et facitis ipsi) incredibili quodam amore patriae, qui me amor et subvenire olim impendentibus periculis maximis cum dimicatione capitis, et rursum, cum omnia tela undique esse intenta in patriam viderem, subire coegit atque excipere unum pro universis. Hic me meus in rem publicam animus pristinus ac perennis cum C. Caesare reducit, reconciliat, restituit in gratiam.</p>
			</div>
		</div>
	</div>

<!--vignetteEvent-->
<div class="vignetteEvent_hide">
	<img class="img-responsive" src="<?=$this->assetUrl('/img/vignetteEvent1.png');?>">
</div>
<!--End vignetteEvent-->
	
	<div class="row">
		<div class="col-md-3">
			<li>
				<h3 class="viewcategoryrow2col1_title">sous-catégories</h3>
				<div class="viewcategoryrow2col1_tirer"><a href="#">Customs tampographiés</a></div>
				<div class="viewcategoryrow2col1_tirer"><a href="#">Customs peints</a></div>		
				<div class="viewcategoryrow2col1_tirer"><a href="#">Bustes tampographiés</a></div>
				<div class="viewcategoryrow2col1_tirer"><a href="#">Pièces en résine</a></div>
				<div class="viewcategoryrow2col1_tirer"><a href="#">Stickers</a></div>
			</li>
			<li>
				<h3 class="viewcategoryrow2col1_title">fitres</h3>
				<div class="form-group viewcategory_checkboxmargin">
					<label class="viewcategorycheckbox_border">
					<input type="checkbox"> <span class="viewcategorycheckbox_font"> 1er empire</span>
					</label>
					<label class="viewcategorycheckbox_border">
					<input type="checkbox"> <span class="viewcategorycheckbox_font"> Sudistes</span>
					</label>
					<label class="viewcategorycheckbox_border">
					<input type="checkbox"> <span class="viewcategorycheckbox_font"> Nordistes</span>
					</label>
				</div>
			</li>
			<li>
				<h3 class="viewcategoryrow2col1_title">état</h3>
				<div class="form-group viewcategory_checkboxmargin">
					<label class="viewcategorycheckbox_border">
					<input type="checkbox"> <span class="viewcategorycheckbox_font"> Nouveau</span>
					</label>
					<div class="clear"></div>
					<label class="viewcategorycheckbox_border">
					<input type="checkbox"> <span class="viewcategorycheckbox_font"> Promo</span>
					</label>
				</div>
			</li>
		</div>
		<div class="col-md-9">
			<h4>Home <span>></span> Customs <span>></span> Customs tampographiés</h4>
		</div>
	</div>
</div>

<?php $this->stop('main_content') ?>
