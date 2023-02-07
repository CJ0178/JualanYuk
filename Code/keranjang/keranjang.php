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
    $currentUsername = "YOUR NAME";
    redirectTo('../home/home.php');
}

$currentUserId = $currentUserData['userId'];

// Validasi semua keranjang, kalau ada yang stoknya kurang, keranjang diperbaiki
$query = "UPDATE trolly t JOIN item i ON i.itemId = t.itemId SET t.qty = i.itemStock WHERE i.itemStock < t.qty AND t.userId = $currentUserId";
mysqli_query($conn, $query);

// Delete semua keranjang yang 0
$query = "DELETE FROM trolly WHERE qty = 0 AND userId = $currentUserId";
mysqli_query($conn, $query);

// Query seluruh keranjang yang dimiliki currentUser
$trollies = query("SELECT t.userId, t.qty, i.qtyPerItem, i.itemId,i.itemName, i.buyPrice, i.itemImage, i.itemStock FROM trolly t JOIN item i ON i.itemId=t.itemId WHERE t.userId=$currentUserId");
$i = 0;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Keranjang</title>
    <link rel="stylesheet" href="../header/header.css">
    <link rel="stylesheet" href="../footer/footer.css">
    <link rel="stylesheet" href="../editStok/editStok.css">
    <link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet'>
    <link rel="stylesheet" href="keranjang.css">
</head>
<body>
    <!-- header -->
    <?php require '../header/headerWithSearch.php' ?>

    <!-- body -->
    <div class="main">
        <div class="kotakAtas">
            <div class="tulisanKeranjang">
                KERANJANG
            </div>
            <div class="garis"></div>
        </div>
        <div class="kotakBawah">
            <!-- <label for="myCheckBoxId" class="checkBox">
                <input type="checkbox" name="myCheckBoxName" id="myCheckBoxId" class="checkBoxInput">
                <div class="checkBoxBox"></div>
                Pilih Semua
            </label> -->
            <div class="pilihSemua">
                <div class="kotakPilih"  id="pilihSemua">
                    <svg viewBox="0 0 25 25" fill="none" xmlns="http://www.w3.org/2000/svg" id="gambarLogoPilihSemua" class="displayNone">
                        <rect x="0.5" y="0.5" width="23.3226" height="23.3226" fill="white" stroke="white"/>
                        <path d="M20.8232 5H19.2813C19.0652 5 18.86 5.09086 18.7277 5.24633L9.63318 15.7921L5.27233 10.7343C5.20636 10.6576 5.12227 10.5956 5.02638 10.5529C4.93049 10.5103 4.82529 10.488 4.71867 10.4879H3.17682C3.02903 10.4879 2.94742 10.6434 3.03786 10.7484L9.07953 17.7547C9.36187 18.0818 9.90449 18.0818 10.189 17.7547L20.9621 5.25845C21.0526 5.15547 20.971 5 20.8232 5Z" fill="#8C8E81"/>
                    </svg>                        
                </div>
                <div class="tulisanPilih">Pilih Semua</div>
            </div>
            <div class="garis2"></div>
            <div class="kumpulanKeranjang">
                <?php foreach($trollies as $trolly): ?>
                <div class="cardKeranjang">
                    <div class="kotakPilih">
                        <svg viewBox="0 0 25 25" fill="none" xmlns="http://www.w3.org/2000/svg" class="gambarlogo displayNone">
                            <rect x="0.5" y="0.5" width="23.3226" height="23.3226" fill="white" stroke="white"/>
                            <path d="M20.8232 5H19.2813C19.0652 5 18.86 5.09086 18.7277 5.24633L9.63318 15.7921L5.27233 10.7343C5.20636 10.6576 5.12227 10.5956 5.02638 10.5529C4.93049 10.5103 4.82529 10.488 4.71867 10.4879H3.17682C3.02903 10.4879 2.94742 10.6434 3.03786 10.7484L9.07953 17.7547C9.36187 18.0818 9.90449 18.0818 10.189 17.7547L20.9621 5.25845C21.0526 5.15547 20.971 5 20.8232 5Z" fill="#8C8E81"/>
                        </svg>      
                        <input type="checkbox" value="<?=$trolly['itemId'].','.$trolly['qty'].','?>" class="checkBoxInput">
                    </div>
                    <div class="kotakFoto" style="background-image:url(../image/Produk/<?=$trolly['itemImage']?>) ;"></div>
                    <div class="kotakTulisan">
                        <p class="namaBarang"><?=$trolly['itemName']?> (<?=$trolly['qtyPerItem']?>pcs)</p>
                        <p class="harga">Rp<?=number_format($trolly['buyPrice'])?></p>
                        <p class="stokItem displayNone"><?=$trolly['itemStock']?></p>
                    </div>
                    <div class="kotakJumlah">
                        <div class="kotakMin">-</div>
                        <div class="kotakAngka">
                            <form action="../updateKeranjang.php" method="get" class="qty<?php echo"$i"; $i++;?>">
                                <input type="hidden" name="itemId" value="<?=$trolly['itemId']?>">
                                <input type="text" name="qtyKeranjang" class="inputText qtyBeli" value="<?=$trolly['qty']?>">
                            </form>
                        </div>
                        <div class="kotakTambah">+</div>
                    </div>
                    <div class="tempatSampah">
                        <div class="svgTempatSampah">
                            <a href="../deleteKeranjang.php?userId=<?=$trolly['userId']?>&itemId=<?=$trolly['itemId']?>">
                                <svg width="32" height="32" viewBox="0 0 36 36" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M27.1399 34H8.85988C8.47507 33.9909 8.09583 33.9061 7.74381 33.7504C7.39179 33.5947 7.07391 33.3711 6.80831 33.0925C6.54271 32.8139 6.33461 32.4857 6.1959 32.1267C6.05718 31.7676 5.99058 31.3848 5.99988 31V11.23H7.99988V31C7.99033 31.1222 8.00504 31.2451 8.04315 31.3616C8.08126 31.4781 8.14202 31.5859 8.22194 31.6788C8.30186 31.7717 8.39937 31.848 8.50885 31.9031C8.61833 31.9582 8.73763 31.9911 8.85988 32H27.1399C27.2621 31.9911 27.3814 31.9582 27.4909 31.9031C27.6004 31.848 27.6979 31.7717 27.7778 31.6788C27.8577 31.5859 27.9185 31.4781 27.9566 31.3616C27.9947 31.2451 28.0094 31.1222 27.9999 31V11.23H29.9999V31C30.0092 31.3848 29.9426 31.7676 29.8039 32.1267C29.6651 32.4857 29.457 32.8139 29.1915 33.0925C28.9259 33.3711 28.608 33.5947 28.2559 33.7504C27.9039 33.9061 27.5247 33.9909 27.1399 34Z" fill="white"/>
                                    <path d="M30.78 9H5C4.73478 9 4.48043 8.89464 4.29289 8.70711C4.10536 8.51957 4 8.26522 4 8C4 7.73478 4.10536 7.48043 4.29289 7.29289C4.48043 7.10536 4.73478 7 5 7H30.78C31.0452 7 31.2996 7.10536 31.4871 7.29289C31.6746 7.48043 31.78 7.73478 31.78 8C31.78 8.26522 31.6746 8.51957 31.4871 8.70711C31.2996 8.89464 31.0452 9 30.78 9Z" fill="white"/>
                                    <path d="M21 13H23V28H21V13Z" fill="white"/>
                                    <path d="M13 13H15V28H13V13Z" fill="white"/>
                                    <path d="M23 5.86H21.1V4H14.9V5.86H13V4C12.9994 3.48645 13.1963 2.99233 13.55 2.62C13.9037 2.24767 14.3871 2.02568 14.9 2H21.1C21.6129 2.02568 22.0963 2.24767 22.45 2.62C22.8037 2.99233 23.0006 3.48645 23 4V5.86Z" fill="white"/>
                                </svg>                            
                            </a>
                        </div>
                    </div>
                    <div class="harga totalHarga">
                        <p class="subtotal">Rp<?=number_format($trolly['buyPrice']*$trolly['qty'])?></p>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>

        </div>
    </div>
    <div class="bagianBawah">
        <div class="kotakDalam">
            <div class="atas">
                <div class="tulisanSub">SUBTOTAL</div>
                <div class="garis3"></div>
            </div>
            <div class="bawah">
                <div class="totalBrg">
                    <p class="tulis">Total Barang</p>
                    <p class="jumlah grandTotalQty">0 Barang</p>
                </div>
                <div class="totalHrg">
                    <p class="tulis">Total Harga</p>
                    <p class="harga grandTotal">Rp0</p>
                </div>
            </div>
            <div class="tombolCekot">
                <p class="tulisanCekot">CHECKOUT</p>
            </div>
        </div>
    </div>

    <script src="keranjang.js"></script>
</body>
</html>