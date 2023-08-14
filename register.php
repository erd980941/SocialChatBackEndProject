<?php include 'header.php' ?>
<div class="erkekfoto">
  <div class="container">
    <div class="row">
      <div class="col-lg-4"></div>
      <div class="col-lg-4">
        <h2>Kayıt OL</h2>
        <h4 style="color: white;">Kayıt Olduktan Sonra Bilgilerinizi Tamamlayınız.</h4>
      </div>
      <div class="col-lg-4"></div>
    </div>
  </div>
</div>
<div class="container con">
	
	<div class="row">
		<div class="col-lg-6">
			<!-- Default form register -->
			<form class="text-center" action="nedmin/netting/kullanici.php" data-parsley-validate method="POST">

				<p class="h4 mb-4">KAYIT OL</p>
        <?php 
          if ($_GET['durum']=="sifreuyusmuyor") 
          {
            ?>
            <div class="alert alert-danger">
              <strong>Hata!</strong> Girdiğiniz Şifreler Eşleşmiyor.
            </div>
            <?php
          }
          elseif ($_GET['durum']=="eksiksifre") 
          {
            ?>
            <div class="alert alert-danger">
              <strong>Hata!</strong> Şifreniz minumum 6 karakter uzunluğunda olmalıdır.
            </div>
            <?php
          }
          elseif ($_GET['durum']=="kayitvar") 
          {
            ?>
            <div class="alert alert-danger">
              <strong>Hata!</strong> Bu kullanıcı daha önce kayıt edilmiş.
            </div>
            <?php
          }
          elseif ($_GET['durum']=="no") 
          {
            ?>
            <div class="alert alert-danger">
              <strong>Hata!</strong> Kayıt yapılamadı sistem yöneticisine danışınız.
            </div>
            <?php
          }
          elseif ($_GET['durum']=="bos") 
          {
            ?>
            <div class="alert alert-danger">
              <strong>Hata!</strong> Lütfen Bilgileri Eksiksiz Doldurunuz.
            </div>
            <?php
          }
          elseif ($_GET['durum']=="ok") 
          {
            ?>
            <div class="alert alert-success">
              <strong>Kayıt Oldunuz.</strong> Giriş yapmak için lütfen <a style="text-decoration: underline;" href="#" data-toggle="modal" data-target="#modalLoginForm"> Buraya </a>tıklayınız.
            </div>
            <?php
          }
          ?>
        <div class="form-row mb-4">
         <div class="col">
          <!-- First name -->
          <input type="text" id="defaultRegisterFormFirstName" required class="form-control" placeholder="Adınız.." name="kullanici_ad">
        </div>
        <div class="col">
          <!-- Last name -->
          <input type="text" id="defaultRegisterFormLastName" required class="form-control" placeholder="Soyadınız.." name="kullanici_soyad">
        </div>
      </div>

      <!-- E-mail -->
      <input type="email" id="defaultRegisterFormEmail" required class="form-control mb-4" placeholder="Mail Adresiniz.." name="kullanici_mail">

      <div class="form-row mb-4">
       <div class="col">
        <!-- First P -->
        <input type="password" id="defaultRegisterFormPassword" required class="form-control" placeholder="Şifreniz.."
        aria-describedby="defaultRegisterFormPasswordHelpBlock" name="kullanici_passwordone">
        <small style="text-align: left;" id="defaultRegisterFormPasswordHelpBlock" class="form-text text-muted mb-4">
         En az 6 karakter uzunluğunda olmalıdır.
       </small>
     </div>
     <div class="col">
      <!-- Last P -->
      <input type="password" id="defaultRegisterFormPassword" required class="form-control" placeholder="Şifre Tekrar.."
      aria-describedby="defaultRegisterFormPasswordHelpBlock" name="kullanici_passwordtwo">
      <small style="text-align: left;" id="defaultRegisterFormPasswordHelpBlock" class="form-text text-muted mb-4">
       Şifrelerinizi Doğru Yazmaya Dikkat Ediniz.
     </small>
   </div>
 </div>

 <!-- Password -->



 <!-- Phone number -->
 <input type="tel" id="defaultRegisterPhonePassword" required class="form-control" placeholder="Telefon Numaranız.."
 aria-describedby="defaultRegisterFormPhoneHelpBlock" name="kullanici_tel">
 <small style="text-align: left;" id="defaultRegisterFormPhoneHelpBlock" class="form-text text-muted mb-4">
   0590 111 11 11
 </small>


 <!-- Sign up button -->
 <button class="btn my-4 btn-block btn-kategori" type="submit" name="kullaniciekle">Kayıt Ol</button>

 <!-- Social register -->
 <p>Bizi Takip Etmeyi Unutmayın</p>

 <a href="#" class="mx-1" role="button"><i class="fab fa-instagram"></i></a>
 <a href="#" class="mx-1" role="button"><i class="fab fa-twitter"></i></a>

 <hr>
 <p><em>Kaydol</em>'a tıklayarak <a href=""   data-toggle="modal" data-target="#exampleModalLongSC">hizmet şartlarımızı</a> kabul etmiş olursunuz</p>

</form>
<!-- Default form register -->
</div>
<div class="col-lg-6">
 <img src="img/slide/register.jpg" class="img-fluid">
 <div class="rememberpassword">
  <b>Şifrenizi Unuttuysanız <br> Lütfen <a href="">İnstagram</a> Adresinden<br> Bize Ulaşınız</b>
</div>
</div>
</div>

</div>
<div class="modal fade" id="exampleModalLongSC" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitleSC" data-gtm-vis-first-on-screen-2340190_1302="153858" data-gtm-vis-total-visible-time-2340190_1302="100" data-gtm-vis-has-fired-2340190_1302="1" style="display: none;" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitleSC">Kullanım Şartları</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body">
        <p>Cras mattis consectetur purus sit amet fermentum. Cras justo odio, dapibus ac facilisis in, egestas eget
          quam.
        Morbi leo risus, porta ac consectetur ac, vestibulum at eros.</p>
        <p>Praesent commodo cursus magna, vel scelerisque nisl consectetur et. Vivamus sagittis lacus vel augue
          laoreet
        rutrum faucibus dolor auctor.</p>
        <p>Aenean lacinia bibendum nulla sed consectetur. Praesent commodo cursus magna, vel scelerisque nisl
          consectetur
          et. Donec sed odio dui. Donec ullamcorper nulla non metus auctor fringilla.
        </p>
        <p>Cras mattis consectetur purus sit amet fermentum. Cras justo odio, dapibus ac facilisis in, egestas eget
          quam.
        Morbi leo risus, porta ac consectetur ac, vestibulum at eros.</p>
        <p>Praesent commodo cursus magna, vel scelerisque nisl consectetur et. Vivamus sagittis lacus vel augue
          laoreet
        rutrum faucibus dolor auctor.</p>
        <p>Aenean lacinia bibendum nulla sed consectetur. Praesent commodo cursus magna, vel scelerisque nisl
          consectetur
          et. Donec sed odio dui. Donec ullamcorper nulla non metus auctor fringilla.
        </p>
        <p>Cras mattis consectetur purus sit amet fermentum. Cras justo odio, dapibus ac facilisis in, egestas eget
          quam.
        Morbi leo risus, porta ac consectetur ac, vestibulum at eros.</p>
        <p>Praesent commodo cursus magna, vel scelerisque nisl consectetur et. Vivamus sagittis lacus vel augue
          laoreet
        rutrum faucibus dolor auctor.</p>
        <p>Aenean lacinia bibendum nulla sed consectetur. Praesent commodo cursus magna, vel scelerisque nisl
          consectetur
          et. Donec sed odio dui. Donec ullamcorper nulla non metus auctor fringilla.
        </p>
        <p>Cras mattis consectetur purus sit amet fermentum. Cras justo odio, dapibus ac facilisis in, egestas eget
          quam.
        Morbi leo risus, porta ac consectetur ac, vestibulum at eros.</p>
        <p>Praesent commodo cursus magna, vel scelerisque nisl consectetur et. Vivamus sagittis lacus vel augue
          laoreet
        rutrum faucibus dolor auctor.</p>
        <p>Aenean lacinia bibendum nulla sed consectetur. Praesent commodo cursus magna, vel scelerisque nisl
          consectetur
          et. Donec sed odio dui. Donec ullamcorper nulla non metus auctor fringilla.
        </p>
        <p>Cras mattis consectetur purus sit amet fermentum. Cras justo odio, dapibus ac facilisis in, egestas eget
          quam.
        Morbi leo risus, porta ac consectetur ac, vestibulum at eros.</p>
        <p>Praesent commodo cursus magna, vel scelerisque nisl consectetur et. Vivamus sagittis lacus vel augue
          laoreet
        rutrum faucibus dolor auctor.</p>
        <p>Aenean lacinia bibendum nulla sed consectetur. Praesent commodo cursus magna, vel scelerisque nisl
          consectetur
          et. Donec sed odio dui. Donec ullamcorper nulla non metus auctor fringilla.
        </p>
        <p>Cras mattis consectetur purus sit amet fermentum. Cras justo odio, dapibus ac facilisis in, egestas eget
          quam.
        Morbi leo risus, porta ac consectetur ac, vestibulum at eros.</p>
        <p>Praesent commodo cursus magna, vel scelerisque nisl consectetur et. Vivamus sagittis lacus vel augue
          laoreet
        rutrum faucibus dolor auctor.</p>
        <p>Aenean lacinia bibendum nulla sed consectetur. Praesent commodo cursus magna, vel scelerisque nisl
          consectetur
          et. Donec sed odio dui. Donec ullamcorper nulla non metus auctor fringilla.
        </p>
      </div>
    </div>
  </div>
</div>

<?php include 'footer.php' ?>