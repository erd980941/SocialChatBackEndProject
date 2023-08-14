<?php  
  ob_start();
  session_start();
  error_reporting(0);
  include 'nedmin/netting/baglan.php';
  include 'nedmin/production/fonksiyon.php';
?>
<?php  
  $ayarsor=$db->prepare("SELECT * FROM ayar where ayar_id=:id");
  $ayarsor -> execute(array(
    'id' => 0
  ));
  $ayarcek=$ayarsor->fetch(PDO::FETCH_ASSOC);

  // KULLANICI SORGU
  if (isset($_SESSION['userkullanici_mail'])) 
  {
    $kullanicisor=$db->prepare("SELECT * FROM kullanici where kullanici_mail=:mail");
    $kullanicisor->execute(array('mail'=>$_SESSION['userkullanici_mail']));
    $say=$kullanicisor->rowCount();
    $kullanicicek=$kullanicisor->fetch(PDO::FETCH_ASSOC);

    if (!isset($_SESSION['userkullanici_id'])) 
    {
      $_SESSION['userkullanici_id']=$kullanicicek['kullanici_id'];
    }

  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="description" content="<?php echo $ayarcek['ayar_description']; ?>">
    <meta name="keywords" content="<?php echo $ayarcek['ayar_keywords']; ?>">
    <meta name="author" content="<?php echo $ayarcek['ayar_author']; ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <title><?php if (empty($title)) { echo $ayarcek['ayar_title']; } ?></title>
  <!-- MDB icon -->
  <link rel="icon" href="img/mdb-favicon.ico" type="image/x-icon">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.11.2/css/all.css">
  <!-- Google Fonts Roboto -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap">
  <!-- Bootstrap core CSS -->
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <!-- Material Design Bootstrap -->
  <link rel="stylesheet" href="css/mdb.min.css">

  <!-- Owl Carousel -->
  <link rel="stylesheet" href="owl-carousel/assets/owl.carousel.min.css">
  <link rel="stylesheet" href="owl-carousel/assets/owl.theme.default.min.css">

  <!-- Google Font -->
  <link href="https://fonts.googleapis.com/css2?family=Bungee+Inline&family=Monoton&family=Montserrat:wght@300&family=Open+Sans+Condensed:wght@300&family=Permanent+Marker&family=Poppins:wght@700&display=swap" rel="stylesheet">
  <!-- Your custom styles (optional) -->
  <link rel="stylesheet" href="css/style.css">
</head>
<body>

<div class="alert alert-warning alert-dismissible fade show headertop" role="alert">
  <a target="_blank" href="<?php echo $ayarcek['ayar_instagram']; ?>">Sosyal Medya Hesaplarımızı Takip Etmeyi Unutmayın.</a>
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>

<div class="container">
  <div class="row">
    <div class="col-xl-4">
        <a href="index"><img style="width: 300px;" src="<?php echo $ayarcek['ayar_logo']; ?>"></a>
    </div>
    <div class="col-xl-8">
      <div class="reklam">
        <h2><b><strong>SPONSORLUK</strong></b></h2>
      </div>
    </div>
  </div>
</div>
<!--Navbar -->
<!--Navbar -->
<nav class="mb-1 navbar navbar-expand-lg navbar-dark default-color">
  <div class="container">
  <a class="navbar-brand" href="index"><b>ADMİN</b> | <span style="font-size: 12px;">butik</span></a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent-333"
    aria-controls="navbarSupportedContent-333" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarSupportedContent-333">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item">
        <a class="nav-link" href="erkekkategori">Erkek
          <span class="sr-only">(current)</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="kadinkategori">Kadın
          <span class="sr-only">(current)</span>
        </a>
      </li> 
      <li class="nav-item">
        <a class="nav-link" href="kombinler">Kombinler
          <span class="sr-only">(current)</span>
        </a>
      </li>   
    </ul>
    <?php  
      if (isset($_SESSION['userkullanici_mail']))
      {
        ?>
          <ul class="navbar-nav ml-auto nav-flex-icons">
            <li class="nav-item">
              <a href="sepet" class="nav-link waves-effect waves-light">
               <i style="font-size: 20px;" class="fas fa-shopping-cart"></i>
               <?php  
                 $sepetsor=$db->prepare("SELECT * FROM sepet where kullanici_id=:kullanici_id");
                 $sepetsor->execute(array('kullanici_id'=>$_SESSION['userkullanici_id']));
                 $sadet=$sepetsor->rowCount();
               ?>
               <b class="sepetsayi">
                 <?php echo $sadet; ?>
               </b>
              </a>
            </li>
            <!-- Dropdown -->
            <li class="nav-item dropdown">
              <a class="nav-link" href="hesabim"><i style="font-size: 20px;" class="far fa-user"></i> <b>Profil</b></a>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link" href="logout"><i style="font-size: 20px;" class="fas fa-sign-out-alt"></i> <b>Güvenli Çıkış</b></a>
            </li>
            <?php include 'login.php' ?>
          </ul>
        <?php
      }
      else
      {
        ?>
          <ul class="navbar-nav ml-auto nav-flex-icons">
            <!-- Dropdown -->
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink" data-toggle="dropdown"
                aria-haspopup="true" aria-expanded="false"><i style="font-size: 20px;" class="far fa-user"></i></a>
              <div class="dropdown-menu dropdown-primary dropdownmenu" aria-labelledby="navbarDropdownMenuLink">
                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#modalLoginForm"><b>GİRİŞ YAP</b></a>
                <a class="dropdown-item" href="register"><b>KAYIT OL</b></a>
              </div>
            </li>
             <?php include 'login.php' ?>
          </ul>
        <?php
      }
    ?>
  </div>
  </div>
</nav>
<!--/.Navbar -->


