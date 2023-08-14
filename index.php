<?php include 'header.php' ?>
<?php  
  $kategorisor=$db->prepare("SELECT * FROM kategori where kategori_durum=:durum and kategori_onecikar=:onecikar order by kategori_sira ASC");
  $kategorisor->execute(array('durum'=>1,'onecikar'=>1));
?>
  <!--/.Navbar -->
<div class="headerfoto">
  <div class="container">
    <div class="row">
      <div class="col-lg-1"></div>
      <div class="col-lg-9">
        <h2>Erkek Koleksiyon 2020</h2>
        <h4 style="color: white;">Yeni Erkek Kombin</h4>
       <button type="button" class="btn btn-a">İncele</button>
      </div>
      <div class="col-lg-1"></div>
    </div>
  </div>
</div>
  <div  class="container con">

  <!--Section: Content-->
  <section class="dark-grey-text text-center">
    
    <!-- Section heading -->
    <h3 class="font-weight-bold mb-4 pb-2">Kategoriler</h3>
    <!-- Section description -->
    <p class="grey-text w-responsive mx-auto mb-5">Aşağıdaki kategorilerden sadece erkek kategorisindeki ürünlere ulabişilirsiniz. Kadın kategorisindeki ürünlere ulaşmak için yukarıdaki menüden Kadın sekmesine tıklayınız.</p>

    <!-- Grid row -->
    <div class="row">

      <?php  
        while ($kategoricek=$kategorisor->fetch(PDO::FETCH_ASSOC)) 
        {
          ?>
            <!-- Grid column -->
            <div class="col-lg-3 col-md-6 mb-4">
              <!-- Collection card -->
              <div class="card collection-card z-depth-1-half">
                <!-- Card image -->
                <a href="erkekkategori-<?php echo $kategoricek['kategori_seourl']."-".$kategoricek['kategori_id']  ?>">
                  <div class="view zoom">
                  <img src="<?php echo $kategoricek['kategori_foto']; ?>" alt="<?php echo $kategoricek['kategori_ad']; ?>" class="img-fluid"
                    alt="">
                  <div class="stripe dark">
                    <a>
                      <p><?php echo $kategoricek['kategori_ad']; ?>
                        <i class="fas fa-angle-right"></i>
                      </p>
                    </a>
                  </div>
                </div>
                </a>
                <!-- Card image -->
              </div>
              <!-- Collection card -->
            </div>
            <!-- Grid column -->
          <?php
        }
      ?>

    </div>
    <!-- Grid row -->

  </section>
  <!--Section: Content-->

  

  <div class="row" style="margin-bottom: 30px;">
    <div class="col-12">
      <div class="reklam">
        <h2><b><strong>SPONSORLUK</strong></b></h2>
      </div>
    </div>
  </div>

  <div class="row urunrow">
    <div class="col-12">
      <h2>Çok Satanlar</h2>
      <hr>
    </div>
  </div>
  
  <div class="owl-carousel">
    <?php 
          $urunsor=$db->prepare("SELECT * FROM urun where urun_durum=:durum and urun_onecikar=:onecikar");
          $urunsor->execute(array(
            'durum'=>1,
            'onecikar'=>1));

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
              <div class="item onecikan">
                <a href="urun-<?php echo $uruncek['urun_seourl']."-".$uruncek['urun_id']; ?>">
                <?php if ($simditarih<=$uruntarih) { ?> <div class="new"><b>Yeni</b></div> <?php } ?>
                <img src="<?php echo $urunfotocek['urunfoto_resimyol']; ?>" class="img-fluid">
                <div class="onecikanfiyat">
                 <?php echo $uruncek['urun_ad']; ?> <br> <b> <?php echo $uruncek['urun_fiyat']; ?> TL</b>
                </div>  
                </a>
              </div>
            <?php
          }  
        ?>
  </div>

  <div class="row">
    <div class="col-xl-5 col-lg-5 mgindex">
      <img class="img-fluid" src="img/slide/bagger-07.jpg">
    </div>
    <div class="col-xl-7 col-lg-7 mgindex1">
      <img class="img-fluid" src="img/slide/wallpaper.jpg">
      <div class="indexdesign">
        <h2>Yeni Trendler</h2>
        <h4>Kombinler</h4>
        <div class="wrapper">
          <div class="btn btn_1">
            <a href="kombinler">İncele</a>
          </div>
        </div>  
      </div>
    </div>
  </div>
</div>
<div class="container my-5">

  <!-- Section: Block Content -->
  <section>
    
    <style>
      .rgba-black-gradient {
        background: linear-gradient(to top, rgba(0,0,0,.8) 55%,rgba(0,0,0,0) 100%);
      }
    </style>

  </section>
  <!-- Section: Block Content -->

</div>
  
  <?php include 'footer.php' ?>

<script type="text/javascript">
  $(document).ready(function() 
  {
    <?php if ($_GET['durum']=="basarisizgiris") { ?> alert("Lütfen Bilgilerinizi Kontrol Ediniz."); <?php } ?>
  });
</script>

