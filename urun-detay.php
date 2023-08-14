<?php include 'header.php' ?>
<?php  
	$urunsor=$db->prepare("SELECT urun.*,kategori.* FROM urun INNER JOIN kategori ON urun.kategori_id=kategori.kategori_id where urun_id=:urun_id and urun_durum=:durum");
	$urunsor->execute(array('urun_id'=>$_GET['urun_id'],'durum'=>1));
	$uruncek=$urunsor->fetch(PDO::FETCH_ASSOC);

	$cinsiyet=$uruncek['urun_cinsiyet'];


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
			<li class="breadcrumb-item active"><a href="<?php if ($cinsiyet=='E') { echo "erkekkategori-".$uruncek['kategori_seourl']."-".$uruncek['kategori_id']; } elseif ($cinsiyet=='K') { echo "kadinkategori-".$uruncek['kategori_seourl']."-".$uruncek['kategori_id']; } ?>"><?php echo $uruncek['kategori_ad']; ?></a></li>
			<li class="breadcrumb-item active"><?php echo $uruncek['urun_ad']; ?></li>
		</ol>
	</nav>
	<div class="row">
		<div class="col-12">
			<?php 
	          if ($_GET['durum']=="stokyok") 
	          {
	            ?>
	            <div class="alert alert-danger">
	              <strong>Hata!</strong> Malesef Elimizde Seçtiğiniz Adet Kadar Stok Yok.
	            </div>
	            <?php
	          }
	          elseif ($_GET['durum']=="no") 
	          {
	            ?>
	            <div class="alert alert-danger">
	              <strong>Hata!</strong> Ürün Sepete Eklenemedi.
	            </div>
	            <?php
	          }
	          elseif ($_GET['durum']=="ok") 
	          {
	            ?>
	            <div class="alert alert-success">
	              <strong>Bilgi.</strong> Ürün Sepete Eklendi..
	            </div>
	            <?php
	          }
	          ?>
		</div>
	</div>
	<div class="row">
		<div class="col-lg-5">
			<div class="row">
				<div class="col-12 detay-img">
					
				</div>
			</div>
			<div class="detay-img-s">
				<div class="row">
					<?php  
					$urun_id=$uruncek['urun_id'];
					$urunfotosor=$db->prepare("SELECT * FROM urunfoto where urun_id=:urun_id order by urunfoto_id");
					$urunfotosor->execute(array('urun_id'=>$urun_id));
					?>
					<?php 
						$say=0;
						while ($urunfotocek=$urunfotosor->fetch(PDO::FETCH_ASSOC)) 
						{
							$say++;
							?>
								<div class="col-3 img-s1" id="urunfoto-<?php echo $say; ?>">
									<img src="<?php echo $urunfotocek['urunfoto_resimyol']; ?>" class="img-fluid">
								</div>
							<?php
						}
					?>
				</div>
			</div>
		</div>
		<div class="col-lg-5">
			<h1 class="product-details-header"><b><?php echo $uruncek['urun_ad']; ?></b></h1>
			<?php  
				$uruntarih=mb_substr($uruncek['urun_zaman'], 5,-12);
				$simditarih=date("m");
				$uruntarih=$uruntarih+2;
			?>
			<?php if ($simditarih<=$uruntarih) { ?> <div class="new2"><b>Yeni</b></div> <?php } ?><hr>
			
			<div class="row product-details-satir">
				<div class="col-4">
					<h4 class="product-details-h4">Stok Durumu : </h4>
				</div>
				<div class="col-8" style="line-height: 2;">
					<?php  
							$stokS=$uruncek['urun_stokS'];
                            $stokM=$uruncek['urun_stokM'];
                            $stokL=$uruncek['urun_stokL'];
                            $stokXL=$uruncek['urun_stokXL'];
                            $stokXXL=$uruncek['urun_stokXXL'];
					?>
					<b><?php echo $stokS+$stokM+$stokL+$stokXL+$stokXXL; ?></b>
				</div>
			</div>
			<div class="row product-details-satir">
				<div class="col-4">
					<h4 class="product-details-h4">Fiyat: </h4>
				</div>
				<div class="col-8" style="line-height: 2;">
					<b><?php echo $uruncek['urun_fiyat'] ?> TL</b>
				</div>
			</div>
		<form action="nedmin/netting/kullanici.php" method="POST"  data-parsley-validate>
			<div class="row product-details-satir">
				<div class="col-4">
					<h4 class="product-details-h4">Beden : </h4>
				</div>
				<div class="col-8">
					<select class="form-control form-control-sm" name="urun_beden">
						<?php if ($stokS!=0) { ?> <option value="S">S</option> <?php } ?>
						<?php if ($stokM!=0) { ?> <option value="M">M</option> <?php } ?>
						<?php if ($stokL!=0) { ?> <option value="L">L</option> <?php } ?>
						<?php if ($stokXL!=0) { ?> <option value="XL">XL</option> <?php } ?>
						<?php if ($stokXXL!=0) { ?> <option value="XXL">XXL</option> <?php } ?>
					</select>
				</div>
			</div>
			<div class="row product-details-satir">
				<div class="col-4">
					<h4 class="product-details-h4">Adet :</h4>
				</div>
				<div class="col-8">
					<input class="form-control form-control-sm" min="1" value="1" type="number" name="urun_adet">
				</div>
			</div>
			<div class="row product-details-satir">
				<div class="col-12">
					<?php  
						if (isset($_SESSION['userkullanici_mail'])) 
						{
							?>
								<input type="hidden" name="urun_id" value="<?php echo $uruncek['urun_id'] ?>"> 
								<button type="submit" class="btn btn-block btn-kategori" name="sepeteekle">Sepete Ekle</button>
							<?php
						}
						else
						{
							?>
								<p>Ürünü Sepete Eklemek İçin Lütfen Giriş Yapınız.</p>

							<?php
						}
					?>
					
				</div>
			</div>
		</form>	
			<div class="row" style="margin-top: 40px;">
				<div class="col-12">
					<h4>Detay</h4><hr>
					<p>
						<?php echo $uruncek['urun_detay']; ?>
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
	<div class="row mt-50">
		<div class="row urunrow">
			<div class="col-12">
				<h2>Önerilenler</h2>
				<hr>
			</div>
		</div>

		<div class="owl-carousel">
		    <?php 
		          $onerilensor=$db->prepare("SELECT * FROM urun where urun_durum=:durum and urun_onecikar=:onecikar");
		          $onerilensor->execute(array(
		            'durum'=>1,
		            'onecikar'=>1));

		          while ($onerilencek=$onerilensor->fetch(PDO::FETCH_ASSOC)) 
		          {
		              $urun_id=$onerilencek['urun_id'];
		              $onerilenfotosor=$db->prepare("SELECT * FROM urunfoto where urun_id=:urun_id order by urunfoto_id ASC limit 1");
		              $onerilenfotosor->execute(array('urun_id'=>$urun_id));

		              $onerilenfotocek=$onerilenfotosor->fetch(PDO::FETCH_ASSOC);

		            ?>
		              <div class="item onecikan">
		                <a href="urun-<?php echo $onerilencek['urun_seourl']."-".$onerilencek['urun_id']; ?>">
		                <div class="new"><b>Yeni</b></div>
		                <img src="<?php echo $onerilenfotocek['urunfoto_resimyol']; ?>" class="img-fluid">
		                <div class="onecikanfiyat">
		                 <?php echo $onerilencek['urun_ad']; ?> <br> <b> <?php echo $onerilencek['urun_fiyat']; ?> TL</b>

		                </div>  
		                </a>
		              </div>
		            <?php
		          }  
		        ?>
		  </div>
	</div>
</div>
<?php include 'footer.php' ?>
<script type="text/javascript">

	$(document).ready(function(){
		var deger = $("#urunfoto-1").html();
		$(".detay-img").html(deger);
	});

	$("#urunfoto-1").click(function(){
		var deger = $("#urunfoto-1").html();
		$(".detay-img").html(deger);
	});
	$("#urunfoto-2").click(function(){
		var deger = $("#urunfoto-2").html();
		$(".detay-img").html(deger);
	});
	$("#urunfoto-3").click(function(){
		var deger = $("#urunfoto-3").html();
		$(".detay-img").html(deger);
	});
	$("#urunfoto-4").click(function(){
		var deger = $("#urunfoto-4").html();
		$(".detay-img").html(deger);
	});
</script>