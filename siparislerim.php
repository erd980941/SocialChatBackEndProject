<?php include 'header.php' ?>
<?php islemkontrol(); ?>
<div class="erkekfoto">
	<div class="container">
		<div class="row">
			<div class="col-lg-4"></div>
			<div class="col-lg-4">
				<h2>Siparişlerim</h2>
				<h4 style="color: white;">Siparişlerinize Göz Atabilirsiniz</h4>
			</div>
			<div class="col-lg-4"></div>
		</div>
	</div>
</div>

<div class="container con">
	<nav aria-label="breadcrumb">
		<ol style="background-color: transparent !important;" class="breadcrumb cyan lighten-4">
			<li class="breadcrumb-item active"><a href="index">Anasayfa</a></li>
			<li class="breadcrumb-item active">Hesabım</li>
		</ol>
	</nav>
	<div class="row">
		
		<div class="col-lg-4">
			<?php include 'hesap-sidebar.php' ?>
		</div>
		<div class="col-lg-8">
			 <?php 
          if ($_GET['teslim']=="no") 
          {
            ?>
            <div class="alert alert-danger">
              <strong>Hata!</strong> Teslim İşlemi Yapılamadı Lütfen Sosyal Medya Hesabından Bize Ulaşınız.
            </div>
            <?php
          }
          elseif ($_GET['durum']=="ok") 
          {
            ?>
            <div class="alert alert-success">
              <strong>Bilgi.</strong> Siparişiniz Onayladı. Lütfen Teslim Aldığınızda Siparişlerim Sayfasından Teslim Aldığınızı Belirtiniz
            </div>
            <?php
          }
          elseif ($_GET['teslim']=="ok") 
          {
            ?>
            <div class="alert alert-success">
              <strong>Bilgi.</strong> Ürünlerinizi Güle Güle Kullanın :)
            </div>
            <?php
          }
          ?>
			<div class="table-responsive">
				<?php  
				$siparissor=$db->prepare("SELECT * FROM siparis where kullanici_id=:kullanici_id and siparis_teslim=:siparis_teslim");
				$siparissor->execute(array('kullanici_id'=>$_SESSION['userkullanici_id'],'siparis_teslim'=>0));
				?>
				<?php  
				while ($sipariscek=$siparissor->fetch(PDO::FETCH_ASSOC)) 
				{
					$siparis_id=$sipariscek['siparis_id'];
					$siparis_detaysor=$db->prepare("SELECT * FROM siparis_detay where siparis_id=:siparis_id");
					$siparis_detaysor->execute(array('siparis_id'=>$sipariscek['siparis_id']));
					
					$toplam_fiyat+=$uruncek['urun_fiyat']*$sipariscek['urun_adet'];
					?>
					<table class="table">
						<thead style="background-color: #e65540;" class="white-text">
							<tr>
								<th scope="col">Ürün</th>
								<th scope="col"></th>
								<th scope="col">Beden</th>
								<th scope="col">Adet</th>
								<th scope="col">Toplam</th>
							</tr>
						</thead>
						<tbody>

							<?php 
							while ($siparis_detaycek=$siparis_detaysor->fetch(PDO::FETCH_ASSOC)) 
							{
								$urunsor=$db->prepare("SELECT urun.*,urunfoto.* FROM urun INNER JOIN urunfoto ON urun.urun_id=urunfoto.urun_id where urun.urun_id=:urun_id");
								$urunsor->execute(array('urun_id'=>$siparis_detaycek['urun_id']));
								$uruncek=$urunsor->fetch(PDO::FETCH_ASSOC);
							 	?>
									<tr>
										<th><div style="width: 90px"><img src="<?php echo $uruncek['urunfoto_resimyol']; ?>" class="img-fluid"></div></th>
										<td><?php echo $uruncek['urun_ad']; ?><br><b><?php echo $siparis_detaycek['urun_fiyat']; ?> TL</b></td>
										<td><?php echo $siparis_detaycek['urun_beden']; ?></td>
										<td><?php echo $siparis_detaycek['urun_adet']; ?></td>
										<td><h4><b><?php echo $siparis_detaycek['urun_fiyat']*$siparis_detaycek['urun_adet']; ?> TL</b></h4></td>
									</tr>
								<?php
							} 								
							?>
							<tr>
								<th></th>
								<th></th>
								<th></th>
								<th></th>
								<th><a onclick="return confirm('Siparişinizin Teslim Edildiğine Eminmisiniz?')" href="nedmin/netting/kullanici?teslim=ok&siparis_id=<?php echo $siparis_id; ?>" class="btn btn-block btn-kategori">Teslim Aldım</a></th>
							</tr>
						</tbody>
					</table>
					<?php
				}
				?>
			</div>
		</div>
	</div>
</div>
<?php include 'footer.php' ?>
