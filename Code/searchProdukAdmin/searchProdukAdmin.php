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
    <title>Edit Stok</title>
    <link rel="stylesheet" href="../header/header.css">
    <link rel="stylesheet" href="../home/home.css">
    <link rel="stylesheet" href="../footer/footer.css">
    <link rel="stylesheet" href="searchProdukAdmin.css">
    <link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet'>
</head>
<body>
    <!-- header -->
    <?php require '../header/headerWithSearchAdmin.php' ?>

    <!-- body -->
    <div class="main">
        <!-- lengkapi tokomu -->
        <div class="kotakLengkapi">
            <div class="pembungkusContainer">
                <div class="containerKiri">
                    <div class="kotakAtas2">
                        <div class="tulisanLengkapi">
                            DAFTAR PRODUK
                        </div>
                        <div class="garis2"></div>
                    </div>
                    <div class="bantuan"></div>
                </div>
                <div class="containerKanan">
                    <a href="../addStok/addStok.php">
                    <div class="tambahProduk">
                         <div class="tandaPlus">
                            +
                        </div>
                        <div class="tulisanTambahProduk">
                            TAMBAH PRODUK
                        </div>
                    </div>
                    </a>
                </div>
            </div>

            <div class="isiLengkapi">
                <?php foreach($items as $item): ?>
                    <?php if($item['itemStock'] <= 0) {continue;} else {$count++;} ?>
                <div class="cardLengkapi">
                    <div class="gambarLengkapi" style="background-image:url(../image/Produk/<?=$item["itemImage"]?>);"></div>
                    <div class="deskripsiLengkapi">
                        <div class="kiri2">
                            <p><?=$item["itemName"]?> (<?=$item["qtyPerItem"]?>pcs)</p>
                            <p class="harga">Rp<?=number_format($item["buyPrice"])?></p>
                        </div>
                        <div class="kanan2">
                            <a href="../editProduk/editProduk.php?id=<?=$item['itemId']?>">
                            <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M12.7987 14.9334H1.06656V3.20132H8.11649L9.18305 2.13477H1.06656C0.783688 2.13477 0.512405 2.24713 0.312387 2.44715C0.112369 2.64717 0 2.91845 0 3.20132V14.9334C0 15.2163 0.112369 15.4876 0.312387 15.6876C0.512405 15.8876 0.783688 16 1.06656 16H12.7987C13.0815 16 13.3528 15.8876 13.5528 15.6876C13.7529 15.4876 13.8652 15.2163 13.8652 14.9334V6.93427L12.7987 8.00082V14.9334Z" fill="white"/>
                                <path d="M15.7478 2.04945L13.9506 0.252304C13.8709 0.172328 13.7761 0.108875 13.6718 0.0655804C13.5675 0.0222857 13.4556 0 13.3427 0C13.2298 0 13.1179 0.0222857 13.0136 0.0655804C12.9093 0.108875 12.8145 0.172328 12.7348 0.252304L5.42352 7.60621L4.83159 10.1713C4.80637 10.2956 4.80902 10.424 4.83935 10.5472C4.86968 10.6704 4.92693 10.7853 5.00699 10.8837C5.08705 10.9822 5.18793 11.0616 5.30237 11.1164C5.41681 11.1712 5.54196 11.1999 5.66883 11.2005C5.7344 11.2077 5.80057 11.2077 5.86614 11.2005L8.45254 10.6299L15.7478 3.26532C15.8278 3.18557 15.8912 3.09081 15.9345 2.98649C15.9778 2.88217 16.0001 2.77033 16.0001 2.65739C16.0001 2.54444 15.9778 2.4326 15.9345 2.32828C15.8912 2.22396 15.8278 2.12921 15.7478 2.04945ZM7.89793 9.64333L5.94614 10.0753L6.39942 8.13949L11.9029 2.59873L13.4067 4.10257L7.89793 9.64333ZM14.0093 3.49997L12.5055 1.99612L13.332 1.15354L14.8465 2.66805L14.0093 3.49997Z" fill="white"/>
                            </svg>                                                            
                            </a>
                        </div>
                    </div>
                </div>
                
                <?php endforeach; ?>
                <!-- Sisa item -->
                <?php for($i = 0; $i < (5 - ($count)%5)%5; $i++): ?>
                    <div class="cardLengkapi visibilityHidden"></div>
                <?php endfor; ?>
            </div>

            <!-- Di sini untuk item habis -->
            <?php if(sizeof($items) > $count): ?>
            <div class="tulisanHabis">HABIS</div>

            <div class="isiLengkapi">
                <?php $count = 0; ?>
                <?php foreach($items as $item): ?>
                    <?php if($item['itemStock'] > 0) {continue;} else {$count++;} ?>
                <div class="cardLengkapi">
                    <div class="gambarLengkapi" style="background-image:url(../image/Produk/<?=$item["itemImage"]?>);"></div>
                    <div class="deskripsiLengkapi">
                        <div class="kiri2">
                            <p><?=$item["itemName"]?> (<?=$item["qtyPerItem"]?>pcs)</p>
                            <p class="harga">Rp<?=number_format($item["buyPrice"])?></p>
                        </div>
                        <div class="kanan2">
                            <a href="../editProduk/editProduk.php?id=<?=$item['itemId']?>">
                            <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M12.7987 14.9334H1.06656V3.20132H8.11649L9.18305 2.13477H1.06656C0.783688 2.13477 0.512405 2.24713 0.312387 2.44715C0.112369 2.64717 0 2.91845 0 3.20132V14.9334C0 15.2163 0.112369 15.4876 0.312387 15.6876C0.512405 15.8876 0.783688 16 1.06656 16H12.7987C13.0815 16 13.3528 15.8876 13.5528 15.6876C13.7529 15.4876 13.8652 15.2163 13.8652 14.9334V6.93427L12.7987 8.00082V14.9334Z" fill="white"/>
                                <path d="M15.7478 2.04945L13.9506 0.252304C13.8709 0.172328 13.7761 0.108875 13.6718 0.0655804C13.5675 0.0222857 13.4556 0 13.3427 0C13.2298 0 13.1179 0.0222857 13.0136 0.0655804C12.9093 0.108875 12.8145 0.172328 12.7348 0.252304L5.42352 7.60621L4.83159 10.1713C4.80637 10.2956 4.80902 10.424 4.83935 10.5472C4.86968 10.6704 4.92693 10.7853 5.00699 10.8837C5.08705 10.9822 5.18793 11.0616 5.30237 11.1164C5.41681 11.1712 5.54196 11.1999 5.66883 11.2005C5.7344 11.2077 5.80057 11.2077 5.86614 11.2005L8.45254 10.6299L15.7478 3.26532C15.8278 3.18557 15.8912 3.09081 15.9345 2.98649C15.9778 2.88217 16.0001 2.77033 16.0001 2.65739C16.0001 2.54444 15.9778 2.4326 15.9345 2.32828C15.8912 2.22396 15.8278 2.12921 15.7478 2.04945ZM7.89793 9.64333L5.94614 10.0753L6.39942 8.13949L11.9029 2.59873L13.4067 4.10257L7.89793 9.64333ZM14.0093 3.49997L12.5055 1.99612L13.332 1.15354L14.8465 2.66805L14.0093 3.49997Z" fill="white"/>
                            </svg>                                                            
                            </a>
                        </div>
                    </div>
                </div>
                
                <?php endforeach; ?>
                <!-- Sisa item -->
                <?php for($i = 0; $i < (5 - ($count)%5)%5; $i++): ?>
                    <div class="cardLengkapi visibilityHidden"></div>
                <?php endfor; ?>
            </div>
            <?php endif; ?>
        </div>
    </div>

    <!-- footer -->
    <?php include '../footer/footer.php' ?>

    <script src="../header/header.js"></script>
</body>
</html>