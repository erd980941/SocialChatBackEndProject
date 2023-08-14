<?php 

  include 'header.php';


  $kombinsor=$db->prepare("SELECT * from kombin order by kombin_id DESC");
  $kombinsor->execute();

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

                    <div class="clearfix"><div align="right"><a href="kombin-ekle"><button class="btn btn-success">Yeni Ekle</button></a></div></div>
                    
                  </div>
                  <div class="x_content">
                    <div class="table-responsive">
                      <table id="datatable-responsive" class="ttable table-striped jambo_table bulk_action" cellspacing="0" width="100%">
                      <thead>
                        <tr>
                          <th>Kombin Foto</th>
                          <th>Kombin Ad</th>
                          <th>Kombin Durum</th>
                          <th>Kombin Öne Çıkar</th>
                          <th></th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php $say=0;
                          while ($kombincek=$kombinsor->fetch(PDO::FETCH_ASSOC)) 
                          { $say++;
                                ?>
                                <tr>
                                  <td><img style="width: 100px;" src="../../<?php echo $kombincek['kombin_foto']; ?>" class="img-fluid" ></td>
                                  <td><?php echo $kombincek['kombin_ad']; ?></td>
                                  <td><?php if ($kombincek['kombin_durum']==1) { echo "<b style='color: green;'>Aktif</b>";} else { echo "<b style='color: red;'>Pasif</b>"; } ?></td>
                                  <td><?php if ($kombincek['kombin_onecikar']==1) { echo "<b style='color: green;'>Evet</b>";} else { echo "<b style='color: red;'>Hayır</b>"; } ?></td>
                                  <td>
                                    <center>
                                      <a href="kombin-duzenle?kombin_id=<?php echo $kombincek['kombin_id']; ?>"><button class="btn btn-primary btn-xs"><i class="fas fa-edit"></i></button></a>
                                      <a onclick="return confirm('Bu Kombini silmek istediğinize eminmisiniz?')"  href="../netting/islem.php?kombin_id=<?php echo $kombincek['kombin_id']; ?>&eski_yol=<?php echo $kombincek['kombin_foto']; ?>&kombinsil=ok"><button class="btn btn-danger btn-xs"><i class="fas fa-trash-alt"></i></button></a>
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