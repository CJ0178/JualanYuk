-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 20 Des 2022 pada 07.55
-- Versi server: 10.4.19-MariaDB
-- Versi PHP: 8.0.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `jualanyuk`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `buy`
--

CREATE TABLE `buy` (
  `buyId` int(11) NOT NULL,
  `userId` int(11) DEFAULT NULL,
  `itemId` int(11) DEFAULT NULL,
  `qty` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `buy`
--

INSERT INTO `buy` (`buyId`, `userId`, `itemId`, `qty`) VALUES
(1, 1, 1, 5),
(2, 1, 1, 5),
(3, 2, 2, 2),
(4, 3, 3, 1),
(5, 4, 9, 1),
(6, 1, 5, 2),
(7, 5, 6, 3),
(8, 5, 10, 4),
(9, 5, 10, 5),
(10, 2, 4, 2),
(12, 20, 3, 4),
(13, 20, 3, 4),
(14, 20, 8, 3),
(15, 20, 9, 5),
(16, 20, 8, 2),
(17, 20, 8, 4),
(18, 20, 7, 6),
(19, 20, 9, 6),
(20, 20, 19, 3),
(21, 20, 25, 10),
(22, 20, 5, 3),
(23, 20, 5, 8),
(24, 20, 5, 2),
(25, 20, 19, 3),
(26, 20, 19, 20),
(27, 20, 19, 30),
(28, 20, 42, 3),
(29, 20, 47, 2),
(30, 23, 55, 2),
(31, 23, 58, 40),
(32, 23, 20, 20),
(33, 24, 9, 2),
(34, 25, 25, 1),
(35, 25, 4, 2),
(36, 25, 7, 1),
(37, 25, 5, 9);

-- --------------------------------------------------------

--
-- Struktur dari tabel `cashier`
--

CREATE TABLE `cashier` (
  `userId` int(11) NOT NULL,
  `itemId` int(11) NOT NULL,
  `qty` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `category`
--

CREATE TABLE `category` (
  `categoryId` int(11) NOT NULL,
  `categoryName` varchar(100) DEFAULT NULL,
  `categoryImage` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `category`
--

INSERT INTO `category` (`categoryId`, `categoryName`, `categoryImage`) VALUES
(1, 'Makanan', 'kategori1.png'),
(2, 'Minuman', 'kategori2.png'),
(3, 'Kebutuhan Rumah', 'kategori3.png'),
(4, 'Kebutuhan Dapur', 'kategori4.png'),
(5, 'Alat Mandi', 'kategori5.png'),
(6, 'Alat Tulis', 'kategori6.png'),
(7, 'Kebutuhan Kesehatan', 'kategori7.png'),
(8, 'Kosmetik', 'kategori8.png'),
(9, 'Kebutuhan Ibu & Anak', 'kategori9.png'),
(10, 'Kebutuhan Pribadi', 'kategori10.png');

-- --------------------------------------------------------

--
-- Struktur dari tabel `item`
--

CREATE TABLE `item` (
  `itemId` int(11) NOT NULL,
  `categoryId` int(11) DEFAULT NULL,
  `itemName` varchar(100) DEFAULT NULL,
  `itemStock` int(11) DEFAULT NULL,
  `itemRating` decimal(3,1) DEFAULT NULL,
  `qtyPerItem` int(11) DEFAULT NULL,
  `buyPrice` int(11) DEFAULT NULL,
  `itemImage` varchar(100) DEFAULT NULL,
  `itemDescription` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `item`
--

INSERT INTO `item` (`itemId`, `categoryId`, `itemName`, `itemStock`, `itemRating`, `qtyPerItem`, `buyPrice`, `itemImage`, `itemDescription`) VALUES
(1, 1, 'Kusuka', 100, '4.9', 10, 150000, 'kusuka.png', 'KuSuka Keripik Singkong merupakan produk camilan keripik singkong yang dipadukan dengan varian rasa bumbu tabur. Terbuat dari singkong pilihan yang dipanen, diiris dengan ketebalan yang sama serta diolah secara modern dan higenis menghasilkan keripik singkong yang nikmat dan berkualitas. Komposisi : Singkong, minyak kelapa sawit, gula, bumbu perasa (mengandung natrium glutamat) dan garam.                                                                '),
(2, 4, 'Chitato', 50, '4.8', 10, 170000, 'chitato.png', '(text)                                                                                                '),
(3, 1, 'Qtela', 25, '4.0', 10, 200000, 'qtela.png', '(text)                                                                                                                                                                                                                                                                             '),
(4, 2, 'Cimory', 90, '3.8', 12, 90000, 'cimory.png', 'Cimory terbuat dari susu segar dan hanya bahan-bahan terbaik yang diproses menggunakan standar proses yang canggih. Cimory mengandung nutrisi baik yang penting, yaitu protein, karbohidrat, vitamin dan berbagai mineral seperti kalsium, fosfor, magnesium dan seng. Cimory dianjurkan untuk dikonsumsi setiap hari karena melengkapi kebutuhan asupan nutrisi harian dan juga baik untuk pertumbuhan Anda, cocok untuk anak-anak dan orang dewasa. Komposisi dari Cimory adalah Susu sapi segar (51%), air, gula, susu skim bubuk, susu bubuk full krim, penstabil nabati, sari buah leci (0.1%,) perisa sintetik leci, kultur Streptococcus thermophilus dan Lactobacillus delbrueckii subsp bulgaricus.'),
(5, 2, 'Cap Badak', 45, '4.2', 12, 80000, 'capbadak.png', '(text)'),
(6, 2, 'FreshTea', 30, '4.3', 12, 90000, 'freshtea.png', '(text)'),
(7, 5, 'Pepsodent', 20, '4.1', 10, 110000, 'pepsodent.png', 'Pepsodent merupakan produk pasta gigi yang dapat memberikan perlindungan selama 12 jam dalam mencegah terjadinya gigi berlubang. Hal ini dapat dilakukan dengan mengembalikan mineral gigi yang hilang dan menghasilkan lubang kecil yang tak kasat mata. Pasta gigi Pepsodent memiliki perlindungan Mikro Kalsium Aktif yang membantu memperbaiki lubang kecil tak kasat mata, dan Pro-Fluride Kompleks yang melindungi gigi lebih lama. Komposisi : Calcium carbonate, water, sorbitol, hydrated silica, sodium lauryl sulfate, soidum monoflurophosphate, flavor, cellulose gum, potassium, citrate, sodium silicate, sodium saccharin, calcium glycerophosphate, DMDM hydantoin, CI 77891.'),
(8, 5, 'Biore', 30, '3.5', 12, 120000, 'biore.png', '(text)                                '),
(9, 8, 'Vaseline', 20, '4.6', 10, 300000, 'vaseline.png', '(text)'),
(10, 4, 'Sunlight', 40, '5.0', 12, 75000, 'sunlight.png', '(text)'),
(11, 4, 'Sania', 30, '4.2', 12, 140000, 'sania.png', '(text)'),
(12, 9, 'MamyPoko', 50, '3.9', 10, 400000, 'mamypoko.png', '(text)'),
(13, 1, 'Beng-Beng', 100, '5.0', 20, 180000, 'beng-beng.png', '(text)'),
(14, 3, 'Rinso', 30, '4.5', 12, 180000, 'rinso.png', '(text)'),
(15, 7, 'Antis', 60, '5.0', 10, 90000, 'antis.png', '(text)'),
(16, 8, 'Nivea', 75, '4.1', 10, 200000, 'nivea.png', '(text)'),
(17, 3, 'Wipol', 25, '4.2', 20, 350000, 'wipol.png', '(text)'),
(18, 3, 'Ekonomi', 10, '4.3', 10, 120000, 'ekonomi.png', '(text)'),
(19, 5, 'Lifebuoy', 40, '4.4', 12, 290000, 'lifebuoy.png', '(text)'),
(20, 2, 'Buavita', 65, '4.5', 10, 250000, 'buavita.png', '(text)'),
(21, 1, 'Sari Roti', 10, '4.6', 12, 150000, 'sariroti.png', '(text)'),
(22, 7, 'Minyak Angin', 15, '4.7', 20, 200000, 'minyakangin.png', '(text)'),
(23, 1, 'Indomie', 200, '4.8', 20, 60000, 'indomie.png', '(text)'),
(24, 7, 'Tolakangin', 100, '4.9', 20, 80000, 'tolakangin.png', '(text)'),
(25, 7, 'Panadol', 20, '5.0', 10, 110000, 'panadol.png', 'PANADOL merupakan obat dengan kandungan Paracetamol yang dapat digunakan untuk meringankan rasa sakit pada sakit kepala, sakit gigi, sakit pada otot dan menurunkan demam. Paracetamol bekerja pada pusat pengatur suhu di hipotalamus untuk menurunkan suhu tubuh (antipiretik) serta menghambat sintesis prostaglandin sehingga dapat mengurangi nyeri ringan sampai sedang (analgesik). Setiap kaplet Panadol mengandung Paracetamol 500 mg. Dewasa dan anak usia lebih dari 12 tahun : 1 - 2 kaplet, 3-4 kali sehari (Maksimum 8 kaplet dalam 24 jam). Anak-anak usia 6-11 tahun : 1/2 - 1 kaplet, 3-4 kali sehari (maksimum 4 kaplet dalam 24 jam). Minimum interval penggunaan dosis adalah 4 jam. Jangan melebihi dosis yang dianjurkan, atau menurut aturan dokter.'),
(26, 2, 'Aqua', 90, '4.0', 12, 360000, 'aqua.png', '(text)'),
(27, 1, 'Pronas', 10, '4.2', 10, 400000, 'pronas.png', '(text)'),
(28, 1, 'Prochiz', 45, '4.4', 20, 180000, 'prochiz.png', '(text)'),
(29, 9, 'Ball Toys', 60, '4.6', 20, 300000, 'bola.png', '(text)'),
(30, 1, 'Oreo', 30, '4.4', 12, 60000, 'oreo.png', '(text)'),
(31, 1, 'Fiesta', 40, '4.4', 12, 300000, 'fiesta.png', '(text)'),
(32, 1, 'Good Time', 10, '4.4', 12, 120000, 'goodtime.png', '(text)'),
(33, 1, 'Pocky', 20, '4.3', 10, 130000, 'pocky.png', '(text)'),
(34, 1, 'Lemonia', 13, '4.3', 20, 200000, 'lemonia.png', '(text)'),
(35, 1, 'Tango', 40, '4.3', 20, 100000, 'tango.png', '(text)'),
(36, 1, 'Doritos', 40, '4.2', 12, 144000, 'doritos.png', '(text)'),
(37, 1, 'Nabati', 50, '5.0', 12, 60000, 'nabati.png', '(text)'),
(38, 1, 'Rebo', 60, '4.2', 12, 84000, 'rebo.png', '(text)'),
(39, 1, 'Snickers', 70, '4.1', 10, 75000, 'snickers.png', '(text)'),
(40, 1, 'Pringles', 80, '4.1', 20, 350000, 'pringles.png', '(text)'),
(41, 1, 'Cheetos', 40, '4.1', 20, 200000, 'cheetos.png', '(text)'),
(42, 6, 'Pena', 60, '4.3', 12, 52000, 'pena.png', '(text)'),
(43, 6, 'Pensil', 75, '4.3', 12, 46000, 'pensil.png', '(text)'),
(44, 6, 'Penggaris', 25, '4.3', 12, 96000, 'penggaris.png', '(text)'),
(45, 6, 'Penghapus', 10, '4.2', 12, 60000, 'penghapus.png', '(text)'),
(46, 6, 'Jangka', 40, '4.2', 12, 120000, 'jangka.png', '(text)'),
(47, 6, 'Busur', 65, '4.2', 12, 60000, 'busur.png', '(text)'),
(48, 6, 'Krayon', 10, '4.1', 12, 180000, 'krayon.png', '(text)'),
(49, 6, 'Stapler', 10, '4.1', 12, 170000, 'stapler.png', '(text)'),
(50, 6, 'Stipo', 45, '4.1', 12, 60000, 'stipo.png', '(text)'),
(51, 6, 'Peruncing', 60, '4.0', 12, 60000, 'peruncing.png', '(text)'),
(52, 7, 'Blackmores', 100, '4.9', 20, 1800000, 'blackmores.png', '(text)'),
(53, 7, 'Vitacimin', 20, '4.8', 12, 20000, 'vitacimin.png', '(text)'),
(54, 7, 'Betadine', 50, '4.0', 12, 60000, 'betadine.png', '(text)'),
(55, 7, 'Becom Zet', 30, '3.8', 12, 100000, 'becomzet.png', '(text)'),
(56, 7, 'IM Boost', 50, '4.2', 10, 80000, 'imboost.png', '(text)'),
(57, 7, 'Diapet', 50, '4.3', 20, 60000, 'diapet.png', '(text)'),
(58, 9, 'Plushie', 10, '4.1', 20, 1000000, 'plushie.png', '(text)'),
(59, 9, 'Barbie', 20, '3.5', 12, 480000, 'barbie.png', '(text)'),
(60, 9, 'Dancow', 20, '4.6', 12, 1200000, 'dancow.png', '(text)'),
(61, 9, 'Puzzle', 30, '5.0', 12, 300000, 'puzzle.png', '(text)'),
(62, 9, 'Lego', 30, '4.2', 12, 2000000, 'lego.png', '(text)'),
(63, 9, 'Lactogrow', 40, '3.9', 12, 1500000, 'lactogrow.png', '(text)'),
(64, 9, 'Block', 40, '5.0', 12, 700000, 'block.png', '(text)'),
(65, 9, 'Primamil', 40, '4.5', 12, 1000000, 'primamil.png', '(text)'),
(66, 8, 'Mediheal', 20, '5.0', 12, 120000, 'mediheal.png', '(text)'),
(67, 8, 'Liptint', 30, '4.1', 12, 200000, 'liptint.png', '(text)'),
(68, 8, 'Lipstick', 30, '4.2', 12, 250000, 'lipstick.png', '(text)'),
(69, 8, 'Himalaya', 15, '4.3', 10, 300000, 'lipbalm.png', '(text)'),
(70, 8, 'Wardah', 25, '4.4', 20, 320000, 'wardah.png', '(text)'),
(71, 8, 'Purbasari', 60, '4.5', 20, 280000, 'purbasari.png', '(text)'),
(72, 8, 'Sariayu', 35, '4.6', 10, 150000, 'sariayu.png', '(text)'),
(73, 8, 'Emina', 20, '4.7', 10, 140000, 'emina.png', '(text)'),
(74, 2, 'Pocari', 100, '4.9', 10, 150000, 'pocari.png', '(text)'),
(75, 2, 'Kapal Api', 50, '4.8', 10, 170000, 'kapalapi.png', '(text)'),
(76, 2, 'Ovaltine', 25, '4.6', 10, 160000, 'ovaltine.png', '(text)'),
(77, 2, 'Sprite', 90, '4.4', 12, 90000, 'sprite.png', '(text)'),
(78, 2, 'Jahe Merah', 45, '4.5', 12, 80000, 'jahemerah.png', '(text)'),
(79, 2, 'Ultra Milk', 30, '4.5', 12, 90000, 'ultramilk.png', '(text)'),
(80, 2, 'Fruit Tea', 20, '4.3', 10, 110000, 'fruittea.png', '(text)'),
(81, 2, 'Hydro Coco', 30, '4.5', 12, 150000, 'hydrococo.png', '(text)'),
(82, 2, 'Kopi Susu', 20, '4.6', 10, 300000, 'kopisusu.png', '(text)'),
(83, 2, 'Nutriboost', 40, '4.4', 12, 75000, 'nutriboost.png', '(text)'),
(84, 2, 'Javana', 30, '4.2', 12, 140000, 'javana.png', '(text)'),
(85, 2, 'Sosro', 50, '4.5', 10, 400000, 'tehsosro.png', '(text)'),
(86, 2, 'Luwak', 100, '5.0', 20, 180000, 'luwak.png', '(text)'),
(87, 2, 'Coca-Cola', 30, '4.5', 12, 180000, 'cocacola.png', '(text)'),
(88, 2, 'Adem Sari', 60, '5.0', 10, 90000, 'ademsari.png', '(text)'),
(89, 3, 'Bayclin', 75, '4.1', 10, 200000, 'bayclin.png', '(text)'),
(90, 3, 'Vanish', 25, '4.2', 20, 550000, 'vanish.png', '(text)'),
(91, 3, 'Harpic', 10, '4.3', 10, 120000, 'harpic.png', '(text)'),
(92, 3, 'Philips', 40, '4.4', 12, 320000, 'philips.png', '(text)'),
(93, 3, 'Alkaline', 65, '4.5', 10, 90000, 'alkaline.png', '(text)'),
(94, 3, 'Mama Lemon', 10, '4.6', 12, 180000, 'mamalemon.png', '(text)'),
(95, 3, 'Stella', 15, '4.7', 20, 200000, 'stella.png', '(text)'),
(96, 4, 'Santan', 200, '4.8', 20, 60000, 'santan.png', '(text)'),
(97, 4, 'Pondan', 100, '4.9', 20, 110000, 'pondan.png', '(text)'),
(98, 4, 'Mayonnaise', 20, '4.4', 10, 80000, 'mayonaise.png', '(text)'),
(99, 4, 'Bango', 90, '4.0', 12, 70000, 'bango.png', '(text)'),
(100, 4, 'Sambal ABC', 10, '4.2', 10, 85000, 'sambalabc.png', '(text)'),
(101, 4, 'Garam', 45, '4.4', 20, 180000, 'garam.png', '(text)'),
(102, 4, 'Minyak Wijen', 60, '4.6', 20, 400000, 'minyakwijen.png', '(text)'),
(103, 4, 'Tropicana', 100, '4.9', 10, 150000, 'tropicana.png', '(text)'),
(104, 5, 'Spons Mandi', 50, '4.8', 10, 170000, 'sponsmandi.png', '(text)'),
(105, 5, 'Sikat Gigi', 25, '4.5', 10, 160000, 'sikatgigi.png', '(text)'),
(106, 5, 'Gillette', 90, '4.3', 12, 90000, 'gillete.png', '(text)'),
(107, 5, 'Clear', 45, '4.5', 12, 80000, 'clear.png', '(text)'),
(108, 5, 'Sensodyne', 30, '4.5', 12, 90000, 'sensodyne.png', '(text)'),
(109, 5, 'Listerine', 20, '4.1', 10, 110000, 'listerine.png', '(text)'),
(110, 5, 'Detol', 30, '4.7', 12, 150000, 'detol.png', '(text)'),
(111, 10, 'Handcream', 20, '4.6', 10, 300000, 'handcream.png', '(text)'),
(112, 10, 'Gatsby', 40, '4.3', 12, 75000, 'gatsby.png', '(text)'),
(113, 10, 'Deodorant', 30, '4.2', 12, 140000, 'deodorant.png', '(text)'),
(114, 10, 'Pembalut', 50, '4.8', 10, 400000, 'pembalut.png', '(text)'),
(115, 10, 'Sun Block', 100, '4.6', 20, 180000, 'sunblock.png', '(text)'),
(116, 10, 'Body Mist', 30, '4.5', 12, 180000, 'bodymist.png', '(text)'),
(117, 10, 'Tisu Basah', 60, '4.9', 10, 90000, 'tisubasah.png', '(text)'),
(118, 10, 'Perfume', 75, '4.2', 10, 200000, 'perfume.png', '(text)'),
(119, 10, 'Sisir Rambut', 25, '4.0', 20, 350000, 'sisirrambut.png', '(text)'),
(120, 10, 'Cotton Bud', 10, '4.5', 10, 120000, 'cottonbud.png', '(text)');

-- --------------------------------------------------------

--
-- Struktur dari tabel `owns`
--

CREATE TABLE `owns` (
  `userId` int(11) NOT NULL,
  `itemId` int(11) NOT NULL,
  `qty` int(11) DEFAULT NULL,
  `sellPrice` int(11) DEFAULT NULL,
  `COGS` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `owns`
--

INSERT INTO `owns` (`userId`, `itemId`, `qty`, `sellPrice`, `COGS`) VALUES
(1, 1, 100, 17000, 15000),
(2, 1, 50, 17000, 15000),
(3, 1, 150, 18000, 15000),
(3, 8, 150, 15000, 12000),
(4, 9, 40, 50000, 30000),
(5, 4, 96, 10000, 12000),
(5, 5, 96, 10000, 12000),
(20, 3, 320, 17600, 18500),
(20, 5, 156, 7333, 6667),
(20, 7, 60, 12100, 11000),
(20, 8, 108, 13750, 10833),
(20, 9, 110, 33000, 30000),
(20, 19, 672, 26583, 24167),
(20, 25, 100, 12100, 11000),
(20, 42, 36, 4767, 4333),
(20, 47, 24, 5500, 5000),
(20, 58, 240, 55000, 50000),
(23, 20, 200, 27500, 25000),
(23, 55, 24, 9167, 8333),
(23, 58, 800, 55000, 50000),
(24, 9, 20, 33000, 30000),
(25, 4, 24, 8250, 7500),
(25, 5, 108, 7333, 6667),
(25, 7, 10, 12100, 11000),
(25, 25, 10, 12100, 11000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `sell`
--

CREATE TABLE `sell` (
  `sellId` int(11) NOT NULL,
  `userId` int(11) DEFAULT NULL,
  `itemId` int(11) DEFAULT NULL,
  `sellDate` date DEFAULT NULL,
  `qty` int(11) DEFAULT NULL,
  `COGS` int(11) DEFAULT NULL,
  `sellPrice` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `sell`
--

INSERT INTO `sell` (`sellId`, `userId`, `itemId`, `sellDate`, `qty`, `COGS`, `sellPrice`) VALUES
(1, 1, 1, '2022-01-01', 2, 15000, 17000),
(2, 1, 1, '2022-01-02', 3, 15000, 17000),
(3, 1, 1, '2022-01-02', 10, 15000, 17000),
(4, 2, 1, '2022-01-02', 5, 15000, 18000),
(5, 3, 8, '2022-01-03', 5, 12000, 15000),
(6, 4, 9, '2022-01-05', 2, 30000, 40000),
(7, 2, 1, '2022-01-07', 6, 15000, 18000),
(8, 5, 4, '2022-01-07', 20, 12000, 10000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `trolly`
--

CREATE TABLE `trolly` (
  `userId` int(11) NOT NULL,
  `itemId` int(11) NOT NULL,
  `qty` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `trolly`
--

INSERT INTO `trolly` (`userId`, `itemId`, `qty`) VALUES
(2, 1, 5),
(2, 5, 5),
(4, 9, 1),
(20, 7, 3),
(23, 58, 40);

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `userId` int(11) NOT NULL,
  `username` varchar(100) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`userId`, `username`, `password`) VALUES
(1, 'Johansen', 'deras'),
(2, 'Nicolegate', 'dewong'),
(3, 'Mikeson', 'mochi'),
(4, 'Charmender', 'charlene'),
(5, 'Steven', 'minecraft'),
(6, 'admin', '$2y$10$xF4FZCG2/xyxApVLDAmP8uwzAQrNLm2dxb3h2YOsBy1rfuXwVJWei'),
(7, 'jefferson', '$2y$10$N2EHFQKnAPmM3Wp41MdXiem7dD/H5QvzCYunIGGnoDNpetN0MMlL.'),
(9, 'jevent', '$2y$10$CYWJqADCz8H79SQ6DegDH.aLNr14966SXVaJWP/g6Jdn4ovVii2N.'),
(15, 'kucing', '$2y$10$41kYbRL4FTHA65p2rlyhI.sBh/opX9zkZNEBEBIKy3Z50u1eCuiya'),
(18, 'michael', '$2y$10$PkpxGx8yH1wXenMVbfWzNO2yxJx9ANptEgaE8EYWR.wJF0VCzqeE2'),
(19, 'nicole', '$2y$10$t2zPwgaElQwkhRPJAIiqp.oY/BrFOUylPk/Edi2zsxhqvLdE.sJJa'),
(20, 'akunBaru', '$2y$10$Lzc7NkZed4oVxjzdT5InYuRD5/zSj1hD68jMWpYcsrybrFJhOiTu.'),
(22, 'mikey', '$2y$10$p56zhgWtaJAGjeuL52YpxOBJ5H4ae1IOZExv7GIZpSQW7biPb96fS'),
(23, 'jeff', '$2y$10$U5uA.U1xmCSxeuzsSdVnwuAQtRQKNvzNKRBPYrdgTjpk8iEZ3c5Ge'),
(24, 'jeff1', '$2y$10$ED5kXVP5rr4cBvX1Zvg4beSwj39Agy65D0vaX49mDK2dg5NHp8Tja'),
(25, 'jeff2', '$2y$10$/3z9dMFp14./kO82cw0fkufCX5ffzigcGpX7xPzLcioimmhfBPlHC');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `buy`
--
ALTER TABLE `buy`
  ADD PRIMARY KEY (`buyId`),
  ADD KEY `userId` (`userId`),
  ADD KEY `itemId` (`itemId`);

--
-- Indeks untuk tabel `cashier`
--
ALTER TABLE `cashier`
  ADD PRIMARY KEY (`userId`,`itemId`),
  ADD KEY `itemId` (`itemId`);

--
-- Indeks untuk tabel `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`categoryId`);

--
-- Indeks untuk tabel `item`
--
ALTER TABLE `item`
  ADD PRIMARY KEY (`itemId`),
  ADD KEY `categoryId` (`categoryId`);

--
-- Indeks untuk tabel `owns`
--
ALTER TABLE `owns`
  ADD PRIMARY KEY (`userId`,`itemId`),
  ADD KEY `itemId` (`itemId`);

--
-- Indeks untuk tabel `sell`
--
ALTER TABLE `sell`
  ADD PRIMARY KEY (`sellId`),
  ADD KEY `userId` (`userId`),
  ADD KEY `itemId` (`itemId`);

--
-- Indeks untuk tabel `trolly`
--
ALTER TABLE `trolly`
  ADD PRIMARY KEY (`userId`,`itemId`),
  ADD KEY `itemId` (`itemId`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`userId`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `buy`
--
ALTER TABLE `buy`
  MODIFY `buyId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT untuk tabel `category`
--
ALTER TABLE `category`
  MODIFY `categoryId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `item`
--
ALTER TABLE `item`
  MODIFY `itemId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=124;

--
-- AUTO_INCREMENT untuk tabel `sell`
--
ALTER TABLE `sell`
  MODIFY `sellId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `userId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `buy`
--
ALTER TABLE `buy`
  ADD CONSTRAINT `buy_ibfk_1` FOREIGN KEY (`userId`) REFERENCES `user` (`userId`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `buy_ibfk_2` FOREIGN KEY (`itemId`) REFERENCES `item` (`itemId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `cashier`
--
ALTER TABLE `cashier`
  ADD CONSTRAINT `cashier_ibfk_1` FOREIGN KEY (`itemId`) REFERENCES `item` (`itemId`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `cashier_ibfk_2` FOREIGN KEY (`userId`) REFERENCES `user` (`userId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `item`
--
ALTER TABLE `item`
  ADD CONSTRAINT `item_ibfk_1` FOREIGN KEY (`categoryId`) REFERENCES `category` (`categoryId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `owns`
--
ALTER TABLE `owns`
  ADD CONSTRAINT `owns_ibfk_1` FOREIGN KEY (`userId`) REFERENCES `user` (`userId`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `owns_ibfk_2` FOREIGN KEY (`itemId`) REFERENCES `item` (`itemId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `sell`
--
ALTER TABLE `sell`
  ADD CONSTRAINT `sell_ibfk_1` FOREIGN KEY (`userId`) REFERENCES `user` (`userId`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `sell_ibfk_2` FOREIGN KEY (`itemId`) REFERENCES `item` (`itemId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `trolly`
--
ALTER TABLE `trolly`
  ADD CONSTRAINT `trolly_ibfk_1` FOREIGN KEY (`userId`) REFERENCES `user` (`userId`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `trolly_ibfk_2` FOREIGN KEY (`itemId`) REFERENCES `item` (`itemId`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
