<?php include 'header.php'; ?>

        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">

            <div class="clearfix"></div>
            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>API Ayarları <small>

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
                    <br />

                    <!-- / => en kök dizine çık ../ => bir üst dizine çık -->
                    <form action="../netting/islem.php" method="POST" id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Analystic Kodu <span class="required">*</span></label>

                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="first-name" name="ayar_analystic" required="required" class="form-control col-md-7 col-xs-12" value="<?php echo $ayarcek['ayar_analystic']; ?>">
                        </div>
                      </div>

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">MAPS Api <span class="required">*</span></label>

                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="first-name" name="ayar_maps" required="required" class="form-control col-md-7 col-xs-12" value="<?php echo $ayarcek['ayar_maps']; ?>">
                        </div>
                      </div>

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Zopim Api <span class="required">*</span></label>

                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="first-name" name="ayar_zopim" required="required" class="form-control col-md-7 col-xs-12" value="<?php echo $ayarcek['ayar_zopim']; ?>">
                        </div>
                      </div>

                      <div class="ln_solid"></div>
                      <div class="form-group">
                        <div align="right" class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                          <button type="submit" class="btn btn-success" name="apiayarkaydet">Güncelle</button>
                        </div>
                      </div>

                    </form>


                  </div>
                </div>
              </div>
            </div>
                     
          </div>
        </div>
        <!-- /page content -->

    <?php include 'footer.php'; ?>