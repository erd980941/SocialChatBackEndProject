<?php include 'header.php' ?>
<?php islemkontrol(); ?>
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
	 <?php 
          if ($_GET['sil']=="no") 
          {
            ?>
            <div class="alert alert-danger">
              <strong>Hata!</strong> Ürünü Sepetten Çıkaramadınız.
            </div>
            <?php
          }
          elseif ($_GET['sil']=="ok") 
          {
            ?>
            <div class="alert alert-success">
              <strong>Bilgi.</strong> Ürün Sepetten Çıkarıldı
            </div>
            <?php
          }
          ?>
	<div class="row">
		<div class="col-lg-9">
			<div class="table-responsive">
				<table class="table">
				<thead style="background-color: #e65540;" class="white-text">
					<tr>
						<th scope="col">Ürün</th>
						<th scope="col"></th>
						<th scope="col">Beden</th>
						<th scope="col">Adet</th>
						<th scope="col">Toplam</th>
						<th scope="col"></th>
					</tr>
				</thead>
				<tbody>
					<?php  
						$sepetsor=$db->prepare("SELECT * FROM sepet where kullanici_id=:kullanici_id");
						$sepetsor->execute(array('kullanici_id'=>$_SESSION['userkullanici_id']));
					?>
					<?php  
						while ($sepetcek=$sepetsor->fetch(PDO::FETCH_ASSOC)) 
						{
							$urunsor=$db->prepare("SELECT * FROM urun INNER JOIN urunfoto ON urun.urun_id=urunfoto.urun_id where urun.urun_id=:urun_id");
							$urunsor->execute(array('urun_id'=>$sepetcek['urun_id']));
							$uruncek=$urunsor->fetch(PDO::FETCH_ASSOC);
							$toplam_fiyat+=$uruncek['urun_fiyat']*$sepetcek['urun_adet'];
							?>
								<tr>
									<th><div style="width: 90px"><img src="<?php echo $uruncek['urunfoto_resimyol']; ?>" class="img-fluid"></div></th>
									<td><?php echo $uruncek['urun_ad']; ?><br><b><?php echo $uruncek['urun_fiyat']; ?> TL</b></td>
									<td><?php echo $sepetcek['urun_beden']; ?></td>
									<td><?php echo $sepetcek['urun_adet']; ?></td>
									<td><h4><b><?php echo $uruncek['urun_fiyat']*$sepetcek['urun_adet']; ?> TL</b></h4></td>
									<td><a  onclick="return confirm('Bu Ürünü Silmek İstediğinize Eminmisiniz?')"  href="nedmin/netting/kullanici.php?sepet_id=<?php echo $sepetcek['sepet_id']; ?>&sepetsil=ok" class="btn btn-kategori btn-sm">Kaldır</a></td>
								</tr>
							<?php
						}
					?>
				</tbody>
			</table>
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
					<a  onclick="return confirm('Sepeti Onaylamak İstediğinize Eminmisiniz?')" href="odeme" class="btn btn-block btn-kategori">Sepeti Onayla</a>
				</div>
			</div>
		</div>
	</div>
</div>
<?php include 'footer.php' ?>