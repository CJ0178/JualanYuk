<?php 

require 'functions.php';

if(isset($_GET['userId'])&&
    isset($_GET['itemId']) &&
    isset($_GET['qty'])
){
    $userId = $_GET['userId'];
    $itemId = $_GET['itemId'];
    $qty = $_GET['qty']; 

    mysqli_query($conn, "INSERT INTO trolly VALUES($userId, $itemId, $qty)");
    
    if(mysqli_affected_rows($conn) > 0){
        // Jika berhasil masuk keranjang
        alertMessage('Keranjang anda telah ditambahkan');
    } else{
        // Jika berhasil masuk keranjang
        alertMessage('Keranjang anda gagal ditambahkan');
    }

    redirectTo('home/home.php');
} else{
    redirectTo('home/home.php');
}

?>