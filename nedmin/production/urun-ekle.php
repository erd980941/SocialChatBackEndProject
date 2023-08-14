<?php 
include 'header.php'; 

?>

<!-- page content -->
<div class="right_col" role="main">
  <div class="">

    <div class="clearfix"></div>
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h2>Ürün Ekle <small>,

              <?php 

              if ($_GET['durum']=="ok") {?>

              <b style="color:green;">İşlem Başarılı...</b>

              <?php } elseif ($_GET['durum']=="no") {?>

              <b style="color:red;">İşlem Başarısız...</b>

              <?php }

              ?>


            </small></h2>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
            <br />

            <!-- / => en kök dizine çık ... ../ bir üst dizine çık -->
            <form action="../netting/islem.php" method="POST" id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">


               <!-- Kategori seçme başlangıç -->


              <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Kategori Seç<span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-6">

                  <?php  

                  $kategorisor=$db->prepare("select * from kategori order by kategori_sira");
                  $kategorisor->execute();

                    ?>
                    <select class="select2_multiple form-control" required="" name="kategori_id" >


                     <?php 

                     while($kategoricek=$kategorisor->fetch(PDO::FETCH_ASSOC)) 
                     {
                       ?>

                       <option value="<?php echo $kategoricek['kategori_id']; ?>"><?php echo $kategoricek['kategori_ad']; ?></option>

                       <?php } ?>

                     </select>
                   </div>
                 </div>


                 <!-- kategori seçme bitiş -->

                  <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Ürün Cinsiyet <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                   <select class="select2_multiple form-control" required="" name="urun_cinsiyet" >
                       <option value="E">Erkek</option>
                       <option value="K">Kadın</option>
                    </select>
                </div>
               </div>

              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Ürün Ad <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="text" id="first-name" name="urun_ad"  placeholder="Urun Adı Giriniz.." required="required" class="form-control col-md-7 col-xs-12 ilkharf">
                </div>
              </div>

               <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Ürün Fiyat <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="text" id="first-name" name="urun_fiyat"  placeholder="Ürün Fiyatı Giriniz.." required="required" class="form-control col-md-7 col-xs-12">
                </div>
               </div>

              

               <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Ürün Keyword <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="text" id="first-name" name="urun_keyword"  placeholder="Ürün Keyword Giriniz.." required="required" class="form-control col-md-7 col-xs-12">
                </div>
               </div>

               <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Ürün Stok Small<span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="number" id="first-name" name="urun_stokS"  placeholder="Ürün Small Stok Giriniz.." required="required" class="form-control col-md-7 col-xs-12">
                </div>
               </div>
               <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Ürün Stok Medium<span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="number" id="first-name" name="urun_stokM"  placeholder="Ürün Medium Stok Giriniz.." required="required" class="form-control col-md-7 col-xs-12">
                </div>
               </div>
               <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Ürün Stok Large<span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="number" id="first-name" name="urun_stokL"  placeholder="Ürün Large Stok Giriniz.." required="required" class="form-control col-md-7 col-xs-12">
                </div>
               </div>
               <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Ürün Stok XLarge<span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="number" id="first-name" name="urun_stokXL"  placeholder="Ürün XLarge Stok Giriniz.." required="required" class="form-control col-md-7 col-xs-12">
                </div>
               </div>
               <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Ürün Stok XXLarge<span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="number" id="first-name" name="urun_stokXXL"  placeholder="Ürün XXLarge Stok Giriniz.." required="required" class="form-control col-md-7 col-xs-12">
                </div>
               </div>

               <!-- Ck Editör Başlangıç -->
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Ürün Detay <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">

                          <textarea placeholder="Ürün Detay"  class="ckeditor" id="editor1" name="urun_detay"></textarea>
                        </div>
                      </div>
                      <script type="text/javascript">

                         CKEDITOR.replace( 'editor1',

                         {

                          filebrowserBrowseUrl : 'ckfinder/ckfinder.html',

                          filebrowserImageBrowseUrl : 'ckfinder/ckfinder.html?type=Images',

                          filebrowserFlashBrowseUrl : 'ckfinder/ckfinder.html?type=Flash',

                          filebrowserUploadUrl : 'ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',

                          filebrowserImageUploadUrl : 'ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images',

                          filebrowserFlashUploadUrl : 'ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash',

                          forcePasteAsPlainText: true

                        } 

                        );

                       </script>
                      <!-- Ck Editör Bitiş -->              
              

              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Ürün Durum<span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                 <select id="heard" class="form-control" name="urun_durum" required>
                  <option value="1" selected="">Aktif</option>
                  <option value="0" >Pasif</option>
                 </select>
               </div>
             </div>
             <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Ürün Öneçıkar<span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                 <select id="heard" class="form-control" name="urun_onecikar" required>
                  <option value="1" >Aktif</option>
                  <option value="0" selected="">Pasif</option>
                 </select>
               </div>
             </div>


             <div class="ln_solid"></div>
             <div class="form-group">
              <div align="right" class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                <button type="submit" name="urunekle" class="btn btn-success">Ekle</button>
              </div>
            </div>

          </form>



        </div>
      </div>
    </div>
  </div>



  <hr>
  <hr>
  <hr>



</div>
</div>
<!-- /page content -->

<?php include 'footer.php'; ?>
