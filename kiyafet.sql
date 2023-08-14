-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Anamakine: localhost
-- Üretim Zamanı: 06 Ara 2022, 10:58:24
-- Sunucu sürümü: 8.0.17
-- PHP Sürümü: 7.3.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Veritabanı: `kiyafet`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `admin`
--

CREATE TABLE `admin` (
  `admin_id` int(11) NOT NULL,
  `admin_mail` varchar(50) COLLATE utf8_turkish_ci NOT NULL,
  `admin_password` varchar(100) COLLATE utf8_turkish_ci NOT NULL,
  `admin_yetki` enum('1','2','3','4','5') COLLATE utf8_turkish_ci NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `admin`
--

INSERT INTO `admin` (`admin_id`, `admin_mail`, `admin_password`, `admin_yetki`) VALUES
(1, 'erdal318@gmail.com', 'ab4b5f750349b8f8c57527662dca3164', '5');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `ayar`
--

CREATE TABLE `ayar` (
  `ayar_id` int(11) NOT NULL,
  `ayar_logo` varchar(250) CHARACTER SET utf8 COLLATE utf8_turkish_ci NOT NULL,
  `ayar_url` varchar(50) CHARACTER SET utf8 COLLATE utf8_turkish_ci NOT NULL,
  `ayar_title` varchar(250) CHARACTER SET utf8 COLLATE utf8_turkish_ci NOT NULL,
  `ayar_description` varchar(250) CHARACTER SET utf8 COLLATE utf8_turkish_ci NOT NULL,
  `ayar_keywords` varchar(50) CHARACTER SET utf8 COLLATE utf8_turkish_ci NOT NULL,
  `ayar_author` varchar(50) CHARACTER SET utf8 COLLATE utf8_turkish_ci NOT NULL,
  `ayar_tel` varchar(50) CHARACTER SET utf8 COLLATE utf8_turkish_ci NOT NULL,
  `ayar_gsm` varchar(50) CHARACTER SET utf8 COLLATE utf8_turkish_ci NOT NULL,
  `ayar_faks` varchar(50) CHARACTER SET utf8 COLLATE utf8_turkish_ci NOT NULL,
  `ayar_mail` varchar(50) CHARACTER SET utf8 COLLATE utf8_turkish_ci NOT NULL,
  `ayar_ilce` varchar(50) CHARACTER SET utf8 COLLATE utf8_turkish_ci NOT NULL,
  `ayar_il` varchar(50) CHARACTER SET utf8 COLLATE utf8_turkish_ci NOT NULL,
  `ayar_adres` varchar(250) CHARACTER SET utf8 COLLATE utf8_turkish_ci NOT NULL,
  `ayar_mesai` varchar(250) CHARACTER SET utf8 COLLATE utf8_turkish_ci NOT NULL,
  `ayar_maps` varchar(250) CHARACTER SET utf8 COLLATE utf8_turkish_ci NOT NULL,
  `ayar_analystic` varchar(50) CHARACTER SET utf8 COLLATE utf8_turkish_ci NOT NULL,
  `ayar_zopim` varchar(250) CHARACTER SET utf8 COLLATE utf8_turkish_ci NOT NULL,
  `ayar_facebook` varchar(50) CHARACTER SET utf8 COLLATE utf8_turkish_ci NOT NULL,
  `ayar_twitter` varchar(50) CHARACTER SET utf8 COLLATE utf8_turkish_ci NOT NULL,
  `ayar_google` varchar(50) CHARACTER SET utf8 COLLATE utf8_turkish_ci NOT NULL,
  `ayar_youtube` varchar(50) CHARACTER SET utf8 COLLATE utf8_turkish_ci NOT NULL,
  `ayar_smtphost` varchar(50) CHARACTER SET utf8 COLLATE utf8_turkish_ci NOT NULL,
  `ayar_smtpuser` varchar(50) CHARACTER SET utf8 COLLATE utf8_turkish_ci NOT NULL,
  `ayar_smtppassword` varchar(50) CHARACTER SET utf8 COLLATE utf8_turkish_ci NOT NULL,
  `ayar_smtpport` varchar(50) CHARACTER SET utf8 COLLATE utf8_turkish_ci NOT NULL,
  `ayar_bakim` enum('0','1') CHARACTER SET utf8 COLLATE utf8_turkish_ci NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `ayar`
--

INSERT INTO `ayar` (`ayar_id`, `ayar_logo`, `ayar_url`, `ayar_title`, `ayar_description`, `ayar_keywords`, `ayar_author`, `ayar_tel`, `ayar_gsm`, `ayar_faks`, `ayar_mail`, `ayar_ilce`, `ayar_il`, `ayar_adres`, `ayar_mesai`, `ayar_maps`, `ayar_analystic`, `ayar_zopim`, `ayar_facebook`, `ayar_twitter`, `ayar_google`, `ayar_youtube`, `ayar_smtphost`, `ayar_smtpuser`, `ayar_smtppassword`, `ayar_smtpport`, `ayar_bakim`) VALUES
(0, 'img/232182227442logo.png', 'http://www.joyakademi.com', 'Joy Akademi E-Ticaret Scripti', 'Joy Akademi E-Ticaret Scripti yazım eğitimi projesi', 'eticaret, shopping, php, learning, student php', 'Joy Akademi', '0850 840 80 76', '0850 840 80 76', '0850 840 80 76', 'info@emrahyuksel.com.tr', 'İstanbul', 'Topkapı', 'Topkapı sarayı', '7 x 24 açık eticaret scripti', 'ayar_maps_api', 'ayar_analystic', 'ayar_zopima', 'www.facebook.com', 'www.twitter.com', 'www.google.com', 'www.youtube.com', 'mail.emrahyuksel.com.tr', 'joyakademi@emrahyuksel.com.tr', 'password', '25', '1');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `banka`
--

CREATE TABLE `banka` (
  `banka_id` int(11) NOT NULL,
  `banka_ad` varchar(50) CHARACTER SET utf8 COLLATE utf8_turkish_ci NOT NULL,
  `banka_iban` varchar(50) CHARACTER SET utf8 COLLATE utf8_turkish_ci NOT NULL,
  `banka_hesapadsoyad` varchar(50) CHARACTER SET utf8 COLLATE utf8_turkish_ci NOT NULL,
  `banka_durum` enum('0','1') CHARACTER SET utf8 COLLATE utf8_turkish_ci NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `banka`
--

INSERT INTO `banka` (`banka_id`, `banka_ad`, `banka_iban`, `banka_hesapadsoyad`, `banka_durum`) VALUES
(1, 'Garanti Bankası', 'TR98755656564564546', 'Emrah Yüksel', '1'),
(2, 'Yapı Kredi', 'TR45646545646545646465546', 'Emrah Yüksel', '1'),
(3, 'Vakıfbank', 'TR455645645646546465465', 'Emrah Yüksel', '1'),
(5, 'Ziraat Bankası', 'TR45646545646awrwerwerwer', 'Emrah Yüksel', '1');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `hakkimizda`
--

CREATE TABLE `hakkimizda` (
  `hakkimizda_id` int(11) NOT NULL,
  `hakkimizda_baslik` varchar(250) CHARACTER SET utf8 COLLATE utf8_turkish_ci NOT NULL,
  `hakkimizda_icerik` text CHARACTER SET utf8 COLLATE utf8_turkish_ci NOT NULL,
  `hakkimizda_video` varchar(50) CHARACTER SET utf8 COLLATE utf8_turkish_ci NOT NULL,
  `hakkimizda_vizyon` varchar(500) CHARACTER SET utf8 COLLATE utf8_turkish_ci NOT NULL,
  `hakkimizda_misyon` varchar(500) CHARACTER SET utf8 COLLATE utf8_turkish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `hakkimizda`
--

INSERT INTO `hakkimizda` (`hakkimizda_id`, `hakkimizda_baslik`, `hakkimizda_icerik`, `hakkimizda_video`, `hakkimizda_vizyon`, `hakkimizda_misyon`) VALUES
(0, 'Joy Akademi Eğitim Sürümü', '<p><strong>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</strong> Phasellus viverra viverra eros, <img alt=\"\" src=\"https://www.neyazilim.com/dimg/30166neyazilim_logo.png\" style=\"float:right; height:42px; width:200px\" />eu laoreet leo iaculis vehicula. Nunc pretium volutpat neque, finibus fermentum neque pretium vel. In hac habitasse platea dictumst. Phasellus ipsum lacus, vehicula et fringilla a, dapibus ac mi. Nulla orci tortor, fringilla eget magna in, dictum consequat lectus. Sed tincidunt purus nec erat scelerisque pretium. Aliquam vehicula lacus vel lacus varius egestas.</p>\r\n\r\n<p>Vivamus eget euismod mi. Pellentesque et bibendum libero. Aliquam ullamcorper felis id nisl fermentum fringilla. Curabitur egestas condimentum lacus ut ornare. Donec vitae libero sagittis, pharetra massa ut, aliquam tellus. Proin luctus ex orci, nec pretium purus ultrices id. Nulla facilisi. Donec convallis pellentesque mauris. Suspendisse potenti. Ut viverra ex ante, vel tincidunt massa pellentesque et. Aenean rutrum ut ex facilisis vestibulum. Mauris est nibh, auctor quis efficitur et, pellentesque eu metus.</p>\r\n\r\n<p>Sed auctor maximus nunc ut cursus. Sed ultrices lectus eu turpis tincidunt, id dignissim nisl mattis. Sed in risus justo. Fusce et eleifend elit. Donec sit amet sapien accumsan, ornare diam ut, pellentesque dui. Maecenas ut molestie mauris. Curabitur imperdiet enim ut feugiat vulputate. Quisque dictum dolor a risus facilisis, eu bibendum dolor aliquam. Mauris vestibulum leo mauris, sit amet blandit erat suscipit nec.</p>\r\n\r\n<p>Nam facilisis sem vitae sem cursus, non ultrices dolor ullamcorper. Donec tortor massa, convallis eu tortor ornare, ornare sollicitudin tellus. Pellentesque quis interdum neque. Praesent elementum mauris sit amet nibh scelerisque bibendum. Maecenas aliquet metus lacinia elit bibendum volutpat. Vivamus eget augue eu quam consectetur venenatis. Proin rhoncus, tellus vitae tempor efficitur, eros orci maximus odio, eu rutrum sapien arcu non nisl. Donec egestas mauris eu nisl faucibus, ullamcorper dictum urna efficitur. Aliquam eu velit nisi. Etiam vitae nisi massa. Etiam a auctor felis.</p>\r\n\r\n<p>Vestibulum sem erat, venenatis at blandit in, mollis ut mauris. Donec vitae neque venenatis ante fermentum auctor vel at quam. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Etiam ut auctor lectus, at egestas odio. Donec vestibulum nunc vitae porttitor scelerisque. Aenean non erat facilisis, finibus ex eu, commodo nulla. Pellentesque ornare, sem sit amet laoreet efficitur, sapien enim facilisis nibh, vel imperdiet nunc eros id libero. Suspendisse potenti. Nullam nec fringilla nibh. Duis sed ex a eros interdum faucibus. Duis viverra quis sem ut accumsan.</p>\r\n', 'gGXSHaER4h8', 'Joy Akademi ile ilgili hakkımızda vizyon içeriği burada yer alacağından buraya vizyon verisi girilecekitir.', 'Joy Akademi ile ilgili hakkımızda vizyon içeriği burada yer alacağından buraya vizyon verisi girilecekitir.');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `kategori`
--

CREATE TABLE `kategori` (
  `kategori_id` int(11) NOT NULL,
  `kategori_ad` varchar(100) CHARACTER SET utf8 COLLATE utf8_turkish_ci NOT NULL,
  `kategori_foto` varchar(250) COLLATE utf8_turkish_ci NOT NULL,
  `kategori_seourl` varchar(250) CHARACTER SET utf8 COLLATE utf8_turkish_ci NOT NULL,
  `kategori_sira` int(2) NOT NULL,
  `kategori_durum` enum('0','1') CHARACTER SET utf8 COLLATE utf8_turkish_ci NOT NULL DEFAULT '1',
  `kategori_onecikar` enum('0','1') COLLATE utf8_turkish_ci NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `kategori`
--

INSERT INTO `kategori` (`kategori_id`, `kategori_ad`, `kategori_foto`, `kategori_seourl`, `kategori_sira`, `kategori_durum`, `kategori_onecikar`) VALUES
(12, 'Tişört', 'img/kategorifoto/632dbc304e4a3.jpg', 'tisort', 1, '1', '1'),
(13, 'Etek', 'img/kategorifoto/632dbc465c5c8.jpg', 'etek', 6, '1', '1'),
(14, 'Gömlek', 'img/kategorifoto/632dbc5a5e115.jpg', 'gomlek', 3, '1', '1'),
(15, 'Pantolon', 'img/kategorifoto/632dbc6d59d48.jpg', 'pantolon', 2, '1', '1'),
(16, 'Ceket', 'img/kategorifoto/632dbc7c880f3.jpg', 'ceket', 4, '1', '1'),
(17, 'Saat', 'img/kategorifoto/632dbc9773119.jpg', 'saat', 5, '1', '1'),
(18, 'Hırka', 'img/kategorifoto/632dbcc05ef07.jpg', 'hirka', 7, '1', '1');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `kombin`
--

CREATE TABLE `kombin` (
  `kombin_id` int(11) NOT NULL,
  `kombin_ad` varchar(50) COLLATE utf8_turkish_ci NOT NULL,
  `kombin_foto` varchar(250) CHARACTER SET utf8 COLLATE utf8_turkish_ci NOT NULL,
  `kombin_durum` enum('0','1') CHARACTER SET utf8 COLLATE utf8_turkish_ci NOT NULL DEFAULT '1',
  `kombin_onecikar` enum('0','1') CHARACTER SET utf8 COLLATE utf8_turkish_ci NOT NULL DEFAULT '1',
  `urun_idbir` int(11) NOT NULL,
  `urun_idiki` int(11) NOT NULL,
  `urun_iduc` int(11) NOT NULL,
  `urun_iddort` int(11) NOT NULL,
  `kombin_detay` text COLLATE utf8_turkish_ci NOT NULL,
  `kombin_cinsiyet` enum('E','K') COLLATE utf8_turkish_ci NOT NULL,
  `kombin_seourl` varchar(250) CHARACTER SET utf8 COLLATE utf8_turkish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `kombin`
--

INSERT INTO `kombin` (`kombin_id`, `kombin_ad`, `kombin_foto`, `kombin_durum`, `kombin_onecikar`, `urun_idbir`, `urun_idiki`, `urun_iduc`, `urun_iddort`, `kombin_detay`, `kombin_cinsiyet`, `kombin_seourl`) VALUES
(2, 'Güzel Kombin', 'img/kombinfoto/632dbe7c94431.jpg', '1', '1', 6, 8, 9, 7, '<p>uyumlu renkler</p>\r\n', 'E', 'guzel-kombin');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `kullanici`
--

CREATE TABLE `kullanici` (
  `kullanici_id` int(11) NOT NULL,
  `kullanici_tc` varchar(50) COLLATE utf8_turkish_ci NOT NULL,
  `kullanici_ad` varchar(50) COLLATE utf8_turkish_ci NOT NULL,
  `kullanici_soyad` varchar(50) COLLATE utf8_turkish_ci NOT NULL,
  `kullanici_mail` varchar(50) COLLATE utf8_turkish_ci NOT NULL,
  `kullanici_password` varchar(50) COLLATE utf8_turkish_ci NOT NULL,
  `kullanici_il` varchar(50) COLLATE utf8_turkish_ci NOT NULL,
  `kullanici_ilce` varchar(50) COLLATE utf8_turkish_ci NOT NULL,
  `kullanici_zip` varchar(50) COLLATE utf8_turkish_ci NOT NULL,
  `kullanici_adres` text COLLATE utf8_turkish_ci NOT NULL,
  `kullanici_tel` varchar(50) COLLATE utf8_turkish_ci NOT NULL,
  `kullanici_resim` varchar(250) COLLATE utf8_turkish_ci NOT NULL,
  `kullanici_durum` enum('0','1') COLLATE utf8_turkish_ci NOT NULL DEFAULT '1',
  `kullanici_zaman` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `kullanici`
--

INSERT INTO `kullanici` (`kullanici_id`, `kullanici_tc`, `kullanici_ad`, `kullanici_soyad`, `kullanici_mail`, `kullanici_password`, `kullanici_il`, `kullanici_ilce`, `kullanici_zip`, `kullanici_adres`, `kullanici_tel`, `kullanici_resim`, `kullanici_durum`, `kullanici_zaman`) VALUES
(2, '23150281204', 'Erdal', 'Fidan', 'erdal318@gmail.com', 'bb2d91d0fbbebe8719509ed0f865c63f', '', '', '', '', '0541 520 44 41', '', '1', '2022-09-23 16:18:38');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `sepet`
--

CREATE TABLE `sepet` (
  `sepet_id` int(11) NOT NULL,
  `kullanici_id` int(11) NOT NULL,
  `urun_id` int(11) NOT NULL,
  `urun_adet` int(3) NOT NULL,
  `urun_beden` enum('S','M','L','XL','XXL') COLLATE utf8_turkish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `siparis`
--

CREATE TABLE `siparis` (
  `siparis_id` int(11) NOT NULL,
  `kullanici_id` int(11) NOT NULL,
  `siparis_il` varchar(50) COLLATE utf8_turkish_ci NOT NULL,
  `siparis_ilce` varchar(50) COLLATE utf8_turkish_ci NOT NULL,
  `siparis_adres` text COLLATE utf8_turkish_ci NOT NULL,
  `siparis_zip` varchar(50) COLLATE utf8_turkish_ci NOT NULL,
  `siparis_not` text COLLATE utf8_turkish_ci NOT NULL,
  `siparis_toplam` float(9,2) NOT NULL,
  `siparis_zaman` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `siparis_teslim` enum('0','1') COLLATE utf8_turkish_ci NOT NULL DEFAULT '0',
  `siparis_odeme` enum('0','1') COLLATE utf8_turkish_ci NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `siparis`
--

INSERT INTO `siparis` (`siparis_id`, `kullanici_id`, `siparis_il`, `siparis_ilce`, `siparis_adres`, `siparis_zip`, `siparis_not`, `siparis_toplam`, `siparis_zaman`, `siparis_teslim`, `siparis_odeme`) VALUES
(1, 2, 'Kocaeli', 'Izmit', 'asdasd', '41100', 'asdasd', 15000.00, '2022-09-23 16:51:16', '1', '1');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `siparis_detay`
--

CREATE TABLE `siparis_detay` (
  `siparis_detay_id` int(11) NOT NULL,
  `siparis_id` int(11) NOT NULL,
  `urun_id` int(11) NOT NULL,
  `urun_fiyat` float(9,2) NOT NULL,
  `urun_beden` varchar(2) COLLATE utf8_turkish_ci NOT NULL,
  `urun_adet` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `siparis_detay`
--

INSERT INTO `siparis_detay` (`siparis_detay_id`, `siparis_id`, `urun_id`, `urun_fiyat`, `urun_beden`, `urun_adet`) VALUES
(1, 1, 3, 5000.00, 'S', 2),
(2, 1, 3, 5000.00, 'XL', 1);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `urun`
--

CREATE TABLE `urun` (
  `urun_id` int(11) NOT NULL,
  `kategori_id` int(11) NOT NULL,
  `urun_ad` varchar(100) COLLATE utf8_turkish_ci NOT NULL,
  `urun_detay` text COLLATE utf8_turkish_ci NOT NULL,
  `urun_fiyat` float(9,2) NOT NULL,
  `urun_cinsiyet` enum('E','K') COLLATE utf8_turkish_ci NOT NULL,
  `urun_keyword` varchar(250) COLLATE utf8_turkish_ci NOT NULL,
  `urun_durum` enum('1','2') COLLATE utf8_turkish_ci NOT NULL DEFAULT '1',
  `urun_onecikar` enum('1','2') COLLATE utf8_turkish_ci NOT NULL DEFAULT '1',
  `urun_stokS` int(2) NOT NULL,
  `urun_stokM` int(2) NOT NULL,
  `urun_stokL` int(2) NOT NULL,
  `urun_stokXL` int(2) NOT NULL,
  `urun_stokXXL` int(2) NOT NULL,
  `urun_seourl` varchar(100) COLLATE utf8_turkish_ci NOT NULL,
  `urun_zaman` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `urun`
--

INSERT INTO `urun` (`urun_id`, `kategori_id`, `urun_ad`, `urun_detay`, `urun_fiyat`, `urun_cinsiyet`, `urun_keyword`, `urun_durum`, `urun_onecikar`, `urun_stokS`, `urun_stokM`, `urun_stokL`, `urun_stokXL`, `urun_stokXXL`, `urun_seourl`, `urun_zaman`) VALUES
(6, 12, 'Kırmızı Tişört', '<p>iyi</p>\r\n', 50.00, 'E', 'kt', '1', '1', 2, 3, 3, 1, 1, 'kirmizi-tisort', '2022-09-23 14:05:12'),
(7, 17, 'Siyah Saat', '<p>asd</p>\r\n', 500.00, 'E', 'ss', '1', '1', 2, 2, 2, 2, 2, 'siyah-saat', '2022-09-23 14:08:20'),
(8, 16, 'Mavi Kot Ceket', '<p>h&uuml;zel</p>\r\n', 600.00, 'E', 'mkc', '1', '1', 3, 3, 3, 3, 3, 'mavi-kot-ceket', '2022-09-23 14:09:19'),
(9, 13, 'Mavi Kot Etek', '<p>g&uuml;zle etek</p>\r\n', 200.00, 'K', 'mke', '1', '1', 3, 3, 3, 3, 2, 'mavi-kot-etek', '2022-09-23 14:10:19');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `urunfoto`
--

CREATE TABLE `urunfoto` (
  `urunfoto_id` int(11) NOT NULL,
  `urunfoto_resimyol` varchar(250) COLLATE utf8_turkish_ci NOT NULL,
  `urun_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `urunfoto`
--

INSERT INTO `urunfoto` (`urunfoto_id`, `urunfoto_resimyol`, `urun_id`) VALUES
(4, 'img/urunfoto/632db4989419eWhatsApp Image 2022-09-07 at 14.45.03.jpeg', 3),
(5, 'img/urunfoto/632dbdac41190item-11.jpg', 6),
(6, 'img/urunfoto/632dbdac5f349item-10.jpg', 6),
(7, 'img/urunfoto/632dbddaf1bceitem-05.jpg', 7),
(8, 'img/urunfoto/632dbddb152e2item-08.jpg', 7),
(9, 'img/urunfoto/632dbddb30bbcitem-09.jpg', 7),
(10, 'img/urunfoto/632dbe164f91ditem-03.jpg', 8),
(11, 'img/urunfoto/632dbe165df5fitem-04.jpg', 8),
(12, 'img/urunfoto/632dbe957f7e6item-07.jpg', 9),
(13, 'img/urunfoto/632dbe958ee72item-13.jpg', 9);

--
-- Dökümü yapılmış tablolar için indeksler
--

--
-- Tablo için indeksler `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Tablo için indeksler `ayar`
--
ALTER TABLE `ayar`
  ADD PRIMARY KEY (`ayar_id`);

--
-- Tablo için indeksler `banka`
--
ALTER TABLE `banka`
  ADD PRIMARY KEY (`banka_id`);

--
-- Tablo için indeksler `hakkimizda`
--
ALTER TABLE `hakkimizda`
  ADD PRIMARY KEY (`hakkimizda_id`);

--
-- Tablo için indeksler `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`kategori_id`);

--
-- Tablo için indeksler `kombin`
--
ALTER TABLE `kombin`
  ADD PRIMARY KEY (`kombin_id`);

--
-- Tablo için indeksler `kullanici`
--
ALTER TABLE `kullanici`
  ADD PRIMARY KEY (`kullanici_id`);

--
-- Tablo için indeksler `sepet`
--
ALTER TABLE `sepet`
  ADD PRIMARY KEY (`sepet_id`);

--
-- Tablo için indeksler `siparis`
--
ALTER TABLE `siparis`
  ADD PRIMARY KEY (`siparis_id`);

--
-- Tablo için indeksler `siparis_detay`
--
ALTER TABLE `siparis_detay`
  ADD PRIMARY KEY (`siparis_detay_id`);

--
-- Tablo için indeksler `urun`
--
ALTER TABLE `urun`
  ADD PRIMARY KEY (`urun_id`);

--
-- Tablo için indeksler `urunfoto`
--
ALTER TABLE `urunfoto`
  ADD PRIMARY KEY (`urunfoto_id`);

--
-- Dökümü yapılmış tablolar için AUTO_INCREMENT değeri
--

--
-- Tablo için AUTO_INCREMENT değeri `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Tablo için AUTO_INCREMENT değeri `banka`
--
ALTER TABLE `banka`
  MODIFY `banka_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Tablo için AUTO_INCREMENT değeri `kategori`
--
ALTER TABLE `kategori`
  MODIFY `kategori_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- Tablo için AUTO_INCREMENT değeri `kombin`
--
ALTER TABLE `kombin`
  MODIFY `kombin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Tablo için AUTO_INCREMENT değeri `kullanici`
--
ALTER TABLE `kullanici`
  MODIFY `kullanici_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Tablo için AUTO_INCREMENT değeri `sepet`
--
ALTER TABLE `sepet`
  MODIFY `sepet_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Tablo için AUTO_INCREMENT değeri `siparis`
--
ALTER TABLE `siparis`
  MODIFY `siparis_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Tablo için AUTO_INCREMENT değeri `siparis_detay`
--
ALTER TABLE `siparis_detay`
  MODIFY `siparis_detay_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Tablo için AUTO_INCREMENT değeri `urun`
--
ALTER TABLE `urun`
  MODIFY `urun_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Tablo için AUTO_INCREMENT değeri `urunfoto`
--
ALTER TABLE `urunfoto`
  MODIFY `urunfoto_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
