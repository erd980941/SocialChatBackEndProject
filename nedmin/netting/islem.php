<?php 
	error_reporting(0);
	ob_start();
	session_start();
	include 'baglan.php';
	include '../production/fonksiyon.php';

	//GENEL AYARLAR (40)
	//KULLANICI AYARLAR (230)
	//KATEGORİ AYARLARI (305)
	//URUN AYARLARI (480)
	//KOMBİN AYARLARI (620)
?>
<?php 

//Admin Girişi
if (isset($_POST['admingiris'])) {

	$admin_mail=$_POST['admin_mail'];
	$admin_password=md5($_POST['admin_password']);

	$adminsor=$db->prepare("SELECT * FROM admin where admin_mail=:mail and admin_password=:password and admin_yetki=:yetki");
	$adminsor->execute(array(
	'mail' => $admin_mail,
	'password' => $admin_password,
	'yetki' => 5
	));

	$say=$adminsor->rowCount();

	if ($say==1) 

	{	$_SESSION['admin_mail']=$admin_mail;
		header("Location:../production/index");
		exit;
	}
	else
	{
		header("Location:../production/login?durum=no");
		exit;
	}

}


//--------------------------------------------------------------------------------------------------------------------------------------------


//LOGO DUZENLE
if (isset($_POST['logoduzenle'])) 
{
	if ($_FILES['ayar_logo']['size']>1048576) 
	{
		header("Location:../production/genel-ayarlar?durum=dosyabuyuk");
		exit;
	}

	$izinli_uzantilar=array('jpg','png');
	$ext=strtolower(substr($_FILES['ayar_logo']['name'],strpos($_FILES['ayar_logo']['name'], '.')+1));

	if (in_array($ext, $izinli_uzantilar)==false) 
	{
		header("Location:../production/genel-ayarlar?durum=uzantiyanlis");
		exit;
	}

	$uploads_dir="../../img";
	@$tmp_name=$_FILES['ayar_logo']["tmp_name"];
	@$name = $_FILES['ayar_logo']["name"];
	$benzersizsayi4=rand(200000,320000);
	$refimgyol=substr($uploads_dir,6)."/".$benzersizsayi4.$name;
	@move_uploaded_file($tmp_name, "$uploads_dir/$benzersizsayi4$name");

	$duzenle=$db->prepare("UPDATE ayar SET ayar_logo=:logo where ayar_id=0");
	$update=$duzenle->execute(array('logo'=>$refimgyol));

		if ($update) 
		{
			$resimsilunlink=$_POST['eski_yol'];
			unlink("../../$resimsilunlink");

			Header("location:../production/genel-ayarlar?durum=ok");
		}
		else
		{
			Header("location:../production/genel-ayarlar?durum=no");
		}
}


//GENEL AYARLAR
if (isset($_POST['genelayarkaydet'])) 
{
	$ayarkaydet=$db->prepare("UPDATE ayar set 
		ayar_title=:ayar_title,
		ayar_description=:ayar_description,
		ayar_keywords=:ayar_keywords,
		ayar_author=:ayar_author
		where ayar_id=0");

	$update=$ayarkaydet->execute(array( 
		'ayar_title' => $_POST['ayar_title'],
		'ayar_description' => strip_tags($_POST['ayar_description']),
		'ayar_keywords' => strip_tags($_POST['ayar_keywords']),
		'ayar_author' => strip_tags($_POST['ayar_author'])));

	if ($update) 
	{
		header("Location:../production/genel-ayarlar?durum=ok");
	}
	else
	{
		header("Location:../production/genel-ayarlar?durum=no");
	}
}

//İLETİŞİM AYARLARI
if (isset($_POST['iletisimayarkaydet'])) 
{
	$ayarkaydet=$db->prepare("UPDATE ayar set   
		ayar_tel=:ayar_tel,
		ayar_gsm=:ayar_gsm,
		ayar_faks=:ayar_faks,
		ayar_mail=:ayar_mail,
		ayar_ilce=:ayar_ilce,
		ayar_il=:ayar_il,
		ayar_adres=:ayar_adres,
		ayar_mesai=:ayar_mesai
		where ayar_id=0");

	$update=$ayarkaydet->execute(array( 
		'ayar_tel' => strip_tags($_POST['ayar_tel']),
		'ayar_gsm' => strip_tags($_POST['ayar_gsm']),
		'ayar_faks' => strip_tags($_POST['ayar_faks']),
		'ayar_mail' => strip_tags($_POST['ayar_mail']),
		'ayar_ilce' => strip_tags($_POST['ayar_ilce']),
		'ayar_il' => strip_tags($_POST['ayar_il']),
		'ayar_adres' => strip_tags($_POST['ayar_adres']),
		'ayar_mesai' => strip_tags($_POST['ayar_mesai'])));

	if ($update) 
	{
		header("Location:../production/iletisim-ayarlar?durum=ok");
	}
	else
	{
		header("Location:../production/iletisim-ayarlar?durum=no");
	}
}


//API Ayarları
if (isset($_POST['apiayarkaydet'])) 
{
	$ayarkaydet=$db->prepare("UPDATE ayar set  
		ayar_analystic=:ayar_analystic,
		ayar_maps=:ayar_maps,
		ayar_zopim=:ayar_zopim
		where ayar_id=0");

	$update=$ayarkaydet->execute(array( 
		'ayar_analystic' => strip_tags($_POST['ayar_analystic']),
		'ayar_maps' => strip_tags($_POST['ayar_analystic']),
		'ayar_zopim' => strip_tags($_POST['ayar_zopim'])));

	if ($update) 
	{
		header("Location:../production/api-ayarlar?durum=ok");
	}
	else
	{
		header("Location:../production/api-ayarlar?durum=no");
	}
}

//Sosyal Ayar
if (isset($_POST['sosyalayarkaydet'])) 
{
	$ayarkaydet=$db->prepare("UPDATE ayar set   
		ayar_facebook=:ayar_facebook,
		ayar_twitter=:ayar_twitter,
		ayar_google=:ayar_google,
		ayar_youtube=:ayar_youtube,
		ayar_instagram=:ayar_instagram
		where ayar_id=0");

	$update=$ayarkaydet->execute(array( 
		'ayar_facebook' => strip_tags($_POST['ayar_facebook']),
		'ayar_twitter' => strip_tags($_POST['ayar_twitter']),
		'ayar_google' => strip_tags($_POST['ayar_google']),
		'ayar_youtube' => strip_tags($_POST['ayar_youtube']),
		'ayar_instagram' => strip_tags($_POST['ayar_instagram'])));

	if ($update) 
	{
		header("Location:../production/sosyal-ayarlar?durum=ok");
	}
	else
	{
		header("Location:../production/sosyal-ayarlar?durum=no");
	}
}


//Mail AYARLAR
if (isset($_POST['mailayarkaydet'])) 
{
	$ayarkaydet=$db->prepare("UPDATE ayar set   
		ayar_smtphost=:ayar_smtphost,
		ayar_smtpuser=:ayar_smtpuser,
		ayar_smtppassword=:ayar_smtppassword,
		ayar_smtpport=:ayar_smtpport
		where ayar_id=0");

	$update=$ayarkaydet->execute(array( 
		'ayar_smtphost' => strip_tags($_POST['ayar_smtphost']),
		'ayar_smtpuser' => strip_tags($_POST['ayar_smtpuser']),
		'ayar_smtppassword' => strip_tags($_POST['ayar_smtppassword']),
		'ayar_smtpport' => strip_tags($_POST['ayar_smtpport'])));

	if ($update) 
	{
		header("Location:../production/mail-ayarlar?durum=ok");
	}
	else
	{
		header("Location:../production/mail-ayarlar?durum=no");
	}
}




//----------------------------------------------------------------------------------------------------------------------




//KULLANICI DÜZENLE
if (isset($_POST['kullaniciduzenle'])) 
{

	$kullanici_id=$_POST['kullanici_id'];

	$kullanicikaydet=$db->prepare("UPDATE kullanici SET  
		kullanici_tc=:kullanici_tc,
		kullanici_soyad=:kullanici_soyad,
		kullanici_ad=:kullanici_ad,
		kullanici_il=:kullanici_il,
		kullanici_ilce=:kullanici_ilce,
		kullanici_zip=:kullanici_zip,
		kullanici_adres=:kullanici_adres,
		kullanici_tel=:kullanici_tel,
		kullanici_durum=:kullanici_durum
		WHERE kullanici_id={$_POST['kullanici_id']}");

	$update=$kullanicikaydet->execute(array( 
		'kullanici_tc' => strip_tags(trim($_POST['kullanici_tc'])),
		'kullanici_soyad' => strip_tags(ucfirst(trim($_POST['kullanici_soyad']))),
		'kullanici_ad' => strip_tags(ucfirst(trim($_POST['kullanici_ad']))),
		'kullanici_il' => strip_tags(ucfirst(trim($_POST['kullanici_il']))),
		'kullanici_ilce' => strip_tags(ucfirst(trim($_POST['kullanici_ilce']))),
		'kullanici_zip' => strip_tags(trim($_POST['kullanici_zip'])),
		'kullanici_adres' => strip_tags($_POST['kullanici_adres']),
		'kullanici_tel' => strip_tags(trim($_POST['kullanici_tel'])),
		'kullanici_durum' => strip_tags($_POST['kullanici_durum'])));


	if ($update) 
	{

		Header("Location:../production/kullanici-duzenle?kullanici_id=$kullanici_id&durum=ok");

	} 
	else 
	{

		Header("Location:../production/kullanici-duzenle?kullanici_id=$kullanici_id&durum=no");
	}

}


//Kullanıcı Silme
if ($_GET['kullanicisil']=="ok") 
{
	$kullanicisor=$db->prepare("SELECT * FROM kullanici where kullanici_id=:id");
	$kullanicisor->execute(array('id'=>$_GET['kullanici_id']));
	$kullanicicek=$kullanicisor->fetch(PDO::FETCH_ASSOC);

	$sil=$db->prepare("DELETE from kullanici where kullanici_id=:id");

	$kontrol=$sil->execute(array('id' => $_GET['kullanici_id']));


	if ($kontrol) 
	{
		$resimsilunlink=$kullanicicek['kullanici_resim'];
		if ($resimsilunlink!="img/userfoto.jpg") 
		{
			unlink("../../$resimsilunlink");
		}
		Header("Location:../production/kullanici?durum=ok");

	} 
	else 
	{

		Header("Location:../production/kullanici?durum=no");
	}

}


//----------------------------------------------------------------------------------------------------------------------------------

//Kategori Ekle
if (isset($_POST['kategoriekle'])) 
{
	$kategori_seourl=seo(strip_tags($_POST['kategori_ad']));

	if ($_FILES['kategori_foto']['size']==0||empty($_POST['kategori_ad'])||empty($_POST['kategori_sira'])) 
	{
		header("Location:../production/kategori-ekle?durum=bos");
		exit;
	}
	if ($_FILES['kategori_foto']['size']>1048576) 
	{
		header("Location:../production/kategori-ekle?durum=dosyabuyuk");
		exit;
	}

	$izinli_uzantilar=array('jpg','png');
	$ext=strtolower(substr($_FILES['kategori_foto']["name"], strpos($_FILES['kategori_foto']["name"], '.')+1));

	if (in_array($ext,$izinli_uzantilar)==false) 
	{
		header("Location:../production/kategori-ekle?durum=formathata");
		exit;
	}
	
	$uploads_dir='../../img/kategorifoto';

	@$tmp_name=$_FILES['kategori_foto']["tmp_name"];
	@$name = seo($_FILES['kategori_foto']["name"]);

	$benzersizsayi4=uniqid();
	$refimgyol=substr($uploads_dir,6)."/".$benzersizsayi4.".".$ext;

	@move_uploaded_file($tmp_name, "$uploads_dir/$benzersizsayi4.$ext");


	$kaydet=$db->prepare("INSERT INTO kategori SET
		kategori_ad=:ad,
		kategori_foto=:foto,
		kategori_durum=:durum,	
		kategori_seourl=:seourl,
		kategori_sira=:sira");
	$insert=$kaydet->execute(array(
		'ad' => strip_tags(ucfirst($_POST['kategori_ad'])),
		'foto' => $refimgyol,
		'durum' => strip_tags(trim($_POST['kategori_durum'])),
		'seourl' => $kategori_seourl,
		'sira' => strip_tags(trim($_POST['kategori_sira']))));

	if ($insert) {

		Header("Location:../production/kategoriler?durum=ok");

	} else {

		Header("Location:../production/kategoriler?durum=no");
	}

}

//Kategori Düzenle
if (isset($_POST['kategoriduzenle'])) 
{
	

	$kategori_id=strip_tags($_POST['kategori_id']);
	$kategori_seourl=seo(strip_tags($_POST['kategori_ad']));


	$kaydet=$db->prepare("UPDATE kategori SET
		kategori_ad=:ad,
		kategori_durum=:durum,
		kategori_onecikar=:onecikar,	
		kategori_seourl=:seourl,
		kategori_sira=:sira
		WHERE kategori_id={$_POST['kategori_id']}");
	$update=$kaydet->execute(array(
		'ad' => strip_tags(ucfirst($_POST['kategori_ad'])),
		'durum' => strip_tags($_POST['kategori_durum']),
		'onecikar' => strip_tags($_POST['kategori_onecikar']),
		'seourl' => $kategori_seourl,
		'sira' => strip_tags($_POST['kategori_sira'])		
	));

	if ($update) {

		Header("Location:../production/kategori-duzenle?durum=ok&kategori_id=$kategori_id");

	} else {

		Header("Location:../production/kategori-duzenle?durum=no&kategori_id=$kategori_id");
	}

}

//Kategori Foto Düzenle
if (isset($_POST['kategorifotoduzenle'])) 
{
	$kategori_id=$_POST['kategori_id'];
	if ($_FILES['kategori_foto']['size']==0) 
	{
		header("Location:../production/kategori-duzenle?durum=bos&kategori_id=$kategori_id");
		exit;
	}
	if ($_FILES['kategori_foto']['size']>1048576) 
	{
		header("Location:../production/kategori-duzenle?durum=dosyabuyuk&kategori_id=$kategori_id");
		exit;
	}
	
	$izinli_uzantilar=array('jpg','gif','png');
	$ext=strtolower(substr($_FILES['kategori_foto']["name"], strpos($_FILES['kategori_foto']["name"], '.')+1));

	if (in_array($ext,$izinli_uzantilar)==false) 
	{
		header("Location:../production/kategori-duzenle?durum=yanlisuzanti&kategori_id=$kategori_id");
		exit;
	}
	$uploads_dir='../../img/kategorifoto';

	@$tmp_name=$_FILES['kategori_foto']["tmp_name"];
	@$name = seo($_FILES['kategori_foto']["name"]);

	$benzersizsayi4=uniqid();
	$refimgyol=substr($uploads_dir,6)."/".$benzersizsayi4.".".$ext;

	@move_uploaded_file($tmp_name, "$uploads_dir/$benzersizsayi4.$ext");

	$duzenle=$db->prepare("UPDATE kategori SET kategori_foto=:foto where kategori_id={$_POST['kategori_id']}");
	$update=$duzenle->execute(array('foto'=>$refimgyol));

	if ($update) 
	{
		$resimsilunlink=strip_tags($_POST['eski_yol']);
		unlink("../../$resimsilunlink");

		Header("location:../production/kategori-duzenle?kategori_id=$kategori_id&durum=ok");
	}
	else
	{
		Header("location:../production/kategori-duzenle?kategori_id=$kategori_id&durum=no");
	}

}

//Kategori Sil
if ($_GET['kategorisil']=="ok") 
{

	$sil=$db->prepare("DELETE from kategori where kategori_id=:kategori_id");

	$kontrol=$sil->execute(array('kategori_id' => $_GET['kategori_id']));


	if ($kontrol) 
	{
		$resimsilunlink=$_GET['eski_yol'];
		unlink("../../$resimsilunlink");

		header("Location:../production/kategoriler?sil=ok");

	} 
	else 
	{

		header("Location:../production/kategoriler?sil=no");
	}

}

//-----------------------------------------------------------------------------------------------------------------------------------------

//Ürün Ekleme
if (isset($_POST['urunekle'])) 
{

	$urun_seourl=seo(strip_tags($_POST['urun_ad']));


	$kaydet=$db->prepare("INSERT INTO urun SET
		kategori_id=:kategori_id,
		urun_ad=:urun_ad,
		urun_detay=:urun_detay,
		urun_fiyat=:urun_fiyat,
		urun_cinsiyet=:urun_cinsiyet,
		urun_keyword=:urun_keyword,
		urun_durum=:urun_durum,
		urun_onecikar=:urun_onecikar,	
		urun_stokS=:urun_stokS,
		urun_stokM=:urun_stokM,
		urun_stokL=:urun_stokL,
		urun_stokXL=:urun_stokXL,
		urun_stokXXL=:urun_stokXXL,	
		urun_seourl=:urun_seourl");

	$insert=$kaydet->execute(array(
		'kategori_id' => strip_tags($_POST['kategori_id']),
		'urun_ad' => strip_tags(ucfirst($_POST['urun_ad'])),
		'urun_detay' => $_POST['urun_detay'],
		'urun_fiyat' => strip_tags($_POST['urun_fiyat']),
		'urun_cinsiyet' => strip_tags($_POST['urun_cinsiyet']),
		'urun_keyword' => strip_tags($_POST['urun_keyword']),
		'urun_durum' => strip_tags($_POST['urun_durum']),
		'urun_onecikar' => strip_tags($_POST['urun_onecikar']),
		'urun_stokS' => strip_tags($_POST['urun_stokS']),
		'urun_stokM' => strip_tags($_POST['urun_stokM']),
		'urun_stokL' => strip_tags($_POST['urun_stokL']),
		'urun_stokXL' => strip_tags($_POST['urun_stokXL']),
		'urun_stokXXL' => strip_tags($_POST['urun_stokXXL']),
		'urun_seourl' => $urun_seourl));

	if ($insert) {

		Header("Location:../production/urunler?durum=ok");

	} else {

		Header("Location:../production/urunler?durum=no");
	}

}

//Ürün Düzenleme
if (isset($_POST['urunduzenle'])) 
{
	$urun_id=$_POST['urun_id'];
	$urun_seourl=seo($_POST['urun_ad']);


	$kaydet=$db->prepare("UPDATE urun SET
		kategori_id=:kategori_id,
		urun_ad=:urun_ad,
		urun_detay=:urun_detay,
		urun_fiyat=:urun_fiyat,
		urun_cinsiyet=:urun_cinsiyet,
		urun_keyword=:urun_keyword,
		urun_durum=:urun_durum,
		urun_onecikar=:urun_onecikar,		
		urun_stokS=:urun_stokS,
		urun_stokM=:urun_stokM,
		urun_stokL=:urun_stokL,
		urun_stokXL=:urun_stokXL,
		urun_stokXXL=:urun_stokXXL,		
		urun_seourl=:urun_seourl
		where urun_id={$_POST['urun_id']}");
	$update=$kaydet->execute(array(
		'kategori_id' => strip_tags($_POST['kategori_id']),
		'urun_ad' => strip_tags(ucfirst($_POST['urun_ad'])),
		'urun_detay' => $_POST['urun_detay'],
		'urun_fiyat' => strip_tags($_POST['urun_fiyat']),
		'urun_cinsiyet' => strip_tags($_POST['urun_cinsiyet']),
		'urun_keyword' => strip_tags($_POST['urun_keyword']),
		'urun_durum' => strip_tags($_POST['urun_durum']),
		'urun_onecikar' => strip_tags($_POST['urun_onecikar']),
		'urun_stokS' => strip_tags($_POST['urun_stokS']),
		'urun_stokM' => strip_tags($_POST['urun_stokM']),
		'urun_stokL' => strip_tags($_POST['urun_stokL']),
		'urun_stokXL' => strip_tags($_POST['urun_stokXL']),
		'urun_stokXXL' => strip_tags($_POST['urun_stokXXL']),
		'urun_seourl' => $urun_seourl));

	if ($update) {

		Header("Location:../production/urun-duzenle?durum=ok&urun_id=$urun_id");

	} else {

		Header("Location:../production/urun-duzenle?durum=no&urun_id=$urun_id");
	}

}

//urun Sil
if ($_GET['urunsil']=="ok") 
{
	$sil=$db->prepare("DELETE from urun where urun_id=:urun_id");
	$kontrol=$sil->execute(array('urun_id'=>$_GET['urun_id']));

	if ($kontrol) 
	{
		Header("Location:../production/urunler?sil=ok");
	}
	else
	{
		Header("Location:../production/urunler?sil=no");
	}
}

//Ürün Foto Silme
	if (isset($_POST['urunfotosil'])) 
	{
		$urun_id=$_POST['urun_id'];

		$checklist=$_POST['urunfotosec'];

		foreach ($checklist as $list) 
		{
			$urunfotosor=$db->prepare("SELECT * FROM urunfoto where urunfoto_id=:urunfoto_id");
			$urunfotosor->execute(array('urunfoto_id'=>$list));
			while ($urunfotocek=$urunfotosor->fetch(PDO::FETCH_ASSOC)) 
			{
				$resimsilunlink=$urunfotocek['urunfoto_resimyol'];
				unlink("../../$resimsilunlink");
			}

			$sil=$db->prepare("DELETE from urunfoto where urunfoto_id=:urunfoto_id");
			$kontrol=$sil->execute(array('urunfoto_id'=>$list));


		}

		if ($kontrol) 
		{
			Header("Location:../production/urun-galeri?urun_id=$urun_id&durum=ok");
		}
		else
		{
			Header("Location:../production/urun-galeri?urun_id=$urun_id&durum=no");
		}

		
	}






//----------------------------------------------------------------------------------------------------------

//Kombin Ekle
if (isset($_POST['kombinekle'])) 
{
	$kombin_seourl=seo(strip_tags($_POST['kombin_ad']));

	if ($_FILES['kombin_foto']['size']==0||empty($_POST['kombin_ad'])) 
	{
		header("Location:../production/kombin-ekle?durum=bos");
		exit;
	}
	if ($_FILES['kombin_foto']['size']>1048576) 
	{
		header("Location:../production/kombin-ekle?durum=dosyabuyuk");
		exit;
	}

	$izinli_uzantilar=array('jpg','png');
	$ext=strtolower(substr($_FILES['kombin_foto']["name"], strpos($_FILES['kombin_foto']["name"], '.')+1));

	if (in_array($ext,$izinli_uzantilar)==false) 
	{
		header("Location:../production/kombin-ekle?durum=formathata");
		exit;
	}
	
	$uploads_dir='../../img/kombinfoto';

	@$tmp_name=$_FILES['kombin_foto']["tmp_name"];
	@$name = seo($_FILES['kombin_foto']["name"]);

	$benzersizsayi4=uniqid();
	$refimgyol=substr($uploads_dir,6)."/".$benzersizsayi4.".".$ext;

	@move_uploaded_file($tmp_name, "$uploads_dir/$benzersizsayi4.$ext");


	$kaydet=$db->prepare("INSERT INTO kombin SET
		kombin_ad=:ad,
		kombin_foto=:foto,
		kombin_durum=:durum,
		kombin_onecikar=:kombin_onecikar,
		kombin_detay=:kombin_detay,
		urun_idbir=:urun_idbir,
		urun_idiki=:urun_idiki,
		urun_iduc=:urun_iduc,
		urun_iddort=:urun_iddort,	
		kombin_seourl=:seourl,
		kombin_cinsiyet=:cinsiyet");
	$insert=$kaydet->execute(array(
		'ad' => strip_tags(ucfirst($_POST['kombin_ad'])),
		'foto' => $refimgyol,
		'durum' => strip_tags(trim($_POST['kombin_durum'])),
		'kombin_onecikar' => strip_tags(trim($_POST['kombin_onecikar'])),
		'kombin_detay' => $_POST['kombin_detay'],
		'urun_idbir' => strip_tags(trim($_POST['urun_idbir'])),
		'urun_idiki' => strip_tags(trim($_POST['urun_idiki'])),
		'urun_iduc' => strip_tags(trim($_POST['urun_iduc'])),
		'urun_iddort' => strip_tags(trim($_POST['urun_iddort'])),
		'seourl' => $kombin_seourl,
		'cinsiyet' => strip_tags(trim($_POST['kombin_cinsiyet']))));

	if ($insert) {

		Header("Location:../production/kombinler?durum=ok");

	} else {

		Header("Location:../production/kombinler?durum=no");
	}

}

//kombin Foto Düzenle
if (isset($_POST['kombinfotoduzenle'])) 
{
	$kombin_id=$_POST['kombin_id'];
	if ($_FILES['kombin_foto']['size']==0) 
	{
		header("Location:../production/kombin-duzenle?durum=bos&kombin_id=$kombin_id");
		exit;
	}
	if ($_FILES['kombin_foto']['size']>1048576) 
	{
		header("Location:../production/kombin-duzenle?durum=dosyabuyuk&kombin_id=$kombin_id");
		exit;
	}
	
	$izinli_uzantilar=array('jpg','gif','png');
	$ext=strtolower(substr($_FILES['kombin_foto']["name"], strpos($_FILES['kombin_foto']["name"], '.')+1));

	if (in_array($ext,$izinli_uzantilar)==false) 
	{
		header("Location:../production/kombin-duzenle?durum=yanlisuzanti&kombin_id=$kombin_id");
		exit;
	}
	$uploads_dir='../../img/kombinfoto';

	@$tmp_name=$_FILES['kombin_foto']["tmp_name"];
	@$name = seo($_FILES['kombin_foto']["name"]);

	$benzersizsayi4=uniqid();
	$refimgyol=substr($uploads_dir,6)."/".$benzersizsayi4.".".$ext;

	@move_uploaded_file($tmp_name, "$uploads_dir/$benzersizsayi4.$ext");

	$duzenle=$db->prepare("UPDATE kombin SET kombin_foto=:foto where kombin_id={$_POST['kombin_id']}");
	$update=$duzenle->execute(array('foto'=>$refimgyol));

	if ($update) 
	{
		$resimsilunlink=strip_tags($_POST['eski_yol']);
		unlink("../../$resimsilunlink");

		Header("location:../production/kombin-duzenle?kombin_id=$kombin_id&durum=ok");
	}
	else
	{
		Header("location:../production/kombin-duzenle?kombin_id=$kombin_id&durum=no");
	}

}

//kombin Düzenle
if (isset($_POST['kombinduzenle'])) 
{
	

	$kombin_id=strip_tags($_POST['kombin_id']);
	$kombin_seourl=seo(strip_tags($_POST['kombin_ad']));


	$kaydet=$db->prepare("UPDATE kombin SET
		kombin_ad=:ad,
		kombin_durum=:durum,
		kombin_onecikar=:kombin_onecikar,
		kombin_detay=:kombin_detay,
		urun_idbir=:urun_idbir,
		urun_idiki=:urun_idiki,
		urun_iduc=:urun_iduc,
		urun_iddort=:urun_iddort,	
		kombin_seourl=:seourl,
		kombin_cinsiyet=:cinsiyet
		WHERE kombin_id={$_POST['kombin_id']}");
	$update=$kaydet->execute(array(
		'ad' => strip_tags(ucfirst($_POST['kombin_ad'])),
		'durum' => strip_tags(trim($_POST['kombin_durum'])),
		'kombin_onecikar' => strip_tags(trim($_POST['kombin_onecikar'])),
		'kombin_detay' => $_POST['kombin_detay'],
		'urun_idbir' => strip_tags(trim($_POST['urun_idbir'])),
		'urun_idiki' => strip_tags(trim($_POST['urun_idiki'])),
		'urun_iduc' => strip_tags(trim($_POST['urun_iduc'])),
		'urun_iddort' => strip_tags(trim($_POST['urun_iddort'])),
		'seourl' => $kombin_seourl,
		'cinsiyet' => strip_tags(trim($_POST['kombin_cinsiyet']))	
	));

	if ($update) {

		Header("Location:../production/kombin-duzenle?durum=ok&kombin_id=$kombin_id");

	} else {

		Header("Location:../production/kombin-duzenle?durum=no&kombin_id=$kombin_id");
	}

}

//kombin Sil
if ($_GET['kombinsil']=="ok") 
{

	$sil=$db->prepare("DELETE from kombin where kombin_id=:kombin_id");

	$kontrol=$sil->execute(array('kombin_id' => $_GET['kombin_id']));


	if ($kontrol) 
	{
		$resimsilunlink=$_GET['eski_yol'];
		unlink("../../$resimsilunlink");

		header("Location:../production/kombinler?sil=ok");

	} 
	else 
	{

		header("Location:../production/kombinler?sil=no");
	}

}

//-----------------------------------------------------------------------------------------------------------------

if ($_GET['siparisteslim']=="ok") 
{
	$kaydet=$db->prepare("UPDATE siparis SET
		siparis_odeme=:siparis_odeme
		WHERE siparis_id={$_GET['siparis_id']}");

	$update=$kaydet->execute(array(
		'siparis_odeme' => 1
	));

	if ($update) {

		Header("Location:../production/siparisler?durum=ok");

	} else {

		Header("Location:../production/siparisler?durum=no");
	}
}
if ($_GET['siparisteslim']=="no") 
{
		$kaydet=$db->prepare("UPDATE siparis SET
		siparis_odeme=:siparis_odeme
		WHERE siparis_id={$_GET['siparis_id']}");

	$update=$kaydet->execute(array(
		'siparis_odeme' => 0
	));

	if ($update) {

		Header("Location:../production/siparisler?durum=ok");

	} else {

		Header("Location:../production/siparisler?durum=no");
	}
}

?>