<?php 
session_start();
require 'functions.php';

// Ketika pencet checkout,
// - Hapus keranjang
// - Insert owns
// - Insert Buy

// Memisahkan GET menjadi listofId dan listOfQty
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

// Untuk setiap barang, coba di insert
foreach($items as $count => $item){
    // ====== Proses Cek Stok ======
    
    if(substractStock($item['itemId'], $listOfQty[$count])){
        // Pengurangan Stok berhasil

        // ====== Proses Insert Owns ======
        $hargaSatuan = $item['buyPrice']/$item['qtyPerItem'];
    
        // Default harga jual 110%
        $qtyBeli = $item['qtyPerItem'] * $listOfQty[$count];
        $query = "INSERT IGNORE INTO owns VALUES(".$item['userId'].", ".$item['itemId'].", ".$qtyBeli.", ".$hargaSatuan*1.1.", ".$hargaSatuan.")";
        mysqli_query($conn, $query);
        
        if(!mysqli_affected_rows($conn) > 0){
            // Gagal insert, berarti data sudah ada
            // Query quantity & COGS
            $query = "SELECT qty, COGS FROM owns WHERE userId = ". $_SESSION['currentUserId']. " AND itemId = ". $item['itemId'];
            $raw = query($query)[0];
    
            // Quantity baru = Stok lama berapa + Beli baru berapa
            $qtyNew = $raw['qty'] + $qtyBeli;
            // Calculate COGS baru = (stoklama * harga + hargabelidus * berapa dus)/(qtyNew)
            $COGSnew = (($raw['qty'] * $raw['COGS']) + ($item['buyPrice'] * $listOfQty[$count]))/($qtyNew);
            
            // Update database
            $query = "UPDATE owns SET qty = $qtyNew, COGS = $COGSnew WHERE userId = ". $_SESSION['currentUserId']. " AND itemId = ". $item['itemId'];
            mysqli_query($conn, $query);
            
        }
    
        // ====== Proses Insert Buy  ======
        $userId = $_SESSION['currentUserId'];
        $itemId = $item['itemId'];
        $qtyBeli = $listOfQty[$count];
        $query = "INSERT INTO Buy VALUES (NULL, $userId, $itemId, $qtyBeli)";
        mysqli_query($conn, $query);
    
        // ====== Proses Hapus Keranjang  ======
        $query = "DELETE FROM trolly WHERE userId = $userId AND itemId = $itemId";
        mysqli_query($conn, $query);
    
        // Redirect
        alertMessage('Pembelian Berhasil');
    } else{
        // Pengurangan stok gagal
        alertMessage('Pembelian gagal');
    }

    redirectTo('home/home.php');
}


?>