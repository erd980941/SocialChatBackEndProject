<?php include 'header.php' ?>
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
			<li class="breadcrumb-item active">Kadin</li>
			
		</ol>
	</nav>
	<div class="row">

		<?php include 'sidebar-k.php'; ?>
		<div class="col-lg-9">
			<div class="row">
			<?php 
				
			if (isset($_GET['kategori_id'])) 
			{

				$sayfada = 9; // sayfada gösterilecek içerik miktarını belirtiyoruz.

				$sorgu=$db->prepare("select * from urun where kategori_id=:kategori_id");
				$sorgu->execute(array(
					'kategori_id' => $_GET['kategori_id']
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
				$urunsor=$db->prepare("SELECT * FROM urun WHERE urun_durum=:urun_durum and kategori_id=:kategori_id and urun_cinsiyet=:urun_cinsiyet order by urun_id DESC limit $limit,$sayfada");
				$urunsor->execute(array(
					'urun_durum' => 1,
					'kategori_id' => $_GET['kategori_id'],
					'urun_cinsiyet' => 'K'
				));

				$say=$sorgu->rowCount();
				if ($say==0) { echo "Bu kategoride ürün Bulunamadı"; } 


			} 
			else 
			{

				$sayfada = 9; // sayfada gösterilecek içerik miktarını belirtiyoruz.
				$sorgu=$db->prepare("select * from urun");
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


				$urunsor=$db->prepare("SELECT * FROM urun WHERE urun_durum=:urun_durum and urun_cinsiyet=:urun_cinsiyet order by urun_id DESC limit $limit,$sayfada");
				$urunsor->execute(array(
					'urun_durum' => 1,
					'urun_cinsiyet' => 'K'
				));

				$say=$sorgu->rowCount();

				if ($say==0) {
					echo "Bu kategoride ürün Bulunamadı";
				}



			}
			?>	

			<?php  
			while ($uruncek=$urunsor->fetch(PDO::FETCH_ASSOC)) 
			{
				$urun_id=$uruncek['urun_id'];
				$urunfotosor=$db->prepare("SELECT * FROM urunfoto where urun_id=:urun_id order by urunfoto_id ASC limit 1");
				$urunfotosor->execute(array('urun_id'=>$urun_id));

				$urunfotocek=$urunfotosor->fetch(PDO::FETCH_ASSOC);
				?>
				<?php  
					$uruntarih=mb_substr($uruncek['urun_zaman'], 5,-12);
					$simditarih=date("m");
					$uruntarih=$uruntarih+2;
				?>
				<div class="col-sm-12 col-md-6 col-lg-4">
					<a href="urun-<?php echo $uruncek['urun_seourl']."-".$uruncek['urun_id']; ?>">
						<div class=" aw-zoom">
							<?php if ($simditarih<=$uruntarih) { ?> <div class="new new1"><b>Yeni</b></div> <?php } ?>
							<img src="<?php echo $urunfotocek['urunfoto_resimyol']; ?>" class="img-fluid">
						</div>
						<div class="onecikanfiyat">
							<?php echo $uruncek['urun_ad']; ?> <br> <b> <?php echo $uruncek['urun_fiyat']; ?> TL</b>
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
							if (!empty($_GET['kategori_id'])) 
							{ 

								if ($s==$sayfa) 
								{
									?>
									<li class="page-item"><a class="page-link" href="erkekkategori-<?php echo $_GET['sef']; ?>-<?php echo $_GET['kategori_id'] ?>?sayfa=<?php echo $s; ?>"><?php echo $s; ?></a></li>
									<?php 
								} 
								else 
								{
									?>
									<li class="page-item"><a class="page-link" href="kategoriler-<?php echo $_GET['sef']; ?>-<?php echo $_GET['kategori_id'] ?>?sayfa=<?php echo $s; ?>"><?php echo $s; ?></a></li>
									<?php   
								}


							} 
							else 
							{
								if ($s==$sayfa) 
								{
									?>
									<li class="page-item"><a class="page-link" style="background-color: #C84C3C; color:white;" href="erkekkategori?sayfa=<?php echo $s; ?>"><?php echo $s; ?></a></li>
									<?php
								} 
								else 
								{
									?>
									<li class="page-item"><a class="page-link" href="erkekkategori?sayfa=<?php echo $s; ?>"><?php echo $s; ?></a></li>
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