<?php 

  include 'header.php';
 
        $siparissor=$db->prepare("SELECT siparis.*,kullanici.* FROM siparis INNER JOIN kullanici ON siparis.kullanici_id=kullanici.kullanici_id");
        $siparissor->execute();

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
                          <th>Sipariş Kod</th>
                          <th>Sipariş Tarih</th>
                          <th>Kullanıcı</th>
                          <th>Adres</th>
                          <th>Toplam</th>
                          <th>Teslim</th>
                          <th>Ürünler</th>
                          <th>Ödeme</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php $say=0;
                          while ($sipariscek=$siparissor->fetch(PDO::FETCH_ASSOC)) 
                          { 
                                ?>
                                <tr>
                                  <td ><?php echo $sipariscek['siparis_id']; ?></td>
                                  <td><?php echo $sipariscek['siparis_zaman']; ?></td>
                                  <td style="padding:10px 0;"><?php echo $sipariscek['kullanici_ad']." ".$sipariscek['kullanici_soyad']." / ".$sipariscek['kullanici_id']; ?><br><?php echo $sipariscek['kullanici_mail']; ?><br><?php echo $sipariscek['kullanici_tel'] ?><br></td>
                                  <td style="padding:10px 0;"><?php echo $sipariscek['siparis_zip']; ?><br><?php echo $sipariscek['siparis_il']." / ".$sipariscek['siparis_ilce'] ?><br><?php echo $sipariscek['siparis_adres']; ?></td>
                                  <td><?php echo $sipariscek['siparis_toplam']; ?> TL</td>
                                  <td><?php if ($sipariscek['siparis_teslim']==1) { echo "<b style='color: green;'>Teslim Edildi</b>";} else { echo "<b style='color: red;'>Teslim Edilmedi</b>"; } ?></td>
                                  <td>
                                      <button type="button" class="btn btn-primary btn-xs" data-toggle="modal" data-target=".bd-example-modal-lg<?php echo $sipariscek['siparis_id']; ?>">Ürünler</button>

                                      <div class="modal fade bd-example-modal-lg<?php echo $sipariscek['siparis_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-lg">
                                          <div class="modal-content">
                                            <?php 
                                              $siparisdetaysor=$db->prepare("SELECT * FROM siparis_detay where siparis_id=:siparis_id");
                                              $siparisdetaysor->execute(array('siparis_id'=>$sipariscek['siparis_id']));

                                              
                                            ?> 
                                                <table id="datatable-responsive" class="ttable table-striped jambo_table bulk_action" cellspacing="0" width="100%">
                                                  <thead>
                                                    <tr>
                                                      <th>Ürün Foto</th>
                                                      <th>Ürün</th>
                                                      <th>Ürün Kod</th>
                                                      <th>Sipariş Adet</th>
                                                      <th>Ürün Fiyat</th>
                                                    </tr>
                                                  </thead>
                                                  <tbody>
                                                    <tr>
                                                      <?php 
                                                      while ($siparisdetaycek=$siparisdetaysor->fetch(PDO::FETCH_ASSOC)) 
                                                      {
                                                        $urunsor=$db->prepare("SELECT urun.*,urunfoto.* FROM urun INNER JOIN urunfoto ON urun.urun_id=urunfoto.urun_id where urun.urun_id=:urun_id");
                                                        $urunsor->execute(array('urun_id'=>$siparisdetaycek['urun_id']));
                                                        $uruncek=$urunsor->fetch(PDO::FETCH_ASSOC);
                                                        ?>
                                                          <tr>
                                                            <td><img  style="width: 100px;" src="../../<?php echo $uruncek['urunfoto_resimyol']; ?>" class="img-fluid"></td>
                                                            <td><?php echo $uruncek['urun_ad']; ?><br><?php echo $uruncek['urun_fiyat']; ?></td>
                                                            <td><?php echo $uruncek['urun_id']; ?></td>
                                                            <td><?php echo $siparisdetaycek['urun_adet']; ?></td>
                                                            <td><?php echo $siparisdetaycek['urun_fiyat']*$siparisdetaycek['urun_adet']; ?> TL</td>
                                                          </tr>
                                                        <?php
                                                      }
                                                      ?>
                                                    </tr>
                                                  </tbody>
                                                </table>
                                          </div>
                                        </div>
                                      </div>
                                  </td>
                                  <td>
                                      <?php if ($sipariscek['siparis_odeme']==1) { ?> <a href="../netting/islem?siparisteslim=no&siparis_id=<?php echo $sipariscek['siparis_id']; ?>" class='btn btn-xs btn-success'>Ödendi</a> <?php } else { ?> <a  href="../netting/islem?siparisteslim=ok&siparis_id=<?php echo $sipariscek['siparis_id']; ?>" class='btn btn-xs btn-warning'>Ödenmedi</a> <?php } ?>
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