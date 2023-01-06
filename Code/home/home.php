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
    <?php require '../header/headerWithSearch.php' ?>

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
                    <svg width="2vw" height="2vw" viewBox="0 0 32 26" fill="none" xmlns="http://www.w3.org/2000/svg">
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

    <?php require '../footer/footer.php' ?>
    <script src="../header/header.js"></script>
</body>
</html>