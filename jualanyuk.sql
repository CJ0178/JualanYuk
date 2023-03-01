-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 01 Mar 2023 pada 05.03
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
-- Struktur dari tabel `bundled`
--

CREATE TABLE `bundled` (
  `idBundle` int(11) NOT NULL,
  `itemId` int(11) NOT NULL,
  `qty` int(11) DEFAULT NULL,
  `COGS` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `bundled`
--

INSERT INTO `bundled` (`idBundle`, `itemId`, `qty`, `COGS`) VALUES
(1, 15, 50, 7200),
(1, 22, 120, 8000),
(1, 24, 200, 3200),
(1, 52, 40, 72000),
(1, 53, 240, 1333),
(1, 54, 120, 4000),
(1, 57, 200, 2400),
(1, 88, 200, 7200),
(2, 1, 50, 12000),
(2, 2, 50, 13600),
(2, 4, 60, 6000),
(2, 6, 60, 6000),
(2, 30, 120, 4000),
(2, 33, 50, 10400),
(2, 35, 80, 4000),
(2, 38, 60, 5600),
(3, 7, 50, 8800),
(3, 8, 60, 8000),
(3, 10, 120, 5000),
(3, 12, 50, 32000),
(3, 14, 60, 12000),
(3, 17, 80, 14000),
(3, 23, 200, 2400),
(3, 75, 200, 13600),
(4, 42, 240, 3466),
(4, 43, 240, 3066),
(4, 44, 120, 6400),
(4, 45, 240, 4000),
(4, 47, 120, 4000),
(4, 49, 120, 11333),
(4, 50, 240, 4000),
(4, 51, 120, 4000),
(5, 15, 50, 7200),
(5, 22, 120, 8000),
(5, 24, 200, 3200),
(5, 52, 40, 72000),
(5, 53, 240, 1333),
(5, 54, 120, 4000),
(5, 57, 200, 2400),
(5, 88, 200, 7200),
(6, 1, 50, 12000),
(6, 2, 50, 13600),
(6, 4, 60, 6000),
(6, 6, 60, 6000),
(6, 30, 120, 4000),
(6, 33, 50, 10400),
(6, 35, 80, 4000),
(6, 38, 60, 5600),
(7, 7, 50, 8800),
(7, 8, 60, 8000),
(7, 10, 120, 5000),
(7, 12, 50, 32000),
(7, 14, 60, 12000),
(7, 17, 80, 14000),
(7, 23, 200, 2400),
(7, 75, 200, 13600),
(8, 42, 240, 3466),
(8, 43, 240, 3066),
(8, 44, 120, 6400),
(8, 45, 240, 4000),
(8, 47, 120, 4000),
(8, 49, 120, 11333),
(8, 50, 240, 4000),
(8, 51, 120, 4000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `bundleh`
--

CREATE TABLE `bundleh` (
  `idBundle` int(11) NOT NULL,
  `price` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `bundleh`
--

INSERT INTO `bundleh` (`idBundle`, `price`) VALUES
(1, 9600000),
(2, 5700000),
(3, 10200000),
(4, 7700000),
(5, 7600000),
(6, 3700000),
(7, 8200000),
(8, 5700000);

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
(37, 25, 5, 9),
(38, 20, 7, 3),
(39, 20, 7, 1),
(40, 20, 7, 1),
(41, 20, 48, 3),
(42, 20, 1, 3),
(43, 20, 66, 2),
(44, 20, 1, 1),
(45, 20, 42, 1),
(46, 20, 1, 1),
(47, 20, 66, 1),
(48, 20, 66, 1),
(49, 20, 42, 1),
(50, 20, 66, 1),
(51, 20, 58, 1),
(52, 20, 20, 1),
(53, 20, 1, 1),
(54, 20, 5, 1),
(55, 20, 42, 1),
(56, 20, 58, 1),
(57, 20, 9, 1),
(58, 20, 1, 1),
(59, 20, 52, 1),
(60, 20, 7, 1),
(61, 20, 33, 1),
(62, 20, 12, 1),
(63, 20, 9, 1),
(64, 20, 9, 1),
(65, 20, 12, 51),
(66, 20, 58, 11),
(67, 20, 114, 50),
(68, 23, 55, 30),
(69, 23, 58, 1),
(70, 23, 45, 1),
(71, 23, 9, 2),
(72, 23, 13, 1),
(73, 23, 9, 2),
(74, 20, 17, 25),
(75, 20, 48, 1),
(76, 20, 8, 1),
(77, 23, 3, 25),
(78, 23, 33, 15);

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
(2, 4, 'Chitato', 50, '4.8', 10, 170000, 'chitato.png', 'Chitato snack potato terbuat dari kentang asli dengan potongan bergelombang yang hadir dalam berbagai rasa untuk memberikan pengalaman baru dalam setiap gigitannya. Keripik kentang Chitato diproses secara higienis dan modern dengan menggunakan teknologi modern. Tekstur yang renyah dan tipis ditambah dengan bumbu rempah dan perisa sapi panggang yang memberikan perpaduan rasa yang nikmat di lidah. Komposisi: Kentang (65%), minyak kelapa sawit, bumbu perasa, penguat rasa mononatrium glutamat, dinatrium inosinat dinatrium guanilat.'),
(3, 1, 'Qtela', 0, '4.0', 10, 200000, 'qtela.png', 'Qtela Keripik Singkong Original merupakan salah satu varian dari Qtela Keripik Singkong yang terbuat dari singkong pilihan. Qtela Keripik Singkong diolah dan diproses secara modern dan higienis untuk hasilkan camilan keripik berkualitas dengan cita rasa istimewa serta dipadukan dengan bumbu bumbu berkualitas sehingga menjadikan Qtela sangat renyah dan nikmat. Komposisi: Kentang, minyak kelapa sawit (mengandung antioksidan TBHQ), amonium bikarbonat , bumbu perasa, pewarna makanan (ponceau 4RC CI-16255 kuning FCF CI 15985).'),
(4, 2, 'Cimory', 90, '3.8', 12, 90000, 'cimory.png', 'Cimory terbuat dari susu segar dan hanya bahan-bahan terbaik yang diproses menggunakan standar proses yang canggih. Cimory mengandung nutrisi baik yang penting, yaitu protein, karbohidrat, vitamin dan berbagai mineral seperti kalsium, fosfor, magnesium dan seng. Cimory dianjurkan untuk dikonsumsi setiap hari karena melengkapi kebutuhan asupan nutrisi harian dan juga baik untuk pertumbuhan Anda, cocok untuk anak-anak dan orang dewasa. Komposisi dari Cimory adalah Susu sapi segar (51%), air, gula, susu skim bubuk, susu bubuk full krim, penstabil nabati, sari buah leci (0.1%,) perisa sintetik leci, kultur Streptococcus thermophilus dan Lactobacillus delbrueckii subsp bulgaricus.'),
(5, 2, 'Cap Badak', 45, '4.2', 12, 80000, 'capbadak.png', 'Sinde Larutan Penyegar Cap Badak adalah larutan penyegar dalam kemasan kaleng yang dipersembahkan oleh Sinde untuk mencegah dan meredakan panas dalam. Dihasilkan dari bahan-bahan herbal dengan banyak khasiat, Larutan Penyegar dapat meminimalkan gejala panas dalam dengan efektif tanpa warna, bau, dan rasa pahit. Komposisi: Gipsum fibrosum 3.25%, galcarecus spar 0.125g, bahan-bahan lain sampai 100%.'),
(6, 2, 'FreshTea', 30, '4.3', 12, 90000, 'freshtea.png', 'Frestea Minuman Teh adalah minuman teh dalam botol yang dibuat dari daun teh pilihan yang diproses dengan higienis sehingga menghasilkan rasa teh yang benar-benar murni. Paduan teh dan rasa buah menghasilkan rasa minuman teh yang berbeda dengan minuman teh lainnya. Rasa pahit teh dan manisnya buah apel berpadu menghasilkan rasa manis yang pas. Komposisi: air, gula, daun teh melati (0.69%), perisa sintetik, pengatur keasaman (natrium bikarbonat), antioksidan (natrium askorbat), pemanis alami glikosida steviol (stevia).'),
(7, 5, 'Pepsodent', 20, '4.1', 10, 110000, 'pepsodent.png', 'Pepsodent merupakan produk pasta gigi yang dapat memberikan perlindungan selama 12 jam dalam mencegah terjadinya gigi berlubang. Hal ini dapat dilakukan dengan mengembalikan mineral gigi yang hilang dan menghasilkan lubang kecil yang tak kasat mata. Pasta gigi Pepsodent memiliki perlindungan Mikro Kalsium Aktif yang membantu memperbaiki lubang kecil tak kasat mata, dan Pro-Fluride Kompleks yang melindungi gigi lebih lama. Komposisi : Calcium carbonate, water, sorbitol, hydrated silica, sodium lauryl sulfate, soidum monoflurophosphate, flavor, cellulose gum, potassium, citrate, sodium silicate, sodium saccharin, calcium glycerophosphate, DMDM hydantoin, CI 77891.'),
(8, 5, 'Biore', 29, '3.5', 12, 120000, 'biore.png', 'Biore Body Foam Refill adalah sabun mandi cair dengan sentuhan busa lembutnya yang creamy dan melimpah, membersihkan dan menjaga kelembaban kulit sehingga kulit terasa dengan yogurt extract. Rasakan kelembutan kulit segar yang bercahaya. Tersedia dalam kemasan pouch refill. Komposisi: Water, lauric acid, potassium hydroxide, myristic acid, lauryl hydroxysultaine, glycol distearate, fragrance, cedyl glucosside, palmitic acid, laureth-6 carboxylic acid, sodium laureth sulfate, hydrocyethylcellulose, etidronic acid, BHT, algin, sodium PCA, butylene glycol, yogurt filtrate.'),
(9, 8, 'Vaseline', 14, '4.6', 10, 300000, 'vaseline.png', 'Vaseline Repairing Petroleum Jelly Original adalah repairing jelly (Petroleum Jelly Pure) yang bekerja sebagai krim kulit kering dengan cara menciptakan pembatas antarsel, sehingga mengunci kelembaban dan mempercepat proses perbaikan alami kulit, membantunya diperbaiki dari dalam. Fungsi zat occlusive-nya memungkinkan untuk memperbaiki kulit kering, pecah-pecah, luka gores kecil, kulit mengelupas, penghilang bekas luka, dan luka bakar. Jelly cream ini bersifat non-comedogenic, sehingga tidak menyumbat pori-pori kulit atau menyebabkan komedo. Tersedia dalam kemasan jar. Komposisi: White Petrolatum Usp (100%).'),
(10, 4, 'Sunlight', 40, '5.0', 12, 75000, 'sunlight.png', 'Sunlight Sabun Cuci Piring Jeruk Nipis merupakan cairan pencuci piring dengan kekuatan lebih dari 100 jeruk nipis. Dibuat dengan ekstrak jeruk nipis asli dan paduan garam mineral alami yang mampu menghilangkan lemak membandel dan menghilangkan bakteri. Formula barunya mampu membersihkan lemak membandel lebih cepat, bahkan pada piring atau alat memasak berbahan plastik sekalipun. Juga lembut ditangan. Tersedia dalam kemasan pouch. Komposisi: Bahan aktif : 15% (natrium alkil benzena sulfonat, natrium lauril eter sulfat).'),
(11, 4, 'Sania', 30, '4.2', 12, 140000, 'sania.png', 'Sania Minyak Goreng Pouch adalah minyak goreng yang dihasilkan dari kelapa sawit pilihan dan diproses dengan teknologi yang mutakhir dengan pemilihan bahan baku dan rafinasi yang dilakukan dengan teliti. Proses yang baik tersebut menghasilkan minyak goreng berkualitas premium. Selain itu, minyak goreng Sania juga diproses dalam dua kali penyaringan agar tercipta minyak goreng dengan lemak tak jenuh yang tinggi. Komposisi: Minyak kelapa sawit dan vitamin A (mengandung antioksidan tokoferol).'),
(12, 9, 'MamyPoko', 10, '3.9', 10, 400000, 'mamypoko.png', 'Mamy Poko Pants Standar S adalah popok celana sekali pakai yang praktis untuk digunakan pada bayi yang aktif bergerak. Dibuat dari bahan yang lembut dengan lapisan cepat serap yang menjaga kulit bayi tetap kering sehingga jauh dari ruam popok. Desain bentuk celana baru yang pas di area perut juga menambah kenyamanan. Tak hanya itu, lapisan penahan ganda mampu mencegah bocor samping sehingga membuat bayi tetap nyaman beraktifitas. Komposisi: Non woven polypropylene, paper, pulp, polymer 29.82%, polyethylene, polyurethane, holt melt adhesive.                                '),
(13, 1, 'Beng-Beng', 99, '5.0', 20, 180000, 'beng-beng.png', 'Beng-Beng Wafer Rice Crispy Chocolate adalah makanan ringan berbentuk snack bar. Dibuat dengan menggunakan bahan bahan berkualitas yang diolah secara higienis dan menggunakan teknologi berstandar tinggi. Snack dibuat dengan beberapa lapisan, wafer vanilla yang dibalur oleh saus karamel yang manis dan nikmat, dan diberikan taburan rice crispies di atasnya untuk memberikan sensasi rasa renyah saat digigit. Dibalur kembali dengan cokelat nikmat sebagai lapisan terkakhir. Dalam sekali gigitan, berbagai lapisan rasa yang dikombinasikan bercampur menjadi satu secara nikmat. Cocok disajikan dalam kondisi dingin atau disantap secara langsung. Komposisi: Glukosa Gula, Susu Bubuk, Krispi Beras, Tepung Terigu, Lemak Nabati (mengandung Antioksidan BHA), Lemak Kakao, Kakao Massa, Maltodekstrin, Lemak Susu, Dekstrosa, Pengemulsi (Lesitin Kedelai), Garam, Bahan Pengembang, Perisa Cokelat, Vanili.'),
(14, 3, 'Rinso', 30, '4.5', 12, 180000, 'rinso.png', 'Rinso Molto Anti Noda Deterjen Bubuk Classic Fresh merupakan deterjen bubuk dengan formula yang dapat menghilangkan noda membandel dengan 1x kucek. Formulanya mudah larut dengan sempurna dalam air dan cepat menyerap ke dalam serat kain. Komposisi: Bahan aktif saat dikemas: 19% Surfaktan anionik.'),
(15, 7, 'Antis', 60, '5.0', 10, 90000, 'antis.png', 'Antis Pembersih Tangan Spray Jeruk Nipis adalah cairan pembersih tangan berbentuk cair berbasis alkohol. Dengan aroma jeruk nipis menyegarkan yang mengandung bahan aktif alkohol yang dapat bekerja cepat membunuh kuman, seperti E.coli dan S.aureus (kuman flu dan diare). Dilengkapi dengan kandungan moisturizer yang dapat melembabkan kulit sehingga tidak terasa kering setelah disemprotkan. Bahan-bahan yang terkandung didalamnya memiliki efek long lasting untuk memberikan perlindungan dari kuman selama 2 jam. Tersedia dalam kemasan botol spray. Komposisi: Bahan aktif: Irgasan DP 300: 0.1% alcohol 60% w/w.'),
(16, 8, 'Nivea', 75, '4.1', 10, 200000, 'nivea.png', 'Nivea Sun Protect & Moisture Lotion Spf 50+ dengan formula yang memberikan perlindungan maksimal terhadap sinar UVA dan UVB serta memberikan kelembaban tahan lama pada kulit. Kandungan Vitamin E memberikan kelembaban terhadap kulit dan tahan air. Komposisi: Aqua, Octocrylene, Glycerin, Titanium Dioxide, Butyl Methoxydibenzoylmethane, Butylene Glycol Dicaprylate/Dicaprate, C12-15 Alkyl Benzoate, Alcohol Denat, Bis-Ethylhexyloxyphenol Methoxyphenyl Triazine, Dicaprylyl Carbonate, Glyceryl Stearate Citrate, Panthenol, Hydrogenated Coco-Glycerides, Myristyl Myristate, Silica, Cetyl Alcohol, Phenoxyethanol, Stearyl Alcohol, VP/Hexadecene Copolymer, Ethylhexylglycerin, Methylparaben, Xanthan Gum, Dimethicone, Ethylparaben, Trisodium EDTA, Sodium Citrate, Acrylates/C10-30 Alkyl Acrylate Crosspolymer, Citric Acid, Tocopheryl Acetate, Sodium Hydroxide, Parfum.'),
(17, 3, 'Wipol', 0, '4.2', 20, 350000, 'wipol.png', 'Wipol Pembersih Lantai Karbol Cemara adalah cairan pembersih lantai yang efektif, mudah dan cepat membersihkan kuman yang menempel di seluruh penjuru lantai di setiap ruangan rumah. Setelah penggunaannya, lantai rumah akan terasa lebih higienis, bersih, kesat dan terlihat berkilau sehingga keluarga dapat nyaman bermain di lantai rumah tanpa perlu khawatir terkontaminasi kuman pembawa penyakit dan kesehatan keluarga akan selalu terjaga. Tersedia dalam kemasan pouch refill. Komposisi: Bahan Aktif : HCI 17%, pine oil (2.5%) .'),
(18, 3, 'Ekonomi', 10, '4.3', 10, 120000, 'ekonomi.png', '(text)'),
(19, 5, 'Lifebuoy', 40, '4.4', 12, 290000, 'lifebuoy.png', 'Sabun Cuci Tangan Lifebuoy Sabun Cuci Tangan Total 10 merupakan sabun cuci tangan anti bakteri yang mengandung Activ Silver Formula untuk perlindungan terhadap 10 kuman penyebab masalah kesehatan yang berevolusi semakin kuat. Mampu membersihkan tangan dengan sangat lembut dan menjaga agar tetap bersih dan terlindungi dari kuman. Dapat digunakan setiap hari untuk membunuh kuman berbahaya 99% dalam waktu 10 detik sehingga kulit tertap terawat. Memberikan perlindungan secara total dan menyeluruh pada kulit. Formula mutakhirnya terbukti melindungi dari kuman dalam 10 detik. Komposisi: Air, sodium laureth sulfate, sodium chloride, glycol distearate, cocamide MEA, parfume, citric acid, acrylate copolymer, sodium benzoat, PPG-9, tetrasodium EDTA, Sodium hydroxide, VP/VA copolymer, terpineol, pentasodiun pentetate, sodium carbonate, SILVER OXIDE, Lauric acid CI 45100.'),
(20, 2, 'Buavita', 65, '4.5', 10, 250000, 'buavita.png', 'Buavita Jus Buah Asli Jambu adalah salah satu varian jus buah jambu Buavita yang dibuat menggunakan buah alami yang dipilih berdasarkan standar kualitas Buavita untuk mendapatkan konsentrat buah yang menjadi bahan dasar minuman Buavita. Mengandung Vitamin A, B1, B2, B3, B6, juga sumber Vitamin C. Kandungan Vitamin C yang terkandung di dalamnya dapat berperan dalam membentuk dan pemeliharaan jaringan kolagen, membuat kulit senantiasa segar dan sehat. Komposisi: Air, sari buah jambu 35.5%, sukrosa, perisa identik alami jambu, penstabil nabati, garam, pewarna alami karmin CI75470, Vit C, pengatur keasaman sitrat dan Vit A (mengandung antioksidan alfa tokoferol).'),
(21, 1, 'Sari Roti', 10, '4.6', 12, 150000, 'sariroti.png', 'SARI ROTI Roti Tawar adalah roti tawar siap santap yang memiliki tekstur lembut dengan pingiran kulit luar roti yang utuh. Dibuat dengan bahan utama pilihan berkualitas seperti tepung, susu, mentega, dan ragi hingga menghasilkan roti tawar dengan kualitas yang segar dan berkualitas. Memiliki tekstur yang empuk dan lembut saat digigit. Dengan kandungan kalsium, vitamin B1 & B2, vitamin D, dan mineral didalamnya. Komposisi: Tepung terigu (mengandung gluten), air, gula pasir, lemak reroti (mengandung antioksidan askorbil palmitat dan tokoferol campur pekat), premiks roti (mengandung susu lemak nabati 0.61%), pengawet kalsium propionat, antioksidan asam askorbat, ragi, garam.'),
(22, 7, 'Minyak Angin', 15, '4.7', 20, 200000, 'minyakangin.png', 'Cap Lang Minyak Kayu Putih adalah minyak kayu putih yang dihasilkan dari kayu putih terbaik yang ada di Indonesia. Dari sumber terbaik, hadir dengan aroma yang istimewa dengan kandungan cineol yang tinggi. Kayu putih terbaik tersebut kemudian diolah dengan CPOB (Cara Pembuatan Obat yang Baik) yang distandardisasi oleh BPOM (Badan Pengawas Obat dan Makanan) dan cGMP (current Good Manufacturing Practices) berdasarkan rekomendasi WHO (World Health Organization). Membantu memberikan berbagai manfaat, seperti mengatasi kurang enak badan, menjaga tubuh tetap hangat dan nyaman, terutama pada cuaca yang dingin. Selain itu, Minyak Kayu Putih Cap Lang juga dapat meredakan perut kembung, sakit perut, mual, dan gatal-gatal karena gigitan serangga. Komposisi: Tiap ml mengandung Cajuput oil (63%), natural rhodinol (3%).'),
(23, 1, 'Indomie', 200, '4.8', 20, 60000, 'indomie.png', 'Indomie Mi Instan Goreng adalah adalah mi instan dengan varian goreng original. Dibuat dengan menggunakan tepung terigu pilihan berkualitas tinggi, yang diolah secara higienis menggunakan teknologi modern. Diperkaya dengan berbagai vitamin dan mineral yang baik untuk tubuh. Dengan bumbu yang dibuat dari rempah rempah asli kekayaan nusantara sehingga menghasilkan rasa yang khas dan kaya rasa. Komposisi: Mie: Tepung terigu, minyak nabati, tepung tapioka, garam, penstabil, pengatur keasaman, mineral (zat besi), pewarna (tartrazin CI 19140), antioksidan (TBHQ). Bumbu: Gula, garam, penguat rasa mononatrium glutamat (MSG), bubuk bawang putih, bubuk bawang bombay, perisa identik alami ayam (mengandung penguat rasa dinatrium inosinat dan guanilat), bubuk lada dan vitamin (A, B1, B6, B12, Niasin, Asam Folat, Pantotenat). Minyak: Minyak nabati dan bawang merah. Kecap Manis: Gula (mengandung sulfit), air.'),
(24, 7, 'Tolakangin', 100, '4.9', 20, 80000, 'tolakangin.png', 'SidoMuncul Tolak Angin merupakan obat herbal cair yang diformulasi untuk mengatasi gejala masuk angin seperti gejala mual, perut kembung, sakit kepala, tenggorokan kering, badan meriang, dan demam. Terbuat dari bahan-bahan alami berkhasiat, seperti madu, jahe, daun mint, cengkeh dan buah adas yang dibudidayakan dengan kontrol kualitas yang ketat, diproses dengan cara produksi yang baik dan benar serta melewati tahapan pengujian ilmiah. Selain itu, Tolak Angin hanya menggunakan esktrak zat aktif tanaman obat dengan tidak menyertakan kandungan pati (starch) yang tidak bermanfaat sehingga obat herbal cair ini tidak berwarna keruh. Komposisi: Tolak angin extract (amomi fructus, foeniculli fructus, caryophylli folium, menthae arvensis herba, zingiberis rhizoma and other ingredients), sugar, glucose and honey.'),
(25, 7, 'Panadol', 20, '5.0', 10, 110000, 'panadol.png', 'PANADOL merupakan obat dengan kandungan Paracetamol yang dapat digunakan untuk meringankan rasa sakit pada sakit kepala, sakit gigi, sakit pada otot dan menurunkan demam. Paracetamol bekerja pada pusat pengatur suhu di hipotalamus untuk menurunkan suhu tubuh (antipiretik) serta menghambat sintesis prostaglandin sehingga dapat mengurangi nyeri ringan sampai sedang (analgesik). Setiap kaplet Panadol mengandung Paracetamol 500 mg. Dewasa dan anak usia lebih dari 12 tahun : 1 - 2 kaplet, 3-4 kali sehari (Maksimum 8 kaplet dalam 24 jam). Anak-anak usia 6-11 tahun : 1/2 - 1 kaplet, 3-4 kali sehari (maksimum 4 kaplet dalam 24 jam). Minimum interval penggunaan dosis adalah 4 jam. Jangan melebihi dosis yang dianjurkan, atau menurut aturan dokter.'),
(26, 2, 'Aqua', 90, '4.0', 12, 360000, 'aqua.png', 'Aqua Galon Isi Ulang adalah air minum dalam kemasan isi ulang yang dapat diisi ulang kapan pun dibutuhkan. Kemasan ini membuatnya menjadi produk yang dapat dinikmati setiap hari di rumah tanpa perlu memasak air setiap saat. Aqua galon ini akan menjaga Anda tetap hidrasi dan sehat sepanjang hari. Komposisi: Air mineral.'),
(27, 1, 'Pronas', 10, '4.2', 10, 400000, 'pronas.png', 'Pronas Corned Beef merupakan daging kornet dalam kemasan yang diolah dari daging sapi pilihan dan diproses secara higienis menggunakan teknologi modern untuk menghasilkan kornet berkualitas dengan cita rasa istimewa. Berbeda dengan kornet lainnya yang seperti bubur daging dan terdapat campuran tepung, Pronas Corned Beef ini dibuat padat tanpa campuran tepung sehingga saat dimasak tidak berair dan lembek. Juga mengandung protein dan mineral yang bermanfaat bagi kesehatan tubuh. Komposisi: Daging sapi, terigu, protein kedelai (gula, bumbu, MSG, polifosfat, nitrit).'),
(28, 1, 'Prochiz', 45, '4.4', 20, 180000, 'prochiz.png', 'Prochiz Gold Keju Cheddar Olahan merupakan produk keju cheddar olahan yang dipersembahkan oleh Prochiz. Keju cheddar dari Prochiz dibuat hanya dengan menggunakan susu dari sapi terbaik yang kemudian melalui proses filtering untuk memastikan susu yang diproses hanya susu terbaik dari yang terbaik. Susu pilihan ini lalu melalui pemrosesan dengan mesin modern untuk dapat menghasilkan sajian keju cheddar dengan cita rasa serta aroma gurih dan asin khas dari keju cheddar. Bertekstur lembut dan padat, mudah diparut, serta memiliki parutan panjang. Komposisi: Air, keju cheddar, pengental pati modifikasi asam, minyak nabati, pengemulsi, garam, pengatur keasaman asam laktat, perisa alami keju, pengawet, susu bubuk tanpa lemak, pewarna anato CI75120.'),
(29, 9, 'Ball Toys', 60, '4.6', 20, 300000, 'bola.png', 'Ball Toys adalah bola pastik mainan untuk anak-anak untuk mandi bola. Ball Toys memiliki kulaitas yang sangat bagus dan halus sehingga tidak ada sayatan serta aman untuk digunakan oleh anak-anak ketika bermain. Ball Toys terdiri dari bola plastic mainan dengan beragam varian warna. Ball Toys memiliki bahan plastic yang aman untuk anak-anak dan sudah SNI serta tidak mudah penyok.'),
(30, 1, 'Oreo', 30, '4.4', 12, 60000, 'oreo.png', 'Oreo Biscuit Vanilla adalah makanan ringan berupa biskuit coklat isi. Dibuat menggunakan bahan-bahan pilihan berkualitas dan resep rahasia yang telah melegenda, membuat biskuit ini memiliki rasa yang lezat. Biskuit cokelat isi berwarna hitam pekat dengan isian krim vanilla di antaranya, memberikan perpaduan rasa manis yang nikmat. Memiliki tekstur biskuit yang renyah dan isian krim yang creamy menghasilkan perpaduan tekstur nikmat. Dicetak dalam bentuk bulat yang pas dalam satu gigitan. Komposisi: Gula, tepung terigu, minyak nabati (mengandung antioksidan tbhq), bubuk/serbuk coklat, sirup fruktosa, pati jagung, garam, pengembang (ammonium & natrium bikarbonat), pengemulsi (lesitin kedelai), perisa vanilla.'),
(31, 1, 'Fiesta', 40, '4.4', 12, 300000, 'fiesta.png', 'Fiesta Chicken Nugget adalah olahan ayam instan berupa nugget ayam yang hadir untuk memeriahkan kotak makan siang. Dibuat dari dada ayam cincang pilihan yang diolah secara seksama untuk menghasilkan nugget berkualitas. Hadirnya balutan tepung roti menjadikan nugget ini terasa renyah saat digigit. Komposisi: Daging ayam, minyak nabati, Tepung roti ( mengandung pewarna : tartrazine cl 19140, kuning fcf cl 15985, ponceau cl 16255, caramel ), Air, Tepung batter, Gula, Protein nabati, Bumbu-bumbu, Garam, Pati jagung, Penguat rasa ( mononatrium glutamate ), Sekuestran ( natrium tripolifosfat).'),
(32, 1, 'Good Time', 10, '4.4', 12, 120000, 'goodtime.png', 'Good Time Cookies Chocolate adalah produk Good Time Cookies yang kini hadir dengan varian rasa coklat. Kerenyahan kue kering berkualitas ditambah dengan taburan choco chips rasa coklat yang lebih banyak akan memberikan pengalaman makan yang istimewa untuk Anda dan keluarga. Perpaduan renyah dan manisnya menjadikan Good Time Cookies Chocolate pilihan yang tepat dalam berbagai kesempatan. Komposisi: Tepung terigu, cokelat chips, margarin, gula,mentega, sirup fruktosa, susu bubuk skim, sirup fruktosa, pengembang (natrium bikarbonat), telur, garam, pengemulsi (lesitin kedeleai), dan perisa identik alami vanila dan pewarna karamel.'),
(33, 1, 'Pocky', 5, '4.3', 10, 130000, 'pocky.png', 'Glico Pocky Biskuit Stick Chocolate merupakan produk biskuit dengan bentuk stik sehingga menjadikan mudah untuk dikonsumsi ngga belepotan ketika dimakan, dan ada bagian stik yang bersih tanpa terkena krim untuk memudahkan mudah digenggam dengan jari-jari tanpa khawatir takut kotor. Dengan bentuk stik juga memudahkan untuk dibagikan kepada teman atau kerabat untuk berbagi kebahagiaan bersama. Komposisi: Tepung terigu, gula, minyak nabati, kakao bubuk, margarin (mengandung antioksidan BHA & tokoferol), susu bubuk skim, susu bubuk cokelat massa, garam, perisa artifisial cokelat, pengemulsi (lesitin kedelai), pengatur keasaman (trinatrium fosfat), pengembang (natrium bikarbonat), enzim papain.'),
(34, 1, 'Lemonia', 13, '4.3', 20, 200000, 'lemonia.png', 'Nissin Lemonia Cookies adalah cemilan berbentuk biskuit nikmat. Terbuat dari bahan bahan pilihan, sehingga menghasilkan biskuit berkualitas. Diolah dengan cara dipanggang menggunakan teknologi modern pada suhu yang tepat sehingga menghasilkan biskuit krakers dengan warna kuning keemasan dan tekstur yang renyah, tanpa adanya kandungan minyak tambahan. Dicetak dalam bentuk bulat tipis, yang pas dalam sekali lahapan. Dilengkapi dengan taburan gula pasir di atasnya dan rasa lemon pada biskuit memberikan perpaduan rasa yang unik. Komposisi: Tepung terigu, gula, minyak nabati, susu bubuk, telur, kalisum karbonat, garam, pengembang (ammonium bikarbonat dan natrium bikarbonat), perisa leomn, pewarna makanan: Tartrazin (CI-19140).'),
(35, 1, 'Tango', 40, '4.3', 20, 100000, 'tango.png', 'Tango Wafer cokelat merupakan salah satu varian wafer Tango yang dibuat dengan memadukan resep rahasia original dari ahli pembuat cokelat dan bahan-bahan pilihan berkualitas untuk menghasilkan wafer renyah yang memiliki kemurniaan dan kelembutan. Nikmati kelezatan coklat premium dalam tiap lapis Tango Wafer Coklat, bersama teman dan keluarga. Rasa coklatnya yang lezat dan kemasan kaleng praktis membuat Tango Wafer Coklat mudah dibawa dan dinikmati kapan dan di mana saja. Komposisi: Tepung terigu, gula, lemak nabati, coklat bubuk, susu bubuk, pengemulsi lesitin kedelai, garam, pengembang natrium, perisa artifisial vanilla.'),
(36, 1, 'Doritos', 40, '4.2', 12, 144000, 'doritos.png', 'Doritos Barbeque adalah keripik jagung yang dibuat dari jagung asli pilihan dan diolah secara higenis dan dengan menggunakan teknologi modern untuk menghasilkan keripik jagung yang berkualitas. Rasakan ledakan rasa dari Doritos Keripik Tortilla rasa Barbeque. Rasa Barbeque kami dibuat dengan perpaduan antara rasa manis dan gurih yang sempurna yang dapat dinikmati di setiap gigitan yang renyah. Komposisi: Jagung, minyak kelapa sawit, bumbu barbekiu mengandung penguat rasa mononatrium glutamat, dinatrium inosinat, dinatrium guanilat, antioksidan asam askorbat, daging bubuk 0.1%.'),
(37, 1, 'Nabati', 50, '5.0', 12, 60000, 'nabati.png', 'Richoco Nabati Wafer Krim Cokelat  adalah snack wafer krim rasa cokelat. Dibuat menggunakan bahan bahan berkualitas yang diolah dalam pabrik yang dilengkapi dengan teknologi tinggi serta higienis. Wafer dengan tekstur renyah mengandung vitamin A, B1, B2, B6, dan B12 yang baik untuk tubuh. Dengan rasa krim cokelat dengam rasa cokelat yang kuat dan manis yang pas, serta tekstur krim cokelat yang creamy. Perpaduan krim cokelat dan wafer renyah menghasilkan rasa nikmat yang sempurna. Komposisi: Tepung terigu. Gula, minyak nabati (mengandung antioksidan TBHQ), cokelat bubuk, whey bubuk, pengemulsi lesitin kedelai, pengembang natrium bikarbonat, vitamin (A, B2, B12, E).'),
(38, 1, 'Rebo', 60, '4.2', 12, 84000, 'rebo.png', 'Rebo Kuaci Biji Bunga Matahari Original merupakan kuaci siap makan yang ideal untuk menjadi teman camilan yang seru. Dibuat dari biji bunga matahari pilihan dan paduan rempah-rempah berkualitas, serta diolah secara higienis menggunakan teknologi modern untuk menciptakan camilan kuaci yang gurih dan nikmat. Selain memiliki rasa original yang gurih, kuaci ini mengandung Vitamin E yang baik untuk kesehatan kulit. Komposisi: Biji bunga matahari, garam, perisa sintetik rempah-rempah.'),
(39, 1, 'Snickers', 70, '4.1', 10, 75000, 'snickers.png', 'Snickers Chocolate Peanut Caramel Bar adalah camilan cokelat batangan yang diproduksi oleh Mars Incorporated. Snickers terbuat dari selai kacang, nougat, kacang yang disangrai, dan karamel yang dilapisi cokelat susu. Komposisi : Gula , Sirup Glukosa , Susu Skim Bubuk , Lemak Cokelat , Cokelat Massa , Lemak Susu - Nabati , Laktosa , Garam , Pengemulsi , Putih Telur , Perisa Vanilla. (Mungkin mengandung Gluten dalam jumlah yang kecil).'),
(40, 1, 'Pringles', 80, '4.1', 20, 350000, 'pringles.png', 'Pringles Potato Crisps Original adalah salah satu varian keripik kentang Pringles. Dengan teksturnya yang tebal dan berbentuk pelana, keripik kentang ini disusun dalam sebuah tabung berlapis alumunium foil yang tertutup rapat sehingga terjaga kerenyahan dan keutuhannya. Anda akan merasakan kelezatan yang tebal dan utuh dalam setiap tabungnya. Kompossi; Kentang kerin, minyak sayuran, kanji gandum, tepung beras, maltodekstrin, garam, dekstrosa.'),
(41, 1, 'Cheetos', 40, '4.1', 20, 200000, 'cheetos.png', 'Cheetos adalah makanan ringan berteknologi modern komersial buatan Indonesia. Berupa snack ekstrudat berbahan dasar utama jagung generasi awal yang dipertahankan resepnya hingga sekarang. Beratribut lengkap BPOM RI dan Halal MUI. Rasa Jagung Bakar: cheetos rasa jagung bakar yang gurih dan enak. Komposisi: Tepung jagung (38.85%), minyak kelapa sawit, bumbu rasa keju (mengandung gandum, padatan susu, penguat rasa mononatrium glutamat, dinatrium 5 ribonukleotida, padatan keju (0.5%)), tepung jagung termodifikasi, pengemulsi kalsium karbonat, perisa identik alami keju (mengandung susu, gandum, penguat rasa dinatrium 5 ribonukleotida).'),
(42, 6, 'Pena', 60, '4.3', 12, 52000, 'pena.png', 'STANDARD Pulpen NX-7 0.38 Micro Tip Hitam adalah pulpen yang didesain unik dan menarik dalam balutan warna-warna yang cerah dan ceria. Tinta yang digunakan adalah tinta berkualitas warna hitam yang dikombinasikan dengan micro tip anti-macet. Sangat cocok untuk kebutuhan menulis hingga menggambar sederhana dimana saja.'),
(43, 6, 'Pensil', 75, '4.3', 12, 46000, 'pensil.png', 'FABER-CASTELL Pensil 2B adalah pensil yang diperkenalkan oleh Count Alexander von Faber-Castell pada tahun 1905 sebagai alat untuk menulis, menggambar dan membuat sketsa. Terbuat dari grafit murni yang direkatkan pada kayu dengan menggunakan teknologi SV Bonding sehingga pensil yang dihasilkan berkualitas tinggi, tidak mudah patah dan mudah diraut. Pensil 2B ini merupakan pensil yang memenuhi standar sebagai alat tulis yang dapat digunakan pada ujian karena kualitas guratan pensilnya dapat terbaca oleh sistem komputer.'),
(44, 6, 'Penggaris', 25, '4.3', 12, 96000, 'penggaris.png', 'Penggaris yang terbuat dari bahan plastik berkualitas, tebal dan tidak mudah patah. Dengan desain simpel yang cocok melengkapi peralatan sekolah maupun kantor. Tersedia dalam ukuran panjang 30 cm. Penggaris ini dapat memenuhi kebutuhan alat tulis. Selain itu, penggaris juga terbuat dari bahan plastik berkualitas, sehingga tidak mudah untuk patah dan aman digunakan karena tidak memiliki sisi yang tajam.'),
(45, 6, 'Penghapus', 9, '4.2', 12, 60000, 'penghapus.png', 'Pencil Eraser adalah penghapus yang digunakan untuk kebutuhan alat tulis sekolah atau kantor dan anak. Terbuat dari olahan karet yang kuat dan dibuat cukup padat dan sedikit lentur, nyaman digunakan untuk menghapus tulisan pensil yang salah dan memberikan hasil yang lebih bersih. Dirancang dalam bentuk persegi panjang cukup besar berwarna putih dan dibalut lapisan kertas tebal agar penghapus pensil ini tetap bersih dan terlindungi.'),
(46, 6, 'Jangka', 40, '4.2', 12, 120000, 'jangka.png', 'Jangka adalah alat untuk menggambar lingkaran atau busur yang digunaka untuk kebutuhan alat tulis. Alat ini juga dapat digunakan untuk mengukur jarak, terutama pada peta. Terbuat dari besi yang berkualitas, dan terdiri dari dua bagian/kaki yang dihubungkan oleh engsel dan bisa diatur pembukaannya. Salah satu kaki mempunyai jarum di ujungnya, dan pensil di kaki yang lain, atau bisa juga memakai pena.'),
(47, 6, 'Busur', 65, '4.2', 12, 60000, 'busur.png', 'Penggaris Busur Derajat Butterfly Protactor merupakan alat yang digunakan untuk mengukur barang berukuran sedang dan kecil. Penggaris busur ini berbentuk setengah lingkaran dengan sebuah lubang kecil yang dinamakan titik tengah, titik ini terletak di tengah pinggiran busur yang rata.'),
(48, 6, 'Krayon', 9, '4.1', 12, 180000, 'krayon.png', 'Krayon yang banyak digunakan oleh anak-anak dan bahkan orang dewasa. Pilihan warna yang menarik, aman digunakan bagi balita maupun anak-anak karena tidak mengandung toxic/racun yang sangat berbahaya menjadikan crayon joyko oil pastel menjadi produk pilihan yang sangat berkualitas. Crayon joyko oil pastel adalah pilihan yang terbaik bagi anak-anak bahkan balita yang baru saja akan belajar mewarnai dan menggambar.'),
(49, 6, 'Stapler', 10, '4.1', 12, 170000, 'stapler.png', 'KENKO Stapler HD-10 dapat melengkapi alat tulis Anda. Stapler persembahan KENKO ini hadir untuk membantu Anda dalam menyatukan lembaran kertas secara kuat. Didesain ergonomis agar nyaman digenggam, aman, dan mudah digunakan. Pada bagian ujung belakang stapler, terdapat sudut yang dapat digunakan untuk membantu melepas isi staples yang sudah terpasang di kertas. Ideal untuk kebutuhan kantor maupun pelajar.'),
(50, 6, 'Stipo', 45, '4.1', 12, 60000, 'stipo.png', 'Stipo atau Tip-Ex JOYKO merupakan alat yang digunakan untuk menghapus tulisan yang menggunakan pena. Dengan ujung tip-ex terbuat dari besi (metal tip) yang berkualitas sehingga tidak mudah berkarat. Cepat kering ketika digunakan dan hasil tip-ex halus sehingga dapat memudahkan Anda.'),
(51, 6, 'Peruncing', 60, '4.0', 12, 60000, 'peruncing.png', 'Peruncing merupakan alat untuk menghaluskan/meruncingkan ujung tulis pensil dengan mencukur bagian yang membalutnya. Terbuat dari pisau baja yang berkualitas tingg sehingga memiliki daya tahan yang lama dan pisau baja yang tajam.'),
(52, 7, 'Blackmores', 100, '4.9', 20, 1800000, 'blackmores.png', 'Blackmores Multivitamins + Minerals 30 Tablet merupakan suplemen kesehatan yang mengandung vitamin esensial dan berbagai mineral yang membantu memenuhi kebutuhan nutrisi setiap hari. Multiviitamin BLACKMORES ini juga baik untuk memelihara kesehatan dan membantu memenuhi asupan vitamin & mineral secara optimal. Multivitamin ini mengandung Vitamin B kompleks yang dapat menambah stamina. Suplemen kesehatan ini dapat dikonsumsi 1 tablet sehari setelah makan, atau sesuai petunjuk dokter. Komposisi: Ekstrak grape seed (Vitis Vinifera) setara dgn biji kering 1200 mg, Ekstrak milk thistle (Silybum marianum) setara dengan buah kering 700 mg, Selenium 13 mcg, Betakaroten 3000 mcg, Vit B1 10 mg, Vit B5 49,6 mg, Vit B6 20,6 mg, Vit B12 50 mcg, Vit C 250 mg, Natural Vit E 100 IU 67,1 mg., Zinc 5 mg, Asam folat 20 mcg.'),
(53, 7, 'Vitacimin', 20, '4.8', 12, 20000, 'vitacimin.png', 'Vitacimin Vitamin C Hisap Sweetlet 2 Tablet merupakan suplemen vitamin C berbentuk tablet hisap yang diformulasi untuk membantu memenuhi kebutuhan vitamin C. Vitacimin Orange Tablet mengandung vitamin C dosis tinggi sebanyak 500 mg pada tiap tabletnya. Komposisi: Acidum Ascorbicum (vitamin C) 250 mg, Natrii Ascorbas 281,25 mg.'),
(54, 7, 'Betadine', 50, '4.0', 12, 60000, 'betadine.png', 'BETADINE Antiseptic Solution Obat Luka merupakan cairan antiseptik berwarna merah pekat yang ampuh untuk digunakan dalam pertolongan pertama pada luka. Cairan yang mengandung povidone iodine efektif mencegah timbulnya infeksi pada luka, seperti lecet, tergores, atau teriris. BETADINE Antiseptic Solution dapat digunakan, baik untuk mengoleskan maupun kompres. Komposisi: Povidone iodine 10 %.'),
(55, 7, 'Becom Zet', 0, '3.8', 12, 100000, 'becomzet.png', 'Becom-Zet merupakan suplemen yang mengandung kombinasi antara multivitamin, mineral, dan zinc yang berfungsi sebagai Suplementasi vitamin b kompleks, vitamin C, vitamin E dan zinc. Suplementasi vitamin B kompleks, vitamin C, vitamin E dan zinc. Komposisi: Vitamin E 30 IU, Vitamin B1 15mg, Vit B2 15mg, Vit B6 20 mg, Vit B12 mcg, Asam Pantotenate 20mg, Niasin 100 mg, Vit C 750 mg, Zinc 22,5mg.'),
(56, 7, 'IM Boost', 50, '4.2', 10, 80000, 'imboost.png', 'IMBOOST Tablet adakalanya daya tahan tubuh menurun, tubuh terasa tidak bersemangat dan membutuhkan asupan agar daya tahan tubuh kembali membaik, kini imboost telah hadir untuk membantu anda meningkatkan daya tahan tubuh. Imboost adalah sejenis suplemen yang sering digunakan untuk terapi suportif agar daya tahan tubuh meningkat. Imboost mengandung Echinacea yang merupakan salah satu jenis tanaman herbal. Beberapa spesies tanaman Echinacea biasa digunakan untuk membuat obat yang diekstrak dari daun, bunga, dan akarnya. Komposisi: Echinacea purpurea herb dry extract 250 mg, Zn Picolinate 10 mg, bahan tambahan: FD&C Euroblake Brown, FD&C Red No 40.'),
(57, 7, 'Diapet', 50, '4.3', 20, 60000, 'diapet.png', 'Diapet Obat Diare adalah obat herbal yang mengandung ekstrak daun jambu biji, kunyit, buah mojokeling dan kulit buah delima yang dikemas dalam bentuk sediaan kapsul. Diapet digunakan untuk membantu mengurangi frekuensi buang air besar. Komposisi: Psidii Guajava Folium 240 mg, Curucumae Domestica Rhizoma 204 mg, Terminalia Cherbulae 64 mg, Punicae Granati Pericarpium 72 mg.'),
(58, 9, 'Plushie', 0, '4.1', 20, 1000000, 'plushie.png', 'Plushie adalah bantal multifungsi yang dapat digunakan sebagai room decor, bisa ditaruh di sofa, mobil, maupun kamar anak. Plushie ini sangat lembut dan nyaman untuk disentuh. Dapat dijadikan sebagai hadiah yang bagus untuk anak-anak.                                '),
(59, 9, 'Barbie', 20, '3.5', 12, 480000, 'barbie.png', 'Barbie Mainan Boneka adalah mainan boneka Barbie yang diciptakan khusus untuk anak perempuan berusia 3 tahun ke atas. Terbuat dari bahan boneka yang baik untuk menemani anak bermain. Rupanya yang cantik dengan pakaian dress bunga-bunga sangat menarik perhatian buah hati anda untuk menikmati masa kanak-kanaknya dengan gembira. Anda juga dapat menemaninya bermain sambil mengenali pertumbuhan anak anda sendiri. Selain dijadikan permainan, boneka Barbie ini juga dapat dijadikan hiasan di rumah untuk anda yang penyuka Barbie.'),
(60, 9, 'Dancow', 20, '4.6', 12, 1200000, 'dancow.png', 'DANCOW 3+ Nutritods, Susu Bubuk yang diformulasi khusus untuk Anak Indonesia di masa Prasekolah usia 3-5 tahun. Mengandung 0 gram Sukrosa & nutrisi untuk bantu tumbuh kembang Si Buah Hati. Dilengkapi juga dengan manfaat perlindungan Lactobacillus rhamnosus, tinggi zat besi & zink, Minyak Ikan, Omega 3 & 6, serta Tinggi Vitamin A & C untuk lindungi proses belajar dan eksplorasi Si Buah Hati di masa Prasekolah. Komposisi: Padatan susu (susu bubuk skim, susu sapi, lemak susu) ,Laktosa, Campuran minyak nabati (Mengandung antioksidan askorbil palmitat), Serat pangan, Madu 4%, premiks mineral dan 3 mineral, Pengemulsi lesitin kedelai, Premiks vitamin, Bubuk krim,  Perisa sintetik, Minyak ikan (mengandung antioksidan tokoferol), Lactobacillus rhamnosus NCC 4007.'),
(61, 9, 'Puzzle', 30, '5.0', 12, 300000, 'puzzle.png', 'Puzzle merupakan permainan dengan cara menyusun gambar. Pada permainan yang satu ini anak dilatih untuk mengingat sebuah bentuk gambar, kemudian menyusunnya kembali dengan tepat. Proses ini juga akan membantu anak untuk mengingat & menyusun kembali bentuk dari puzzle. Mainan puzzle mampu melatih kesabaran anak. Menggabungkan potongan-potongan dari puzzle membutuhkan kesabaran khusus pada seorang anak. Bermain puzzle juga menuntut anak untuk lebih sabar & mau berlatih untuk dapat berproses agar mencapai satu tujuannya. Mainan ini sangat cocok untuk melatih dan mengembangkan bakat motorik dan kognitif.'),
(62, 9, 'Lego', 30, '4.2', 12, 2000000, 'lego.png', 'Lego adalah sejenis alat permainan bongkah plastik kecil yang terkenal di dunia khususnya di kalangan anak-anak atau remaja tidak pandang lelaki ataupun perempuan. Bongkah-bongkah ini serta kepingan lain bisa disusun menjadi model apa saja. Melalui Lego anak dapat mengasah kreativitasnya melalui cara bermainnya dengan menyusun balok demi balok menjadi bentuk tertentu. Kegiatan menyusun Lego ini bertujuan untuk mencurahkan kreativitas mulai dari bentuk yang sederhana seperti kue hingga melampiaskan hasrat kreativitas anak yang sangat beragam.'),
(63, 9, 'Lactogrow', 40, '3.9', 12, 1500000, 'lactogrow.png', 'Susu bubuk rasa vanila untuk anak usia 1-3 tahun. Diperkaya dengan 13 vitamin, 7 mineral, kalsium, omega 3 & 6, minyak ikan, dan Lactobacillus reuteri untuk dukung pertumbuhan si Kecil. Dengan 13 vitamin & 7 mineral diantaranya, sumber zat Besi merupakan komponen hemoglobin dalam sel darah merah yang membawa oksigen ke seluruh bagian tubuh. Tinggi Vitamin C untuk membantu penyerapan zat besi. Tinggi kalsium & vitamin D dan sumber protein, kalsium membantu dalam pembentukan & mempertahankan kepadatan tulang dan gigi. Vitamin D membantu penyerapan kalsium. Protein merupakan salah satu komponen esensial dalam pertumbuhan & perkembangan anak. Mengandung minyak ikan & omega 3 & 6. Dengan Minyak Ikan 0.15%, Omega 3 (Asam alfa Linolenat) 79 mg/saji, Omega 6 (Asam Linoleat) 778 mg/saji.'),
(64, 9, 'Block', 40, '5.0', 12, 700000, 'block.png', 'Block adalah sejenis alat permainan bongkah plastik kecil. Bongkah-bongkah ini serta kepingan lain bisa disusun menjadi model apa saja. Melalui Block anak dapat mengasah kreativitasnya melalui cara bermainnya dengan menyusun balok demi balok menjadi bentuk tertentu. Kegiatan menyusun Block ini bertujuan untuk mencurahkan kreativitas anak.'),
(65, 9, 'Primamil', 40, '4.5', 12, 1000000, 'primamil.png', 'FRISIAN BABY Primamil Susu Formula Bayi 0-6 Bulan 360 g adalah susu formula awal untuk bayi usia 0-6 bulan sebagai pengganti Air Susu Ibu bila terdapat indikasi medis, kondisi dimana ibu tidak ada atau ibu terpisah dari bayi. Dengan PRIMANUTRI, tambahan nutrisi untuk mendukung pertumbuhan fisik dan otak bayi. Hadir dengan kandungan nutrisi lengkap, seperti laktosa, whey yang didemineralisasi, tanpa sukrosa, karbohidrat, protein, lemak, omega 3, omega 6, AA, DHA, asam sialat, beta karoten, vitamin D3, serat pangan FOS serta 28 vitamin dan mineral.'),
(66, 8, 'Mediheal', 20, '5.0', 12, 120000, 'mediheal.png', 'Watermide Essential Mask untuk efek menghidrasi kulit dengan optimal dengan 10.000ppm Deep Sea Water. Masker esensial yang diformulasikan dengan 3x Water Active yaitu Sea Water, Aqua Seal, Glyceryl Glucoside yang efektif untuk menghidrasi dan melembapkan kulit kering dan HydrodeeperTM,  kandungan patent ekslusif dari Mediheal yang membantu memaksimalkan efek melembapkan &  penyerapan formula. Kandungan yang cocok untuk kulit sensitif dan lembut di kulit karena didukung dengan : Formula 1-2 EWG Green Grade, Dermatologically tested, Bahan sheet mask yang Hypollergenic & biodegradable'),
(67, 8, 'Liptint', 30, '4.1', 12, 200000, 'liptint.png', 'Lip tint adalah produk pewarna bibir yang dipopulerkan Korean beauty ke seluruh dunia. Anda yang menyukai pewarna bibir dengan sensasi ringan di bibir mungkin sudah akrab dengan produk yang satu ini. Lip tint adalah pewarna bibir yang dapat memberikan warna natural, bahkan ada yang menyerupai warna alami bibir. Lip tint termasuk salah satu produk kosmetik yang serupa dengan lipstik alias bisa memberikan warna pada bibir. Namun, bedanya dengan lipstik, lip tint tidak terlalu intens saat dipakai pada bibir.'),
(68, 8, 'Lipstick', 30, '4.2', 12, 250000, 'lipstick.png', 'Lipstik adalah jenis yang dilekatkan pada bibir dan melapisi selaput yang kering. Dengan berbagai macam sentuhan lipstik guna meningkatkan estetika dala tata rias wajah. Manfaat lipstik dijadikan sebagai pewarna yang membuat bibir tampak lebih indah dan merona. Lipstik juga tersedia dalam berbagai macam warna yang bisa dipilih sendiri sesuai dengan kebutuhan.'),
(69, 8, 'Himalaya', 15, '4.3', 10, 300000, 'lipbalm.png', 'Himalaya skincare merupakan perawatan kecantikan yang saat ini banyak digunakan oleh masyarakat. Produk tersebut memiliki banyak varian mulai dari skincare, obat herbal, hingga produk untuk bayi. Himalaya mengeluarkan produk yang khusus digunakan untuk kamu yang memiliki masalah jerawat. Produk ini mengunggulkan tanaman neem yang jadi bahan baku pembuatan skincare dan bahan herbal. Tanaman tersebut dapat mengatasi berbagai permasalahan kulit.'),
(70, 8, 'Wardah', 25, '4.4', 20, 320000, 'wardah.png', 'Wardah Lightening Micellar Gentle Wash, inovasi baru pembersih wajah dengan Non Soap Formula, bersihkan wajah dengan lembut sekaligus jaga kelembaban kulit tanpa meninggalkan kesan kesat. Dengan Teknologi Micellar, angkat minyak dan kotoran pada wajah dengan bersih. Cocok untuk kulit normal - kering. Wajah cerah, bersih, tanpa rasa kesat.'),
(71, 8, 'Purbasari', 60, '4.5', 20, 280000, 'purbasari.png', 'Purbasari Clean Face Micellar Water 3in1 for Normal Skin [100 mL] adalah produk pembersih yang sesuai untuk kulit remaja, dilengakapi dengan vitamin C untuk mencerahkan kulit. Micellar partikel yang dengan cepat mebersihkan wajah tanpa lengket. Bermanfaat untuk Membersihkan make up pada wajah. Cara pemakaian : Tuangkan secukupnya pada kapas lalu usapkan pada wajah secara menyeluruh.'),
(72, 8, 'Sariayu', 35, '4.6', 10, 150000, 'sariayu.png', 'Sabun wajah untuk membantu merawat kulit berjerawat tanpa membuat kulit menjadi kering dan iritasi. Mengandung ekstrak Pegagan dan bahan lainnya untuk membantu mengurangi jerawat, serta Cananga Oil sebagai aromaterapi yang aromanya memberikan ketenangan. Produk ini juga diperkaya dengan kandungan minyak kenanga yang berfungsi sebagai aromaterapi yang aromanya memberikan ketenangan. Teksturnya pun nggak terlalu cair. Facial Foam ini cocok untuk jenis kulit berjerawat dan berminyak.'),
(73, 8, 'Emina', 20, '4.7', 10, 140000, 'emina.png', 'Sesuai dengan nama produknya, Emina Bright Stuff Face Wash mempunyai kandungan utama yang dapat mencerahkan kulit wajah. Klaim dari produk ini adalah mencerahkan, menghidrasi, sekaligus menjaga kulit dari efek radikal bebas. Seperti adanya kandungan niacinamide yang merupakan vitamin B3 sehingga mampu untuk mencerahkan kulit wajah karena dapat memperlambat pertumbuhan melanin. Bahan lain yang dapat membuat kulit menjadi lebih cerah adalah Glycyrrhiza glabra extract atau biasa disebut sebagai licorice extract. Selain mencegah hiperpigmentasi, kandungan ini dapat mengatasi masalah kulit kusam sekaligus mengurangi iritasi dan kemerahan.'),
(74, 2, 'Pocari', 100, '4.9', 10, 150000, 'pocari.png', 'POCARI SWEAT adalah minuman isotonik sebagai pengganti cairan tubuh yang hilang setiap harinya. Komposisi POCARI SWEAT mirip dengan cairan tubuh dengan kandungan elektrolit yang seimbang, sehingga dapat diserap lebih cepat dan lebih baik dibandingkan air minum biasa, sehingga dapat mencegah terjadinya dehidrasi berat.'),
(75, 2, 'Kapal Api', 50, '4.8', 10, 170000, 'kapalapi.png', 'Kopi Kapal Api terbuat dari biji kopi pilihan dan diproses dengan mesin yang paling modern yang menghasilkan kopi berkualitas tinggi dengan Aroma terbaik dan Rasa yang enak. Kapal Api Special Mix Dibuat dari Biji kopi pilihan yang diolah dengan mesin yang paling modern dan campuran gula murni. Menjadikannya paduan spesial dari kopi dan gula. Kemasan Praktisnya, membuat kopi anda siap seduh dengan aroma kopi senikmat selera pilihan.'),
(76, 2, 'Ovaltine', 25, '4.6', 10, 160000, 'ovaltine.png', 'Ovaltine (juga dikenal sebagai Ovomaltine) adalah sebuah merek produk bumbu susu yang dibuat dengan ekstrak malt (kecuali dalam kemasan biru di Amerika Serikat), gula (kecuali di Swiss), dan whey. Sejumlah varian juga dilengkapi dengan kakao. KOMPOSISI : Gula, ekstrak malt 14%, susu bubuk full cream 14%, krimer nabati, premiks vitamin dan mineral, cokelat bubuk, sirup glukosa, bubuk whey, lemak susu, minyak nabati, perisa identik alami (cokelat, susu kental manis, vanila).'),
(77, 2, 'Sprite', 90, '4.4', 12, 90000, 'sprite.png', 'Asam dan menyegarkan, Sprite adalah minuman ringan rasa lemon dan jeruk nipis terkemuka di dunia. Minuman berkarbonasi dalam kemasan dengan rasa lemon dan jeruk nipis, hadir dalam kemasan praktis botol kecil 250ml. Nikmati kesegarannya yang maksimal dengan meminumnya ketika dingin.'),
(78, 2, 'Jahe Merah', 45, '4.5', 12, 80000, 'jahemerah.png', 'Merupakan Minuman Jahe Merah Instant 2in1 (Jahe Merah + Gula) terbuat dariJahe dan rempah-rempah pilihan dan tanpa bahan pengawet -Dikemas dengan hygienis, rapi dan praktis, merupakan pilihan mudah menikmati sari Jahe Merah asli tanpa perlu repot-repot. Rasa dan Kualitas adalah nomor satu dari ratunya minuman herbal instan yaitu SIDOWARAS. Merupakan Produsen Asli Minuman Kesehatan Homemade dari Kediri.'),
(79, 2, 'Ultra Milk', 30, '4.5', 12, 90000, 'ultramilk.png', 'Ultra Milk Merupakan susu segar alami berkualitas tinggi dengan berbagai kebaikan seluruh kandungan nutrisi didalamnya, dari mulai protein, karbohidrat, vitamin, serta berbagai macam mineral seperti kalsium, magnesium, fosfor. Menjadikan Ultra Milk Full Cream susu bernutrisi seimbang yang baik diminum sehari-hari bagi seluruh keluarga Indonesia. Selain itu, ini juga mengadung nutrisi yang baik mendukung pertumbuhan anak-anak maupun dewasa.'),
(80, 2, 'Fruit Tea', 20, '4.3', 10, 110000, 'fruittea.png', 'Fruit Tea adalah merek minuman teh rasa buah pertama di Indonesia yang diproduksi oleh PT. Sinar Sosro. Fruit Tea pertama kali diperkenalkan pada tahun 1997. Berasal dari Daun Teh Pilihan Diambil dari perkebunan milik sendiri demi menjaga kualitas teh yang bermutu. Diolah Dengan Bahan Bermutu Tinggi Diekstrak menjadi berbagai varian rasa yang menyegarkan, rasa apel, stroberi, jambu (guava), blackcurrant Dikemas Secara Higienis Kualitas selalu dijaga selama proses produksi.'),
(81, 2, 'Hydro Coco', 30, '4.5', 12, 150000, 'hydrococo.png', 'Hydro Coco merupakan minuman air kelapa yang diproduksi dengan menggunakan teknologi UHT dan aseptik. Ini membuat Hydro Coco tidak memerlukan pemanis buatan serta pengawet sehingga menjaga kualitas air kelapa di dalamnya. Manfaat Hydro Coco adalah untuk menghidrasi tubuh (terutama saat udara panas, mengalami demam atau diare), membantu menetralkan racun dalam tubuh, meningkatkan kekebalan tubuh, memenuhi nutrisi yang diperlukan oleh tubuh, serta membersihkan saluran pencernaan dari zat-zat berbahaya. Tak hanya itu, air kelapa juga bebas akan kandungan lemak sehingga aman jika dikonsumsi tiap hari.'),
(82, 2, 'Kopi Susu', 20, '4.6', 10, 300000, 'kopisusu.png', 'Kopi Susu adalah perpaduan antara kopi mantap, gula, dan susu nikmat yang diproses secara modern. Kopi komplit dalam kemasan praktis yang langsung dapat dinikmati. Seduh dengan air panas dan nikmati hari anda bersama Kopi Susu. Komposisi : kopi murni, gula dan susu.'),
(83, 2, 'Nutriboost', 40, '4.4', 12, 75000, 'nutriboost.png', 'Nutriboost Strawberry 300 ml merupakan kombinasi antara susu dengan sari buah segar kaya akan kalsium, zinc, vitamin E, vitamin B3, dan vitamin B6. Kalsium pada produk Coca-Cola Company ini akan membantu membentuk dan mempertahankan kepadatan tulang dan gigi kita.'),
(84, 2, 'Javana', 30, '4.2', 12, 140000, 'javana.png', 'Teh Javana adalah minuman dari seduhan teh asli yang begitu menyegarkan. Berawal dari daun teh segar yang dipetik dan ditambah dengan gula asli untuk rasa seduhan teh yang segar. Teh Javana mengandung teh berkualitas dan gula asli, yang dibuat menggunakan aroma lock technology yang menjaga aroma dan rasanya agar tetap segar seperti seduhan pertama. Keunggulan: Menggunakan Teh dan Gula Asli, Aroma Lock Technology: Mempertahankan Aroma & Rasa Teh Asli dalam Setiap Tegukan, Tanpa Pengawe, Cita Rasa Teh Asli Indonesia dan Keunggulan teknologi produksi Javana yang Higienis – Tanpa Sentuhan Tangan.'),
(85, 2, 'Sosro', 50, '4.5', 10, 400000, 'tehsosro.png', 'Tehbotol Sosro hanya menggunakan bahan baku asli dan alami. Daun tehnya dipetik dari perkebunan sendiri. Kemudian diolah menjadi teh wangi yaitu teh hijau yang dicampur bunga melati dan bunga gambir. Sehingga menghasilkan rasa yang unik, ke-khas-annya selalu terjaga dan terjamin kualitasnya.');
INSERT INTO `item` (`itemId`, `categoryId`, `itemName`, `itemStock`, `itemRating`, `qtyPerItem`, `buyPrice`, `itemImage`, `itemDescription`) VALUES
(86, 2, 'Luwak', 100, '5.0', 20, 180000, 'luwak.png', 'Luwak merupakan kopi putih yang terbuat dari kombinasi krimer non susu dan gula murni dengan kopi luwak pilihan, dihasilkan dari biji kopi terbaik yang hanya tumbuh di Sumatera dan pulau Jawa. White coffee dapat mengurangi risiko terkena kanker dan stroke. Minuman ini bisa membantu menurunkan berat badan dengan cara membakar lemak lebih banyak dan lebih cepat. Mencegah terjadinya kehilangan memori dan juga menjaga agar kulit tetap terlihat halus. Membuat anda bisa tetap waspada, fokus sekaligus mencegah pusing. Bisa melindungi tubuh dan juga otak. Membantu seseorang agar lebih segar dan bersemangat ketika sedang mengalami depresi. Bisa menurunkan risiko diabetes tipe 2.'),
(87, 2, 'Coca-Cola', 30, '4.5', 12, 180000, 'cocacola.png', 'COCA - COLA - Kaleng 330ml COCA-COLA Original adalah minuman berkarbonasi rasa kola, hadir dalam kemasaan kaleng kecil praktis isi 330ml. Nikmati kesegarannya yang paling enak dengan meminumnya ketika dingin.'),
(88, 2, 'Adem Sari', 60, '5.0', 10, 90000, 'ademsari.png', 'Adem Sari merupakan minuman penyejuk yang mengandung ekstrak Citrus Aurantifolia dan ekstrak Alyxia stellata. Dilengkapi juga dengan kandungan vitamin C. Digunakan untuk meredakan gejala panas dalam, sakit tenggorokan, sariawan, bibir pecah-pecah dan susah buang air besar.'),
(89, 3, 'Bayclin', 75, '4.1', 10, 200000, 'bayclin.png', 'Bayclin memutihkan, membersihkan noda serta dapat membersihkan dan menghilangkan bau. Bayclin dapat digunakan untuk memutihkan dan menghilangkan noda pada pakaian dan juga dapat digunakan untuk membersihkan kamar mandi dari jamur, membersihkan lantai, membersihkan dapur dan menghilangkan bau tak sedap di dapur.'),
(90, 3, 'Vanish', 25, '4.2', 20, 550000, 'vanish.png', 'Vanish cair penghilang noda membandel. Hilangkan noda, aman bagi warna & serat pakaian. CARA PENGGUNAAN : Sebelum pemakaian, periksa ketahanan warna dengan melakukan uji coba pada bagia kain yang tidak mencolok.'),
(91, 3, 'Harpic', 10, '4.3', 10, 120000, 'harpic.png', 'Harpic Pembersih Kamar Mandi merupakan solusi cerdas untuk Kamar Mandi bersih maksimal, higienis dan harum. Harpic Pembersih Kamar Mandi aman digunakan pada porselen kamar mandi, bak mandi, dan wastafel. Pastikan Harpic Pembersih Kamar Mandi selalu tertutup dan jauhkan dari jangkauan anak-anak.'),
(92, 3, 'Philips', 40, '4.4', 12, 320000, 'philips.png', 'Philips Lampu Essential merupakan lampu yang cerah dari merk terbaik Philips untuk berbagai ruangan di rumah, kantor atau pun sekolah Anda. Lampu Philips Essential ini memberikan tingkat kecerahan terbaik setelah Anda menyalakannya. Lampu ini pun akan membantu memastikan suasana nyaman dengan tone warna terbaik untuk waktu yang lama. Punya dimensi produk yang cukup ringkas yakni 12 x 6 x 6 cm dengan berat 0.2kg. Philips sudah dikenal dari generasi ke generasi sebagai merk elektronik yang berkualitas dan tahan lama. Tak terkecuali lampu bohlam Philips yang memang tidak diragukan lagi kualitasnya. Seluruh lini yang dihadirkan ke pembeli pastinya dalam keadaan baik dan langsung bisa digunakan. Segera beli Philips Lampu Essential terbaik di Bhinneka.'),
(93, 3, 'Alkaline', 65, '4.5', 10, 90000, 'alkaline.png', 'Bisa digunakan untuk Flash, Amaran LED, Portable Recorder, Battery Grip, dll. Type: AA. Tegangan: 1.5 Volt. Ukuran: 14 x 50 mm. Isi Per Kemasan: 2 Pcs'),
(94, 3, 'Mama Lemon', 10, '4.6', 12, 180000, 'mamalemon.png', 'Mama Lemon Ekstrak Jeruk Nipis adalah salah satu sabun cuci piring yang sangat efektif  digunakan untuk menghilangkan lemak, bau amis, dan noda membandel pada peralatan memasak atau dapur. Bahkan pencuci piring ini bisa juga digunakan untuk membersihkan peralatan memasak yang terbuat dari plastik. Dibekali dengan formula 3X Action, 3X busa lebih banyak, 3X lebih cepat membersihkan, dan 3X lebih kesat, serta terasa lembut ditangan membuatnya sangat praktis dan mudah digunakan. Karenanya, sabun cuci piring dari MAMA Lemon bisa dijadikan solusi yang tepat Anda gunakan.'),
(95, 3, 'Stella', 15, '4.7', 20, 200000, 'stella.png', 'Stella All in One - Lemon Splash merupakan pengharum ruangan yang menghadirkan keharuman sepanjang hari di rumah Anda. Gantung di tempat yang Anda inginkan untuk aroma segar yang tahan lama di rumah Anda.'),
(96, 4, 'Santan', 200, '4.8', 20, 60000, 'santan.png', 'Santan diproduksi dengan menggunakan teknologi mutakhir, dan diproses secara higienis. Produk ini memiliki proses sterilisasi tingkat tinggi untuk menjamin kualitas produk santan tersebut. Produk santan ini terbuat dari kelapa pilihan, memberikan cita rasa yang gurih pada makanan kita.'),
(97, 4, 'Pondan', 100, '4.9', 20, 110000, 'pondan.png', 'Tersedia dalam kemasan 250 g. Praktis, tinggal tambahkan telur dan air. Tepung untuk membuat pancake. Dilengkapi dengan tambahan sirup maple di dalamnya. Tepung untuk membuat pancake Praktis, tinggal tambahkan telur dan air Dilengkapi dengan tambahan sirup maple di dalamnya Tersedia dalam kemasan 250 g. Pondan Pancake Mix Original 250 g merupakan tepung olahan kue pancake. Menjadi salah satu solusi untuk membuat kue dengan lebih mudah dan praktis. Terdiri dari bubuk tepung bahan kue berkualitas yang terbuat dari tepung pilihan dan diproses secara alami. Pondan Pancake Mix Original 250 g ini cocok digunakan untuk membuat aneka kue dan makanan lainnya agar lebih nikmat dan lezat. Tersedia dengan tambahan sirup mapple di dalamnya.'),
(98, 4, 'Mayonnaise', 20, '4.4', 10, 80000, 'mayonaise.png', 'Mayonnaise merupakan produk emulsi semi padat minyak dalam air (o/w) yang dibuat dengan menambahkan bahan lain seperti garam, vinegar, gula, dll. Komposisi mayonnaise sedikitnya mengandung 65% lemak atau minyak, kuning telur, asam, dan bumbu lain. Bahan dasar utama dalam pembuatan mayonnaise adalah minyak kedelai.'),
(99, 4, 'Bango', 90, '4.0', 12, 70000, 'bango.png', 'Bango adalah kecap yang terbuat dari bahan alami pilihan. Rasa dan kualitas kecap ini tetap terjaga sejak tahun 1928. Rasa manis gurih membuat kecap Bango menjadi kecap unggulan di Indonesia. Kecap manis Bango terbuat dari gula merah, garam, air, dan kedelai hitam Mallika.'),
(100, 4, 'Sambal ABC', 10, '4.2', 10, 85000, 'sambalabc.png', 'Sangat cocok untuk melengkapi berbagai hidangan, sensasi pedasnya bikin ketagihan. KOMPOSISI : Cabai, gula, air, garam, bawang putih, pati, cuka, pengawet natrium benzoat dan natriium metabisulfit, penguat rasa mononatrium glutamat dan inosinat glutamat.'),
(101, 4, 'Garam', 45, '4.4', 20, 180000, 'garam.png', 'Secara fisik, garam adalah benda padatan berwarna putih berbentuk kristal yang merupakan kumpulan senyawa dengan kandungan terbesar Natrium Klorida (>80%) serta senyawa lainnya seperti magnesium klorida, magnesium sulfat, kalsium klorida dan lain-lain.'),
(102, 4, 'Minyak Wijen', 60, '4.6', 20, 400000, 'minyakwijen.png', 'Minyak wijen merupakan minyak nabati yang terbuat dari ekstrak biji wijen. Minyak wijen telah lama menjadi salah satu minyak yang popular untuk memasak karena rasanya yang gurih dan kandungan lemak tak jenuh di dalamnya.'),
(103, 4, 'Tropicana', 100, '4.9', 10, 150000, 'tropicana.png', 'Tropicana Slim Sweetener adalah pemanis rendah kalori yang dapat digunakan untuk berbagai jenis minuman (kopi, teh, jus, dll). Memiliki rasa manis seperti gula sehingga dapat digunakan sebagai pengganti gula pasir yang sesuai bagi diet dan diabetesi. Beli Tropicana Slim Sweetener di Apotek online K24klik dan dapatkan manfaatnya. Komposisi : Sorbitol, pemanis aspartam 42mg/sachet (ADI: 50mg/kg berat badan/hari), bubuk jagung. untuk mencegah diabetes, mengontrol asupan kalori, serta menjaga agar badan tetap ideal'),
(104, 5, 'Spons Mandi', 50, '4.8', 10, 170000, 'sponsmandi.png', 'Spons Mandi merupakan alat mandi untuk menghemat sabun cair yg kita pakai, krn akan mengasilkan busa sabun yg banyak. Besar spons sangat pas di genggaman tangan.\r\nSpesifikasi :, Mudah digunakan, Praktis, Kualitas yang baik, Busa mandi jadi melimpah, Warna nya menarik'),
(105, 5, 'Sikat Gigi', 25, '4.5', 10, 160000, 'sikatgigi.png', 'Sikat gigi adalah suatu alat pembersih untuk membersihkan gigi yang terdiri dari kepala sikat gigi, tangkai sikat gigi, bentuk bulu sikat gigi dan bulu sikat gigi yang disusun sedemikian rupa sehingga mempunyai daya pembersih sesuai dengan keadaan mulut, tanpa menimbulkan luka pada mukosa mulut.'),
(106, 5, 'Gillette', 90, '4.3', 12, 90000, 'gillete.png', 'Gillette Foamy Lemon-Lime kaya akan krim busa untuk kenyamanan bercukur, dengan wangi Lemon-Lime. Menyebar dengan mudah, setelah dibilas dengan air kulit terasa halus dan lembut dan telah dinikmati selama beberapa generasi.Komposisi : Water, Triethanolamine, Palmitic Acid, Stearic Acid, Laureth-23, Butane, Isobutane, Sodium Lauryl Sulfate, Propane, Fragrance, BHT. Manfaat: Melindungi kulit, nyaman digunakan, aroma lemon, mengurangi tingkat iritasi, mencukur dengan halus, dan kulit tetap segar.'),
(107, 5, 'Clear', 45, '4.5', 12, 80000, 'clear.png', 'Clear diformulasikan khusus dengan NUTRIUM 10, perpaduan dari Nutrisi, Vitamin, dan Mineral. Formulasinya menutrisi kulit kepala secara mendalam untuk mengembalikan nutrisi penting dan berikan perlindungan lebih lama terhadap ketombe. Tak ada ketombe, tak ada yang disembunyikan. Menghilangkan dan Mencegah Ketombe Balik. Clear Shampoo Anti Ketombe memberikan nutrisi kulit kepala secara mendalam. Selain itu juga memberikan perlindungan komplit terhadap ketombe tanpa membuat kulit kepala kering. Kandungan mentholnya memberikan sensasi dingin pada kulit kepala. Dengan pemakaian secara teratur, dapat membuat rambut indah bebas ketombe.'),
(108, 5, 'Sensodyne', 30, '4.5', 12, 90000, 'sensodyne.png', 'Sensodyne multi action merupakan pasta gigi yang mengandung bahan aktif sodium fluoride 0,221%, potassium nitrate 5%, yang digunakan untuk membantu meredakan rasa ngilu akibat gigi sensitif, dan mampu memberikan perlindungan gigi sensitif selama 24 jam dan 7 hari dan perlindungan terhadap gigi berlubang.'),
(109, 5, 'Listerine', 20, '4.1', 10, 110000, 'listerine.png', 'LISTERINE ORIGINAL LIQUID 250 ML merupakan cairan antiseptik kumur dengan rasa lebih kuat yang bermanfaat mengurangi 99.9% kuman penyebab bau mulut dan plak serta mengurangi 36% masalah gusi. Cairan ini mengandung bahan aktif Eucalyptol, Menthol, Methyl Salicylate, dan Thymol yang menjadikan nafas segar.'),
(110, 5, 'Detol', 30, '4.7', 12, 150000, 'detol.png', 'DETOL ANTISEPTIK CAIR merupakan antiseptik cair yang digunakan sebagai perlindungan dari penyakit yang disebabkan kuman. Cairan ini juga dapat digunakan untuk mempercepat penyembuhan luka, lecet, gigitan, sengatan serangga, membunuh kuman pada pakaian kotor dan sebagai disinfektan pada peralatan rumah tangga.'),
(111, 10, 'Handcream', 20, '4.6', 10, 300000, 'handcream.png', 'Dikenal juga dengan sebutan krim tangan, yaitu produk perawatan kulit bertekstur krim yang diformulasikan untuk melembutkan dan melembapkan kulit tangan. Biasanya krim tangan banyak mengandung bahan-bahan yang kaya seperti shea butter, jojoba, atau aloe vera yang bermanfaat untuk mengunci kelembapan kulit.'),
(112, 10, 'Gatsby', 40, '4.3', 12, 75000, 'gatsby.png', 'Merapikan dan mengkilatkan rambut dengan mantap serta dapat mengatur rambut kaku atau sukar diatur. Produk penata rambut tipe Pomade untuk membentuk gaya rambut Pompadour dengan efek bervolume & tahan lama. Holding power tinggi untuk membuat gaya rambut Pompadour tahan lebih lama dengan formula yang mudah dibilas.'),
(113, 10, 'Deodorant', 30, '4.2', 12, 140000, 'deodorant.png', 'Deodorant merupakan produk dirancang dengan menggunakan teknologi Motionsense yang memberikan perlindungan lebih maksimal terhadap keringat dan mengurangi bau badan. Dilengkapi juga dengan kandungan microcapsule unik yang ampuh memberikan kesegaran ketika kamu melakukan aktivitas sepanjang hari. Tanpa mengandung pewarna, deodorant ini ampuh bekerja menghilangkan bau tanpa menimbulkan noda putih pada pakaian hitam dan noda kuning pada pakaian putih.'),
(114, 10, 'Pembalut', 0, '4.8', 10, 400000, 'pembalut.png', 'Pembalut wanita dengan ekstrak daun sirih alami. Antiseptik alami dari ekstrak daun sirih dapat membantu menghambat bakteri. Pembalut Slim yang dilengkapi dengan teknologi menyerap 1 detik, menjaga permukaan tetap kering dan bebas lembap, jadi kamu bisa tetap nyaman beraktivitas sepanjang hari. Bersih Sehat Bebas Worry!'),
(115, 10, 'Sun Block', 100, '4.6', 20, 180000, 'sunblock.png', 'Sunblock adalah tabir surya yang dapat menghalau dan memantulkan sinar matahari dari kulit. Berkat kandungan titanium dioksida atau seng oksida di dalamnya, sunblock dinilai efektif melindungi kedua jenis ultraviolet, yaitu UVA dan UVB.'),
(116, 10, 'Body Mist', 30, '4.5', 12, 180000, 'bodymist.png', 'Body mist adalah pewangi tubuh dalam bentuk spray yang memiliki konsentrasi essential oil di dalamnya, serta perpaduan air dan alkohol. Body mist memiliki aroma yang sangat ringan dan tidak menyengat, sehingga cocok untuk pemakaian sehari-hari.'),
(117, 10, 'Tisu Basah', 60, '4.9', 10, 90000, 'tisubasah.png', 'Tisu basah atau juga dikenal dengan handuk basah dan tisu bayi dalam keadaan tertentu adalah sepotong kertas atau kain plastik kecil yang dibasahi. Tisu basah dipakai untuk tujuan pembersihan seperti higenitas pribadi dan pembersihan rumah tangga.'),
(118, 10, 'Perfume', 75, '4.2', 10, 200000, 'perfume.png', 'Parfum atau minyak wangi adalah campuran minyak esensial dan senyawa aroma, fiksatif, dan pelarut yang digunakan untuk memberikan bau wangi untuk tubuh manusia, objek, atau ruangan.'),
(119, 10, 'Sisir Rambut', 25, '4.0', 20, 350000, 'sisirrambut.png', 'Sisir adalah sebuah alat yang dibuat dari bahan keras, biasanya berbentuk pipih, bergigi, dan digunakan untuk menata rambut, meluruskan dan membersihkannya, atau untuk digunakan untuk serat-serat lainnya.'),
(120, 10, 'Cotton Bud', 10, '4.5', 10, 120000, 'cottonbud.png', 'Cotton bud adalah spidel pendek dengan salah satu atau kedua ujungnya dilapisi kapas yang telah lama digunakan untuk keperluan kosmetik dan kebersihan pribadi, terutama untuk membersihkan telinga.');

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
(20, 1, 118, 16500, 13750),
(20, 2, 49, 14960, 13600),
(20, 3, 295, 19000, 18500),
(20, 4, 12, 6600, 6000),
(20, 5, 151, 3000, 6667),
(20, 6, 60, 6600, 6000),
(20, 7, 60, 9680, 9167),
(20, 8, 72, 8800, 8333),
(20, 9, 132, 12000, 30000),
(20, 10, 120, 5500, 5000),
(20, 12, 570, 35200, 39298),
(20, 14, 60, 13200, 12000),
(20, 15, 850, 7920, 7200),
(20, 17, 580, 15400, 17017),
(20, 19, 669, 26583, 24167),
(20, 20, 10, 27500, 25000),
(20, 22, 2040, 8800, 8000),
(20, 23, 200, 2640, 2400),
(20, 24, 3400, 3520, 3200),
(20, 25, 98, 12500, 11000),
(20, 30, 120, 4400, 4000),
(20, 33, 60, 11440, 10833),
(20, 35, 80, 4400, 4000),
(20, 38, 60, 6160, 5600),
(20, 42, 303, 3400, 3646),
(20, 43, 240, 3373, 3066),
(20, 44, 120, 7040, 6400),
(20, 45, 240, 4400, 4000),
(20, 47, 143, 5600, 4161),
(20, 48, 44, 16500, 15000),
(20, 49, 120, 12466, 11333),
(20, 50, 240, 4400, 4000),
(20, 51, 120, 4400, 4000),
(20, 52, 700, 79200, 72514),
(20, 53, 4080, 1466, 1333),
(20, 54, 2040, 4400, 4000),
(20, 57, 3400, 2640, 2400),
(20, 58, 497, 55000, 50000),
(20, 66, 60, 11000, 10000),
(20, 75, 200, 14960, 13600),
(20, 88, 3400, 7920, 7200),
(20, 114, 500, 44000, 40000),
(23, 3, 250, 22000, 20000),
(23, 9, 40, 33000, 30000),
(23, 13, 20, 9900, 9000),
(23, 20, 200, 27500, 25000),
(23, 33, 150, 14300, 13000),
(23, 42, 240, 3813, 3466),
(23, 43, 240, 3373, 3066),
(23, 44, 120, 7040, 6400),
(23, 45, 252, 4400, 4048),
(23, 47, 120, 4400, 4000),
(23, 49, 120, 12466, 11333),
(23, 50, 240, 4400, 4000),
(23, 51, 120, 4400, 4000),
(23, 55, 384, 9167, 8333),
(23, 58, 820, 55000, 50000),
(24, 9, 20, 33000, 30000),
(25, 4, 23, 8250, 7500),
(25, 5, 106, 7333, 6667),
(25, 7, 7, 12100, 11000),
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
(8, 5, 4, '2022-01-07', 20, 12000, 10000),
(9, 20, 5, '2022-12-21', 4, 6667, 7333),
(10, 20, 8, '2022-12-21', 2, 10833, 13750),
(11, 20, 19, '2022-12-21', 1, 24167, 26583),
(12, 20, 25, '2022-12-21', 2, 11000, 12100),
(13, 20, 42, '2022-12-21', 9, 4333, 4767),
(14, 20, 58, '2022-12-21', 3, 50000, 55000),
(16, 20, 5, '2022-12-21', 1, 6667, 7333),
(17, 20, 7, '2022-12-21', 13, 11000, 12100),
(19, 20, 3, '2022-12-21', 1, 18500, 17600),
(20, 20, 7, '2022-12-21', 97, 11000, 12100),
(21, 20, 8, '2022-12-21', 1, 10833, 13750),
(22, 20, 7, '2022-12-21', 1, 11000, 12100),
(23, 20, 8, '2022-12-21', 1, 10833, 13750),
(24, 20, 5, '2022-12-21', 4, 6667, 7333),
(25, 20, 7, '2022-12-21', 1, 11000, 12100),
(26, 20, 7, '2022-12-21', 95, 11000, 12100),
(27, 20, 48, '2022-12-21', 2, 15000, 16500),
(28, 20, 47, '2022-12-21', 1, 5000, 5500),
(29, 20, 48, '2022-12-21', 2, 15000, 16500),
(30, 20, 9, '2022-12-22', 1, 30000, 33000),
(31, 20, 9, '2022-12-22', 1, 30000, 33000),
(32, 20, 19, '2022-12-22', 1, 24167, 26583),
(33, 20, 3, '2022-12-23', 2, 18500, 17600),
(34, 20, 5, '2022-12-23', 7, 6667, 7333),
(35, 20, 9, '2022-12-23', 5, 30000, 33000),
(36, 20, 5, '2022-12-24', 1, 6667, 7333),
(37, 20, 9, '2022-12-24', 1, 30000, 33000),
(38, 20, 19, '2022-12-24', 1, 24167, 26583),
(39, 20, 3, '2022-12-24', 5, 18500, 17600),
(40, 25, 4, '2022-12-24', 1, 7500, 8250),
(41, 25, 5, '2022-12-24', 2, 6667, 7333),
(42, 25, 7, '2022-12-24', 3, 11000, 12100),
(43, 20, 3, '2023-01-17', 4, 18500, 19000),
(44, 20, 4, '2023-01-17', 2, 6000, 6600),
(45, 20, 3, '2023-01-18', 8, 18500, 19000),
(46, 20, 4, '2023-01-18', 1, 6000, 6600),
(48, 20, 4, '2023-01-18', 1, 6000, 6600),
(49, 20, 3, '2023-01-18', 1, 18500, 19000),
(50, 20, 4, '2023-01-18', 1, 6000, 6600),
(51, 20, 4, '2023-01-18', 1, 6000, 6600),
(52, 20, 4, '2023-01-18', 1, 6000, 6600),
(53, 20, 4, '2023-01-18', 1, 6000, 6600),
(54, 20, 4, '2023-01-18', 1, 6000, 6600),
(55, 20, 4, '2023-01-18', 1, 6000, 6600),
(56, 20, 4, '2023-01-18', 1, 6000, 6600),
(57, 20, 4, '2023-01-18', 1, 6000, 6600),
(58, 20, 4, '2023-01-18', 1, 6000, 6600),
(59, 20, 4, '2023-01-18', 1, 6000, 6600),
(60, 20, 4, '2023-01-18', 1, 6000, 6600),
(61, 20, 4, '2023-01-18', 1, 6000, 6600),
(62, 20, 4, '2023-01-18', 1, 6000, 6600),
(63, 20, 4, '2023-01-18', 1, 6000, 6600),
(64, 20, 4, '2023-01-18', 1, 6000, 6600),
(65, 20, 4, '2023-01-18', 1, 6000, 6600),
(66, 20, 4, '2023-01-18', 1, 6000, 6600),
(67, 20, 4, '2023-01-18', 1, 6000, 6600),
(68, 20, 3, '2023-01-18', 1, 18500, 19000),
(69, 20, 4, '2023-01-18', 1, 6000, 6600),
(70, 20, 4, '2023-01-18', 1, 6000, 6600),
(71, 20, 4, '2023-01-18', 1, 6000, 6600),
(72, 20, 1, '2023-01-18', 1, 13750, 16500),
(73, 20, 4, '2023-01-18', 1, 6000, 6600),
(74, 20, 3, '2023-01-18', 1, 18500, 19000),
(75, 20, 4, '2023-01-18', 2, 6000, 6600),
(76, 20, 4, '2023-01-18', 1, 6000, 6600),
(77, 20, 4, '2023-01-18', 1, 6000, 6600),
(78, 20, 4, '2023-01-18', 1, 6000, 6600),
(79, 20, 4, '2023-01-18', 1, 6000, 6600),
(80, 20, 3, '2023-01-18', 1, 18500, 19000),
(81, 20, 4, '2023-01-18', 1, 6000, 6600),
(82, 20, 4, '2023-01-18', 1, 6000, 6600),
(83, 20, 4, '2023-01-18', 1, 6000, 6600),
(84, 20, 4, '2023-01-18', 1, 6000, 6600),
(85, 20, 4, '2023-01-18', 2, 6000, 6600),
(86, 20, 4, '2023-01-18', 1, 6000, 6600),
(87, 20, 4, '2023-01-18', 1, 6000, 6600),
(88, 20, 4, '2023-01-18', 1, 6000, 6600),
(89, 20, 4, '2023-01-18', 3, 6000, 6600),
(90, 20, 4, '2023-01-18', 2, 6000, 6600),
(91, 20, 4, '2023-01-18', 1, 6000, 6600),
(92, 20, 3, '2023-01-18', 1, 18500, 19000),
(93, 20, 3, '2023-01-18', 1, 18500, 19000),
(94, 20, 4, '2023-01-18', 1, 6000, 6600),
(95, 20, 1, '2023-01-18', 1, 13750, 16500),
(96, 20, 2, '2023-01-18', 1, 13600, 14960);

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
(20, 33, 5),
(20, 66, 2);

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
-- Indeks untuk tabel `bundled`
--
ALTER TABLE `bundled`
  ADD PRIMARY KEY (`idBundle`,`itemId`),
  ADD KEY `itemId` (`itemId`);

--
-- Indeks untuk tabel `bundleh`
--
ALTER TABLE `bundleh`
  ADD PRIMARY KEY (`idBundle`);

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
  MODIFY `buyId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=79;

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
  MODIFY `sellId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=97;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `userId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `bundled`
--
ALTER TABLE `bundled`
  ADD CONSTRAINT `bundled_ibfk_1` FOREIGN KEY (`idBundle`) REFERENCES `bundleh` (`idBundle`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `bundled_ibfk_2` FOREIGN KEY (`itemId`) REFERENCES `item` (`itemId`) ON DELETE CASCADE ON UPDATE CASCADE;

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
