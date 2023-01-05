<?php 
// Keuntungan (Omset)
// SELECT
// SUM(s.sellPrice*s.qty) AS 'revenue',
// SUM(s.qty * s.COGS) AS 'COGS',
// SUM(s.sellPrice*s.qty) - SUM(s.qty * s.COGS) AS 'income'
// FROM sell s
// JOIN item i ON i.itemId = s.itemId
// WHERE DATEDIFF('2022-12-31', s.sellDate) >= 0 AND DATEDIFF(s.sellDate, '2022-12-01') >= 0

// Produk Terlaris
// SELECT
// i.itemName as 'nama'
// FROM sell s
// JOIN item i ON i.itemId = s.itemId
// JOIN category c ON i.categoryId = c.categoryId
// WHERE DATEDIFF('2022-12-31', s.sellDate) >= 0 AND DATEDIFF(s.sellDate, '2022-12-01') >= 0
// GROUP BY i.itemId
// ORDER BY SUM(s.qty) DESC
// LIMIT 2

// Kategori Terpopuler
// SELECT
// c.categoryName as 'nama'
// FROM sell s
// JOIN item i ON i.itemId = s.itemId
// JOIN category c ON i.categoryId = c.categoryId
// WHERE DATEDIFF('2022-12-31', s.sellDate) >= 0 AND DATEDIFF(s.sellDate, '2022-12-01') >= 0
// GROUP BY c.categoryId
// ORDER BY SUM(s.qty) DESC
// LIMIT 1

// SELECT IF(DAY(DATE_ADD(CONCAT(YEAR(CURRENT_TIMESTAMP),'-01-01'), INTERVAL ((7 - WEEKDAY(CONCAT(YEAR(CURRENT_TIMESTAMP),'-01-01'))) MOD 7) DAY)) < 5,    
//           DATE_ADD(DATE_ADD(CONCAT(YEAR(CURRENT_TIMESTAMP),'-01-01'), INTERVAL ((7 - WEEKDAY(CONCAT(YEAR(CURRENT_TIMESTAMP),'-01-01'))) MOD 7) DAY), INTERVAL 50 WEEK), DATE_ADD(DATE_ADD(CONCAT(YEAR(CURRENT_TIMESTAMP),'-01-01'), INTERVAL ((7 - WEEKDAY(CONCAT(YEAR(CURRENT_TIMESTAMP),'-01-01'))) MOD 7) DAY), INTERVAL 49 WEEK)) as 'TanggalAwal', 
          
//           DATE_SUB(IF(DAY(DATE_ADD(CONCAT(YEAR(CURRENT_TIMESTAMP),'-01-01'), INTERVAL ((7 - WEEKDAY(CONCAT(YEAR(CURRENT_TIMESTAMP),'-01-01'))) MOD 7) DAY)) < 5,    
//           DATE_ADD(DATE_ADD(CONCAT(YEAR(CURRENT_TIMESTAMP),'-01-01'), INTERVAL ((7 - WEEKDAY(CONCAT(YEAR(CURRENT_TIMESTAMP),'-01-01'))) MOD 7) DAY), INTERVAL 50 WEEK), DATE_ADD(DATE_ADD(CONCAT(YEAR(CURRENT_TIMESTAMP),'-01-01'), INTERVAL ((7 - WEEKDAY(CONCAT(YEAR(CURRENT_TIMESTAMP),'-01-01'))) MOD 7) DAY), INTERVAL 49 WEEK))
//                    , INTERVAL WEEKDAY(IF(DAY(DATE_ADD(CONCAT(YEAR(CURRENT_TIMESTAMP),'-01-01'), INTERVAL ((7 - WEEKDAY(CONCAT(YEAR(CURRENT_TIMESTAMP),'-01-01'))) MOD 7) DAY)) < 5,    
//           DATE_ADD(DATE_ADD(CONCAT(YEAR(CURRENT_TIMESTAMP),'-01-01'), INTERVAL ((7 - WEEKDAY(CONCAT(YEAR(CURRENT_TIMESTAMP),'-01-01'))) MOD 7) DAY), INTERVAL 50 WEEK), DATE_ADD(DATE_ADD(CONCAT(YEAR(CURRENT_TIMESTAMP),'-01-01'), INTERVAL ((7 - WEEKDAY(CONCAT(YEAR(CURRENT_TIMESTAMP),'-01-01'))) MOD 7) DAY), INTERVAL 49 WEEK))) DAY) + INTERVAL 6 DAY as 'TanggalAkhir'


session_start();
require '../functions.php';

// Cek apakah current user sudah ada
if(isset($_SESSION["currentUserId"])){
    // Jika masuk memlalui login,
    $currentUserData = detailUser($_SESSION["currentUserId"]);
    $currentUsername = $currentUserData["username"];

    // Jika dia adalah admin, langsung lempar
    if($currentUsername == 'admin'){
        header("Location: ../editStok/editStok.php");
    }
} else{
    // Jika masuk melalui url
    redirectTo('../login/login.php');
}

// Tentukan tanggal awal dan akhir
if(isset($_GET["mode"])){
    // Generate laporan keuangan
    $mode = $_GET["mode"];
    if($mode == 'week'){
        $weekQuery = substr($_GET["session-week"],0,4);
        $weekKe = substr($_GET["session-week"], -2,2) - 1;
        
        $weekQuery .= '-01-01';
        $query = "
        SELECT IF(DAY(DATE_ADD('$weekQuery', INTERVAL ((7 - WEEKDAY('$weekQuery')) MOD 7) DAY)) < 5,    
          DATE_ADD(DATE_ADD('$weekQuery', INTERVAL ((7 - WEEKDAY('$weekQuery')) MOD 7) DAY), INTERVAL $weekKe WEEK), DATE_ADD(DATE_ADD('$weekQuery', INTERVAL ((7 - WEEKDAY('$weekQuery')) MOD 7) DAY), INTERVAL $weekKe-1 WEEK)) as 'TanggalAwal', 
          
          DATE_SUB(IF(DAY(DATE_ADD('$weekQuery', INTERVAL ((7 - WEEKDAY('$weekQuery')) MOD 7) DAY)) < 5,    
          DATE_ADD(DATE_ADD('$weekQuery', INTERVAL ((7 - WEEKDAY('$weekQuery')) MOD 7) DAY), INTERVAL $weekKe WEEK), DATE_ADD(DATE_ADD('$weekQuery', INTERVAL ((7 - WEEKDAY('$weekQuery')) MOD 7) DAY), INTERVAL $weekKe-1 WEEK))
                   , INTERVAL WEEKDAY(IF(DAY(DATE_ADD('$weekQuery', INTERVAL ((7 - WEEKDAY('$weekQuery')) MOD 7) DAY)) < 5,    
          DATE_ADD(DATE_ADD('$weekQuery', INTERVAL ((7 - WEEKDAY('$weekQuery')) MOD 7) DAY), INTERVAL $weekKe WEEK), DATE_ADD(DATE_ADD('$weekQuery', INTERVAL ((7 - WEEKDAY('$weekQuery')) MOD 7) DAY), INTERVAL $weekKe-1 WEEK))) DAY) + INTERVAL 6 DAY as 'TanggalAkhir'
        ";

        $tanggalAwal = query($query)[0]['TanggalAwal'];
        $tanggalAkhir = query($query)[0]['TanggalAkhir'];
    } else if($mode == 'month'){
        $bulanQuery = $_GET["session-month"].'-01';
        $tanggalAwal = query("SELECT DATE_ADD('$bulanQuery', INTERVAL -DAY('$bulanQuery')+1 DAY) AS awal")[0]['awal'];
        $tanggalAkhir = query("SELECT LAST_DAY('$bulanQuery') AS akhir")[0]['akhir'];

    } else if($mode == 'year'){
        $tanggalAwal = $_GET['session-year'].'-01-01';
        $tanggalAkhir = $_GET['session-year'].'-12-31';
    }
} else{
    // Mode default
    $tanggalHariIni = query("SELECT DATE(CURRENT_TIMESTAMP) as `date`")[0]['date'];

    $query = "
    SELECT IF(DAY(DATE_ADD(CONCAT(YEAR(CURRENT_TIMESTAMP),'-01-01'), INTERVAL ((7 - WEEKDAY(CONCAT(YEAR(CURRENT_TIMESTAMP),'-01-01'))) MOD 7) DAY)) < 5,    
          DATE_ADD(DATE_ADD(CONCAT(YEAR(CURRENT_TIMESTAMP),'-01-01'), INTERVAL ((7 - WEEKDAY(CONCAT(YEAR(CURRENT_TIMESTAMP),'-01-01'))) MOD 7) DAY), INTERVAL IF(DAYOFWEEK(date(CURRENT_TIMESTAMP)) = 1, WEEK(date(CURRENT_TIMESTAMP))-1,  WEEK(date(CURRENT_TIMESTAMP)))-1 WEEK), DATE_ADD(DATE_ADD(CONCAT(YEAR(CURRENT_TIMESTAMP),'-01-01'), INTERVAL ((7 - WEEKDAY(CONCAT(YEAR(CURRENT_TIMESTAMP),'-01-01'))) MOD 7) DAY), INTERVAL IF(DAYOFWEEK(date(CURRENT_TIMESTAMP)) = 1, WEEK(date(CURRENT_TIMESTAMP))-1,  WEEK(date(CURRENT_TIMESTAMP)))-2 WEEK)) as 'TanggalAwal', 
          
          DATE_SUB(IF(DAY(DATE_ADD(CONCAT(YEAR(CURRENT_TIMESTAMP),'-01-01'), INTERVAL ((7 - WEEKDAY(CONCAT(YEAR(CURRENT_TIMESTAMP),'-01-01'))) MOD 7) DAY)) < 5,    
          DATE_ADD(DATE_ADD(CONCAT(YEAR(CURRENT_TIMESTAMP),'-01-01'), INTERVAL ((7 - WEEKDAY(CONCAT(YEAR(CURRENT_TIMESTAMP),'-01-01'))) MOD 7) DAY), INTERVAL IF(DAYOFWEEK(date(CURRENT_TIMESTAMP)) = 1, WEEK(date(CURRENT_TIMESTAMP))-1,  WEEK(date(CURRENT_TIMESTAMP)))-1 WEEK), DATE_ADD(DATE_ADD(CONCAT(YEAR(CURRENT_TIMESTAMP),'-01-01'), INTERVAL ((7 - WEEKDAY(CONCAT(YEAR(CURRENT_TIMESTAMP),'-01-01'))) MOD 7) DAY), INTERVAL IF(DAYOFWEEK(date(CURRENT_TIMESTAMP)) = 1, WEEK(date(CURRENT_TIMESTAMP))-1,  WEEK(date(CURRENT_TIMESTAMP)))-2 WEEK))
                   , INTERVAL WEEKDAY(IF(DAY(DATE_ADD(CONCAT(YEAR(CURRENT_TIMESTAMP),'-01-01'), INTERVAL ((7 - WEEKDAY(CONCAT(YEAR(CURRENT_TIMESTAMP),'-01-01'))) MOD 7) DAY)) < 5,    
          DATE_ADD(DATE_ADD(CONCAT(YEAR(CURRENT_TIMESTAMP),'-01-01'), INTERVAL ((7 - WEEKDAY(CONCAT(YEAR(CURRENT_TIMESTAMP),'-01-01'))) MOD 7) DAY), INTERVAL IF(DAYOFWEEK(date(CURRENT_TIMESTAMP)) = 1, WEEK(date(CURRENT_TIMESTAMP))-1,  WEEK(date(CURRENT_TIMESTAMP)))-1 WEEK), DATE_ADD(DATE_ADD(CONCAT(YEAR(CURRENT_TIMESTAMP),'-01-01'), INTERVAL ((7 - WEEKDAY(CONCAT(YEAR(CURRENT_TIMESTAMP),'-01-01'))) MOD 7) DAY), INTERVAL IF(DAYOFWEEK(date(CURRENT_TIMESTAMP)) = 1, WEEK(date(CURRENT_TIMESTAMP))-1,  WEEK(date(CURRENT_TIMESTAMP)))-2 WEEK))) DAY) + INTERVAL 6 DAY as 'TanggalAkhir'
    ";
    $tanggalAwal = query($query)[0]['TanggalAwal'];
    $tanggalAkhir = query($query)[0]['TanggalAkhir'];
}

// Tentukan 6 indikator
$query = "
SELECT
SUM(s.sellPrice*s.qty) AS 'revenue',
SUM(s.qty * s.COGS) AS 'COGS',
SUM(s.sellPrice*s.qty) - SUM(s.qty * s.COGS) AS 'income'
FROM sell s
JOIN item i ON i.itemId = s.itemId
WHERE DATEDIFF('$tanggalAkhir', s.sellDate) >= 0 AND DATEDIFF(s.sellDate, '$tanggalAwal') >= 0
";

$queryResult = query($query)[0];
$revenue = $queryResult['revenue'];
$COGS = $queryResult['COGS'];
$income = $queryResult['income'];

$query = "
SELECT
i.itemName as 'nama'
FROM sell s
JOIN item i ON i.itemId = s.itemId
JOIN category c ON i.categoryId = c.categoryId
WHERE DATEDIFF('$tanggalAkhir', s.sellDate) >= 0 AND DATEDIFF(s.sellDate, '$tanggalAwal') >= 0
GROUP BY i.itemId
ORDER BY SUM(s.qty) DESC
LIMIT 2
";

$queryResult = query($query);
if(isset($queryResult[0]['nama'])){
    $produkTerlaris1 = $queryResult[0]['nama'];
} else{
    $produkTerlaris1 = '-';
}

if(isset($queryResult[1]['nama'])){
    $produkTerlaris2 = $queryResult[1]['nama'];
} else{
    $produkTerlaris2 = '-';
}

$query = "
SELECT
c.categoryName as 'nama'
FROM sell s
JOIN item i ON i.itemId = s.itemId
JOIN category c ON i.categoryId = c.categoryId
WHERE DATEDIFF('$tanggalAkhir', s.sellDate) >= 0 AND DATEDIFF(s.sellDate, '$tanggalAwal') >= 0
GROUP BY c.categoryId
ORDER BY SUM(s.qty) DESC
LIMIT 1
";

$kategoriTerpopuler = query($query);

if(isset($kategoriTerpopuler[0]['nama'])){
    $kategoriTerpopuler = $kategoriTerpopuler[0]['nama'];
} else{
    $kategoriTerpopuler = '-';
}

$query = "
SELECT
SUM(s.qty) as 'BanyakPenjualan'
FROM sell s
WHERE DATEDIFF('$tanggalAkhir', s.sellDate) >= 0 AND DATEDIFF(s.sellDate, '$tanggalAwal') >= 0
";

$banyakPenjualan = query($query)[0]['BanyakPenjualan'];

// Grafik
$dataPoints = array(
	array("y" => 25, "label" => "Sunday"),
	array("y" => 15, "label" => "Monday"),
	array("y" => 25, "label" => "Tuesday"),
	array("y" => 5, "label" => "Wednesday"),
	array("y" => 10, "label" => "Thursday"),
	array("y" => 0, "label" => "Friday"),
	array("y" => 20, "label" => "Saturday")
);

$begin = new DateTime( $tanggalAwal );
$end   = new DateTime( $tanggalAkhir );

$dataPoints = array();
$currentUserId = $_SESSION['currentUserId'];

for($i = $begin; $i <= $end; $i->modify('+1 day')){
    $tanggalLoop = $i->format("Y-m-d");
    $penghasilan = query("SELECT
    SUM(s.sellPrice - s.COGS)*s.qty as penghasilan
    FROM sell s
    WHERE s.sellDate = '$tanggalLoop' AND s.userId = $currentUserId")[0]['penghasilan'];
    $dataPoints[] = array("y" => $penghasilan, "label" => $tanggalLoop);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Keuangan</title>
    <link rel="stylesheet" href="../header/header.css">
    <link rel="stylesheet" href="../footer/footer.css">
    <link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet'>
    <link rel="stylesheet" href="laporanKeuangan.css">

    <script>
        window.onload = function () {
 
        var chart = new CanvasJS.Chart("grafikContainer", {
            title: {
                text: "Keuntungan <?=$tanggalAwal.' s/d '.$tanggalAkhir?>"
            },
            axisY: {
                title: "Rupiah"
            },
            data: [{
                type: "line",
                dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
            }]
        });
        chart.render();
        
        }
    </script>
</head>
<body>
    <!-- header -->
    <div class="container">
        <!-- logo -->
        <a href="../home/home.php">
            <div class="logo" style="background-image: url(../image/logo.svg) ;"></div>
        </a>

        <!-- akun -->
        <div class="namaAkun"><?= $currentUsername ?></div>

        <!-- kotak logo -->
        <div class="kotakLogo">
            <div class="keranjang">
                <a href="../keranjang/keranjang.php?id=<?=$_SESSION["currentUserId"]?>">
                <svg width="27" height="27" viewBox="0 0 27 27" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M0 2.53125C0 2.30747 0.0888949 2.09286 0.247129 1.93463C0.405362 1.77639 0.619974 1.6875 0.84375 1.6875H3.375C3.56321 1.68755 3.746 1.75053 3.8943 1.86642C4.0426 1.9823 4.14789 2.14445 4.19344 2.32706L4.87688 5.0625H24.4688C24.5926 5.06261 24.715 5.09001 24.8271 5.14274C24.9392 5.19547 25.0383 5.27225 25.1174 5.36761C25.1965 5.46297 25.2536 5.57457 25.2847 5.6945C25.3158 5.81442 25.3201 5.93972 25.2973 6.0615L22.7661 19.5615C22.7299 19.7549 22.6273 19.9295 22.476 20.0552C22.3247 20.1809 22.1342 20.2498 21.9375 20.25H6.75C6.55329 20.2498 6.36283 20.1809 6.21154 20.0552C6.06024 19.9295 5.95763 19.7549 5.92144 19.5615L3.39188 6.08681L2.71688 3.375H0.84375C0.619974 3.375 0.405362 3.28611 0.247129 3.12787C0.0888949 2.96964 0 2.75503 0 2.53125ZM5.23462 6.75L7.45031 18.5625H21.2372L23.4529 6.75H5.23462ZM8.4375 20.25C7.54239 20.25 6.68395 20.6056 6.05101 21.2385C5.41808 21.8715 5.0625 22.7299 5.0625 23.625C5.0625 24.5201 5.41808 25.3785 6.05101 26.0115C6.68395 26.6444 7.54239 27 8.4375 27C9.33261 27 10.1911 26.6444 10.824 26.0115C11.4569 25.3785 11.8125 24.5201 11.8125 23.625C11.8125 22.7299 11.4569 21.8715 10.824 21.2385C10.1911 20.6056 9.33261 20.25 8.4375 20.25ZM20.25 20.25C19.3549 20.25 18.4965 20.6056 17.8635 21.2385C17.2306 21.8715 16.875 22.7299 16.875 23.625C16.875 24.5201 17.2306 25.3785 17.8635 26.0115C18.4965 26.6444 19.3549 27 20.25 27C21.1451 27 22.0035 26.6444 22.6365 26.0115C23.2694 25.3785 23.625 24.5201 23.625 23.625C23.625 22.7299 23.2694 21.8715 22.6365 21.2385C22.0035 20.6056 21.1451 20.25 20.25 20.25ZM8.4375 21.9375C8.88505 21.9375 9.31427 22.1153 9.63074 22.4318C9.94721 22.7482 10.125 23.1774 10.125 23.625C10.125 24.0726 9.94721 24.5018 9.63074 24.8182C9.31427 25.1347 8.88505 25.3125 8.4375 25.3125C7.98995 25.3125 7.56073 25.1347 7.24426 24.8182C6.92779 24.5018 6.75 24.0726 6.75 23.625C6.75 23.1774 6.92779 22.7482 7.24426 22.4318C7.56073 22.1153 7.98995 21.9375 8.4375 21.9375ZM20.25 21.9375C20.6976 21.9375 21.1268 22.1153 21.4432 22.4318C21.7597 22.7482 21.9375 23.1774 21.9375 23.625C21.9375 24.0726 21.7597 24.5018 21.4432 24.8182C21.1268 25.1347 20.6976 25.3125 20.25 25.3125C19.8024 25.3125 19.3732 25.1347 19.0568 24.8182C18.7403 24.5018 18.5625 24.0726 18.5625 23.625C18.5625 23.1774 18.7403 22.7482 19.0568 22.4318C19.3732 22.1153 19.8024 21.9375 20.25 21.9375Z" fill="white"/>
                </svg>
                </a>               
            </div>
            <div class="logOut">
                <a href="../logout.php">
                    <svg width="20" height="24" viewBox="0 0 20 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M1.66667 23.3333H11.6667C12.1086 23.3329 12.5322 23.1572 12.8447 22.8447C13.1572 22.5322 13.3329 22.1086 13.3333 21.6667V19.1667H11.6667V21.6667H1.66667V1.66667H11.6667V4.16667H13.3333V1.66667C13.3329 1.22477 13.1572 0.801108 12.8447 0.488643C12.5322 0.176178 12.1086 0.000441231 11.6667 0H1.66667C1.22477 0.000441231 0.801108 0.176178 0.488643 0.488643C0.176178 0.801108 0.000441231 1.22477 0 1.66667V21.6667C0.000441231 22.1086 0.176178 22.5322 0.488643 22.8447C0.801108 23.1572 1.22477 23.3329 1.66667 23.3333Z" fill="white"/>
                        <path d="M13.8217 15.4884L16.81 12.5001H5V10.8334H16.81L13.8217 7.84508L15 6.66675L20 11.6667L15 16.6667L13.8217 15.4884Z" fill="white"/>
                    </svg>                                     
                </a>                             
            </div>
        </div>
    </div>

    <!-- body -->
    <div class="main">
        <div class="judul">
            <p class="tulisanJudul">LAPORAN PENJUALAN</p>
            <div class="garis10"></div>
        </div>
        <div class="kotakBawah">
            <div class="kotakJudul">
                <?php if(isset($_GET['mode']) && $_GET['mode'] == 'month'): ?>
                    <!-- Bulanan -->
                    <div class="cardJudul">
                        <p class="opsi">Mingguan</p>
                    </div>
                    <div class="cardJudul active">
                        <p class="opsi">Bulanan</p>
                    </div>
                    <div class="cardJudul">
                        <p class="opsi">Tahunan</p>
                    </div>
                <?php elseif(isset($_GET['mode']) && $_GET['mode'] == 'year'): ?>
                    <!-- Tahunan -->
                    <div class="cardJudul">
                        <p class="opsi">Mingguan</p>
                    </div>
                    <div class="cardJudul">
                        <p class="opsi">Bulanan</p>
                    </div>
                    <div class="cardJudul active">
                        <p class="opsi">Tahunan</p>
                    </div>
                <?php else: ?>
                    <!-- Mode default -->
                    <div class="cardJudul active">
                        <p class="opsi">Mingguan</p>
                    </div>
                    <div class="cardJudul">
                        <p class="opsi">Bulanan</p>
                    </div>
                    <div class="cardJudul">
                        <p class="opsi">Tahunan</p>
                    </div>
                <?php endif; ?>
            </div>
            <form action="" method="get">
            <div class="isi">
                <div class="pilih">
                    <!-- Arrow Kiri -->
                    <div class="svgPilih" id="arrowKiri">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M11.325 15.325C11.5083 15.5083 11.7377 15.5957 12.013 15.587C12.2877 15.579 12.5167 15.4833 12.7 15.3C12.8833 15.1167 12.975 14.8833 12.975 14.6C12.975 14.3167 12.8833 14.0833 12.7 13.9L11.8 13H15.025C15.3083 13 15.5417 12.904 15.725 12.712C15.9083 12.5207 16 12.2833 16 12C16 11.7167 15.9043 11.479 15.713 11.287C15.521 11.0957 15.2833 11 15 11H11.8L12.725 10.075C12.9083 9.89167 12.996 9.66233 12.988 9.387C12.9793 9.11233 12.8833 8.88333 12.7 8.7C12.5167 8.51667 12.2833 8.425 12 8.425C11.7167 8.425 11.4833 8.51667 11.3 8.7L8.7 11.3C8.51667 11.4833 8.425 11.7167 8.425 12C8.425 12.2833 8.51667 12.5167 8.7 12.7L11.325 15.325ZM12 22C10.6167 22 9.31667 21.7373 8.1 21.212C6.88333 20.6873 5.825 19.975 4.925 19.075C4.025 18.175 3.31267 17.1167 2.788 15.9C2.26267 14.6833 2 13.3833 2 12C2 10.6167 2.26267 9.31667 2.788 8.1C3.31267 6.88333 4.025 5.825 4.925 4.925C5.825 4.025 6.88333 3.31233 8.1 2.787C9.31667 2.26233 10.6167 2 12 2C13.3833 2 14.6833 2.26233 15.9 2.787C17.1167 3.31233 18.175 4.025 19.075 4.925C19.975 5.825 20.6873 6.88333 21.212 8.1C21.7373 9.31667 22 10.6167 22 12C22 13.3833 21.7373 14.6833 21.212 15.9C20.6873 17.1167 19.975 18.175 19.075 19.075C18.175 19.975 17.1167 20.6873 15.9 21.212C14.6833 21.7373 13.3833 22 12 22Z" fill="white"/>
                        </svg>                            
                    </div>

                    <!-- Untuk button mode -->
                    <?php if(isset($_GET['mode'])): ?>
                        <input type="hidden" name="mode" value="<?=$_GET['mode']?>" id="mode">
                    <?php else: ?>
                        <input type="hidden" name="mode" value="week" id="mode">
                    <?php endif; ?>

                    <?php if(isset($_GET['mode']) && $_GET['mode'] == 'month'): ?>
                        <!-- Bulanan -->
                        <input type="week" name="session-week"  id="session-week" value="<?=query("
                        SELECT CONCAT(SUBSTR(YEARWEEK('$tanggalAwal', 3), 1,4), '-W', SUBSTR(YEARWEEK('$tanggalAwal', 3), 5,2)) as format
                        ")[0]['format']?>" class="input displayNone">
                        
                        <!-- untuk bulanan -->
                        <input type="month" name="session-month" id="session-month" value="<?=query('SELECT CONCAT(YEAR("'.$tanggalAkhir.'"),"-",LPAD(MONTH("'.$tanggalAkhir.'"), 2,"0")) AS `month`')[0]['month']?>" class="input">
                        
                        <!-- untuk tahunan -->
                        <div class="tahunan input displayNone">
                            <?php $currYear = query('SELECT YEAR("'.$tanggalAkhir.'") as `year`')[0]['year'] ?>
                            <select name="session-year" id="session-year" class="session-year" value="-1">
                                <?php for($i = 2018 ; $i <= 2023; $i++): ?>
                                    <?php if($i == $currYear): ?>
                                    <option value="<?=$i?>" selected><?=$i?></option>
                                    <?php else: ?>
                                    <option value="<?=$i?>"><?=$i?></option>
                                    <?php endif; ?>
                                <?php endfor; ?>
                            </select>
                        </div>
                    <?php elseif(isset($_GET['mode']) && $_GET['mode'] == 'year'): ?>
                        <!-- Tahunan -->
                        <input type="week" name="session-week"  id="session-week" value="<?=query("
                        SELECT CONCAT(SUBSTR(YEARWEEK('$tanggalAwal', 3), 1,4), '-W', SUBSTR(YEARWEEK('$tanggalAwal', 3), 5,2)) as format
                        ")[0]['format']?>" class="input displayNone">
                        
                        <!-- untuk bulanan -->
                        <input type="month" name="session-month" id="session-month" value="<?=query('SELECT CONCAT(YEAR("'.$tanggalAkhir.'"),"-",LPAD(MONTH("'.$tanggalAkhir.'"), 2,"0")) AS `month`')[0]['month']?>" class="input displayNone">
                        
                        <!-- untuk tahunan -->
                        <div class="tahunan input">
                            <?php $currYear = query('SELECT YEAR("'.$tanggalAkhir.'") as `year`')[0]['year'] ?>
                            <select name="session-year" id="session-year" class="session-year" value="-1">
                                <?php for($i = 2018 ; $i <= 2023; $i++): ?>
                                    <?php if($i == $currYear): ?>
                                    <option value="<?=$i?>" selected><?=$i?></option>
                                    <?php else: ?>
                                    <option value="<?=$i?>"><?=$i?></option>
                                    <?php endif; ?>
                                <?php endfor; ?>
                            </select>
                        </div>
                    <?php else: ?>
                        <!-- Mode default -->
                        <?php if(isset($_GET['session-week'])): ?>
                            <input type="week" name="session-week"  id="session-week" value="<?=$_GET['session-week']?>" class="input">
                        <?php else: ?>
                            <input type="week" name="session-week"  id="session-week" value="<?=query("
                            SELECT CONCAT(SUBSTR(YEARWEEK('$tanggalAwal', 3), 1,4), '-W', SUBSTR(YEARWEEK('$tanggalAwal', 3), 5,2)) as format
                            ")[0]['format']?>" class="input">
                        <?php endif; ?>
                        
                        <!-- untuk bulanan -->
                        <input type="month" name="session-month" id="session-month" value="<?=query('SELECT CONCAT(YEAR("'.$tanggalAkhir.'"),"-",LPAD(MONTH("'.$tanggalAkhir.'"), 2,"0")) AS `month`')[0]['month']?>" class="input displayNone">
                        
                        <!-- untuk tahunan -->
                        <div class="tahunan input displayNone">
                            <?php $currYear = query('SELECT YEAR("'.$tanggalAkhir.'") as `year`')[0]['year'] ?>
                            <select name="session-year" id="session-year" class="session-year" value="-1">
                                <?php for($i = 2018 ; $i <= 2023; $i++): ?>
                                    <?php if($i == $currYear): ?>
                                    <option value="<?=$i?>" selected><?=$i?></option>
                                    <?php else: ?>
                                    <option value="<?=$i?>"><?=$i?></option>
                                    <?php endif; ?>
                                <?php endfor; ?>
                            </select>
                        </div>
                    <?php endif; ?>

                    <!-- Untuk backend -->
                    <div class="banyakMingguTahunIni displayNone"><?=query("SELECT IF(YEAR('$tanggalAwal')%4=0, IF(DAYOFWEEK(CONCAT(YEAR('$tanggalAwal'), '-01-01')) = 4, 53, 52),IF(DAYOFWEEK(CONCAT(YEAR('$tanggalAwal'),'-01-01')) = 5, 53, 52)) as tahun")[0]['tahun']?></div>
                    <div class="banyakMingguTahunSebelum displayNone"><?=query("SELECT IF((YEAR('$tanggalAwal')-1)%4=0, IF(DAYOFWEEK(CONCAT((YEAR('$tanggalAwal')-1), '-01-01')) = 4, 53, 52),IF(DAYOFWEEK(CONCAT((YEAR('$tanggalAwal')-1),'-01-01')) = 5, 53, 52)) as tahun")[0]['tahun']?></div>

                    <!-- Arrow Kanan -->
                    <div class="svgPilih" id="arrowKanan">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M12 16L16 12L12 8L10.6 9.4L12.2 11H8V13H12.2L10.6 14.6L12 16ZM12 22C10.6167 22 9.31667 21.7373 8.1 21.212C6.88333 20.6873 5.825 19.975 4.925 19.075C4.025 18.175 3.31267 17.1167 2.788 15.9C2.26267 14.6833 2 13.3833 2 12C2 10.6167 2.26267 9.31667 2.788 8.1C3.31267 6.88333 4.025 5.825 4.925 4.925C5.825 4.025 6.88333 3.31233 8.1 2.787C9.31667 2.26233 10.6167 2 12 2C13.3833 2 14.6833 2.26233 15.9 2.787C17.1167 3.31233 18.175 4.025 19.075 4.925C19.975 5.825 20.6873 6.88333 21.212 8.1C21.7373 9.31667 22 10.6167 22 12C22 13.3833 21.7373 14.6833 21.212 15.9C20.6873 17.1167 19.975 18.175 19.075 19.075C18.175 19.975 17.1167 20.6873 15.9 21.212C14.6833 21.7373 13.3833 22 12 22Z" fill="white"/>
                        </svg>                         
                    </div>
                </div>

                <div class="bantuan10">
                    <div class="tombolLihat" id="tombolSubmitForm">
                        <p class="tulisanLihat">LIHAT STATISTIK</p>
                    </div>
                </div>

                <div class="kategori">
                    <div class="cardKategori">
                        <div class="svgLogo">
                            <svg width="49" height="50" viewBox="0 0 49 50" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M18.5 29.0833C18.5 31.3467 20.25 33.1667 22.3967 33.1667H26.7833C28.65 33.1667 30.1667 31.58 30.1667 29.5967C30.1667 27.4733 29.2333 26.7033 27.8567 26.2133L20.8333 23.7633C19.4567 23.2733 18.5233 22.5267 18.5233 20.38C18.5233 18.42 20.04 16.81 21.9067 16.81H26.2933C28.44 16.81 30.19 18.63 30.19 20.8933M24.3333 14.5V35.5" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M47.6667 25C47.6667 37.88 37.2133 48.3333 24.3333 48.3333C11.4533 48.3333 1 37.88 1 25C1 12.12 11.4533 1.66667 24.3333 1.66667M47.6667 11V1.66667H38.3333M36 13.3333L47.6667 1.66667" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>                                
                        </div>
                        <div class="tulisanKategori">
                            <p class="harga">Rp<?=number_format($revenue)?></p>
                            <p class="kategoriApa">Keuntungan</p>
                        </div>
                    </div>
                    <div class="cardKategori">
                        <div class="svgLogo">
                            <svg width="55" height="55" viewBox="0 0 55 55" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M15.7666 41.5937V36.85M27.4999 41.5937V32.1063M39.2333 41.5937V27.3396M39.2333 13.4062L38.1791 14.6437C32.3283 21.4748 24.4944 26.3129 15.7666 28.4854" stroke="white" stroke-width="1.5" stroke-linecap="round"/>
                                <path d="M32.5186 13.4062H39.2331V20.0979" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M20.6252 50.4167H34.3752C45.8335 50.4167 50.4168 45.8333 50.4168 34.375V20.625C50.4168 9.16666 45.8335 4.58333 34.3752 4.58333H20.6252C9.16683 4.58333 4.5835 9.16666 4.5835 20.625V34.375C4.5835 45.8333 9.16683 50.4167 20.6252 50.4167Z" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>                                                               
                        </div>
                        <div class="tulisanKategori">
                            <p class="harga"><?=number_format($banyakPenjualan)?></p>
                            <p class="kategoriApa">Banyak Penjualan</p>
                        </div>
                    </div>
                    <div class="cardKategori">
                        <div class="svgLogo">
                            <svg width="55" height="55" viewBox="0 0 55 55" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M7 16L25.0614 26.458L43 16.0614M25.0614 45V26.4375" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M20.6838 5.98388L9.57618 12.0716C7.05928 13.4449 5 16.8885 5 19.7172V31.2982C5 34.1269 7.05928 37.5704 9.57618 38.9438L20.6838 45.0315C23.0551 46.3228 26.9449 46.3228 29.3162 45.0315L40.4238 38.9438C42.9407 37.5704 45 34.1269 45 31.2982V19.7172C45 16.8885 42.9407 13.4449 40.4238 12.0716L29.3162 5.98388C26.9241 4.67204 23.0551 4.67204 20.6838 5.98388V5.98388Z" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M36 28V20.3917L16 9" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M47.5 39C46.4122 39 45.3488 39.3226 44.4444 39.9269C43.5399 40.5313 42.8349 41.3902 42.4187 42.3952C42.0024 43.4002 41.8935 44.5061 42.1057 45.573C42.3179 46.6399 42.8417 47.6199 43.6109 48.3891C44.3801 49.1583 45.3601 49.6821 46.427 49.8943C47.4939 50.1065 48.5998 49.9976 49.6048 49.5813C50.6098 49.1651 51.4687 48.4601 52.0731 47.5556C52.6774 46.6512 53 45.5878 53 44.5C52.9972 43.0422 52.4168 41.6449 51.3859 40.6141C50.3551 39.5832 48.9578 39.0029 47.5 39ZM47.5 49.3529C46.5402 49.3529 45.6019 49.0683 44.8039 48.5351C44.0058 48.0018 43.3838 47.2439 43.0165 46.3571C42.6492 45.4704 42.5531 44.4946 42.7403 43.5532C42.9276 42.6119 43.3898 41.7471 44.0685 41.0685C44.7472 40.3898 45.6119 39.9276 46.5532 39.7403C47.4946 39.5531 48.4704 39.6492 49.3571 40.0165C50.2439 40.3838 51.0018 41.0058 51.5351 41.8038C52.0683 42.6019 52.3529 43.5402 52.3529 44.5C52.3515 45.7866 51.8398 47.0202 50.93 47.93C50.0202 48.8398 48.7866 49.3515 47.5 49.3529ZM48.0392 42.1275V47.0882C48.0392 47.174 48.0051 47.2563 47.9445 47.317C47.8838 47.3777 47.8015 47.4118 47.7157 47.4118C47.6299 47.4118 47.5476 47.3777 47.4869 47.317C47.4262 47.2563 47.3922 47.174 47.3922 47.0882V42.7314L46.5995 43.2598C46.5281 43.3015 46.4434 43.3142 46.3628 43.2954C46.2823 43.2765 46.212 43.2276 46.1665 43.1586C46.1209 43.0895 46.1035 43.0057 46.1179 42.9242C46.1322 42.8428 46.1772 42.7699 46.2436 42.7206L47.5377 41.8578C47.5865 41.8257 47.643 41.8074 47.7013 41.8048C47.7596 41.8022 47.8175 41.8155 47.8689 41.8431C47.9203 41.8707 47.9633 41.9117 47.9932 41.9618C48.0232 42.0119 48.0391 42.0691 48.0392 42.1275Z" fill="white"/>
                            </svg>                                                             
                        </div>
                        <div class="tulisanKategori">
                            <p class="harga"><?=$produkTerlaris1?></p>
                            <p class="kategoriApa">Produk Terlaris</p>
                        </div>
                    </div>
                    <div class="cardKategori">
                        <div class="svgLogo">
                            <svg width="56" height="56" viewBox="0 0 56 56" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M22.1665 32.0833C22.1665 34.3467 23.9165 36.1667 26.0632 36.1667H30.4498C32.3165 36.1667 33.8332 34.58 33.8332 32.5967C33.8332 30.4733 32.8998 29.7033 31.5232 29.2133L24.4998 26.7633C23.1232 26.2733 22.1898 25.5267 22.1898 23.38C22.1898 21.42 23.7065 19.81 25.5732 19.81H29.9598C32.1065 19.81 33.8565 21.63 33.8565 23.8933M27.9998 17.5V38.5" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M51.3332 28C51.3332 40.88 40.8798 51.3333 27.9998 51.3333C15.1198 51.3333 4.6665 40.88 4.6665 28C4.6665 15.12 15.1198 4.66666 27.9998 4.66666" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M39.6665 7V16.3333H48.9998M51.3332 4.66666L39.6665 16.3333" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>                                                             
                        </div>
                        <div class="tulisanKategori">
                            <p class="harga">Rp<?=number_format($COGS)?></p>
                            <p class="kategoriApa">Pengeluaran</p>
                        </div>
                    </div>
                    <div class="cardKategori">
                        <div class="svgLogo">
                            <svg width="53" height="53" viewBox="0 0 53 53" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M46.3748 25.3958C46.3748 36.9896 36.9894 46.375 25.3957 46.375C13.8019 46.375 4.4165 36.9896 4.4165 25.3958C4.4165 13.8021 13.8019 4.41666 25.3957 4.41666M48.5832 48.5833L44.1665 44.1667" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M32.0206 13.5371C31.2477 11.1079 32.1531 8.0825 34.7148 7.26542C36.0619 6.82375 37.7181 7.19917 38.6677 8.50208C39.5511 7.155 41.2736 6.84583 42.5986 7.26542C45.1602 8.0825 46.0656 11.1079 45.2927 13.5371C44.0781 17.4017 39.8381 19.4113 38.6677 19.4113C37.4752 19.4113 33.2794 17.4458 32.0206 13.5371V13.5371Z" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>                                                            
                        </div>
                        <div class="tulisanKategori">
                            <p class="harga"><?=$kategoriTerpopuler?></p>
                            <p class="kategoriApa">Kategori Terpopuler</p>
                        </div>
                    </div>
                    <div class="cardKategori">
                        <div class="svgLogo">
                            <svg width="55" height="55" viewBox="0 0 55 55" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M7 16L25.0614 26.458L43 16.0614M25.0614 45V26.4375" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M20.6838 5.98388L9.57618 12.0716C7.05928 13.4449 5 16.8885 5 19.7172V31.2982C5 34.1269 7.05928 37.5704 9.57618 38.9438L20.6838 45.0315C23.0551 46.3228 26.9449 46.3228 29.3162 45.0315L40.4238 38.9438C42.9407 37.5704 45 34.1269 45 31.2982V19.7172C45 16.8885 42.9407 13.4449 40.4238 12.0716L29.3162 5.98388C26.9241 4.67204 23.0551 4.67204 20.6838 5.98388V5.98388Z" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M36 28V20.3917L16 9" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M47.5 39.2188C46.4555 39.2188 45.4344 39.5285 44.5659 40.1088C43.6974 40.6891 43.0205 41.5139 42.6208 42.479C42.221 43.444 42.1165 44.5059 42.3202 45.5303C42.524 46.5548 43.027 47.4958 43.7656 48.2344C44.5042 48.973 45.4452 49.476 46.4697 49.6798C47.4941 49.8835 48.556 49.779 49.521 49.3792C50.4861 48.9795 51.3109 48.3026 51.8912 47.4341C52.4715 46.5656 52.7813 45.5445 52.7813 44.5C52.7786 43.1001 52.2213 41.7584 51.2314 40.7686C50.2416 39.7787 48.8999 39.2214 47.5 39.2188ZM47.5 48.9687C46.6162 48.9687 45.7522 48.7067 45.0173 48.2156C44.2824 47.7246 43.7096 47.0267 43.3714 46.2101C43.0332 45.3936 42.9447 44.495 43.1171 43.6282C43.2895 42.7613 43.7152 41.9651 44.3401 41.3401C44.9651 40.7152 45.7613 40.2895 46.6282 40.1171C47.495 39.9447 48.3936 40.0332 49.2101 40.3714C50.0267 40.7096 50.7246 41.2824 51.2156 42.0173C51.7067 42.7522 51.9688 43.6162 51.9688 44.5C51.9674 45.6848 51.4962 46.8206 50.6584 47.6584C49.8206 48.4962 48.6848 48.9674 47.5 48.9687ZM48.8355 44.2055L47.0938 46.5312H48.7188C48.8265 46.5312 48.9298 46.5741 49.006 46.6502C49.0822 46.7264 49.125 46.8298 49.125 46.9375C49.125 47.0452 49.0822 47.1486 49.006 47.2248C48.9298 47.3009 48.8265 47.3437 48.7188 47.3437H46.2813C46.2381 47.3444 46.1951 47.3376 46.1543 47.3234C46.073 47.2967 46.0023 47.245 45.9521 47.1757C45.902 47.1064 45.875 47.023 45.875 46.9375C45.8733 46.8469 45.9039 46.7587 45.9613 46.6887L48.1805 43.7281C48.2612 43.6055 48.3072 43.4633 48.3136 43.3166C48.32 43.1699 48.2865 43.0242 48.2167 42.895C48.1469 42.7658 48.0434 42.658 47.9172 42.5829C47.791 42.5079 47.6468 42.4684 47.5 42.4687C47.3403 42.4686 47.1842 42.5158 47.0513 42.6044C46.9184 42.6929 46.8148 42.8189 46.7535 42.9664C46.7111 43.0661 46.6308 43.1448 46.5303 43.1853C46.4299 43.2257 46.3174 43.2247 46.2178 43.1822C46.1181 43.1398 46.0394 43.0595 45.9989 42.9591C45.9584 42.8586 45.9595 42.7461 46.002 42.6465C46.0908 42.4385 46.2221 42.2513 46.3875 42.0969C46.5528 41.9425 46.7486 41.8244 46.9623 41.75C47.1759 41.6757 47.4027 41.6468 47.6282 41.6651C47.8537 41.6835 48.0728 41.7487 48.2716 41.8566C48.4704 41.9646 48.6445 42.1128 48.7827 42.2919C48.921 42.471 49.0203 42.6769 49.0743 42.8966C49.1283 43.1162 49.1359 43.3448 49.0966 43.5675C49.0572 43.7903 48.9718 44.0024 48.8457 44.1902L48.8355 44.2055Z" fill="white"/>
                            </svg>                                                               
                        </div>
                        <div class="tulisanKategori">
                            <p class="harga"><?=$produkTerlaris2?></p>
                            <p class="kategoriApa">Produk Terlaris</p>
                        </div>
                    </div>
                </div>
                <div class="grafik" id="grafikContainer">

                </div>
            </div>
            </form>
        </div>
    </div>

    <!-- footer -->
    <?php include '../footer/footer.php' ?>
    
    <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
    <script src="laporanKeuangan.js"></script>
</body>
</html>