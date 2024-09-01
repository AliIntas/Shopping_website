-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Anamakine: 127.0.0.1
-- Üretim Zamanı: 01 Eyl 2024, 23:19:55
-- Sunucu sürümü: 10.4.32-MariaDB
-- PHP Sürümü: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Veritabanı: `sirket`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `bio`
--

CREATE TABLE `bio` (
  `id` int(10) NOT NULL,
  `cid` int(10) NOT NULL,
  `tcno` bigint(11) DEFAULT NULL,
  `biography` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Tablo döküm verisi `bio`
--

INSERT INTO `bio` (`id`, `cid`, `tcno`, `biography`) VALUES
(1, 53, 12345678901, 'Ahmet Yılmaz, uzun yıllardır yazılım geliştirme alanında çalışmaktadır.'),
(2, 54, 23456789012, 'Ayşe Demir, büyük bir şirkette insan kaynakları müdürü olarak görev yapmaktadır.'),
(3, 55, 34567890123, 'Mehmet Can, sporla ilgilenir ve boş zamanlarında futbol oynamaktan hoşlanır.'),
(4, 56, 45678901234, 'Fatma Çelik, çocuk gelişimi üzerine çalışmakta ve bu alanda eğitimler vermektedir.'),
(5, 57, 56789012345, 'Ali Vural, doğa yürüyüşlerini sever ve fotoğrafçılıkla ilgilenir. '),
(6, 58, 67890123456, 'Elif Kaya, moda sektöründe çalışmakta ve stil danışmanlığı yapmaktadır.'),
(7, 59, 78901234567, 'Hasan Toprak, mühendislik alanında uzmanlaşmış ve çeşitli projelerde yer almıştır.'),
(8, 60, 89012345678, 'Zeynep Yıldız, edebiyatla ilgilenir ve kısa hikayeler yazar.'),
(9, 61, 90123456789, 'Murat Güneş, bilgisayar mühendisliği mezunu ve teknolojiye büyük ilgi duymaktadır.'),
(10, 62, 10234567890, 'Hülya Erdem, uzun yıllardır sağlık sektöründe hemşire olarak çalışmaktadır.'),
(11, 63, 11234567890, 'Emre Şahin, grafik tasarım alanında çalışmakta ve çeşitli projelere imza atmıştır.'),
(12, 64, 12234567890, 'Serap Akın, pazarlama alanında uzmanlaşmış ve büyük kampanyalarda yer almıştır.'),
(13, 65, 13234567890, 'Levent Keskin, yazılım geliştirme alanında çalışmaktadır ve birçok projede liderlik yapmıştır.'),
(14, 66, 14234567890, 'Buse Kılıç, sosyal medya yönetimi üzerine çalışmakta ve bu alanda danışmanlık yapmaktadır.'),
(15, 67, 15234567890, 'Okan Yıldırım, elektrik mühendisliği mezunu ve yenilenebilir enerji üzerine çalışmaktadır.'),
(16, 68, 16234567890, 'Esra Uzun, çocuk gelişimi alanında çalışmakta ve bu alanda uzmanlaşmıştır.'),
(17, 69, 17234567890, 'Volkan Aksoy, yazılım mühendisliği alanında çalışmakta ve çeşitli projelerde yer almıştır.'),
(18, 70, 18234567890, 'Pelin Aslan, psikoloji alanında eğitim almış ve bu alanda çalışmaktadır.'),
(19, 71, 19234567890, 'Koray Demir, bilgisayar mühendisliği alanında çalışmakta ve oyun geliştirmeye ilgi duymaktadır.'),
(20, 72, 20234567890, 'Duygu Şimşek, edebiyat öğretmeni olarak görev yapmakta ve öğrencilerine ilham vermektedir.'),
(21, 73, 21234567890, 'Suat Karaca, finans sektöründe çalışmakta ve yatırım danışmanlığı yapmaktadır.'),
(22, 74, 22234567890, 'Ebru Altın, sanat tarihi üzerine çalışmakta ve çeşitli sergilerde görev almaktadır.'),
(23, 75, 23234567890, 'Can Özdemir, mühendislik alanında çalışmakta ve robotik teknolojilere ilgi duymaktadır.'),
(24, 76, 24234567890, 'Gül Aydın, tıp fakültesi mezunu ve dahiliye uzmanı olarak görev yapmaktadır.'),
(25, 77, 25234567890, 'Cem Çetin, ekonomi alanında uzmanlaşmış ve çeşitli dergilerde makaleler yayınlamıştır.');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `kategoriler`
--

CREATE TABLE `kategoriler` (
  `id` int(11) NOT NULL,
  `kategori_adi` varchar(20) NOT NULL,
  `durum` int(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Tablo döküm verisi `kategoriler`
--

INSERT INTO `kategoriler` (`id`, `kategori_adi`, `durum`) VALUES
(1, 'Elektronik', 1),
(2, 'Giyim', 1),
(3, 'Meyve', 1),
(4, 'Sebze', 1),
(5, 'Gıda', 1),
(6, 'Ev ve Mutfak', 1),
(7, 'Kitap', 1),
(8, 'Kişisel Bakım', 1),
(9, 'Oyun ve Hobi', 1),
(10, 'BOŞ', 0);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `kullanicilar`
--

CREATE TABLE `kullanicilar` (
  `id` int(10) NOT NULL,
  `tcno` bigint(11) DEFAULT NULL,
  `name_surname` varchar(30) NOT NULL,
  `gender` varchar(1) NOT NULL,
  `birthday` date NOT NULL,
  `email` varchar(30) NOT NULL,
  `phone_number` bigint(10) DEFAULT NULL,
  `status` tinyint(1) NOT NULL,
  `password` varchar(100) DEFAULT NULL,
  `admin` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Tablo döküm verisi `kullanicilar`
--

INSERT INTO `kullanicilar` (`id`, `tcno`, `name_surname`, `gender`, `birthday`, `email`, `phone_number`, `status`, `password`, `admin`) VALUES
(53, 12345678901, 'Ahmet Yılmaz', 'M', '1990-05-15', 'ahmet.yilmaz@example.com', 5301234567, 1, '202cb962ac59075b964b07152d234b70', 1),
(57, 56789012345, 'Ahmet Vural', 'M', '1987-09-18', 'ali.vural@example.com.tr', 5312345678, 1, '202cb962ac59075b964b07152d234b70', 0),
(58, 67890123456, 'Elif Kaya', 'F', '1991-03-12', 'elif.kaya@example.com', 5345678901, 1, '202cb962ac59075b964b07152d234b70', 0),
(59, 78901234567, 'Hasan Toprak', 'M', '1993-06-25', 'hasan.toprak@example.com', 5367890123, 1, 'password7', 0),
(60, 89012345678, 'Zeynep Yıldız', 'F', '1994-08-09', 'zeynep.yildiz@example.com', 5309876543, 1, 'password8', 0),
(61, 90123456789, 'Murat Güneş', 'M', '1990-01-05', 'murat.gunes@example.com', 5323456789, 0, 'password9', 0),
(62, 10234567890, 'Hülya Erdem', 'F', '1989-04-22', 'hulya.erdem@example.com', 5318765432, 1, 'password10', 0),
(63, 11234567890, 'Emre Şahin', 'M', '1992-02-14', 'emre.sahin@example.com', 5376543210, 1, 'password11', 0),
(64, 12234567890, 'Serap Akın', 'F', '1993-11-19', 'serap.akin@example.com', 5340987654, 1, 'password12', 0),
(65, 13234567890, 'Levent Keskin', 'M', '1991-07-03', 'levent.keskin@example.com', 5365432109, 0, 'password13', 0),
(66, 14234567890, 'Buse Kılıç', 'F', '1990-12-10', 'buse.kilic@example.com', 5324567890, 1, 'password14', 0),
(67, 15234567890, 'Okan Yıldırım', 'M', '1988-03-29', 'okan.yildirim@example.com', 5312349876, 1, 'password15', 0),
(68, 16234567890, 'Esra Uzun', 'F', '1989-09-05', 'esra.uzun@example.com', 5343210987, 0, 'password16', 0),
(69, 17234567890, 'Volkan Aksoy', 'M', '1990-10-17', 'volkan.aksoy@example.com', 5378901234, 1, 'password17', 0),
(70, 18234567890, 'Pelin Aslan', 'F', '1991-06-21', 'pelin.aslan@example.com', 5306789123, 1, 'password18', 0),
(71, 19234567890, 'Koray Demir', 'M', '1992-08-13', 'koray.demir@example.com', 5329876543, 0, 'password19', 0),
(72, 20234567890, 'Duygu Şimşek', 'F', '1989-12-08', 'duygu.simsek@example.com', 5314567890, 1, 'password20', 0),
(73, 21234567890, 'Suat Karaca', 'M', '1993-04-14', 'suat.karaca@example.com', 5345674321, 1, 'password21', 0),
(74, 22234567890, 'Ebru Altın', 'F', '1990-09-09', 'ebru.altin@example.com', 5308765432, 1, 'password22', 0),
(100, 11111111111, 'admin', 'M', '2024-01-01', 'admin@gmail.com', 1111111111, 1, '202cb962ac59075b964b07152d234b70', 1);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `sepet`
--

CREATE TABLE `sepet` (
  `id` int(10) NOT NULL,
  `kul_id` int(10) NOT NULL,
  `urun_id` int(10) NOT NULL,
  `adet` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `siparis`
--

CREATE TABLE `siparis` (
  `id` int(11) NOT NULL,
  `kul_id` int(11) NOT NULL,
  `toplam_fiyat` varchar(100) NOT NULL,
  `siparis_tarihi` varchar(20) NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Tablo döküm verisi `siparis`
--

INSERT INTO `siparis` (`id`, `kul_id`, `toplam_fiyat`, `siparis_tarihi`) VALUES
(32, 96, '5000', '2024-08-26 21:29:16'),
(33, 96, '20400', '2024-08-26 21:49:27'),
(34, 96, '', '2024-08-26 21:50:20'),
(35, 57, '220', '2024-08-27 11:23:07'),
(36, 57, '120', '2024-08-27 11:23:23'),
(37, 57, '5000', '2024-08-31 02:20:00');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `siparisler`
--

CREATE TABLE `siparisler` (
  `id` int(10) NOT NULL,
  `siparis_id` int(10) NOT NULL,
  `urun_id` int(10) NOT NULL,
  `urun_adi` varchar(255) NOT NULL,
  `urun_fiyati` varchar(10) NOT NULL,
  `urun_adet` int(255) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Tablo döküm verisi `siparisler`
--

INSERT INTO `siparisler` (`id`, `siparis_id`, `urun_id`, `urun_adi`, `urun_fiyati`, `urun_adet`) VALUES
(18, 32, 29, 'Telefon', '5000', 1),
(19, 33, 26, 'Elma', '40', 8),
(20, 33, 27, 'armut', '20', 4),
(21, 33, 28, 'PC', '10000', 2),
(22, 35, 27, 'armut', '20', 3),
(23, 35, 26, 'Elma', '40', 4),
(24, 36, 26, 'Elma', '40', 3),
(25, 37, 29, 'Telefon', '5000', 1);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `urunler`
--

CREATE TABLE `urunler` (
  `id` int(11) NOT NULL,
  `urun_adi` varchar(30) NOT NULL,
  `amount` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `k_id` int(11) NOT NULL,
  `durum` tinyint(1) NOT NULL DEFAULT 1,
  `pic` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Tablo döküm verisi `urunler`
--

INSERT INTO `urunler` (`id`, `urun_adi`, `amount`, `price`, `k_id`, `durum`, `pic`) VALUES
(26, 'Elma', 100, 40, 3, 1, 'picture/21082024145702-390397114.jpg'),
(27, 'armut', 20, 20, 3, 1, 'picture/21082024150728-194750097.jpg'),
(28, 'PC', 15, 10000, 1, 1, 'picture/22082024140528-2030527021.jpg'),
(29, 'Telefon', 20, 5000, 1, 1, 'picture/22082024140546-1205641533.png'),
(30, 'Cola', 100, 22, 5, 1, ''),
(31, 'Fanta', 100, 20, 5, 1, ''),
(32, 'Karpuz', 30, 20, 5, 1, ''),
(33, 'Elbise 1', 600, 600, 2, 1, ''),
(34, 'ayakkabı FX', 400, 5000, 2, 1, ''),
(35, 'Samsung tablet', 10, 6000, 1, 1, ''),
(36, 'İphone 11', 50, 19000, 1, 1, ''),
(37, 'Pantolon', 60, 1000, 2, 1, ''),
(38, 'Çorap', 100, 50, 2, 1, ''),
(39, 'Avokado', 20, 60, 3, 0, ''),
(40, 'Havuç', 20, 30, 4, 1, ''),
(41, 'Mikrodalga Fırın', 20, 5000, 6, 1, ''),
(42, 'Blender', 10, 1000, 6, 1, ''),
(43, 'Bilim Kurgu Kitabı', 30, 50, 7, 1, ''),
(44, 'Kişisel Gelişim Kitabı', 20, 60, 7, 1, ''),
(45, 'Dağ Bisikleti', 5, 15000, 9, 1, ''),
(46, 'Kamp Çadırı', 2, 10000, 9, 1, ''),
(47, 'Nemlendirici Krem', 100, 100, 8, 1, ''),
(48, 'Makyaj Seti', 30, 250, 8, 1, ''),
(49, 'Oyun Konsolu', 10, 10000, 9, 1, '');

--
-- Dökümü yapılmış tablolar için indeksler
--

--
-- Tablo için indeksler `bio`
--
ALTER TABLE `bio`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `kategoriler`
--
ALTER TABLE `kategoriler`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `kullanicilar`
--
ALTER TABLE `kullanicilar`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `sepet`
--
ALTER TABLE `sepet`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `siparis`
--
ALTER TABLE `siparis`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `siparisler`
--
ALTER TABLE `siparisler`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `urunler`
--
ALTER TABLE `urunler`
  ADD PRIMARY KEY (`id`);

--
-- Dökümü yapılmış tablolar için AUTO_INCREMENT değeri
--

--
-- Tablo için AUTO_INCREMENT değeri `bio`
--
ALTER TABLE `bio`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- Tablo için AUTO_INCREMENT değeri `kategoriler`
--
ALTER TABLE `kategoriler`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Tablo için AUTO_INCREMENT değeri `kullanicilar`
--
ALTER TABLE `kullanicilar`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=104;

--
-- Tablo için AUTO_INCREMENT değeri `sepet`
--
ALTER TABLE `sepet`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- Tablo için AUTO_INCREMENT değeri `siparis`
--
ALTER TABLE `siparis`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- Tablo için AUTO_INCREMENT değeri `siparisler`
--
ALTER TABLE `siparisler`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- Tablo için AUTO_INCREMENT değeri `urunler`
--
ALTER TABLE `urunler`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
