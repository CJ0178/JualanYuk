<?php 
session_start();
require '../functions.php';
$currentUserId = $_SESSION['currentUserId'];
if(isset($_GET['category'])){
    $categoryId = $_GET['category'];
    $query = "SELECT * FROM Owns o JOIN Item i ON i.itemId = o.itemId JOIN `user` u ON u.userId = o.userId JOIN category c ON c.categoryId = i.categoryId WHERE u.userId = $currentUserId AND c.categoryId = $categoryId";
} else {
    $query = "SELECT * FROM Owns o JOIN Item i ON i.itemId = o.itemId JOIN `user` u ON u.userId = o.userId WHERE u.userId = $currentUserId";
}

if(isset($_GET['keyword'])){
    $keyword = $_GET['keyword'];
    $query .= " AND i.itemName LIKE '%$keyword%'";
}

$items = query($query);
$categories = query("SELECT * FROM category");
$cashiers = query("SELECT *, o.qty AS 'qty', c.qty AS 'qtyPesan' FROM cashier c JOIN item i ON i.itemId = c.itemId JOIN Owns o ON o.itemId = i.itemId WHERE c.userId = $currentUserId  AND o.userId = $currentUserId");

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

$i = 0;
$_SESSION['grandTotal'] = 0;

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kasir</title>
    <link rel="stylesheet" href="../header/header.css">
    <link rel="stylesheet" href="../footer/footer.css">
    <link rel="stylesheet" href="kasir.css">
    <link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet'>
</head>
<body>
    <div class="bg" id="bg"></div>
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
       <div class="judulKasir">
            <p class="tulisanKasir">KASIR</p>
            <div class="garis"></div>
       </div>
       <div class="kotakBawah">
            <div class="kotakKiri">
                <form action="" method="get">
                    <div class="cari">
                        <div class="svgCari">
                            <svg width="25" height="25" viewBox="0 0 27 27" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M12.2471 3.78756C13.8717 3.78608 15.4602 4.26647 16.8117 5.16797C18.1633 6.06947 19.217 7.35157 19.8398 8.85207C20.4625 10.3526 20.6262 12.0041 20.3102 13.5976C19.9942 15.1912 19.2126 16.6552 18.0643 17.8045C16.9161 18.9538 15.4528 19.7367 13.8595 20.0542C12.2662 20.3717 10.6146 20.2095 9.11352 19.5881C7.61245 18.9668 6.32939 17.9142 5.42665 16.5635C4.52392 15.2128 4.04208 13.6247 4.04207 12.0001C4.05192 9.8263 4.9193 7.74427 6.45569 6.20647C7.99209 4.66868 10.0733 3.7994 12.2471 3.78756ZM12.2471 2.25006C10.3187 2.25006 8.43364 2.82189 6.83027 3.89323C5.22689 4.96458 3.9772 6.48732 3.23925 8.2689C2.50129 10.0505 2.30821 12.0109 2.68442 13.9022C3.06062 15.7935 3.98922 17.5308 5.35278 18.8944C6.71635 20.2579 8.45363 21.1865 10.3449 21.5627C12.2363 21.9389 14.1967 21.7458 15.9782 21.0079C17.7598 20.2699 19.2826 19.0202 20.3539 17.4169C21.4252 15.8135 21.9971 13.9284 21.9971 12.0001C21.9971 9.4142 20.9698 6.93425 19.1414 5.10577C17.3129 3.27729 14.8329 2.25006 12.2471 2.25006Z" fill="#FFF9F9"/>
                                <path d="M26.2497 24.9676L20.7222 19.4026L19.6572 20.4601L25.1847 26.0251C25.2542 26.095 25.3367 26.1506 25.4276 26.1886C25.5185 26.2266 25.616 26.2464 25.7146 26.2467C25.8131 26.2471 25.9108 26.228 26.0019 26.1906C26.0931 26.1532 26.176 26.0982 26.246 26.0288C26.3159 25.9594 26.3715 25.8768 26.4095 25.7859C26.4475 25.695 26.4673 25.5975 26.4676 25.499C26.468 25.4004 26.4489 25.3028 26.4115 25.2116C26.3741 25.1204 26.3192 25.0375 26.2497 24.9676Z" fill="#FFF9F9"/>
                            </svg>                            
                        </div>
                        <input type="text" name="keyword" id="tulisanCari" placeholder="Cari" class="tulisanCari" onKeyPress="return checkSubmit2(event)" autocomplete="off">
                    </div>
                </form>
                <div class="kotakKiriBawah">
                    <div class="bagianKiri">
                        <?php foreach($categories as $category): ?>
                        <a href="?category=<?=$category['categoryId']?>">
                        <div class="kategoriCard">
                            <div class="kotakFoto" style="background-image: url(../image/Kategori/<?=$category['categoryImage']?>);"></div>
                            <div class="kotakText"><?=$category['categoryName']?></div>
                        </div>
                        </a>
                        <?php endforeach; ?>
        
                    </div>
                    <div class="bagianKanan">
                        <?php foreach($items as $item): ?>
                        <div class="produkCard">
                            <div class="itemId displayNone"><?=$item['itemId']?></div>
                            <div class="fotoProduk" style="background-image: url(../image/Produk/<?=$item['itemImage']?>);"></div>
                            <div class="teks">
                                <p class="namaProduk"><?=$item['itemName']?> (Stok:<?=$item['qty']?>)</p>
                                <p class="harga">Rp<?=number_format($item['sellPrice'])?></p>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
            <div class="garis2"></div>
            <div class="kotakKanan">
                <div class="bagianAtas">
                    PESANAN BARU
                </div>
                <div class="bagianBawah">
                    <div class="pesanan">
                        <div class="containerPesanan">
                            <?php foreach($cashiers as $cashier): ?>
                            <div class="cardPesanan">
                                <div class="atas">
                                    <p class="namaBarang"><?=$cashier['itemName']?></p>
                                    <p class="harga">Rp<?=number_format($cashier['sellPrice'] * $cashier['qtyPesan'])?></p>
                                    <?php $_SESSION['grandTotal'] += $cashier['sellPrice'] * $cashier['qtyPesan']?>
                                </div>
                                <div class="bawah">
                                    <div class="svgSampah">
                                        <a href="../deleteCashier.php?itemId=<?=$cashier['itemId']?>">
                                        <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M15.0789 18.889H4.92335C4.70957 18.8839 4.49888 18.8368 4.30331 18.7503C4.10775 18.6638 3.93114 18.5396 3.78359 18.3848C3.63603 18.23 3.52042 18.0477 3.44336 17.8482C3.3663 17.6488 3.32929 17.4361 3.33446 17.2223V6.23895H4.44557V17.2223C4.44027 17.2902 4.44844 17.3584 4.46961 17.4232C4.49078 17.4879 4.52454 17.5478 4.56894 17.5994C4.61334 17.651 4.66751 17.6934 4.72833 17.724C4.78915 17.7546 4.85543 17.7729 4.92335 17.7778H15.0789C15.1468 17.7729 15.2131 17.7546 15.2739 17.724C15.3347 17.6934 15.3889 17.651 15.4333 17.5994C15.4777 17.5478 15.5115 17.4879 15.5326 17.4232C15.5538 17.3584 15.562 17.2902 15.5567 17.2223V6.23895H16.6678V17.2223C16.673 17.4361 16.636 17.6488 16.5589 17.8482C16.4818 18.0477 16.3662 18.23 16.2187 18.3848C16.0711 18.5396 15.8945 18.6638 15.6989 18.7503C15.5034 18.8368 15.2927 18.8839 15.0789 18.889Z" fill="white"/>
                                            <path d="M17.0995 4.99987H2.77724C2.62989 4.99987 2.48859 4.94134 2.3844 4.83716C2.28021 4.73297 2.22168 4.59166 2.22168 4.44432C2.22168 4.29698 2.28021 4.15567 2.3844 4.05148C2.48859 3.9473 2.62989 3.88876 2.77724 3.88876H17.0995C17.2468 3.88876 17.3881 3.9473 17.4923 4.05148C17.5965 4.15567 17.655 4.29698 17.655 4.44432C17.655 4.59166 17.5965 4.73297 17.4923 4.83716C17.3881 4.94134 17.2468 4.99987 17.0995 4.99987Z" fill="white"/>
                                            <path d="M11.666 7.2222H12.7771V15.5555H11.666V7.2222Z" fill="white"/>
                                            <path d="M7.22168 7.2222H8.33279V15.5555H7.22168V7.2222Z" fill="white"/>
                                            <path d="M12.7772 3.25568H11.7217V2.22235H8.27724V3.25568H7.22168V2.22235C7.22132 1.93704 7.33073 1.66253 7.52724 1.45568C7.72374 1.24883 7.99229 1.1255 8.27724 1.11124H11.7217C12.0066 1.1255 12.2752 1.24883 12.4717 1.45568C12.6682 1.66253 12.7776 1.93704 12.7772 2.22235V3.25568Z" fill="white"/>
                                        </svg>     
                                        </a>                                   
                                    </div>
                                    <div class="kotakJumlah">
                                        <div class="kotakMin">-</div>
                                        <div class="kotakAngka">
                                            <form action="../updateCashier.php" method="get" class="qty<?php echo"$i"; $i++;?>">
                                                <input type="hidden" name="itemId" value="<?=$cashier['itemId']?>">
                                                <input type="text" name="qtyBeli" class="inputText qtyBeli" value="<?=$cashier['qtyPesan']?>">
                                            </form>
                                        </div>
                                        <div class="kotakTambah">+</div>
                                    </div>
                                </div>
                            </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                    <div class="garis3"></div>
                    <div class="total">
                        <p class="totalPes">Total Pesanan</p>
                        <p class="harga harga2" id="grandTotal">Rp<?=number_format($_SESSION['grandTotal'])?></p>
                    </div>
                    <a href="../cashierDatabase.php"><button type="submit" class="tombolBayar" onclick="openPopUp()">UPLOAD PESANAN</button></a>
                </div>
            </div>
            <div class="popUp" id="popUp">
                <div class="isiDalam">
                    <p class="berhasil">UPLOAD BERHASIL</p>
                    <div class="svgBerhasil">
                        <svg width="131" height="95" viewBox="0 0 150 109" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <g clip-path="url(#clip0_556_4125)">
                            <path d="M-0.532227 4.07471H149.468V99.8317H-0.532227V4.07471ZM74.4678 28.014C81.0982 28.014 87.457 30.5361 92.1454 35.0256C96.8339 39.5151 99.4678 45.6041 99.4678 51.9532C99.4678 58.3023 96.8339 64.3913 92.1454 68.8808C87.457 73.3703 81.0982 75.8925 74.4678 75.8925C67.8374 75.8925 61.4785 73.3703 56.7901 68.8808C52.1017 64.3913 49.4678 58.3023 49.4678 51.9532C49.4678 45.6041 52.1017 39.5151 56.7901 35.0256C61.4785 30.5361 67.8374 28.014 74.4678 28.014ZM32.8011 20.0342C32.8011 24.2669 31.0452 28.3263 27.9196 31.3193C24.7939 34.3123 20.5547 35.9937 16.1344 35.9937V67.9127C20.5547 67.9127 24.7939 69.5942 27.9196 72.5871C31.0452 75.5801 32.8011 79.6395 32.8011 83.8722H116.134C116.134 79.6395 117.89 75.5801 121.016 72.5871C124.142 69.5942 128.381 67.9127 132.801 67.9127V35.9937C128.381 35.9937 124.142 34.3123 121.016 31.3193C117.89 28.3263 116.134 24.2669 116.134 20.0342H32.8011Z" fill="#604E49"/>
                            </g>
                            <defs>
                            <clipPath id="clip0_556_4125">
                            <rect width="150" height="109" fill="white"/>
                            </clipPath>
                            </defs>
                        </svg>                    
                    </div>
                    <button type="button" class="kembali" onclick="closePopUp()">KEMBALI KE KASIR</button>
                </div>
            </div>
       </div>
    </div>

    <!-- footer -->
    <?php include '../footer/footer.php' ?>

    <script src="kasir.js"></script>
</body>
</html>