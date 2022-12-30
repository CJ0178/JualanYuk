<?php 

session_start();
require '../functions.php';
$currentUserId = $_SESSION['currentUserId'];
$categories = query("SELECT * FROM category");

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
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gudang</title>
    <link rel="stylesheet" href="../header/header.css">
    <link rel="stylesheet" href="../footer/footer.css">
    <link rel="stylesheet" href="gudang.css">
    <link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet'>
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
        <div class="judulGudang">
            <p class="tulisanGudang">GUDANG</p>
            <div class="garis10"></div>
        </div>
        <form action="" method="get">
            <div class="cari">
                <div class="svgCarii">
                    <svg width="27" height="27" viewBox="0 0 27 27" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M12.2471 3.78756C13.8717 3.78608 15.4602 4.26647 16.8117 5.16797C18.1633 6.06947 19.217 7.35157 19.8398 8.85207C20.4625 10.3526 20.6262 12.0041 20.3102 13.5976C19.9942 15.1912 19.2126 16.6552 18.0643 17.8045C16.9161 18.9538 15.4528 19.7367 13.8595 20.0542C12.2662 20.3717 10.6146 20.2095 9.11352 19.5881C7.61245 18.9668 6.32939 17.9142 5.42665 16.5635C4.52392 15.2128 4.04208 13.6247 4.04207 12.0001C4.05192 9.8263 4.9193 7.74427 6.45569 6.20647C7.99209 4.66868 10.0733 3.7994 12.2471 3.78756M12.2471 2.25006C10.3187 2.25006 8.43364 2.82189 6.83026 3.89323C5.22689 4.96458 3.9772 6.48732 3.23925 8.2689C2.50129 10.0505 2.30821 12.0109 2.68442 13.9022C3.06062 15.7935 3.98922 17.5308 5.35278 18.8943C6.71635 20.2579 8.45363 21.1865 10.3449 21.5627C12.2363 21.9389 14.1967 21.7458 15.9782 21.0079C17.7598 20.2699 19.2826 19.0202 20.3539 17.4169C21.4252 15.8135 21.9971 13.9284 21.9971 12.0001C21.9971 9.4142 20.9698 6.93425 19.1414 5.10577C17.3129 3.27729 14.8329 2.25006 12.2471 2.25006Z" fill="#FFF9F9"/>
                        <path d="M26.2497 24.9676L20.7222 19.4026L19.6572 20.4601L25.1847 26.0251C25.2542 26.095 25.3367 26.1506 25.4276 26.1886C25.5185 26.2266 25.616 26.2464 25.7146 26.2467C25.8131 26.2471 25.9108 26.228 26.0019 26.1906C26.0931 26.1532 26.176 26.0982 26.246 26.0288C26.3159 25.9594 26.3715 25.8768 26.4095 25.7859C26.4475 25.695 26.4673 25.5975 26.4676 25.499C26.468 25.4004 26.4489 25.3028 26.4115 25.2116C26.3741 25.1204 26.3192 25.0375 26.2497 24.9676Z" fill="#FFF9F9"/>
                    </svg>                    
                </div>
                <input type="text" name="keyword" id="tulisanCari" placeholder="Cari" class="tulisanCari">
            </div>
        </form>
        <div class="isi">
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
            <div class="bagianTengah">
                <div class="bagianTengahAtas">
                    <div class="bagian">
                        <p class="namaBrg">NAMA BARANG</p>
                    </div>
                    <div class="bagian">
                        <p class="stok">BANYAK STOK</p>
                    </div>
                    <div class="bagian">
                        <p class="harga">HARGA JUAL(Satuan)</p>
                    </div>
                </div>
                
                <!-- Untuk keperluan backend -->
                <div class="userId displayNone"><?=$currentUserId?></div>
                <div class="queryItem displayNone"><?=$query?></div>
                
                <!-- Akhir dari keperluan backend -->

                <div class="bagianTengahBawah">
                    <?php foreach($items as $item): ?>
                        <form action="" method="get" class="formItem">
                        <div class="exactItem">
                            <div class="itemId displayNone"><?=$item['itemId']?></div>
                            <div class="cardBawah">
                                <div class="bagian">
                                    <label for="namaAwal" class="namaAwal" id="namaAwal"><?=$item['itemName']?></label>
                                </div>
                                <div class="bagian">
                                    <label for="stokAwal" class="stokAwal" id="stokAwal"><?=$item['qty']?></label>
                                    <input type="text" name="stok" id="stok2" class="stok2 displayNone" value="<?=$item['qty']?>" disabled>
                                </div>
                                <div class="bagian">
                                    <label for="hargaAwal" class="hargaAwal" id="hargaAwal">Rp<?=number_format($item['sellPrice'])?></label>
                                    <input type="text" name="harga" id="harga2" class="harga2 displayNone" value="<?=$item['sellPrice']?>" disabled>
                                </div>
                            </div>
                        </div>
                        </form>
                    <?php endforeach; ?>
                </div>
            </div>
            <div class="bagianKanan">
                <div class="bagianKananAtas">
                    <p class="edit2">EDIT</p>
                </div>
                <div class="bagianKananBawah">
                    <?php foreach($items as $item): ?>
                    <div class="paket2">
                        <div class="cardEdit">
                            <button type="button" class="edit" id="edit">
                                <svg width="14" height="15" viewBox="0 0 14 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M11.1987 13.8853H0.933226V3.69137H7.10185L8.03508 2.76465H0.933226C0.685719 2.76465 0.44835 2.86228 0.273336 3.03608C0.0983218 3.20987 0 3.44559 0 3.69137V13.8853C0 14.1311 0.0983218 14.3668 0.273336 14.5406C0.44835 14.7144 0.685719 14.812 0.933226 14.812H11.1987C11.4462 14.812 11.6836 14.7144 11.8586 14.5406C12.0336 14.3668 12.1319 14.1311 12.1319 13.8853V6.93488L11.1987 7.8616V13.8853Z" fill="white"/>
                                    <path d="M13.7785 2.68974L12.206 1.12822C12.1362 1.05873 12.0533 1.0036 11.962 0.965979C11.8707 0.92836 11.7729 0.908997 11.6741 0.908997C11.5752 0.908997 11.4774 0.92836 11.3861 0.965979C11.2948 1.0036 11.2119 1.05873 11.1421 1.12822L4.74484 7.51795L4.2269 9.7467C4.20484 9.85474 4.20716 9.96629 4.2337 10.0733C4.26024 10.1804 4.31033 10.2802 4.38038 10.3658C4.45044 10.4513 4.5387 10.5203 4.63884 10.5679C4.73897 10.6155 4.84848 10.6404 4.95949 10.641C5.01686 10.6473 5.07476 10.6473 5.13213 10.641L7.39521 10.1452L13.7785 3.7462C13.8485 3.6769 13.904 3.59457 13.9419 3.50393C13.9797 3.41328 13.9992 3.31611 13.9992 3.21797C13.9992 3.11983 13.9797 3.02266 13.9419 2.93201C13.904 2.84137 13.8485 2.75904 13.7785 2.68974V2.68974ZM6.90993 9.28798L5.20213 9.6633L5.59875 7.9813L10.4142 3.167L11.73 4.47367L6.90993 9.28798ZM12.2573 3.95008L10.9415 2.64341L11.6647 1.9113L12.9899 3.22724L12.2573 3.95008Z" fill="white"/>
                                </svg>                                
                            </button>
                            <button type="button" class="sampah displayNone" id="sampah">
                                <svg width="17" height="17" viewBox="0 0 17 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M12.8162 16.0556H4.18397C4.00225 16.0513 3.82316 16.0113 3.65693 15.9377C3.4907 15.8642 3.34059 15.7586 3.21517 15.6271C3.08975 15.4955 2.99148 15.3405 2.92598 15.171C2.86047 15.0014 2.82902 14.8206 2.83341 14.6389V5.3031H3.77786V14.6389C3.77335 14.6966 3.78029 14.7547 3.79829 14.8097C3.81628 14.8647 3.84498 14.9156 3.88272 14.9595C3.92046 15.0034 3.9665 15.0394 4.0182 15.0654C4.0699 15.0914 4.12624 15.107 4.18397 15.1112H12.8162C12.8739 15.107 12.9303 15.0914 12.982 15.0654C13.0337 15.0394 13.0797 15.0034 13.1174 14.9595C13.1552 14.9156 13.1839 14.8647 13.2019 14.8097C13.2199 14.7547 13.2268 14.6966 13.2223 14.6389V5.3031H14.1667V14.6389C14.1711 14.8206 14.1397 15.0014 14.0742 15.171C14.0087 15.3405 13.9104 15.4955 13.785 15.6271C13.6596 15.7586 13.5095 15.8642 13.3432 15.9377C13.177 16.0113 12.9979 16.0513 12.8162 16.0556Z" fill="white"/>
                                    <path d="M14.5348 4.24999H2.36089C2.23565 4.24999 2.11554 4.20023 2.02698 4.11168C1.93842 4.02312 1.88867 3.90301 1.88867 3.77776C1.88867 3.65252 1.93842 3.53241 2.02698 3.44385C2.11554 3.35529 2.23565 3.30554 2.36089 3.30554H14.5348C14.66 3.30554 14.7801 3.35529 14.8687 3.44385C14.9573 3.53241 15.007 3.65252 15.007 3.77776C15.007 3.90301 14.9573 4.02312 14.8687 4.11168C14.7801 4.20023 14.66 4.24999 14.5348 4.24999Z" fill="white"/>
                                    <path d="M9.91699 6.13892H10.8614V13.2222H9.91699V6.13892Z" fill="white"/>
                                    <path d="M6.13867 6.13892H7.08312V13.2222H6.13867V6.13892Z" fill="white"/>
                                    <path d="M10.8609 2.76724H9.96367V1.8889H7.03589V2.76724H6.13867V1.8889C6.13837 1.64639 6.23136 1.41306 6.39839 1.23724C6.56542 1.06141 6.79369 0.956583 7.03589 0.944458H9.96367C10.2059 0.956583 10.4341 1.06141 10.6012 1.23724C10.7682 1.41306 10.8612 1.64639 10.8609 1.8889V2.76724Z" fill="white"/>
                                </svg>                                
                            </button>
                        </div>
                        <div class="paket">
                            <button type="button" class="centangKosong displayNone" id="centangKosong">
                                <svg width="17" height="17" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <rect x="0.5" y="0.5" width="21" height="21" stroke="#BDC0AC"/>
                                </svg>            
                            </button>
                            <button type="button" class="centang displayNone" id="centang">
                                <svg width="17" height="17" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M9.6 15.2L16.65 8.15L15.25 6.75L9.6 12.4L6.75 9.55L5.35 10.95L9.6 15.2ZM2 20V2H20V20H2Z" fill="#BDC0AC"/>
                                    <rect x="0.5" y="0.5" width="21" height="21" stroke="#BDC0AC"/>
                                </svg>
                            </button>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>

    <div class="temp"></div>
    
    <!-- footer -->
    <?php include '../footer/footer.php' ?>

    <script src="gudang.js"></script>
</body>
</html>