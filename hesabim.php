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
			<div class="form-group row">
			    <label for="inputEmail3MD" class="col-4 col-form-label hesabim-label">Profil Fotoğrafı</label>
			    <label for="inputEmail3MD" class="col-8 col-form-label"> 		    		
			    	<img width="300" src="<?php echo $kullanicicek['kullanici_resim'] ?>" class="img-fluid">
				</label>
			 </div>
			 <div class="form-group row">
			    <label for="inputEmail3MD" class="col-4 col-form-label hesabim-label">Ad / Soyad</label>
			    <label for="inputEmail3MD" class="col-8 col-form-label">: <b><?php echo $kullanicicek['kullanici_ad']." ".$kullanicicek['kullanici_soyad']; ?></b></label>
			 </div>
			 <div class="form-group row">
			    <label for="inputEmail3MD" class="col-4 col-form-label hesabim-label">TC Kimlik No</label>
			    <label for="inputEmail3MD" class="col-8 col-form-label">: <b><?php echo $kullanicicek['kullanici_tc']; ?></b></label>
			 </div>
			 <div class="form-group row">
			    <label for="inputEmail3MD" class="col-4 col-form-label hesabim-label">Mail Adresi</label>
			    <label for="inputEmail3MD" class="col-8 col-form-label">: <b><?php echo $kullanicicek['kullanici_mail']; ?></b></label>
			 </div>
			 <div class="form-group row">
			    <label for="inputEmail3MD" class="col-4 col-form-label hesabim-label">Telefon Numarası</label>
			    <label for="inputEmail3MD" class="col-8 col-form-label">: <b><?php echo $kullanicicek['kullanici_tel']; ?></b></label>
			 </div>
			 <div class="form-group row">
			    <label for="inputEmail3MD" class="col-4 col-form-label hesabim-label">Posta Kodu</label>
			    <label for="inputEmail3MD" class="col-8 col-form-label">: <b><?php echo $kullanicicek['kullanici_zip']; ?></b></label>
			 </div>
			 <div class="form-group row">
			    <label for="inputEmail3MD" class="col-4 col-form-label hesabim-label">İl / İlçe</label>
			    <label for="inputEmail3MD" class="col-8 col-form-label">: <b><?php echo $kullanicicek['kullanici_il']." ".$kullanicicek['kullanici_ilce']; ?></b></label>
			 </div>
			 <div class="form-group row">
			    <label for="inputEmail3MD" class="col-4 col-form-label hesabim-label">Adres</label>
			    <label for="inputEmail3MD" class="col-8 col-form-label">: <b><?php echo $kullanicicek['kullanici_adres']; ?></b></label>
			 </div>
		</div>
	</div>
</div>
<?php include 'footer.php' ?>
