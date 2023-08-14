<?php include 'header.php' ?>
<?php islemkontrol(); ?>
<div class="erkekfoto">
	<div class="container">
		<div class="row">
			<div class="col-lg-4"></div>
			<div class="col-lg-4">
				<h2>Profil</h2>
				<h4 style="color: white;">Hesap Bilgilerinizi Tamamlayınız</h4>
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
			if ($_GET['durum']=="no") 
			{
				?>
				<div class="alert alert-danger">
					<strong>Hata!</strong> Bilgileriniz Güncellenemedi.
				</div>
				<?php
			}
			elseif ($_GET['durum']=="bos") 
			{
				?>
				<div class="alert alert-danger">
					<strong>Hata!</strong> Lütfen Boş Bırakmayınız.
				</div>
				<?php
			}
			elseif ($_GET['durum']=="dosyabuyuk") 
			{
				?>
				<div class="alert alert-danger">
					<strong>Hata!</strong> Dosya Boyutunuz Çok Fazla.
				</div>
				<?php
			}
			elseif ($_GET['durum']=="yanlisuzanti") 
			{
				?>
				<div class="alert alert-danger">
					<strong>Hata!</strong> Lütfen <b>JPG</b> veya <b>PNG</b> Formatlarına Uygun Fotoğraf Seçiniz.
				</div>
				<?php
			}
			elseif ($_GET['durum']=="ok") 
			{
				?>
				<div class="alert alert-success">
					<strong>Bilgi.</strong> Bilgileriniz Güncellendi.
				</div>
				<?php
			}
			?>
			<form action="nedmin/netting/kullanici.php" data-parsley-validate method="POST"  enctype="multipart/form-data">
				<div class="form-group row">
					<label for="inputPassword3" class="col-sm-2 col-form-label">Yüklü Fotoğraf</label>
					<div class="col-sm-10">					
			    		<img width="300" src="<?php echo $kullanicicek['kullanici_resim'] ?>" class="img-fluid"> 			    		
					</div>
				</div>
				<div class="form-group row">
					<label for="inputPassword3" class="col-sm-2 col-form-label">Resim Seç</label>
					<div class="col-sm-10">
						<input type="file" class="form-control-file" name="kullanici_resim">
					</div>
				</div>
				<div class="form-group row">
					<div class="col-sm-2"></div>
					<div class="col-sm-10" style="text-align: right;">
						<input type="hidden" name="eski_yol" value="<?php echo $kullanicicek['kullanici_resim'] ?>">
						<button type="submit" class="btn btn-kategori" name="kullanicifotoguncelle">Güncelle</button>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>
<?php include 'footer.php' ?>
