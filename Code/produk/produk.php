<?php 

session_start();
require '../functions.php';

// Cek apakah current user sudah ada
if(isset($_SESSION["currentUserId"])){
    // Jika masuk memlalui login,
    $currentUserData = detailUser($_SESSION["currentUserId"]);
    $currentUserId = $currentUserData['userId'];
    $currentUsername = $currentUserData["username"];

    // Jika dia adalah admin, langsung lempar
    if($currentUsername == 'admin'){
        header("Location: ../editStok/editStok.php");
    }
} else{
    // Jika masuk melalui url
    $currentUsername = "YOUR NAME";
}

// Cek apakah produk yang dipilih sudah ada
if(isset($_GET["id"])){
    $itemId = $_GET["id"];
    $item = query("SELECT * FROM item WHERE itemId = $itemId")[0];
    $itemCategoryId = $item["categoryId"];
    $itemRecommendations = query("SELECT * FROM item WHERE categoryId = $itemCategoryId AND itemId != $itemId LIMIT 3");

} else{
    // KAlau belum ada produk yang dipilih
    redirectTo('../home/home.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produk</title>
    <link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet'>
    <link rel="stylesheet" href="produk.css">
    <link rel="stylesheet" href="../header/header.css">
    <link rel="stylesheet" href="../footer/footer.css">
</head>
<body>
        <!-- header -->
        <?php require '../header/headerWithSearch.php' ?>
    
        <!-- body -->
        <div class="main">
            <div class="kotakKiri">
                <?php foreach($itemRecommendations as $itemRecommendation): ?>
                    <a href="../produk/produk.php?id=<?=$itemRecommendation["itemId"]?>" style="color: inherit; text-decoration: inherit;">
                    <div class="card">
                        <div class="gambarCard" style="background-image:url(../image/Produk/<?=$itemRecommendation['itemImage']?>) ;"></div>
                        <div class="deskripsiCard">
                            <div class="kiri">
                                <p><?=$itemRecommendation['itemName']?> (<?=$itemRecommendation['qtyPerItem']?>pcs)</p>
                                <p class="harga">Rp<?=number_format($itemRecommendation['buyPrice'])?></p>
                            </div>
                            <div class="kanan">
                                <svg width="22" height="17" viewBox="0 0 22 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <g filter="url(#filter0_d_183_1477)">
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M17.7705 5.2712C17.8437 5.34444 17.8849 5.44378 17.8849 5.54736C17.8849 5.65095 17.8437 5.75028 17.7705 5.82353L14.4565 9.13751C14.3833 9.21075 14.2839 9.2519 14.1803 9.2519C14.0768 9.2519 13.9774 9.21075 13.9042 9.13751C13.8309 9.06426 13.7898 8.96492 13.7898 8.86134C13.7898 8.75776 13.8309 8.65842 13.9042 8.58518L16.5515 5.93786L5.34307 5.93841C5.29171 5.93841 5.24086 5.9283 5.19342 5.90865C5.14597 5.88899 5.10287 5.86019 5.06655 5.82388C5.03024 5.78756 5.00144 5.74446 4.98178 5.69701C4.96213 5.64957 4.95202 5.59872 4.95202 5.54736C4.95202 5.49601 4.96213 5.44516 4.98178 5.39772C5.00144 5.35027 5.03024 5.30716 5.06655 5.27085C5.10287 5.23454 5.14597 5.20573 5.19342 5.18608C5.24086 5.16643 5.29171 5.15631 5.34307 5.15631L16.5515 5.15687L13.9042 2.50955C13.8309 2.43631 13.7898 2.33697 13.7898 2.23339C13.7898 2.1298 13.8309 2.03046 13.9042 1.95722C13.9774 1.88398 14.0768 1.84283 14.1803 1.84283C14.2839 1.84283 14.3833 1.88398 14.4565 1.95722L17.7705 5.2712Z" fill="white"/>
                                    </g>
                                    <defs>
                                    <filter id="filter0_d_183_1477" x="0.952148" y="0.842827" width="20.9326" height="15.4091" filterUnits="userSpaceOnUse" color-interpolation-filters="sRGB">
                                    <feFlood flood-opacity="0" result="BackgroundImageFix"/>
                                    <feColorMatrix in="SourceAlpha" type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 127 0" result="hardAlpha"/>
                                    <feOffset dy="3"/>
                                    <feGaussianBlur stdDeviation="2"/>
                                    <feComposite in2="hardAlpha" operator="out"/>
                                    <feColorMatrix type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0.25 0"/>
                                    <feBlend mode="normal" in2="BackgroundImageFix" result="effect1_dropShadow_183_1477"/>
                                    <feBlend mode="normal" in="SourceGraphic" in2="effect1_dropShadow_183_1477" result="shape"/>
                                    </filter>
                                    </defs>
                                </svg>                                
                            </div>
                        </div>
                    </div>
                    </a>
                <?php endforeach; ?>
            </div>
            <div class="kotakKanan">
                <div class="kotakGambarProduk" style="background-image:url(../image/Produk/<?=$item["itemImage"]?>) ;"></div>
                <div class="bawahProduk">
                    <div class="deskripsiKiri">
                        <div class="namaProduk">
                            <p><?=$item["itemName"]?></p>
                        </div>
                        <div class="deskripsiProduk">
                            <div class="tulisanDeskripsi">Deskripsi</div>
                            <div class="isiDeskripsi">
                                <p>
                                    <?=$item["itemDescription"]?>
                                </p>
                            </div>
                            <div class="tulisanRating">Rating</div>
                            <div class="rating">
                                <div class="bintang">
                                    <svg width="34" height="33" viewBox="0 0 34 33" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <g filter="url(#filter0_d_183_1460)">
                                        <path d="M17 0L12.9817 8.23214L4 9.54464L10.5 15.9554L8.96332 25L17 20.7321L25.0367 25L23.5 15.9554L30 9.55357L21.0183 8.23214L17 0Z" fill="white"/>
                                        </g>
                                        <defs>
                                        <filter id="filter0_d_183_1460" x="0" y="0" width="34" height="33" filterUnits="userSpaceOnUse" color-interpolation-filters="sRGB">
                                        <feFlood flood-opacity="0" result="BackgroundImageFix"/>
                                        <feColorMatrix in="SourceAlpha" type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 127 0" result="hardAlpha"/>
                                        <feOffset dy="4"/>
                                        <feGaussianBlur stdDeviation="2"/>
                                        <feComposite in2="hardAlpha" operator="out"/>
                                        <feColorMatrix type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0.25 0"/>
                                        <feBlend mode="normal" in2="BackgroundImageFix" result="effect1_dropShadow_183_1460"/>
                                        <feBlend mode="normal" in="SourceGraphic" in2="effect1_dropShadow_183_1460" result="shape"/>
                                        </filter>
                                        </defs>
                                    </svg>                                        
                                </div>
                                <div class="angkaRating"><?=$item["itemRating"]?></div>
                                <div class="perLima">/5.0</div>
                            </div>
                        </div>
                    </div>
                    <div class="deskripsiKanan">
                        <div class="hargaProduk">
                            <p>Rp<?=number_format($item["buyPrice"])?></p>
                        </div>
                        <div class="totalItem">
                            <!-- Kotak plus min -->
                            <div class="kotakMin">-</div>
                            <div class="kotakAngka">
                                <form action="../insertKeranjang.php" method="get" id="formKeranjang">
                                    <input type="hidden" name="userId" value="<?=$currentUserId?>" id="userId">
                                    <input type="hidden" name="itemId" value="<?=$itemId?>" id="itemId">
                                    <input type="text" name="qty" id="qtyBeli" class="inputText" value="1">
                                </form>
                            </div>
                            <div class="kotakTambah">+</div>
                        </div>

                        
                        <div class="tulisanKeranjang">KERANJANG</div>
                        <div class="beliSekarang">
                            <p>BELI SEKARANG</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    
        <!-- footer -->
        <?php include '../footer/footer.php' ?>

        <script src="produk.js"></script>
</body>
</html>