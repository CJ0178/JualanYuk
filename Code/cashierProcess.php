<?php 

session_start();
require 'functions.php';
$currentUserId = $_SESSION['currentUserId'];
$itemId = $_GET['id'];

// Kalau belum ada, insert
$query = "INSERT IGNORE INTO cashier VALUES($currentUserId, $itemId, 1)";
mysqli_query($conn, $query);


if(!mysqli_affected_rows($conn) > 0){
    // Jika tidak berhasil insert, barulah nambah qty 1
    // Cek dulu stoknya yang sudah ada
    $stok = query("SELECT qty FROM owns WHERE userId = $currentUserId AND itemId = $itemId")[0]['qty'];
    $qtySekarang = query("SELECT qty FROM cashier WHERE userId = $currentUserId AND itemId = $itemId")[0]['qty'];
    if($qtySekarang < $stok){
        // Kalau nambah masih cukup, maka tambah
        $query = "UPDATE cashier SET qty = qty + 1 WHERE userId = $currentUserId AND itemId = $itemId";
        mysqli_query($conn, $query);
    } else{
        // Kalau dak cukup lagi, kasih pesan
        echo '<br><center style="color:pink;"> Stok tidak cukup </center>';
    }
}

$cashiers = query("SELECT *, o.qty AS 'qty', c.qty AS 'qtyPesan' FROM cashier c JOIN item i ON i.itemId = c.itemId JOIN Owns o ON o.itemId = i.itemId WHERE c.userId = $currentUserId AND o.userId = $currentUserId");
$_SESSION['grandTotal'] = 0;
$i = 0;

// Print tabel
echo '
<div class="pesanan">
    <div class="containerPesanan">';

foreach($cashiers as $cashier):
    echo '
    <div class="cardPesanan">
        <div class="atas">
            <p class="namaBarang">'.$cashier['itemName'].'</p>
            <p class="harga">Rp'.number_format($cashier['sellPrice']*$cashier['qtyPesan']).'</p>
        </div>
        <div class="bawah">
            <div class="svgSampah">
                <a href="../deleteCashier.php?itemId='.$cashier['itemId'].'">
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
                    <form action="../updateCashier.php" method="get" class="qty'. $i++. '">
                        <input type="hidden" name="itemId" value="'.$cashier['itemId'].'">
                        <input type="text" name="qtyBeli" class="inputText qtyBeli" value="'.$cashier['qtyPesan'].'">
                    </form>
                </div>
                <div class="kotakTambah">+</div>
            </div>
        </div>
    </div>
    ';
    $_SESSION['grandTotal'] += $cashier['sellPrice']*$cashier['qtyPesan'];
endforeach;

echo'
</div>
</div>
<div class="garis3"></div>
<div class="total">
    <p class="totalPes">Total Pesanan</p>
    <p class="harga harga2" id="grandTotal">Rp'.number_format($_SESSION['grandTotal']).'</p>
</div>
<div class="tombolBayar" onclick="openPopUp()">UPLOAD PESANAN</div>
';

?>