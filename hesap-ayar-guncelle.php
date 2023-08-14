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
			elseif ($_GET['durum']=="ok") 
			{
				?>
				<div class="alert alert-success">
					<strong>Bilgi.</strong> Bilgileriniz Güncellendi.
				</div>
				<?php
			}
			?>
			<form action="nedmin/netting/kullanici.php" data-parsley-validate method="POST">
				<div class="form-group row">
					<label for="inputEmail3" class="col-sm-2 col-form-label">Ad / Soyad</label>
					<div class="col-sm-5">
						<input type="text" class="form-control" name="kullanici_ad" value="<?php echo $kullanicicek['kullanici_ad']; ?>" >
					</div>
					<div class="col-sm-5">
						<input type="text" class="form-control" name="kullanici_soyad"  value="<?php echo $kullanicicek['kullanici_soyad']; ?>">
					</div>
				</div>
				<div class="form-group row">
					<label for="inputPassword3" class="col-sm-2 col-form-label">Kimlik No</label>
					<div class="col-sm-10">
						<input type="text" class="form-control" name="kullanici_tc" value="<?php echo $kullanicicek['kullanici_tc']; ?>">
					</div>
				</div>
				<div class="form-group row">
					<label for="inputPassword3" class="col-sm-2 col-form-label">Telefon</label>
					<div class="col-sm-10">
						<input type="tel" class="form-control" name="kullanici_tel" value="<?php echo $kullanicicek['kullanici_tel']; ?>">
					</div>
				</div>
				<div class="form-group row">
					<div class="col-sm-2"></div>
					<div class="col-sm-10" style="text-align: right;">
						<button type="submit" class="btn btn-kategori" name="kullanicibilgiduzenle">Güncelle</button>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>
<?php include 'footer.php' ?>
