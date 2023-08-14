<?php 

  include 'header.php';


  $urunsor=$db->prepare("SELECT urun.*,kategori.kategori_ad FROM urun INNER JOIN kategori ON urun.kategori_id=kategori.kategori_id order by urun_zaman ASC");
  $urunsor->execute();

?>
        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">

            <div class="clearfix"></div>
            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Ürün Listeleme <small>

                      <?php 

                        if (!empty($_GET['sil'])=="ok") 
                        {
                          
                         ?> <b style="color:green;">İşlem Başarılı..</b> <?php

                        }
                        elseif (!empty($_GET['sil'])=="no") 
                        {
                          
                         ?> <b style="color:red;">İşlem Başarısız..</b> <?php

                        }

                        
                        if (!empty($_GET['durum'])=="ok") 
                        {
                          
                         ?> <b style="color:green;">İşlem Başarılı..</b> <?php

                        }
                        elseif (!empty($_GET['durum'])=="no") 
                        {
                          
                         ?> <b style="color:red;">İşlem Başarısız..</b> <?php

                        }

                      ?>
                      
                    </small></h2>

                    <div class="clearfix"><div align="right"><a href="urun-ekle"><button class="btn btn-success">Yeni Ekle</button></a></div></div>
                    
                  </div>
                  <div class="x_content">
                    <div class="table-responsive">
                      <table id="datatable-responsive" class="ttable table-striped jambo_table bulk_action" cellspacing="0" width="100%">
                      <thead>
                        <tr>
                          <th>Ürün Kod</th>
                          <th>Ürün Ad</th>
                          <th>Kategori Ad</th>
                          <th>Ürün Stok</th>
                          <th>Ürün Fiyat</th>
                          <th>Ürün Cinsiyet</th>
                          <th>Resim İşlemleri</th>
                          <th>Ürün Durum</th>
                          <th>Ürün Öne Çıkar</th>
                          <th></th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php $say=0;
                          while ($uruncek=$urunsor->fetch(PDO::FETCH_ASSOC)) 
                          { $say++;
                            $stokS=$uruncek['urun_stokS'];
                            $stokM=$uruncek['urun_stokM'];
                            $stokL=$uruncek['urun_stokL'];
                            $stokXL=$uruncek['urun_stokXL'];
                            $stokXXL=$uruncek['urun_stokXXL'];
                                ?>
                                <tr>
                                  <td><?php echo $uruncek['urun_id']; ?></td>
                                  <td><?php echo $uruncek['urun_ad']; ?></td>
                                  <td><?php echo $uruncek['kategori_ad']; ?></td>
                                  <td><?php echo $stokS+$stokM+$stokL+$stokXL+$stokXXL; ?></td>
                                  <td><?php echo $uruncek['urun_fiyat']; ?> TL</td>
                                  <td><?php echo $uruncek['urun_cinsiyet']; ?></td>
                                  <td><a href="urun-galeri?urun_id=<?php echo $uruncek['urun_id']; ?>" class="btn btn-info btn-xs">Resim İşlemleri</a></td>
                                  <td><?php if ($uruncek['urun_durum']==1) { echo "<b style='color: green;'>Aktif</b>";} else { echo "<b style='color: red;'>Pasif</b>"; } ?></td>
                                  <td><?php if ($uruncek['urun_onecikar']==1) { echo "<b style='color: green;'>Evet</b>";} else { echo "<b style='color: red;'>Hayır</b>"; } ?></td>
                                  <td>
                                    <center>
                                      <a href="urun-duzenle?urun_id=<?php echo $uruncek['urun_id']; ?>"><button class="btn btn-primary btn-xs"><i class="fas fa-edit"></i></button></a>
                                      <a onclick="return confirm('Bu kategoriyi silmek istediğinize eminmisiniz?')" href="../netting/islem.php?urun_id=<?php echo $uruncek['urun_id']; ?>&urunsil=ok"><button class="btn btn-danger btn-xs"><i class="fas fa-trash-alt"></i></button></a>
                                    </center>
                                  </td>
                                </tr>
                                <?php
                          }
                        ?>                                            
                      </tbody>
                    </table>
                    </div>
                  </div>
                </div>
              </div>
            </div>
                     
          </div>
        </div>
        <!-- /page content -->

    <?php include 'footer.php'; ?>