<?php 
  include 'header.php';


  $kullanicisor=$db->prepare("SELECT * FROM kullanici");
  $kullanicisor->execute();

?>
        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">

            <div class="clearfix"></div>
            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Kullanıcı Listeleme <small>

                      <?php 
                        
                        if ($_GET['durum']=="ok") 
                        {
                          
                         ?> <b style="color:green;">İşlem Başarılı..</b> <?php

                        }
                        elseif ($_GET['durum']=="no") 
                        {
                          
                         ?> <b style="color:red;">İşlem Başarısız..</b> <?php

                        }

                      ?>
                      
                    </small></h2>

                    
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <div class="table-responsive">
                    <table id="datatable-responsive" class="table table-striped jambo_table bulk_action" cellspacing="0" width="100%">
                      <thead>
                        <tr>
                          <th>Kayıt Tarihi</th>
                          <th>Ad Soyad</th>
                          <th>Mail Adresi</th>
                          <th>Telefon</th>
                          <th></th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php 
                          while ($kullanicicek=$kullanicisor->fetch(PDO::FETCH_ASSOC)) 
                          { 
                                ?>
                                <tr>
                                  <td><?php echo $kullanicicek['kullanici_zaman']; ?></td>
                                  <td><?php echo $kullanicicek['kullanici_ad']." ".$kullanicicek['kullanici_soyad']; ?></td>
                                  <td><?php echo $kullanicicek['kullanici_mail']; ?></td>
                                  <td><?php echo $kullanicicek['kullanici_tel']; ?></td>
                                  <td>
                                    <center>
                                      <a href="kullanici-duzenle?kullanici_id=<?php echo $kullanicicek['kullanici_id']; ?>"><button class="btn btn-primary btn-xs"><i class="fas fa-edit"></i></button></a>
                                      <a  onclick="return confirm('Bu kullanıcıyı silmek istediğinize eminmisiniz?')" href="../netting/islem?kullanici_id=<?php echo $kullanicicek['kullanici_id']; ?>&kullanicisil=ok"><button class="btn btn-danger btn-xs"><i class="fas fa-trash-alt"></i></button></a>
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