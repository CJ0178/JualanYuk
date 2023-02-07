<?php 
require 'functions.php';

$userId = $_GET['userId'];
$itemId = $_GET['itemId'];
$stok = $_GET['stok'];
$harga = $_GET['harga'];

$query = "
UPDATE owns
SET qty = $stok, sellPrice = $harga
WHERE userId = $userId AND itemId = $itemId
";

mysqli_query($conn, $query);

$query = $_GET['query'];
$query .= ' AND o.itemId = '.$itemId;
$items = query($query);

foreach($items as $item){
    echo '
    <form action="" method="get" class="formItem">
    <div class="itemId displayNone">'.$item['itemId'].'</div>
    <div class="cardBawah">
        <div class="bagian">
            <label for="namaAwal" class="namaAwal" id="namaAwal">'.$item['itemName'].'</label>
            <input type="text" name="nama" id="nama" class="nama displayNone" value="'.$item['itemName'].'" disabled>
        </div>
        <div class="bagian">
            <label for="stokAwal" class="stokAwal" id="stokAwal">'.$item['qty'].'</label>
            <input type="text" name="stok" id="stok2" class="stok2 displayNone" value="'.$item['qty'].'" disabled>
        </div>
        <div class="bagian">
            <label for="hargaAwal" class="hargaAwal" id="hargaAwal">Rp'.number_format($item['sellPrice']).'</label>
            <input type="text" name="harga" id="harga2" class="harga2 displayNone" value="'.$item['sellPrice'].'" disabled>
        </div>
    </div>
    </form>
    ';
}
?>