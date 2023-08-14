<?php 
error_reporting(0);
ob_start();
session_start();
include '../netting/baglan.php';
include 'fonksiyon.php';
?>

<?php  
  $adminsor=$db->prepare("SELECT * FROM admin where admin_mail=:mail");
  $adminsor->execute(array('mail'=> $_SESSION['admin_mail'] ));
  $admincek=$adminsor->fetch(PDO::FETCH_ASSOC);
  $say=$adminsor->rowCount();

  if ($say==0) 
  {
    Header("Location:login?durum=izinsiz");
    exit;
  }
?>

<?php  
  $ayarsor=$db->prepare("SELECT * FROM ayar where ayar_id=:id");
  $ayarsor->execute(array('id'=>0));
  $ayarcek=$ayarsor->fetch(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <!-- Meta, title, CSS, favicons, etc. -->
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>Admin Panel | </title>

  <!-- Bootstrap -->
  <link href="../vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Font Awesome -->
  <link href="../vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
  <!-- NProgress -->
  <link href="../vendors/nprogress/nprogress.css" rel="stylesheet">
  <!-- iCheck -->
  <link href="../vendors/iCheck/skins/flat/green.css" rel="stylesheet">
  <!-- bootstrap-progressbar -->
  <link href="../vendors/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet">
  <!-- JQVMap -->
  <link href="../vendors/jqvmap/dist/jqvmap.min.css" rel="stylesheet"/>
  <!-- bootstrap-daterangepicker -->
  <link href="../vendors/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">

  <!-- Ck Editör -->
  <script src="https://cdn.ckeditor.com/4.7.1/standard/ckeditor.js"></script>

  <!-- Select2 -->
    <link href="../vendors/select2/dist/css/select2.min.css" rel="stylesheet">

  <!-- Dropzone.js -->
  <link href="../vendors/dropzone/dist/min/dropzone.min.css" rel="stylesheet">

  <!-- Dropzone.js -->
  <script src="../vendors/dropzone/dist/min/dropzone.min.js"></script>

  <!-- Custom Theme Style -->
  <link href="../build/css/custom.min.css" rel="stylesheet">

  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.11.2/css/all.css">

  <!-- Datatables -->
    <link href="../vendors/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">
    <link href="../vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css" rel="stylesheet">
    <link href="../vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css" rel="stylesheet">
    <link href="../vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css" rel="stylesheet">
    <link href="../vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css" rel="stylesheet">

    

  <style type="text/css">
    .ilkharf
    {
      text-transform: capitalize;
    }
  </style>
</head>

<body class="nav-md">
  <div class="container body">
    <div class="main_container">
      <div class="col-md-3 left_col">
        <div class="left_col scroll-view">
          <div class="navbar nav_title" style="border: 0;">
            <a href="index" class="site_title"><i class="fa fa-paw"></i> <span>Kıyafet</span></a>
          </div>

          <div class="clearfix"></div>

          <!-- menu profile quick info -->
          <div class="profile clearfix">
            <div class="profile_pic">
              <img src="images/img.jpg" alt="..." class="img-circle profile_img">
            </div>
            <div class="profile_info">
              <span>Hoşgeldin,</span>
              <h2><?php echo $admincek['admin_ad']." ".$admincek['admin_soyad']; ?></h2>
            </div>
          </div>
          <!-- /menu profile quick info -->

          <br />

          <!-- sidebar menu -->
          <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
            <div class="menu_section active">
              <h3>General</h3>
            <ul class="nav side-menu" style="">

                <li class="current-page"><a href="index"><i class="fa fa-home"></i> Anasayfa </a></li>

                <li><a><i class="fa fa-cogs"></i> Site Ayarları <span class="fa fa-cogs"></span></a>
                  <ul class="nav child_menu">
                    <li><a href="genel-ayarlar">Genel Ayarlar</a></li>
                    <li><a href="iletisim-ayarlar">İletişim Ayarlar</a></li>
                    <li><a href="api-ayarlar">Api Ayarlar</a></li>
                    <li><a href="sosyal-ayarlar">Sosyal Ayarlar</a></li>
                    <li><a href="mail-ayarlar">Mail Ayarlar</a></li>
               </ul>
             </li>

             <!--<li><a href="hakkimizda"><i class="fa fa-info"></i> Hakkımızda </a></li>-->

             <li><a href="kullanici"><i class="fa fa-user"></i> Kullanıcılar </a></li>

             <li><a href="urunler"><i class="fa fa-shopping-basket"></i> Ürünler </a></li>

             <li><a href="kategoriler"><i class="fa fa-list"></i> Kategoriler </a></li>

             <li><a href="kombinler"><i style="font-size: 20px;" class="fas fa-tshirt"></i> Kombinler </a>

             <li><a href="siparisler"><i style="font-size: 20px;" class="fas fa-box-open"></i> Siparişler </a>

             <!--<li><a href="slider"><i class="fa fa-image"></i> Slider </a></li>-->

             <!--<li><a href="yorum"><i class="fa fa-comments"></i> Yorumlar </a></li>-->
             
             <!--<li><a href="banka"><i class="fa fa-bank"></i> Bankalar </a></li>-->           

           </ul>
         </div>
       </div>
       <!-- /sidebar menu -->

    </div>
  </div>

  <!-- top navigation -->
  <div class="top_nav">
    <div class="nav_menu">
      <nav>
        <div class="nav toggle">
          <a id="menu_toggle"><i class="fa fa-bars"></i></a>
        </div>
        <ul class="nav navbar-nav navbar-right">
          <li class="">
            <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
              <img src="images/img.jpg" alt=""><?php echo $admincek['admin_ad']." ".$admincek['admin_soyad']; ?>
              <span class=" fa fa-angle-down"></span>
            </a>
            <ul class="dropdown-menu dropdown-usermenu pull-right">
              <li><a href="profil"> Profil</a></li>
              <li><a href="logout"><i class="fa fa-sign-out pull-right"></i> Güvenli Çıkış</a></li>
            </ul>
          </li>

          
        </ul>
      </nav>
    </div>
  </div>
        <!-- /top navigation -->