<?php 
include 'header.php'; 

$urunsor=$db->prepare("SELECT urun.*,kategori.kategori_ad FROM urun INNER JOIN kategori ON urun.kategori_id=kategori.kategori_id where kategori_durum=:durum order by urun_id DESC");
$urunsor->execute(array('durum'=>1));
?>

<!-- page content -->
<div class="right_col" role="main">
  <div class="">
    <div class="clearfix"></div>
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h2>Kombin Ürün Seç </h2>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
            <table id="datatable" class="table table-striped table-bordered">
              <thead>
                <tr>
                  <th>Ürün Foto</th>
                  <th>Ürün Ad</th>
                  <th>Kategori Ad</th>
                  <th>Ürün Durum</th>
                  <th>Ürün Kodu</th>
                </tr>
              </thead>
              <tbody>
                <?php  
                while ($uruncek=$urunsor->fetch(PDO::FETCH_ASSOC)) 
                {
                  $urun_id=$uruncek['urun_id'];
                  $urunfotosor=$db->prepare("SELECT * FROM urunfoto where urun_id=:urun_id order by urunfoto_sira ASC limit 1, 1");
                  $urunfotosor->execute(array('urun_id'=>$urun_id));

                  $urunfotocek=$urunfotosor->fetch(PDO::FETCH_ASSOC);

                  ?>
                  <tr>
                    <td><img style="width: 100px;" src="../../<?php echo $urunfotocek['urunfoto_resimyol']; ?>" class="img-fluid" ></td>
                    <td><?php echo $uruncek['urun_ad']; ?></td>
                    <td><?php echo $uruncek['kategori_ad'] ?></td>
                    <td><?php if ($uruncek['urun_durum']==1) { echo "<b style='color: green;'>Aktif</b>";} else { echo "<b style='color: red;'>Pasif</b>"; } ?></td>
                    <td><?php echo $uruncek['urun_id']; ?></td>
                  </tr>
                  <?php
                }
                ?>
              </tbody>
            </table>
          </div>
        </div>
        <div class="x_panel">
          <div class="x_title">
            <h2>Kombin Ekle <small>,

              <?php 

              if ($_GET['durum']=="ok") {?>

                <b style="color:green;">İşlem Başarılı...</b>

              <?php } elseif ($_GET['durum']=="no") {?>

                <b style="color:red;">İşlem Başarısız...</b>

              <?php }
              elseif ($_GET['durum']=="bos") {?>

                <b style="color:red;">Lütfen Bütün Alanları Doldurunuz...</b>

              <?php }

              ?>

            </small></h2>
            <div class="clearfix"></div>
          </div>

          <div class="x_content">
            <br />
            <div class="table-responsive">

            </div>
            <!-- / => en kök dizine çık ... ../ bir üst dizine çık -->
            <form action="../netting/islem.php" method="POST" id="demo-form2"   enctype="multipart/form-data" data-parsley-validate class="form-horizontal form-label-left">
             <!-- urun seçme başlangıç -->

             <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12">Ürün 1</label>
              <div class="col-md-6 col-sm-6 col-xs-6">
                <select class="select2_group form-control" name="urun_idbir">
                  <?php  
                  $kategorisor1=$db->prepare("SELECT * FROM kategori where kategori_durum=:durum");
                  $kategorisor1->execute(array('durum'=>1));
                  ?>
                  <option selected value="0">Ürün Seçiniz..</option>
                  <?php 
                  while($kategoricek1=$kategorisor1->fetch(PDO::FETCH_ASSOC)) 
                  {
                    ?>
                    <optgroup label="<?php echo $kategoricek1['kategori_ad'] ?>">
                      <?php
                      $kategori_id=$kategoricek1['kategori_id'];
                      $urunsor1=$db->prepare("SELECT * FROM urun where kategori_id=:kategori and urun_durum=:durum order by urun_id DESC");
                      $urunsor1->execute(array('kategori' => $kategori_id , 'durum'=>1));
                      ?>
                      <?php 
                      while($uruncek1=$urunsor1->fetch(PDO::FETCH_ASSOC)) 
                      {
                       ?>
                       <option value="<?php echo $uruncek1['urun_id']; ?>">Kod: <?php echo $uruncek1['urun_id']; ?> | <?php echo $uruncek1['urun_ad']; ?> </option>
                       <?php 
                     } 
                     ?>
                   </optgroup>
                   <?php 
                 } 
                 ?>                            
               </select>
             </div>
           </div>

           <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12">Ürün 2</label>
            <div class="col-md-6 col-sm-6 col-xs-6">
              <select class="select2_group form-control" name="urun_idiki">
                <?php  
                $kategorisor1=$db->prepare("SELECT * FROM kategori where kategori_durum=:durum");
                $kategorisor1->execute(array('durum'=>1));
                ?>
                <option selected value="0">Ürün Seçiniz..</option>
                <?php 
                while($kategoricek1=$kategorisor1->fetch(PDO::FETCH_ASSOC)) 
                {
                  ?>
                  <optgroup label="<?php echo $kategoricek1['kategori_ad'] ?>">
                    <?php
                    $kategori_id=$kategoricek1['kategori_id'];
                    $urunsor1=$db->prepare("SELECT * FROM urun where kategori_id=:kategori and urun_durum=:durum order by urun_id DESC");
                    $urunsor1->execute(array('kategori' => $kategori_id , 'durum'=>1));
                    ?>
                    <?php 
                    while($uruncek1=$urunsor1->fetch(PDO::FETCH_ASSOC)) 
                    {
                     ?>
                     <option value="<?php echo $uruncek1['urun_id']; ?>">Kod: <?php echo $uruncek1['urun_id']; ?> | <?php echo $uruncek1['urun_ad']; ?> </option>
                     <?php 
                   } 
                   ?>
                 </optgroup>
                 <?php 
               } 
               ?>                            
             </select>
           </div>
         </div>


         <div class="form-group">
          <label class="control-label col-md-3 col-sm-3 col-xs-12">Ürün 3</label>
          <div class="col-md-6 col-sm-6 col-xs-6">
            <select class="select2_group form-control" name="urun_iduc">
              <?php  
              $kategorisor1=$db->prepare("SELECT * FROM kategori where kategori_durum=:durum");
              $kategorisor1->execute(array('durum'=>1));
              ?>
              <option selected value="0">Ürün Seçiniz..</option>
              <?php 
              while($kategoricek1=$kategorisor1->fetch(PDO::FETCH_ASSOC)) 
              {
                ?>
                <optgroup label="<?php echo $kategoricek1['kategori_ad'] ?>">
                  <?php
                  $kategori_id=$kategoricek1['kategori_id'];
                  $urunsor1=$db->prepare("SELECT * FROM urun where kategori_id=:kategori and urun_durum=:durum order by urun_id DESC");
                  $urunsor1->execute(array('kategori' => $kategori_id , 'durum'=>1));
                  ?>
                  <?php 
                  while($uruncek1=$urunsor1->fetch(PDO::FETCH_ASSOC)) 
                  {
                   ?>
                   <option value="<?php echo $uruncek1['urun_id']; ?>">Kod: <?php echo $uruncek1['urun_id']; ?> | <?php echo $uruncek1['urun_ad']; ?> </option>
                   <?php 
                 } 
                 ?>
               </optgroup>
               <?php 
             } 
             ?>                            
           </select>
         </div>
       </div>


       <div class="form-group">
        <label class="control-label col-md-3 col-sm-3 col-xs-12">Ürün 4</label>
        <div class="col-md-6 col-sm-6 col-xs-6">
          <select class="select2_group form-control" name="urun_iddort">
            <?php  
            $kategorisor1=$db->prepare("SELECT * FROM kategori where kategori_durum=:durum");
            $kategorisor1->execute(array('durum'=>1));
            ?>
            <option selected value="0">Ürün Seçiniz..</option>
            <?php 
            while($kategoricek1=$kategorisor1->fetch(PDO::FETCH_ASSOC)) 
            {
              ?>
              <optgroup label="<?php echo $kategoricek1['kategori_ad'] ?>">
                <?php
                $kategori_id=$kategoricek1['kategori_id'];
                $urunsor1=$db->prepare("SELECT * FROM urun where kategori_id=:kategori and urun_durum=:durum order by urun_id DESC");
                $urunsor1->execute(array('kategori' => $kategori_id , 'durum'=>1));
                ?>
                <?php 
                while($uruncek1=$urunsor1->fetch(PDO::FETCH_ASSOC)) 
                {
                 ?>
                 <option value="<?php echo $uruncek1['urun_id']; ?>">Kod: <?php echo $uruncek1['urun_id']; ?> | <?php echo $uruncek1['urun_ad']; ?> </option>
                 <?php 
               } 
               ?>
             </optgroup>
             <?php 
           } 
           ?>                            
         </select>
       </div>
     </div><hr>

     <div class="form-group">
      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Kombin Foto <span class="required">*</span>
      </label>
      <div class="col-md-6 col-sm-6 col-xs-12">
        <input type="file" id="first-name" name="kombin_foto" class="form-control col-md-7 col-xs-12">
      </div>
    </div>

    <div class="form-group">
      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Kombin Ad <span class="required">*</span>
      </label>
      <div class="col-md-6 col-sm-6 col-xs-12">
        <input type="text" id="first-name1" name="kombin_ad"  placeholder="kombin Adı Giriniz.." required="required" class="form-control col-md-7 col-xs-12 ilkharf">
      </div>
    </div>

    <div class="form-group">
      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Kombin Cinsiyet <span class="required">*</span>
      </label>
      <div class="col-md-6 col-sm-6 col-xs-12">
       <select class="select2_multiple form-control" required="" name="kombin_cinsiyet" >
         <option value="E">Erkek</option>
         <option value="K">Kadın</option>
       </select>
     </div>
   </div>
   <!-- Ck Editör Başlangıç -->
   <div class="form-group">
    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Kombin Detay <span class="required">*</span>
    </label>
    <div class="col-md-6 col-sm-6 col-xs-12">

      <textarea placeholder="Kombin Detay"  class="ckeditor" id="editor1" name="kombin_detay"></textarea>
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
  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Kombin Durum<span class="required">*</span>
  </label>
  <div class="col-md-6 col-sm-6 col-xs-12">
   <select id="heard" class="form-control" name="kombin_durum" required>
    <option value="1" selected="">Aktif</option>
    <option value="0" >Pasif</option>
  </select>
</div>
</div>
<div class="form-group">
  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Kombin Öneçıkar<span class="required">*</span>
  </label>
  <div class="col-md-6 col-sm-6 col-xs-12">
   <select id="heard" class="form-control" name="kombin_onecikar" required>
    <option value="1" >Aktif</option>
    <option value="0" selected="">Pasif</option>
  </select>
</div>
</div>


<div class="ln_solid"></div>
<div class="form-group">
  <div align="right" class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
    <button type="submit" name="kombinekle" class="btn btn-success">Ekle</button>
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

<!-- Select2 -->
<script>
  $(document).ready(function() {
    $(".select2_single").select2({
      placeholder: "Select a state",
      allowClear: true
    });
    $(".select2_group").select2({});
    $(".select2_multiple").select2({
      maximumSelectionLength: 4,
      placeholder: "With Max Selection limit 4",
      allowClear: true
    });
  });
</script>