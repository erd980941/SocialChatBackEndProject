<?php include 'header.php' ?>
<?php islemkontrol(); ?>
<?php  
	$kullanicisor=$db->prepare("SELECT * FROM kullanici where kullanici_mail=:mail");
    $kullanicisor->execute(array('mail'=>$_SESSION['userkullanici_mail']));
    $say=$kullanicisor->rowCount();
    $kullanicicek=$kullanicisor->fetch(PDO::FETCH_ASSOC);
?>
<?php  
$sepetsor=$db->prepare("SELECT * FROM sepet where kullanici_id=:kullanici_id");
$sepetsor->execute(array('kullanici_id'=>$_SESSION['userkullanici_id']));
	while ($sepetcek=$sepetsor->fetch(PDO::FETCH_ASSOC)) 
	{
		$urunsor=$db->prepare("SELECT * FROM urun where urun_id=:urun_id");
		$urunsor->execute(array('urun_id'=>$sepetcek['urun_id']));
		$uruncek=$urunsor->fetch(PDO::FETCH_ASSOC);
		$toplam_fiyat+=$uruncek['urun_fiyat']*$sepetcek['urun_adet'];
	}
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
	<div class="row">
		 
		<div class="col-lg-9">
			<?php 
          if ($_GET['durum']=="no") 
          {
            ?>
            <div class="alert alert-danger">
              <strong>Hata!</strong> Siparişiniz Onaylanamadı. Lütfen Sosyal Medya Hesabından Bize Ulaşınız.
            </div>
            <?php
          }
          elseif ($_GET['durum']=="noo") 
          {
            ?>
            <div class="alert alert-danger">
              <strong>Hata!</strong> Siparişiniz Onaylanamadı. Lütfen Sosyal Medya Hesabından Bize Ulaşınız.
            </div>
            <?php
          }
          ?>
			<div class="alisveris-onay-form">
				<!-- Extended material form grid -->
				<h3>Adres Bilgileri</h3><hr>
				<form action="nedmin/netting/kullanici" method="POST">
					<!-- Grid row -->
					<div class="form-row">
						<!-- Grid column -->
						<div class="col-md-6">
							<!-- Material input -->
							<div class="md-form form-group">
								<input type="text" class="form-control" placeholder="İl" required value="<?php echo $kullanicicek['kullanici_il']; ?>" name="siparis_il">
								<label for="inputEmail4MD">İl</label>
							</div>
						</div>
						<!-- Grid column -->

						<!-- Grid column -->
						<div class="col-md-6">
							<!-- Material input -->
							<div class="md-form form-group">
								<input type="text" class="form-control" placeholder="İlce" required value="<?php echo $kullanicicek['kullanici_ilce']; ?>" name="siparis_ilce">
								<label for="inputPassword4MD">İlce</label>
							</div>
						</div>
						<!-- Grid column -->
					</div>
					<!-- Grid row -->

					<!-- Grid row -->
					<div class="row">
						<!-- Grid column -->
						<div class="col-md-12">
							<!-- Material input -->
							<div class="md-form form-group">
								<input type="text" class="form-control" placeholder="Adres" required value="<?php echo $kullanicicek['kullanici_adres']; ?>" name="siparis_adres">
								<label for="inputAddressMD">Adres</label>
							</div>
						</div>
						<!-- Grid column -->
					</div>
					<!-- Grid row -->

					<!-- Grid row -->
					<div class="form-row">

						<!-- Grid column -->
						<div class="col-md-12">
							<!-- Material input -->
							<div class="md-form form-group">
								<input type="tel" class="form-control" placeholder="Posta Kodu" required value="<?php echo $kullanicicek['kullanici_zip']; ?>" name="siparis_zip">
								<label for="inputCityMD">Posta Kodu</label>
							</div>
						</div>
						<!-- Grid column -->
					</div>
					<div class="form-row">
						

						<!-- Grid column -->
						<div class="col-md-12">
							<!-- Material input -->
							<div class="md-form form-group">
								<input type="text" class="form-control" placeholder="Not" name="siparis_not">
								<label for="inputZipMD">Not</label>
							</div>
						</div>
						<!-- Grid column -->
					</div>
					<!-- Grid row -->
					<small>Bilgileri Eksizsiz ve Doğru Doldurmanız Rica Olunur</small>
				
				<!-- Extended material form grid -->
			</div>
		</div>
		<div class="col-lg-3">
			<div class="alisverisitamamla">
				<div class="marginsepet">
					<small>Ürünlerimiz Siparişiniz Onaylandıktan Sonra Şeffaf Kargo İle Kapıda Ödeme Yapılarak Gönderilmektedir</small>
				</div>
				<div class="marginsepet">
					<h4>Toplam : <b><?php echo $toplam_fiyat; ?> TL</b></h4>
				</div>
				<div class="marginsepet">
					<a href="sepet" class="btn btn-block btn-kategori">Sepete Geri Dön</a>
				</div>
				<div class="marginsepet">
					<button   onclick="return confirm('Siparişi Onaylamak İstediğinize Eminmisiniz?')" type="submit" name="siparisonay" class="btn btn-block btn-kategori">Siparişimi Onayla</button>
				</div>
				</form>
			</div>
		</div>
	</div>
</div>
<?php include 'footer.php' ?>