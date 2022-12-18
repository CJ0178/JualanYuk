<?php 
session_start();
require 'functions.php';
// Ketika pencet checkout,
// - Hapus keranjang
// - Insert owns
// - Insert Buy

// DELETE FROM trolly WHERE userId = .. AND itemId = ..
// INSERT INTO buy VALUES (NULL, userId, itemId, qty)
// INSERT IGNORE INTO Owns VALUES(userId, itemId, qty, itemPrice*110% (default), itemPrice/qtyPerItem)
// UPDATE Owns SET

// for i in listOfItems
// 1. insert ignore
// 2. kalau affected 1 -> kelar
// 3. kalau affected 0 -> edit

// Memisahkan get menjadi listofId dan listOfQty
$lists = explode(',',$_GET['list']);

$listOfId = array();
$listOfQty = array();

foreach($lists as $count => $list){
    if($count % 2 == 0){
        $listOfId[] = $list;
    } else {
        $listOfQty[] = $list;
    }
}

$items = query("SELECT * FROM trolly t JOIN item i ON i.itemId = t.itemId WHERE t.userId = ".$_SESSION['currentUserId']. " AND t.itemId IN (". implode(",",$listOfId).")");
var_dump($items);

// Untuk setiap barang, coba di insert
foreach($items as $count => $item){
    $hargaSatuan = $item['buyPrice']/$item['qtyPerItem'];
    // Default harga jual 110%
    $query = "INSERT IGNORE INTO Owns VALUES(".$item['userId'].", ".$item['itemId'].", ".$listOfQty[$count].", ".$hargaSatuan*1.1.", ".$hargaSatuan.")";
    query($query);

    if(mysqli_affected_rows($conn) > 0){
        // Berhasil
        var_dump('berhasil');
    } else{
        // Gagal
        var_dump('gagal');
    }
}

?>