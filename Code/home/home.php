<?php 

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

$currentUserId = $_SESSION['currentUserId'];
$items = query("SELECT * FROM item");
$categories = query("SELECT * FROM category");
$bestSellers = query("SELECT
i.*
FROM item i
LEFT JOIN buy b ON b.itemId = i.itemId
GROUP BY i.itemId
ORDER BY SUM(b.qty) DESC
LIMIT 10");

$recommendations = query("SELECT i.*,o.userId, o.qty FROM item i
JOIN Owns o ON o.itemId = i.itemId
WHERE o.userId = $currentUserId
UNION
SELECT i.*, 0, 0 FROM item i
WHERE i.itemId NOT IN (
	SELECT i.itemId FROM item i
	JOIN Owns o ON o.itemId = i.itemId
	WHERE o.userId = $currentUserId
)
ORDER BY IF(abs(userId-$currentUserId) IS NULL, 1000, abs(userId-$currentUserId)) ASC, qty ASC
LIMIT 10
");

// Initialization
$count = 0;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="../header/header.css">
    <link rel="stylesheet" href="home.css">
    <link rel="stylesheet" href="../footer/footer.css">
    <link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet'>
</head>
<body>
    <!-- header -->
    <div class="container">
        <!-- logo -->
        <a href="../home/home.php">
            <div class="logo" style="background-image: url(../image/logo.svg) ;"></div>
        </a>

        <!-- search -->
        <div class="search1" id="search1">
            <label for="inputKeyword">
            <div class="svgSearch">
                <svg width="23" height="23" viewBox="0 0 27 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M12.2475 4.75643C13.8721 4.75473 15.4606 5.30719 16.8122 6.34393C18.1637 7.38067 19.2175 8.85511 19.8402 10.5807C20.4629 12.3063 20.6266 14.2056 20.3106 16.0382C19.9946 17.8708 19.213 19.5545 18.0648 20.8762C16.9165 22.1979 15.4532 23.0983 13.8599 23.4634C12.2667 23.8285 10.615 23.642 9.11395 22.9274C7.61287 22.2128 6.32981 21.0023 5.42708 19.449C4.52435 17.8956 4.0425 16.0693 4.0425 14.201C4.05235 11.7011 4.91973 9.30672 6.45612 7.53823C7.99252 5.76973 10.0738 4.77004 12.2475 4.75643M12.2475 2.98828C10.3191 2.98828 8.43407 3.64589 6.83069 4.87796C5.22731 6.11002 3.97763 7.8612 3.23968 9.91005C2.50172 11.9589 2.30864 14.2134 2.68485 16.3884C3.06105 18.5635 3.98965 20.5614 5.35321 22.1295C6.71677 23.6976 8.45406 24.7655 10.3454 25.1982C12.2367 25.6308 14.1971 25.4088 15.9787 24.5601C17.7602 23.7115 19.283 22.2743 20.3543 20.4304C21.4257 18.5865 21.9975 16.4186 21.9975 14.201C21.9975 11.2272 20.9703 8.37518 19.1418 6.2724C17.3133 4.16961 14.8334 2.98828 12.2475 2.98828Z" fill="#FFF9F9"/>
                    <path d="M26.25 29.1137L20.7225 22.7139L19.6575 23.93L25.185 30.3299C25.2544 30.4103 25.3369 30.4742 25.4279 30.5179C25.5188 30.5617 25.6163 30.5844 25.7148 30.5848C25.8134 30.5852 25.911 30.5633 26.0022 30.5203C26.0934 30.4773 26.1763 30.414 26.2462 30.3342C26.3161 30.2543 26.3717 30.1594 26.4098 30.0549C26.4478 29.9503 26.4675 29.8382 26.4679 29.7248C26.4682 29.6115 26.4492 29.4992 26.4118 29.3944C26.3744 29.2895 26.3194 29.1941 26.25 29.1137Z" fill="#FFF9F9"/>
                </svg>                    
            </div>
            </label>
        </div>
        <div class="search2 displayNone" id="search2">
            <div class="svgSearch svgSearch2">
                <svg width="23" height="23" viewBox="0 0 27 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M12.2475 4.75643C13.8721 4.75473 15.4606 5.30719 16.8122 6.34393C18.1637 7.38067 19.2175 8.85511 19.8402 10.5807C20.4629 12.3063 20.6266 14.2056 20.3106 16.0382C19.9946 17.8708 19.213 19.5545 18.0648 20.8762C16.9165 22.1979 15.4532 23.0983 13.8599 23.4634C12.2667 23.8285 10.615 23.642 9.11395 22.9274C7.61287 22.2128 6.32981 21.0023 5.42708 19.449C4.52435 17.8956 4.0425 16.0693 4.0425 14.201C4.05235 11.7011 4.91973 9.30672 6.45612 7.53823C7.99252 5.76973 10.0738 4.77004 12.2475 4.75643M12.2475 2.98828C10.3191 2.98828 8.43407 3.64589 6.83069 4.87796C5.22731 6.11002 3.97763 7.8612 3.23968 9.91005C2.50172 11.9589 2.30864 14.2134 2.68485 16.3884C3.06105 18.5635 3.98965 20.5614 5.35321 22.1295C6.71677 23.6976 8.45406 24.7655 10.3454 25.1982C12.2367 25.6308 14.1971 25.4088 15.9787 24.5601C17.7602 23.7115 19.283 22.2743 20.3543 20.4304C21.4257 18.5865 21.9975 16.4186 21.9975 14.201C21.9975 11.2272 20.9703 8.37518 19.1418 6.2724C17.3133 4.16961 14.8334 2.98828 12.2475 2.98828Z" fill="#FFF9F9"/>
                    <path d="M26.25 29.1137L20.7225 22.7139L19.6575 23.93L25.185 30.3299C25.2544 30.4103 25.3369 30.4742 25.4279 30.5179C25.5188 30.5617 25.6163 30.5844 25.7148 30.5848C25.8134 30.5852 25.911 30.5633 26.0022 30.5203C26.0934 30.4773 26.1763 30.414 26.2462 30.3342C26.3161 30.2543 26.3717 30.1594 26.4098 30.0549C26.4478 29.9503 26.4675 29.8382 26.4679 29.7248C26.4682 29.6115 26.4492 29.4992 26.4118 29.3944C26.3744 29.2895 26.3194 29.1941 26.25 29.1137Z" fill="#FFF9F9"/>
                </svg>                    
            </div>
            <div class="searchText">
                <form action="../searchProduk/searchProduk.php" method="get">
                    <input type="text" id="inputKeyword" class="inputKeyword" name="keyword" placeholder="Cari" onKeyPress="return checkSubmit(event)" autocomplete="off">
                </form>
            </div>
        </div>

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

        <!-- Hamburger -->
        <div class="hamburger" id="hamburger">
            <span class="line"></span>
            <span class="line"></span>
            <span class="line"></span>
        </div>
    </div>

    <div class="dropdownMenu displayNone">
        <a href="../keranjang/keranjang.php"><div class="menu">Keranjang</div></a>
        <a href="../kasir/kasir.php"><div class="menu">Kasir</div></a>
        <a href="../gudang/gudang.php"><div class="menu">Gudang</div></a>
        <a href="../laporanKeuangan/laporanKeuangan.php"><div class="menu">Laporan Pendapatan</div></a>
        <a href="../logout.php"><div class="menu logout">Logout</div></a>
    </div>

    <!-- body -->
    <div class="main">
        <!-- fitur -->
        <div class="fitur">
            <div class="kotakAtas3">
                <div class="tulisanFitur">
                    FITUR JUALAN YUK!
                </div>
                <div class="garis3"></div>
            </div>
            <div class="bantuan2"></div>
            <div class="kotakFitur">
                <div class="cardFitur">
                    <a href="../buildYourWarung/buildYourWarung.php" style="width: 100%; display: flex;">
                    <div class="logoFitur" style="background-image:url(../image/fitur1.svg) ;"></div>
                    <div class="tulisanFitur2">BUILD YOUR WARUNG</div>
                    </a>
                </div>
                <div class="cardFitur">
                    <a href="../gudang/gudang.php" style="width: 100%; display: flex;">
                    <div class="logoFitur" style="background-image:url(../image/fitur2.svg) ;"></div>
                    <div class="tulisanFitur2">GUDANG</div>
                    </a>
                </div>
                <div class="cardFitur">
                    <a href="../laporanKeuangan/laporanKeuangan.php" style="width: 100%; display: flex;">
                        <div class="logoFitur" style="background-image:url(../image/fitur3.svg) ;"></div>
                        <div class="tulisanFitur2">LAPORAN PENJUALAN</div>
                    </a>
                </div>
                <div class="cardFitur">
                    <a href="../kasir/kasir.php" style="width: 100%; display: flex;">
                    <div class="logoFitur" style="background-image:url(../image/fitur4.svg) ;"></div>
                    <div class="tulisanFitur2">KASIR</div>
                    </a>
                </div>
                
            </div>
        </div>

        <!-- kategori -->
        <div class="kategori">
            <?php foreach($categories as $category): ?>
                <div class="cardKategori">
                    <a href="../kategoriProduk/kategoriProduk.php?categoryId=<?=$category['categoryId']?>">
                        <div class="gambar" style="background-image: url('../image/Kategori/<?=$category["categoryImage"]?>') ;"></div>
                        <div class="teks"><?=$category["categoryName"]?></div>
                    </a>
                </div>
            <?php endforeach; ?>
        </div>

        <!-- rekomendasi -->
        <div class="rekomendasi">
            <div class="kotakAtas">
                <div class="tulisanRekomendasi">
                    REKOMENDASI
                </div>
                <div class="garis"></div>
            </div>
            <div class="kotakRekomendasi">
            <?php foreach($recommendations as $recommendation): ?>
                <div class="cardRekomendasi">
                    <a href="../produk/produk.php?id=<?=$recommendation["itemId"]?>" style="color: inherit; text-decoration: inherit;">
                    <div class="gambarLengkapi" style="background-image:url(../image/Produk/<?=$recommendation["itemImage"]?>);"></div>
                    <div class="deskripsiRekomendasi">
                        <div class="kiri">
                            <p><?= $recommendation["itemName"]?> (<?= $recommendation["qtyPerItem"]?>pcs)</p>
                            <p class="harga">Rp<?=number_format($recommendation["buyPrice"])?></p>
                        </div>
                        <div class="kanan">
                            <svg width="25" height="18" viewBox="0 0 25 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <g filter="url(#filter0_d_111_725)">
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M19.9585 5.8094C20.0485 5.89945 20.0991 6.02158 20.0991 6.14893C20.0991 6.27627 20.0485 6.3984 19.9585 6.48845L15.8842 10.5627C15.7941 10.6528 15.672 10.7034 15.5447 10.7034C15.4173 10.7034 15.2952 10.6528 15.2051 10.5627C15.1151 10.4727 15.0645 10.3506 15.0645 10.2232C15.0645 10.0959 15.1151 9.97373 15.2051 9.88368L18.4598 6.62901L4.6799 6.62969C4.61677 6.62969 4.55425 6.61726 4.49592 6.59309C4.43759 6.56893 4.3846 6.53352 4.33995 6.48888C4.29531 6.44423 4.2599 6.39124 4.23574 6.33291C4.21157 6.27458 4.19914 6.21206 4.19914 6.14893C4.19914 6.08579 4.21157 6.02327 4.23574 5.96494C4.2599 5.90662 4.29531 5.85362 4.33995 5.80897C4.3846 5.76433 4.43759 5.72892 4.49592 5.70476C4.55425 5.6806 4.61677 5.66816 4.6799 5.66816L18.4598 5.66884L15.2051 2.41417C15.1151 2.32412 15.0645 2.20199 15.0645 2.07464C15.0645 1.9473 15.1151 1.82517 15.2051 1.73512C15.2952 1.64507 15.4173 1.59448 15.5447 1.59449C15.672 1.59449 15.7941 1.64507 15.8842 1.73512L19.9585 5.8094Z" fill="white"/>
                                </g>
                                <defs>
                                <filter id="filter0_d_111_725" x="0.199219" y="0.594482" width="23.8999" height="17.1089" filterUnits="userSpaceOnUse" color-interpolation-filters="sRGB">
                                <feFlood flood-opacity="0" result="BackgroundImageFix"/>
                                <feColorMatrix in="SourceAlpha" type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 127 0" result="hardAlpha"/>
                                <feOffset dy="3"/>
                                <feGaussianBlur stdDeviation="2"/>
                                <feComposite in2="hardAlpha" operator="out"/>
                                <feColorMatrix type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0.25 0"/>
                                <feBlend mode="normal" in2="BackgroundImageFix" result="effect1_dropShadow_111_725"/>
                                <feBlend mode="normal" in="SourceGraphic" in2="effect1_dropShadow_111_725" result="shape"/>
                                </filter>
                                </defs>
                            </svg>                                
                        </div>
                    </div>
                    </a>
                </div>
                <?php endforeach; ?>
                
            </div>
        </div>

        <!-- paling laris -->
        <div class="rekomendasi">
            <div class="kotakAtas">
                <div class="tulisanRekomendasi">
                    PALING LARIS
                </div>
                <div class="garis"></div>
            </div>
            <div class="kotakRekomendasi">
                <?php foreach($bestSellers as $bestSeller): ?>
                <div class="cardRekomendasi">
                    <a href="../produk/produk.php?id=<?=$bestSeller["itemId"]?>" style="color: inherit; text-decoration: inherit;">
                    <div class="gambarLengkapi" style="background-image:url(../image/Produk/<?=$bestSeller["itemImage"]?>);"></div>
                    <div class="deskripsiRekomendasi">
                        <div class="kiri">
                            <p><?= $bestSeller["itemName"]?> (<?= $bestSeller["qtyPerItem"]?>pcs)</p>
                            <p class="harga">Rp<?=number_format($bestSeller["buyPrice"])?></p>
                        </div>
                        <div class="kanan">
                            <svg width="25" height="18" viewBox="0 0 25 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <g filter="url(#filter0_d_111_725)">
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M19.9585 5.8094C20.0485 5.89945 20.0991 6.02158 20.0991 6.14893C20.0991 6.27627 20.0485 6.3984 19.9585 6.48845L15.8842 10.5627C15.7941 10.6528 15.672 10.7034 15.5447 10.7034C15.4173 10.7034 15.2952 10.6528 15.2051 10.5627C15.1151 10.4727 15.0645 10.3506 15.0645 10.2232C15.0645 10.0959 15.1151 9.97373 15.2051 9.88368L18.4598 6.62901L4.6799 6.62969C4.61677 6.62969 4.55425 6.61726 4.49592 6.59309C4.43759 6.56893 4.3846 6.53352 4.33995 6.48888C4.29531 6.44423 4.2599 6.39124 4.23574 6.33291C4.21157 6.27458 4.19914 6.21206 4.19914 6.14893C4.19914 6.08579 4.21157 6.02327 4.23574 5.96494C4.2599 5.90662 4.29531 5.85362 4.33995 5.80897C4.3846 5.76433 4.43759 5.72892 4.49592 5.70476C4.55425 5.6806 4.61677 5.66816 4.6799 5.66816L18.4598 5.66884L15.2051 2.41417C15.1151 2.32412 15.0645 2.20199 15.0645 2.07464C15.0645 1.9473 15.1151 1.82517 15.2051 1.73512C15.2952 1.64507 15.4173 1.59448 15.5447 1.59449C15.672 1.59449 15.7941 1.64507 15.8842 1.73512L19.9585 5.8094Z" fill="white"/>
                                </g>
                                <defs>
                                <filter id="filter0_d_111_725" x="0.199219" y="0.594482" width="23.8999" height="17.1089" filterUnits="userSpaceOnUse" color-interpolation-filters="sRGB">
                                <feFlood flood-opacity="0" result="BackgroundImageFix"/>
                                <feColorMatrix in="SourceAlpha" type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 127 0" result="hardAlpha"/>
                                <feOffset dy="3"/>
                                <feGaussianBlur stdDeviation="2"/>
                                <feComposite in2="hardAlpha" operator="out"/>
                                <feColorMatrix type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0.25 0"/>
                                <feBlend mode="normal" in2="BackgroundImageFix" result="effect1_dropShadow_111_725"/>
                                <feBlend mode="normal" in="SourceGraphic" in2="effect1_dropShadow_111_725" result="shape"/>
                                </filter>
                                </defs>
                            </svg>                                
                        </div>
                    </div>
                    </a>
                </div>
                <?php endforeach; ?>
            </div>
        </div>

        <!-- banner -->
        <div class="kotakBanner" style="background-image:url(../image/banner.png) ;">
            <div class="kotakBantuan"></div>
            <div class="hyperlink">
                <a href="../buildYourWarung/buildYourWarung.php">
                <p>KLIK DISINI</p>
                </a>
                <a href="../buildYourWarung/buildYourWarung.php">
                <div class="panah">
                    <svg width="32" height="26" viewBox="0 0 32 26" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <g filter="url(#filter0_d_111_645)">
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M27.5538 9.36116C27.7178 9.52514 27.8095 9.74802 27.8086 9.98077C27.8078 10.2135 27.7145 10.4371 27.5494 10.6022L20.0764 18.0752C19.9112 18.2404 19.6877 18.3336 19.4549 18.3345C19.2222 18.3353 18.9993 18.2436 18.8353 18.0796C18.6713 17.9157 18.5797 17.6928 18.5805 17.46C18.5813 17.2273 18.6746 17.0037 18.8398 16.8386L24.8094 10.8689L5.23949 11.0666C5.1241 11.067 5.00993 11.0447 4.90348 11.0009C4.79703 10.9572 4.7004 10.8928 4.6191 10.8115C4.53779 10.7302 4.47342 10.6335 4.42964 10.5271C4.38587 10.4206 4.36355 10.3065 4.36396 10.1911C4.36437 10.0757 4.38751 9.96135 4.43205 9.85459C4.47658 9.74783 4.54165 9.65073 4.62354 9.56885C4.70542 9.48696 4.80252 9.42189 4.90928 9.37736C5.01604 9.33282 5.13038 9.30968 5.24577 9.30927L24.8157 9.11404L18.8885 3.18688C18.7246 3.0229 18.6329 2.80001 18.6337 2.56727C18.6346 2.33453 18.7278 2.11098 18.893 1.94582C19.0581 1.78066 19.2817 1.6874 19.5144 1.68657C19.7472 1.68574 19.97 1.7774 20.134 1.94138L27.5538 9.36116Z" fill="white"/>
                        </g>
                        <defs>
                        <filter id="filter0_d_111_645" x="0.364014" y="0.686523" width="31.4446" height="24.6479" filterUnits="userSpaceOnUse" color-interpolation-filters="sRGB">
                        <feFlood flood-opacity="0" result="BackgroundImageFix"/>
                        <feColorMatrix in="SourceAlpha" type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 127 0" result="hardAlpha"/>
                        <feOffset dy="3"/>
                        <feGaussianBlur stdDeviation="2"/>
                        <feComposite in2="hardAlpha" operator="out"/>
                        <feColorMatrix type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0.25 0"/>
                        <feBlend mode="normal" in2="BackgroundImageFix" result="effect1_dropShadow_111_645"/>
                        <feBlend mode="normal" in="SourceGraphic" in2="effect1_dropShadow_111_645" result="shape"/>
                        </filter>
                        </defs>
                    </svg>                        
                </div>
                </a>
            </div>
        </div>

        <!-- lengkapi tokomu -->
        <div class="kotakLengkapi">
            <div class="kotakAtas2">
                <div class="tulisanLengkapi">
                    LENGKAPI TOKOMU!
                </div>
                <div class="garis2"></div>
            </div>
            <div class="bantuan"></div>
            <div class="isiLengkapi">

                <!-- Looping item -->
                <?php foreach($items as $count => $item): ?>
                <a href="../produk/produk.php?id=<?=$item["itemId"]?>" style="color: inherit; text-decoration: inherit;">
                    <div class="cardLengkapi">
                        <div class="gambarLengkapi" style="background-image:url(../image/Produk/<?=$item["itemImage"]?>);"></div>
                        <div class="deskripsiLengkapi">
                            <div class="kiri2">
                                <p><?= $item["itemName"]?> (<?= $item["qtyPerItem"]?>pcs)</p>
                                <p class="harga">Rp<?=number_format($item["buyPrice"])?></p>
                            </div>
                            <div class="kanan2">
                                <svg width="25" height="18" viewBox="0 0 25 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <g filter="url(#filter0_d_111_725)">
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M19.9585 5.8094C20.0485 5.89945 20.0991 6.02158 20.0991 6.14893C20.0991 6.27627 20.0485 6.3984 19.9585 6.48845L15.8842 10.5627C15.7941 10.6528 15.672 10.7034 15.5447 10.7034C15.4173 10.7034 15.2952 10.6528 15.2051 10.5627C15.1151 10.4727 15.0645 10.3506 15.0645 10.2232C15.0645 10.0959 15.1151 9.97373 15.2051 9.88368L18.4598 6.62901L4.6799 6.62969C4.61677 6.62969 4.55425 6.61726 4.49592 6.59309C4.43759 6.56893 4.3846 6.53352 4.33995 6.48888C4.29531 6.44423 4.2599 6.39124 4.23574 6.33291C4.21157 6.27458 4.19914 6.21206 4.19914 6.14893C4.19914 6.08579 4.21157 6.02327 4.23574 5.96494C4.2599 5.90662 4.29531 5.85362 4.33995 5.80897C4.3846 5.76433 4.43759 5.72892 4.49592 5.70476C4.55425 5.6806 4.61677 5.66816 4.6799 5.66816L18.4598 5.66884L15.2051 2.41417C15.1151 2.32412 15.0645 2.20199 15.0645 2.07464C15.0645 1.9473 15.1151 1.82517 15.2051 1.73512C15.2952 1.64507 15.4173 1.59448 15.5447 1.59449C15.672 1.59449 15.7941 1.64507 15.8842 1.73512L19.9585 5.8094Z" fill="white"/>
                                    </g>
                                    <defs>
                                    <filter id="filter0_d_111_725" x="0.199219" y="0.594482" width="23.8999" height="17.1089" filterUnits="userSpaceOnUse" color-interpolation-filters="sRGB">
                                    <feFlood flood-opacity="0" result="BackgroundImageFix"/>
                                    <feColorMatrix in="SourceAlpha" type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 127 0" result="hardAlpha"/>
                                    <feOffset dy="3"/>
                                    <feGaussianBlur stdDeviation="2"/>
                                    <feComposite in2="hardAlpha" operator="out"/>
                                    <feColorMatrix type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0.25 0"/>
                                    <feBlend mode="normal" in2="BackgroundImageFix" result="effect1_dropShadow_111_725"/>
                                    <feBlend mode="normal" in="SourceGraphic" in2="effect1_dropShadow_111_725" result="shape"/>
                                    </filter>
                                    </defs>
                                </svg>                                
                            </div>
                        </div>
                    </div>
                </a>
                <?php endforeach; ?>
                <!-- Sisa item -->
                <?php for($i = 0; $i < (5 - ($count + 1)%5)%5; $i++): ?>
                    <div class="cardLengkapi visibilityHidden"></div>
                <?php endfor; ?>
            </div>
        </div>
    </div>

    <!-- footer -->
    <?php include '../footer/footer.php' ?>

    <script src="../header/header.js"></script>
</body>
</html>