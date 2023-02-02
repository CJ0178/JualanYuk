<?php 

session_start();
require '../functions.php';

// Cek apakah ada keyword
if(isset($_GET['keyword'])){
    $keyword = $_GET['keyword'];
    $items = query("SELECT * FROM item WHERE itemName LIKE '%$keyword%'");
} else{
    // Jika tidak ada keyword
    redirectTo('../home/home.php');
}


// Cek apakah current user sudah ada
if(isset($_SESSION["currentUserId"])){
    // Jika masuk memlalui login,
    $currentUserData = detailUser($_SESSION["currentUserId"]);
    $currentUsername = $currentUserData["username"];
    
    // Jika dia adalah admin, langsung lempar
    if($currentUsername == 'admin'){
        header("Location: ../searchProdukAdmin/searchProdukAdmin.php?keyword=$keyword");
    }
} else{
    // Jika masuk melalui url
    $currentUsername = "YOUR NAME";
}

// Initialization
$count = 0;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kategori Produk</title>
    <link rel="stylesheet" href="../header/header.css">
    <link rel="stylesheet" href="../home/home.css">
    <link rel="stylesheet" href="../footer/footer.css">
    <link rel="stylesheet" href="../editStok/editStok.css">
    <link rel="stylesheet" href="searchProduk.css">
    <link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet'>
</head>
<body>
    <!-- header -->
    <?php require '../header/headerWithSearch.php' ?>

    <!-- body -->
    <div class="main">
        <!-- lengkapi tokomu -->
        <div class="kotakLengkapi">
            <div class="isiLengkapi">
                <!-- Looping item -->
                <?php foreach($items as $item): ?>
                <?php if($item['itemStock'] <= 0) {continue;} else {$count++;} ?>
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
                <?php for($i = 0; $i < (5 - ($count)%5)%5; $i++): ?>
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