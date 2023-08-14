<?php 

ob_start();
session_start();

include 'baglan.php';

if (!empty($_FILES)) {



	$uploads_dir = '../../img/urunfoto';
	@$tmp_name = $_FILES['file']["tmp_name"];
	@$name = $_FILES['file']["name"];
	$benzersizad=uniqid();

	$refimgyol=substr($uploads_dir, 6)."/".$benzersizad.$name;
	@move_uploaded_file($tmp_name, "$uploads_dir/$benzersizad$name");

	$urun_id=$_POST['urun_id'];

	$kaydet=$db->prepare("INSERT INTO urunfoto SET
		urunfoto_resimyol=:resimyol,
		urun_id=:urun_id");
	$insert=$kaydet->execute(array(
		'resimyol' => $refimgyol,
		'urun_id' => $urun_id
		));


}





?>