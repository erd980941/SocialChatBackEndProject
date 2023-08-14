<?php include 'header.php' ?>
<div class="erkekfoto">
  <div class="container">
    <div class="row">
      <div class="col-lg-4"></div>
      <div class="col-lg-4">
        <h2>ERKEK</h2>
        <h4 style="color: white;">Yeni Gelen Erkek Koleksiyonu</h4>
      </div>
      <div class="col-lg-4"></div>
    </div>
  </div>
</div>

<div class="container con">
	<nav aria-label="breadcrumb">
		<ol style="background-color: transparent !important;" class="breadcrumb cyan lighten-4">
			<li class="breadcrumb-item active"><a href="index">Anasayfa</a></li>
			<li class="breadcrumb-item active">Kombinler</li>
		</ol>
	</nav>
	<div class="row">
		<div class="col-lg-12"><center><h4 style="font-family: 'Permanent Marker', cursive;"><a href="kombinler?kc=E">ERKEK</a> / <a href="kombinler?kc=K">KADIN</a></h4></center></div>
		<div class="col-lg-12">
			<div class="row">
			<?php 
				
			if (isset($_GET['kc'])) 
			{

				$sayfada = 9; // sayfada gösterilecek içerik miktarını belirtiyoruz.

				$sorgu=$db->prepare("select * from kombin where kombin_cinsiyet=:kombin_cinsiyet");
				$sorgu->execute(array(
					'kombin_cinsiyet' => $_GET['kc']
				));
				$toplam_icerik=$sorgu->rowCount();
				$toplam_sayfa = ceil($toplam_icerik / $sayfada);
				// eğer sayfa girilmemişse 1 varsayalım.
				$sayfa = isset($_GET['sayfa']) ? (int) $_GET['sayfa'] : 1;
				// eğer 1'den küçük bir sayfa sayısı girildiyse 1 yapalım.
				if($sayfa < 1) $sayfa = 1; 
				// toplam sayfa sayımızdan fazla yazılırsa en son sayfayı varsayalım.
				if($sayfa > $toplam_sayfa) $sayfa = $toplam_sayfa; 
				$limit = ($sayfa - 1) * $sayfada;

				//tüm tablo sütunlarının çekilmesi
				$kombinsor=$db->prepare("SELECT * FROM kombin WHERE kombin_durum=:kombin_durum and kombin_cinsiyet=:kombin_cinsiyet order by kombin_id DESC limit $limit,$sayfada");
				$kombinsor->execute(array(
					'kombin_durum' => 1,
					'kombin_cinsiyet' => $_GET['kc']
				));

				$say=$sorgu->rowCount();
				if ($say==0) { echo "Bu kategoride ürün Bulunamadı"; } 


			} 
			else 
			{

				$sayfada = 9; // sayfada gösterilecek içerik miktarını belirtiyoruz.
				$sorgu=$db->prepare("select * from kombin");
				$sorgu->execute();
				$toplam_icerik=$sorgu->rowCount();
				$toplam_sayfa = ceil($toplam_icerik / $sayfada);
				// eğer sayfa girilmemişse 1 varsayalım.
				$sayfa = isset($_GET['sayfa']) ? (int) $_GET['sayfa'] : 1;
				// eğer 1'den küçük bir sayfa sayısı girildiyse 1 yapalım.
				if($sayfa < 1) $sayfa = 1; 
				// toplam sayfa sayımızdan fazla yazılırsa en son sayfayı varsayalım.
				if($sayfa > $toplam_sayfa) $sayfa = $toplam_sayfa; 
				$limit = ($sayfa - 1) * $sayfada;


				$kombinsor=$db->prepare("SELECT * FROM kombin WHERE kombin_durum=:kombin_durum order by kombin_id DESC limit $limit,$sayfada");
				$kombinsor->execute(array(
					'kombin_durum' => 1,
				));

				$say=$sorgu->rowCount();

				if ($say==0) {
					echo "Bu kategoride ürün Bulunamadı";
				}



			}
			?>	

			<?php  
			while ($kombincek=$kombinsor->fetch(PDO::FETCH_ASSOC)) 
			{
				?>
				<div class="col-sm-12 col-md-6 col-lg-4">
					<a href="kombin-<?php echo $kombincek['kombin_seourl']."-".$kombincek['kombin_id']; ?>">
						<div class=" aw-zoom">
							<img src="<?php echo $kombincek['kombin_foto']; ?>" class="img-fluid">
						</div>
						<div class="onecikanfiyat">
							<?php echo $kombincek['kombin_ad']; ?> <br> <b></b>
						</div>
					</a>
				</div>
				<?php
			}
			?>
			<div style="margin-top: 25px;" class="col-xl-12">
				<nav aria-label="Page navigation example">
					<ul class="pagination pg-blue justify-content-center">
						<?php
						$s=0;
						while ($s < $toplam_sayfa) 
						{
							$s++; 
							if (!empty($_GET['kc'])) 
							{ 

								if ($s==$sayfa) 
								{
									?>
									<li class="page-item"><a class="page-link" href="kombinler?kc=<?php echo $_GET['kc'] ?>&sayfa=<?php echo $s; ?>"><?php echo $s; ?></a></li>
									<?php 
								} 
								else 
								{
									?>
									<li class="page-item"><a class="page-link" href="kombinler?kc=<?php echo $_GET['kc'] ?>&sayfa=<?php echo $s; ?>"><?php echo $s; ?></a></li>
									<?php   
								}


							} 
							else 
							{
								if ($s==$sayfa) 
								{
									?>
									<li class="page-item"><a class="page-link" style="background-color: #C84C3C; color:white;" href="kombinler?sayfa=<?php echo $s; ?>"><?php echo $s; ?></a></li>
									<?php
								} 
								else 
								{
									?>
									<li class="page-item"><a class="page-link" href="kombinler?sayfa=<?php echo $s; ?>"><?php echo $s; ?></a></li>
									<?php   
								}


							}
						}
						?>
					</ul>
				</nav>
			</div>
		</div>
		</div>
	</div>
</div>
<?php include 'footer.php' ?>