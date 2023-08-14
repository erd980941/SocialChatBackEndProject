<?php include 'header.php' ?>
<?php  
	$kombinsor=$db->prepare("SELECT * FROM kombin where kombin_id=:kombin_id and kombin_durum=:durum");
	$kombinsor->execute(array('kombin_id'=>$_GET['kombin_id'],'durum'=>1));
	$kombincek=$kombinsor->fetch(PDO::FETCH_ASSOC);

	$cinsiyet=$kombincek['kombin_cinsiyet'];


?>
<div class="kadinfoto">
  <div class="container">
    <div class="row">
      <div class="col-lg-4"></div>
      <div class="col-lg-4">
        <h2>KADIN</h2>
        <h4 style="color: white;">Yeni Gelen Kadın Koleksiyonu</h4>
      </div>
      <div class="col-lg-4"></div>
    </div>
  </div>
</div>

<div class="container con">
	<nav aria-label="breadcrumb">
		<ol style="background-color: transparent !important;" class="breadcrumb cyan lighten-4">
			<li class="breadcrumb-item active"><a href="index">Anasayfa</a></li>
			<li class="breadcrumb-item active"><a href="kombinler">Kombinler</a></li>
			<li class="breadcrumb-item active"><?php echo $kombincek['kombin_ad']; ?></li>
		</ol>
	</nav>
	<div class="row">
		
		<?php 
		$urunsor1=$db->prepare("SELECT * FROM urun where urun_id=:urun_id and urun_durum=:urun_durum");
		$urunsor1->execute(array('urun_id'=>$kombincek['urun_idbir'],'urun_durum'=>1));
		$uruncek1=$urunsor1->fetch(PDO::FETCH_ASSOC);

		$uruntarih1=mb_substr($uruncek1['urun_zaman'], 5,-12);
		$simditarih1=date("m");
		$uruntarih1=$uruntarih1+2;

		$urunfotosor1=$db->prepare("SELECT * FROM urunfoto where urun_id=:urun_id limit 1");
		$urunfotosor1->execute(array('urun_id'=>$uruncek1['urun_id']));
		$urunfotocek1=$urunfotosor1->fetch(PDO::FETCH_ASSOC);

		$a = $urunsor1->rowCount();
		if ($a!=0)
		{
		?>
			<div class="col-sm-12 col-md-6 col-lg-3">
				<a href="urun-<?php echo $uruncek1['urun_seourl']."-".$uruncek1['urun_id']; ?>">
					<div class=" aw-zoom">
						<?php if ($simditarih1<=$uruntarih1) { ?> <div class="new new1"><b>Yeni</b></div> <?php } ?>
						<img src="<?php echo $urunfotocek1['urunfoto_resimyol']; ?>" class="img-fluid">
					</div>
					<div class="onecikanfiyat">
						<?php echo $uruncek1['urun_ad']; ?> <br> <b> <?php echo $uruncek1['urun_fiyat']; ?> TL</b>
					</div>
				</a>
			</div>
		<?php
		}
		?>
		<?php 
		$urunsor2=$db->prepare("SELECT * FROM urun where urun_id=:urun_id and urun_durum=:urun_durum");
		$urunsor2->execute(array('urun_id'=>$kombincek['urun_idiki'],'urun_durum'=>1));
		$uruncek2=$urunsor2->fetch(PDO::FETCH_ASSOC);

		$uruntarih2=mb_substr($uruncek2['urun_zaman'], 5,-12);
		$simditarih2=date("m");
		$uruntarih2=$uruntarih2+2;

		$urunfotosor2=$db->prepare("SELECT * FROM urunfoto where urun_id=:urun_id limit 1");
		$urunfotosor2->execute(array('urun_id'=>$uruncek2['urun_id']));
		$urunfotocek2=$urunfotosor2->fetch(PDO::FETCH_ASSOC);

		$b = $urunsor2->rowCount();
		if ($b!=0)
		{
		?>
			<div class="col-sm-12 col-md-6 col-lg-3">
				<a href="urun-<?php echo $uruncek2['urun_seourl']."-".$uruncek2['urun_id']; ?>">
					<div class=" aw-zoom">
						<?php if ($simditarih2<=$uruntarih2) { ?> <div class="new new1"><b>Yeni</b></div> <?php } ?>
						<img src="<?php echo $urunfotocek2['urunfoto_resimyol']; ?>" class="img-fluid">
					</div>
					<div class="onecikanfiyat">
						<?php echo $uruncek2['urun_ad']; ?> <br> <b> <?php echo $uruncek2['urun_fiyat']; ?> TL</b>
					</div>
				</a>
			</div>
		<?php
		}
		?>
		<?php 
		$urunsor3=$db->prepare("SELECT * FROM urun where urun_id=:urun_id and urun_durum=:urun_durum");
		$urunsor3->execute(array('urun_id'=>$kombincek['urun_iduc'],'urun_durum'=>1));
		$uruncek3=$urunsor3->fetch(PDO::FETCH_ASSOC);

		$uruntarih3=mb_substr($uruncek3['urun_zaman'], 5,-12);
		$simditarih3=date("m");
		$uruntarih3=$uruntarih3+2;

		$urunfotosor3=$db->prepare("SELECT * FROM urunfoto where urun_id=:urun_id limit 1");
		$urunfotosor3->execute(array('urun_id'=>$uruncek3['urun_id']));
		$urunfotocek3=$urunfotosor3->fetch(PDO::FETCH_ASSOC);

		$c = $urunsor3->rowCount();
		if ($c!=0)
		{
		?>
			<div class="col-sm-12 col-md-6 col-lg-3">
				<a href="urun-<?php echo $uruncek3['urun_seourl']."-".$uruncek3['urun_id']; ?>">
					<div class=" aw-zoom">
						<?php if ($simditarih3<=$uruntarih3) { ?> <div class="new new1"><b>Yeni</b></div> <?php } ?>
						<img src="<?php echo $urunfotocek3['urunfoto_resimyol']; ?>" class="img-fluid">
					</div>
					<div class="onecikanfiyat">
						<?php echo $uruncek3['urun_ad']; ?> <br> <b> <?php echo $uruncek3['urun_fiyat']; ?> TL</b>
					</div>
				</a>
			</div>
		<?php
		}
		?>
		<?php 
		$urunsor4=$db->prepare("SELECT * FROM urun where urun_id=:urun_id and urun_durum=:urun_durum");
		$urunsor4->execute(array('urun_id'=>$kombincek['urun_iddort'],'urun_durum'=>1));
		$uruncek4=$urunsor4->fetch(PDO::FETCH_ASSOC);

		$uruntarih4=mb_substr($uruncek4['urun_zaman'], 5,-12);
		$simditarih4=date("m");
		$uruntarih4=$uruntarih4+2;

		$urunfotosor4=$db->prepare("SELECT * FROM urunfoto where urun_id=:urun_id limit 1");
		$urunfotosor4->execute(array('urun_id'=>$uruncek4['urun_id']));
		$urunfotocek4=$urunfotosor4->fetch(PDO::FETCH_ASSOC);

		$d = $urunsor4->rowCount();
		if ($d!=0)
		{
		?>
			<div class="col-sm-12 col-md-6 col-lg-3">
				<a href="urun-<?php echo $uruncek4['urun_seourl']."-".$uruncek4['urun_id']; ?>">
					<div class=" aw-zoom">
						<?php if ($simditarih4<=$uruntarih4) { ?> <div class="new new1"><b>Yeni</b></div> <?php } ?>
						<img src="<?php echo $urunfotocek4['urunfoto_resimyol']; ?>" class="img-fluid">
					</div>
					<div class="onecikanfiyat">
						<?php echo $uruncek4['urun_ad']; ?> <br> <b> <?php echo $uruncek4['urun_fiyat']; ?> TL</b>
					</div>
				</a>
			</div>
		<?php
		}
		?>
	</div>
	<div class="row mt-50">
		<div class="col-lg-5">
			<div class="row">
				<div class="col-12 detay-img">
					<img src="<?php echo $kombincek['kombin_foto']; ?>" class="img-fluid">
				</div>
			</div>
		</div>
		<div class="col-lg-5">
			<h1 class="product-details-header"><b><?php echo $kombincek['kombin_ad']; ?></b></h1><hr>
			
			<div class="row" style="margin-top: 40px;">
				<div class="col-12">
					<p>
						<?php echo $kombincek['kombin_detay'].$urunidler[3]; ?>
					</p>
				</div>
			</div>
		</div>
		<div class="col-lg-2">
			<div class="reklamkategori" style="margin-top: 40px;">
				<h2><b><strong>SPONSORLUK</strong></b></h2>
			</div>
		</div>
	</div>

	
</div>
<?php include 'footer.php' ?>