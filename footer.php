
<!-- Footer -->
<footer style="background-color: #3e4551 !important;" class="page-footer font-small unique-color-dark">

  <div style="background-color: #6351ce;">
    <div class="container">

      <!-- Grid row-->
      <div class="row py-4 d-flex align-items-center">

        <!-- Grid column -->
        <div class="col-md-6 col-lg-5 text-center text-md-left mb-4 mb-md-0">
          <h6 class="mb-0">Bizi Sosyal Medya Üzerinden Takip Etmeyi Unutmayınız!</h6>
        </div>
        <!-- Grid column -->

        <!-- Grid column -->
        <div class="col-md-6 col-lg-7 text-center text-md-right">

          <!-- Facebook -->
          <a href="<?php echo $ayarcek['ayar_facebook']; ?>" class="fb-ic" target="_BLANK">
            <i class="fab fa-facebook-f white-text mr-4"> </i>
          </a>
          <!-- Twitter -->
          <a href="<?php echo $ayarcek['ayar_twitter']; ?>" class="tw-ic" target="_BLANK">
            <i class="fab fa-twitter white-text mr-4"> </i>
          </a>
          <!-- Google +-->
          <a href="<?php echo $ayarcek['ayar_google']; ?>" class="gplus-ic" target="_BLANK">
            <i class="fab fa-google-plus-g white-text mr-4"> </i>
          </a>
          <!--Instagram-->
          <a href="<?php echo $ayarcek['ayar_instagram']; ?>" class="ins-ic" target="_BLANK">
            <i class="fab fa-instagram white-text"> </i>
          </a>

        </div>
        <!-- Grid column -->

      </div>
      <!-- Grid row-->

    </div>
  </div>

  <!-- Footer Links -->
  <div class="container text-center text-md-left mt-5">

    <!-- Grid row -->
    <div class="row mt-3">

      <!-- Grid column -->
      <div class="col-md-3 col-lg-4 col-xl-3 mx-auto mb-4">

        <!-- Content -->
        <h6 class="text-uppercase font-weight-bold">Site Açıklaması</h6>
        <hr class="deep-purple accent-2 mb-4 mt-0 d-inline-block mx-auto" style="width: 60px;">
        <p><?php echo $ayarcek['ayar_description']; ?></p>

      </div>
      <!-- Grid column -->

      <!-- Grid column -->
      <div class="col-md-2 col-lg-2 col-xl-2 mx-auto mb-4">

        <!-- Links -->
        <h6 class="text-uppercase font-weight-bold">Tasarım</h6>
        <hr class="deep-purple accent-2 mb-4 mt-0 d-inline-block mx-auto" style="width: 60px;">
        <p>
          Erdal Fidan
        </p>

      </div>
      <!-- Grid column -->

      <!-- Grid column -->
      <div class="col-md-3 col-lg-2 col-xl-2 mx-auto mb-4">

        <!-- Links -->
        <h6 class="text-uppercase font-weight-bold">Linkler</h6>
        <hr class="deep-purple accent-2 mb-4 mt-0 d-inline-block mx-auto" style="width: 60px;">
        <p>
          <a href="<?php echo $ayarcek['ayar_facebook']; ?>" target="_BLANK">Yardım İçin Tıklayınız</a>
        </p>

      </div>
      <!-- Grid column -->

      <!-- Grid column -->
      <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mb-md-0 mb-4">

        <!-- Links -->
        <h6 class="text-uppercase font-weight-bold">Contact</h6>
        <hr class="deep-purple accent-2 mb-4 mt-0 d-inline-block mx-auto" style="width: 60px;">
        <p>
          <i class="fas fa-home mr-3"></i> <?php echo $ayarcek['ayar_adres']; ?></p>
        <p>
          <i class="fas fa-envelope mr-3"></i> <?php echo $ayarcek['ayar_mail']; ?></p>
        <p>
          <i class="fas fa-phone mr-3"></i> + <?php echo $ayarcek['ayar_tel'] ?></p>

      </div>
      <!-- Grid column -->

    </div>
    <!-- Grid row -->

  </div>
  <!-- Footer Links -->

  <!-- Copyright -->
  <div class="footer-copyright text-center py-3">Copyright © 2020 siteadi.com
  </div>
  <!-- Copyright -->

</footer>
<!-- Footer -->

<!-- jQuery -->
<script type="text/javascript" src="js/jquery.min.js"></script>
<!-- Bootstrap tooltips -->
<script type="text/javascript" src="js/popper.min.js"></script>
<!-- Bootstrap core JavaScript -->
<script type="text/javascript" src="js/bootstrap.min.js"></script>
<!-- MDB core JavaScript -->
<script type="text/javascript" src="js/mdb.min.js"></script>
<!-- Owl Carousel -->
<script src="owl-carousel/owl.carousel.min.js"></script>
<!-- Your custom scripts (optional) -->
<script type="text/javascript"></script>
<script type="text/javascript">
  
$('.owl-carousel').owlCarousel({
    stagePadding: 50,
    loop:true,
    margin:10,
    nav:true,
    responsive:{
        0:{
            items:1
        },
        600:{
            items:3
        },
        1000:{
            items:4
        }
    }
})
</script>
<script type="text/javascript">
  $(function () {
   $("#mdb-lightbox-ui").load("mdb-addons/mdb-lightbox-ui.html");
});
</script>
</body>
</html>