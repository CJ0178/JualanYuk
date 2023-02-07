<?php
session_start();
require 'functions.php';

$currentUserId = $_SESSION['currentUserId'];
$bundleId = $_GET['bundle'];
$qtyBeli = $_GET['qtyBeli'];
$query = "SELECT * FROM bundleh bh JOIN bundled bd  ON bd.idBundle = bh.idBundle JOIN item i ON i.itemId = bd.itemId WHERE bh.idBundle = $bundleId";
$items = query($query);

// Untuk setiap barang, coba di insert
foreach($items as $count => $item){
    // ====== Proses Insert Owns ======
    $hargaSatuan = $item['COGS'];

    // Default harga jual 110%
    $qtyBeli = $item['qty'];
    $query = "INSERT IGNORE INTO owns VALUES(".$currentUserId.", ".$item['itemId'].", ".$qtyBeli.", ".$hargaSatuan*1.1.", ".$hargaSatuan.")";
    mysqli_query($conn, $query);
    
    if(!mysqli_affected_rows($conn) > 0){
        // Gagal insert, berarti data sudah ada
        // Query quantity & COGS
        $query = "SELECT qty, COGS FROM owns WHERE userId = ". $currentUserId . " AND itemId = ". $item['itemId'];
        $raw = query($query)[0];

        // Quantity baru = Stok lama berapa + Beli baru berapa
        $qtyNew = $raw['qty'] + $qtyBeli;
        // Calculate COGS baru = (stoklama * harga + hargabeliperitem * berapaItem)/(qtyNew)
        $COGSnew = (($raw['qty'] * $raw['COGS']) + ($hargaSatuan * $qtyBeli))/($qtyNew);
        
        // Update database
        $query = "UPDATE owns SET qty = $qtyNew, COGS = $COGSnew WHERE userId = ". $currentUserId. " AND itemId = ". $item['itemId'];
        mysqli_query($conn, $query);
        
    }

    // Pembelian bundle tidak masuk ke dalam table Buy untuk best seller
    // Redirect
    alertMessage('Pembelian Berhasil');
    redirectTo('home/home.php');
}
?>
