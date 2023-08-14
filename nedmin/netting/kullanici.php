<?php 
error_reporting(0);
ob_start();
session_start();
include 'baglan.php';
include '../production/fonksiyon.php';
?>
<?php 

//KAYIT OL
if (isset($_POST['kullaniciekle']))
{
	$kullanici_ad=strip_tags(trim(ucfirst($_POST['kullanici_ad'])));
	$kullanici_soyad=strip_tags(trim(ucfirst($_POST['kullanici_soyad'])));
	$kullanici_mail=strip_tags(trim($_POST['kullanici_mail']));
	$kullanici_tel=strip_tags(trim($_POST['kullanici_tel']));
	$kullanici_passwordone=strip_tags(trim($_POST['kullanici_passwordone']));
	$kullanici_passwordtwo=strip_tags(trim($_POST['kullanici_passwordtwo']));


	if (empty($kullanici_ad)||empty($kullanici_soyad)||empty($kullanici_mail)||empty($kullanici_tel)||empty($kullanici_passwordone)||empty($kullanici_passwordtwo)) 
	{
		header("Location:../../register?durum=bos");
		exit;
	}
	if ($kullanici_passwordone!=$kullanici_passwordtwo) 
	{
		header("Location:../../register?durum=sifreuyusmuyor");
		exit;
	}
	if (strlen($kullanici_passwordone)<6) 
	{
		header("Location:../../register?durum=eksiksifre");
		exit;
	}

	$kullanicisor=$db->prepare("SELECT * from kullanici where kullanici_mail=:mail");
	$kullanicisor->execute(array('mail'=>$kullanici_mail));
	$say=$kullanicisor->rowCount();

	if ($say!=0) 
	{
		header("Location:../../register?durum=kayitvar");
		exit;
	}

	$password=md5($kullanici_passwordone);
	$kullanicikaydet=$db->prepare("INSERT INTO kullanici SET 
		kullanici_ad=:kullanici_ad,
		kullanici_soyad=:kullanici_soyad,
		kullanici_mail=:kullanici_mail,
		kullanici_tel=:kullanici_tel,
		kullanici_password=:kullanici_password");

	$insert=$kullanicikaydet->execute(array(
		'kullanici_ad'=>$kullanici_ad,
		'kullanici_soyad'=>$kullanici_soyad,
		'kullanici_mail'=>$kullanici_mail,
		'kullanici_tel'=>$kullanici_tel,
		'kullanici_password'=>$password));

	if ($insert) 
	{
		Header("Location:../../register?durum=ok");
	}
	else
	{
		Header("Location:../../register?durum=no");
	}
}


//Kullanici Girişi
if (isset($_POST['kullanicigiris'])) 
{

	$kullanici_mail=strip_tags($_POST['kullanici_mail']);
	$kullanici_password=md5(strip_tags($_POST['kullanici_password']));

	$kullanicisor=$db->prepare("SELECT * FROM kullanici where kullanici_mail=:mail and kullanici_password=:password and kullanici_durum=:durum");
	$kullanicisor->execute(array(
		'mail' => $kullanici_mail,
		'password' => $kullanici_password,
		'durum' => 1
	));

	$say=$kullanicisor->rowCount();

	if ($say==1) 
	{
		$_SESSION['userkullanici_mail']=$kullanici_mail;
		header("Location:../../index?durum=basariligiris");
		exit;
	}
	else
	{
		header("Location:../../index?durum=basarisizgiris");
		exit;
	}

}



//KULLANICI BİLGİ GÜNCELLE
if (isset($_POST['kullanicibilgiduzenle'])) 
{
	$kullaniciguncelle=$db->prepare("UPDATE kullanici SET 
		kullanici_ad=:kullanici_ad,
		kullanici_soyad=:kullanici_soyad,
		kullanici_tc=:kullanici_tc,
		kullanici_tel=:kullanici_tel
		WHERE kullanici_id={$_SESSION['userkullanici_id']}");

	$update=$kullaniciguncelle->execute(array(
		'kullanici_ad' => strip_tags(ucfirst($_POST['kullanici_ad'])),
		'kullanici_soyad' => strip_tags(ucfirst($_POST['kullanici_soyad'])),
		'kullanici_tc' => strip_tags($_POST['kullanici_tc']),
		'kullanici_tel' => strip_tags($_POST['kullanici_tel'])));

	if ($update) 
	{
		Header("Location:../../hesap-ayar-guncelle?durum=ok");
	}
	else
	{
		Header("Location:../../hesap-ayar-guncelle?durum=no");
	}
}

//KULLANICI FOTO DÜZENLE
if (isset($_POST['kullanicifotoguncelle'])) 
{
	if ($_FILES['kullanici_resim']['size']==0) 
	{
		header("Location:../../profil-resim-guncelle?durum=bos");
		exit;
	}

	if ($_FILES['kullanici_resim']['size']>1048576) 
	{
		header("Location:../../profil-resim-guncelle?durum=dosyabuyuk");
		exit;
	}

	$izinli_uzantilar=array('jpg','png');
	$ext=strtolower(substr($_FILES['kullanici_resim']['name'],strpos($_FILES['kullanici_resim']['name'], '.')+1));

	if (in_array($ext, $izinli_uzantilar)==false) 
	{
		header("Location:../../profil-resim-guncelle?durum=yanlisuzanti");
		exit;
	}

	$uploads_dir='../../img/kullanicifoto';
	@$tmp_name=$_FILES['kullanici_resim']["tmp_name"];
	@$name = seo($_FILES['kullanici_resim']["name"]);

	//IMAGE RESIZE İŞLEMLERİ
	//include('SimpleImage.php');
	//$image = new SimpleImage();
	//$image->load($tmp_name);
	//$image->resize(252,484);
	//$image->save($tmp_name);


	$benzersizsayi4=uniqid();
	$refimgyol=substr($uploads_dir,6)."/".$benzersizsayi4.".".$ext;
	@move_uploaded_file($tmp_name, "$uploads_dir/$benzersizsayi4.$ext");

	$duzenle=$db->prepare("UPDATE kullanici SET kullanici_resim=:kullanici_resim WHERE kullanici_id={$_SESSION['userkullanici_id']}");
	$update=$duzenle->execute(array('kullanici_resim'=>$refimgyol));

	if ($update) 
	{
		$resimsilunlink=$_POST['eski_yol'];
		if ($resimsilunlink!="img/userfoto.jpg") 
		{
			unlink("../../$resimsilunlink");
		}				

		Header("location:../../profil-resim-guncelle?durum=ok");
	}
	else
	{
		Header("location:../../profil-resim-guncelle?durum=no");
	}
}



//MÜŞTERİ ŞİFRE GÜNCELLE
if (isset($_POST['kullanicisifreguncelle'])) 
{

	$kullanici_password=strip_tags($_POST['kullanici_eskipassword']);
	$kullanici_passwordone=strip_tags(trim($_POST['kullanici_passwordone']));
	$kullanici_passwordtwo=strip_tags(trim($_POST['kullanici_passwordtwo']));

	if (empty($kullanici_passwordone)||empty($kullanici_passwordtwo)) 
	{
		Header("Location:../../sifre-guncelle?durum=bos");
		exit;
	}
	if ($kullanici_passwordone!=$kullanici_passwordtwo) 
	{
		Header("Location:../../sifre-guncelle?durum=farklisifre");
		exit;
	}
	if (strlen($kullanici_passwordone)<6) 
	{
		Header("Location:../../sifre-guncelle?durum=eksiksifre");
		exit;
	}

	$kullanici_eskipassword=md5($kullanici_password);

	$kullanicisor=$db->prepare("SELECT * FROM kullanici where kullanici_id=:kullanici_id");
	$kullanicisor->execute(array(
		'kullanici_id'=>$_SESSION['userkullanici_id']));
	$say=$kullanicisor->rowCount();
	$kullanicicek=$kullanicisor->fetch(PDO::FETCH_ASSOC);

	if ($kullanicicek['kullanici_password']!=$kullanici_eskipassword) 
	{
		Header("Location:../../sifre-guncelle?durum=eskisifrehata");
		exit;
	}
	$kullanici_yenipassword=md5($kullanici_passwordone);
	if ($kullanici_yenipassword==$kullanicicek['kullanici_password']) 
	{
		Header("Location:../../sifre-guncelle?durum=aynieskisifre");
		exit;
	}

	$kullaniciguncelle=$db->prepare("UPDATE kullanici SET kullanici_password=:kullanici_password WHERE kullanici_id={$_SESSION['userkullanici_id']}");
	$update=$kullaniciguncelle->execute(array('kullanici_password' => $kullanici_yenipassword));

	if ($update) 
	{
		Header("Location:../../sifre-guncelle?durum=ok");
	}
	else
	{
		Header("Location:../../sifre-guncelle?durum=no");
	}


}

	//MÜŞTERİ ADRES GÜNCELLE
if (isset($_POST['kullaniciadresguncelle'])) 
{

	$kullaniciguncelle=$db->prepare("UPDATE kullanici SET 
		kullanici_il=:kullanici_il,
		kullanici_ilce=:kullanici_ilce,
		kullanici_zip=:kullanici_zip,
		kullanici_adres=:kullanici_adres
		WHERE kullanici_id={$_SESSION['userkullanici_id']}");

	$update=$kullaniciguncelle->execute(array(
		'kullanici_il' => htmlspecialchars(ucfirst($_POST['kullanici_il'])),
		'kullanici_ilce' => htmlspecialchars(ucfirst($_POST['kullanici_ilce'])),
		'kullanici_zip' => htmlspecialchars($_POST['kullanici_zip']),
		'kullanici_adres' => htmlspecialchars($_POST['kullanici_adres'])));

	if ($update) 
	{
		Header("Location:../../adres-guncelle?durum=ok");
	}
	else
	{
		Header("Location:../../adres-guncelle?durum=no");
	}
}

//-----------------------------------------------------------------------------------------------------------------------------------------

//Ürün Sepete Ekleme
if (isset($_POST['sepeteekle'])) 
{
	$urunsor=$db->prepare("SELECT * FROM urun where urun_id=:urun_id");
	$urunsor->execute(array('urun_id'=>$_POST['urun_id']));
	$uruncek=$urunsor->fetch(PDO::FETCH_ASSOC);
	if ($_POST['urun_beden']=="S") 
	{
		$urunseo=$uruncek['urun_seourl'];
		$urunid=$uruncek['urun_id'];

		if ($_POST['urun_adet']>$uruncek['urun_stokS']) 
		{
			Header("Location:../../urun-$urunseo-$urunid?durum=stokyok");
			exit;
		}

		$kaydet=$db->prepare("INSERT INTO sepet SET
			kullanici_id=:kullanici_id,	
			urun_id=:urun_id,	
			urun_adet=:urun_adet,
			urun_beden=:urun_beden");

		$insert=$kaydet->execute(array(
			'kullanici_id' =>  $_SESSION['userkullanici_id'],
			'urun_id' => $uruncek['urun_id'],
			'urun_adet' => $_POST['urun_adet'],
			'urun_beden' => $_POST['urun_beden']));

		

		if ($insert) 
		{

			Header("Location:../../urun-$urunseo-$urunid?durum=ok");

		} else {

			Header("Location:../../urun-$urunseo-$urunid?durum=no");
		}
	}

	if ($_POST['urun_beden']=="M") 
	{
		$urunseo=$uruncek['urun_seourl'];
		$urunid=$uruncek['urun_id'];

		if ($_POST['urun_adet']>$uruncek['urun_stokM']) 
		{
			Header("Location:../../urun-$urunseo-$urunid?durum=stokyok");
			exit;
		}

		$kaydet=$db->prepare("INSERT INTO sepet SET
			kullanici_id=:kullanici_id,	
			urun_id=:urun_id,	
			urun_adet=:urun_adet,
			urun_beden=:urun_beden");

		$insert=$kaydet->execute(array(
			'kullanici_id' =>  $_SESSION['userkullanici_id'],
			'urun_id' => $uruncek['urun_id'],
			'urun_adet' => $_POST['urun_adet'],
			'urun_beden' => $_POST['urun_beden']));

		

		if ($insert) 
		{

			Header("Location:../../urun-$urunseo-$urunid?durum=ok");

		} else {

			Header("Location:../../urun-$urunseo-$urunid?durum=no");
		}
	}

	if ($_POST['urun_beden']=="L") 
	{
		$urunseo=$uruncek['urun_seourl'];
		$urunid=$uruncek['urun_id'];

		if ($_POST['urun_adet']>$uruncek['urun_stokL']) 
		{
			Header("Location:../../urun-$urunseo-$urunid?durum=stokyok");
			exit;
		}

		$kaydet=$db->prepare("INSERT INTO sepet SET
			kullanici_id=:kullanici_id,	
			urun_id=:urun_id,	
			urun_adet=:urun_adet,
			urun_beden=:urun_beden");

		$insert=$kaydet->execute(array(
			'kullanici_id' =>  $_SESSION['userkullanici_id'],
			'urun_id' => $uruncek['urun_id'],
			'urun_adet' => $_POST['urun_adet'],
			'urun_beden' => $_POST['urun_beden']));

		

		if ($insert) 
		{

			Header("Location:../../urun-$urunseo-$urunid?durum=ok");

		} else {

			Header("Location:../../urun-$urunseo-$urunid?durum=no");
		}
	}

	if ($_POST['urun_beden']=="XL") 
	{
		$urunseo=$uruncek['urun_seourl'];
		$urunid=$uruncek['urun_id'];

		if ($_POST['urun_adet']>$uruncek['urun_stokXL']) 
		{
			Header("Location:../../urun-$urunseo-$urunid?durum=stokyok");
			exit;
		}

		$kaydet=$db->prepare("INSERT INTO sepet SET
			kullanici_id=:kullanici_id,	
			urun_id=:urun_id,	
			urun_adet=:urun_adet,
			urun_beden=:urun_beden");

		$insert=$kaydet->execute(array(
			'kullanici_id' =>  $_SESSION['userkullanici_id'],
			'urun_id' => $uruncek['urun_id'],
			'urun_adet' => $_POST['urun_adet'],
			'urun_beden' => $_POST['urun_beden']));

		

		if ($insert) 
		{

			Header("Location:../../urun-$urunseo-$urunid?durum=ok");

		} else {

			Header("Location:../../urun-$urunseo-$urunid?durum=no");
		}
	}

	if ($_POST['urun_beden']=="XXL") 
	{
		$urunseo=$uruncek['urun_seourl'];
		$urunid=$uruncek['urun_id'];

		if ($_POST['urun_adet']>$uruncek['urun_stokXXL']) 
		{
			Header("Location:../../urun-$urunseo-$urunid?durum=stokyok");
			exit;
		}

		$kaydet=$db->prepare("INSERT INTO sepet SET
			kullanici_id=:kullanici_id,	
			urun_id=:urun_id,	
			urun_adet=:urun_adet,
			urun_beden=:urun_beden");

		$insert=$kaydet->execute(array(
			'kullanici_id' =>  $_SESSION['userkullanici_id'],
			'urun_id' => $uruncek['urun_id'],
			'urun_adet' => $_POST['urun_adet'],
			'urun_beden' => $_POST['urun_beden']));

		

		if ($insert) 
		{

			Header("Location:../../urun-$urunseo-$urunid?durum=ok");

		} else {

			Header("Location:../../urun-$urunseo-$urunid?durum=no");
		}
	}
	
}



//SEPET SİLME
if ($_GET['sepetsil']=="ok") 
{
	$sil=$db->prepare("DELETE from sepet where sepet_id=:sepet_id");
	$kontrol=$sil->execute(array('sepet_id'=>$_GET['sepet_id']));

	if ($kontrol) 
	{
		Header("Location:../../sepet?sil=ok");
	}
	else
	{
		Header("Location:../../sepet?sil=no");
	}
}

//Sipariş ONAY
if (isset($_POST['siparisonay']))
{
	$siparis_il=strip_tags(trim(ucfirst($_POST['siparis_il'])));
	$siparis_ilce=strip_tags(trim(ucfirst($_POST['siparis_ilce'])));
	$siparis_adres=strip_tags(trim($_POST['siparis_adres']));
	$siparis_zip=strip_tags(trim($_POST['siparis_zip']));
	$siparis_not=strip_tags(trim($_POST['siparis_not']));

	if (empty($siparis_il)||empty($siparis_ilce)||empty($siparis_adres)||empty($siparis_zip)) 
	{
		header("Location:../../odeme?durum=bos");
		exit;
	}

	$sepetsor=$db->prepare("SELECT * FROM sepet where kullanici_id=:kullanici_id");
	$sepetsor->execute(array('kullanici_id'=>$_SESSION['userkullanici_id']));
	while ($sepetcek=$sepetsor->fetch(PDO::FETCH_ASSOC)) 
	{
		$urunsor=$db->prepare("SELECT * FROM urun where urun_id=:urun_id");
		$urunsor->execute(array('urun_id'=>$sepetcek['urun_id']));
		$uruncek=$urunsor->fetch(PDO::FETCH_ASSOC);
		$toplam_fiyat+=$uruncek['urun_fiyat']*$sepetcek['urun_adet'];
	}

	$kaydet=$db->prepare("INSERT INTO siparis SET
			kullanici_id=:kullanici_id,
			siparis_il=:siparis_il,
			siparis_ilce=:siparis_ilce,
			siparis_adres=:siparis_adres,
			siparis_zip=:siparis_zip,
			siparis_not=:siparis_not,
			siparis_toplam=:siparis_toplam
			");
		$insert=$kaydet->execute(array(
			'kullanici_id' => $_SESSION['userkullanici_id'],
			'siparis_il' => $siparis_il,
			'siparis_ilce' => $siparis_ilce,
			'siparis_adres' => $siparis_adres,
			'siparis_zip' => $siparis_zip,
			'siparis_not' => $siparis_not,
			'siparis_toplam' => $toplam_fiyat	
			));

	if ($insert) 
	{
		$siparis_id = $db->lastInsertId();
		$sepetsor1=$db->prepare("SELECT * FROM sepet where kullanici_id=:id");
		$sepetsor1->execute(array('id' => $_SESSION['userkullanici_id']));

		while($sepetcek1=$sepetsor1->fetch(PDO::FETCH_ASSOC)) 
		{

			$urun_id=$sepetcek1['urun_id']; 
			$urun_adet=$sepetcek1['urun_adet'];

			$urunsor1=$db->prepare("SELECT * FROM urun where urun_id=:id");
			$urunsor1->execute(array('id' => $urun_id));
			$uruncek1=$urunsor1->fetch(PDO::FETCH_ASSOC);
			
			$urun_fiyat=$uruncek1['urun_fiyat'];
			$urun_beden=$sepetcek1['urun_beden'];

			
			$kaydet=$db->prepare("INSERT INTO siparis_detay SET
				
				siparis_id=:siparis_id,
				urun_id=:urun_id,	
				urun_fiyat=:urun_fiyat,
				urun_beden=:urun_beden,
				urun_adet=:urun_adet");
			$insert=$kaydet->execute(array(
				'siparis_id' => $siparis_id,
				'urun_id' => $urun_id,
				'urun_fiyat' => $urun_fiyat,
				'urun_beden' => $urun_beden,
				'urun_adet' => $urun_adet));
			
		}
		if ($insert) 
		{
			$sil=$db->prepare("DELETE from sepet where kullanici_id=:kullanici_id");
			$kontrol=$sil->execute(array('kullanici_id' => $_SESSION['userkullanici_id']));

			Header("Location:../../siparislerim?durum=ok");
			exit;
		}
		else
		{
			Header("Location:../../siparislerim?durum=noo");
		}
	}
	else
	{
		Header("Location:../../siparislerim?durum=no");
	}
}

//Sipariş Teslim
if ($_GET['teslim']=="ok") 
{
	$guncelle=$db->prepare("UPDATE siparis SET 
		siparis_teslim=:siparis_teslim
		WHERE kullanici_id={$_SESSION['userkullanici_id']} and siparis_id={$_GET['siparis_id']}");

	$update=$guncelle->execute(array('siparis_teslim' => 1));

	if ($update) 
	{
		Header("Location:../../siparislerim?teslim=ok");
	}
	else
	{
		Header("Location:../../siparislerim?teslim=no");
	}
}

?>