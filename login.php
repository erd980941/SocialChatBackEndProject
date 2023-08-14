<form method="POST" action="nedmin/netting/kullanici.php">
  <div class="modal fade" id="modalLoginForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header text-center">
          <h4 class="modal-title w-100 font-weight-bold">Giriş Yap</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body mx-3">
            <p>Eğer kayıt olmadıysanız <a href="register" style="color: black;">Buraya</a> tıklayarak kayıt olabilirsiniz.</p>
            <input type="mail" class="form-control mb-4" placeholder="Mail Adresiniz.." name="kullanici_mail">

            <input type="password" class="form-control mb-4" placeholder="Şifreniz.." name="kullanici_password">
        </div>
        <div class="modal-footer d-flex justify-content-center">
          <button style="background-color: #43484a !important;" class="btn btn-default" name="kullanicigiris">Giriş Yap</button>
        </div>

      </div>
    </div>
  </div>
</form>
