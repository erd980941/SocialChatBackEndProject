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
			if ($_GET['durum']=="bos") 
			{
				?>
				<div class="alert alert-danger">
					<strong>Hata!</strong> Lütfen Boş Bırakmayınız.
				</div>
				<?php
			}
			elseif ($_GET['durum']=="aynieskisifre") 
			{
				?>
				<div class="alert alert-danger">
					<strong>Hata!</strong> Lütfen Eski Şifrenizden Farklı Bir Şifre Giriniz.
				</div>
				<?php
			}
			elseif ($_GET['durum']=="eksiksifre") 
			{
				?>
				<div class="alert alert-danger">
					<strong>Hata!</strong> Şifreniz En Az 6 Karakterli Olmalıdır.
				</div>
				<?php
			}
			elseif ($_GET['durum']=="farklisifre") 
			{
				?>
				<div class="alert alert-danger">
					<strong>Hata!</strong> Yeni Şifreleriniz Uyuşmuyor.
				</div>
				<?php
			}
			elseif ($_GET['durum']=="eskisifrehata") 
			{
				?>
				<div class="alert alert-danger">
					<strong>Hata!</strong> Eski Şifrenizi Kontrol Ediniz.
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
					<label for="inputPassword3" class="col-sm-2 col-form-label">Eski Şifre</label>
					<div class="col-sm-10">
						<input type="password" class="form-control" name="kullanici_eskipassword" required>
					</div>
				</div>
				<div class="form-group row">
					<label for="inputEmail3" class="col-sm-2 col-form-label">Yeni Şifre</label>
					<div class="col-sm-5">
						<input type="password" class="form-control" required name="kullanici_passwordone" placeholder="Yeni Bir Şifre Giriniz.." >
					</div>
					<div class="col-sm-5">
						<input type="password" class="form-control" required name="kullanici_passwordtwo" placeholder="Yeni Şifre Tekrar..">
					</div>
				</div>
				<div class="form-group row">
					<div class="col-sm-2"></div>
					<div class="col-sm-10" style="text-align: right;">
						<button type="submit" class="btn btn-kategori" name="kullanicisifreguncelle">Güncelle</button>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>
<?php include 'footer.php' ?>
