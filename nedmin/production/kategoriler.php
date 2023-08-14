<?php 

  include 'header.php';


  $kategorisor=$db->prepare("SELECT * FROM kategori order by kategori_sira ASC");
  $kategorisor->execute();

?>
        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">

            <div class="clearfix"></div>
            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Kategori Listeleme <small>

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
                         elseif (!empty($_GET['durum'])=="bos") 
                        {
                          
                         ?> <b style="color:red;">Lütfen Boş Alan Bırakmayınız..</b> <?php

                        }
                         elseif (!empty($_GET['durum'])=="dosyabuyuk") 
                        {
                          
                         ?> <b style="color:red;">Dosya Boyutu Çok Büyük..</b> <?php

                        }
                         elseif (!empty($_GET['durum'])=="formathata") 
                        {
                          
                         ?> <b style="color:red;">Dosya Uzantısı JPG veya PNG olmalıdır..</b> <?php

                        }


                      ?>
                      
                    </small></h2>

                    <div class="clearfix"><div align="right"><a href="kategori-ekle"><button class="btn btn-success">Yeni Ekle</button></a></div></div>
                    
                  </div>
                  <div class="x_content">
                    <div class="table-responsive">
                      <table id="datatable-responsive" class="table table-striped jambo_table bulk_action" cellspacing="0" width="100%">
                      <thead>
                        <tr>
                          <th >K. Foto</th>
                          <th>Kategori Ad</th>
                          <th>Kategori Sira</th>
                          <th>Kategori Durum</th>
                          <th></th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php $say=0;
                          while ($kategoricek=$kategorisor->fetch(PDO::FETCH_ASSOC)) 
                          { $say++;
                                ?>
                                <tr>
                                  <td><img style="width: 100px;" src="../../<?php echo $kategoricek['kategori_foto']; ?>" class="img-fluid" ></td>
                                  <td><?php echo $kategoricek['kategori_ad']; ?></td>
                                  <td><?php echo $kategoricek['kategori_sira']; ?></td>
                                  <td><?php if ($kategoricek['kategori_durum']==1) { echo "<b style='color: green;'>Aktif</b>";} else { echo "<b style='color: red;'>Pasif</b>"; } ?></td>
                                  <td>
                                    <center>
                                      <a href="kategori-duzenle?kategori_id=<?php echo $kategoricek['kategori_id']; ?>"><button class="btn btn-primary btn-xs"><i class="fas fa-edit"></i></button>
                                      <a  onclick="return confirm('Bu kategoriyi silmek istediğinize eminmisiniz?')" href="../netting/islem.php?kategori_id=<?php echo $kategoricek['kategori_id']; ?>&eski_yol=<?php echo $kategoricek['kategori_foto']; ?>&kategorisil=ok"><button class="btn btn-danger btn-xs"><i class="fas fa-trash-alt"></i></button> </a>
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