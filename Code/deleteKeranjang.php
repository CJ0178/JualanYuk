<?php 

require 'functions.php';

// Jika masuk dengan cara yang benar
if(
    isset($_GET['itemId']) &&
    isset($_GET['userId'])
){
    $itemId = $_GET['itemId'];
    $userId = $_GET['userId'];

    $strQuery = "DELETE FROM trolly WHERE itemId=$itemId AND userId = $userId";

    mysqli_query($conn, $strQuery);

    if(mysqli_affected_rows($conn) > 0){
        // Jika berhasil delete
        alertMessage('Delete berhasil');
    } else{
        // Jika gagal delete
        alertMessage('Delete gagal');
    }
    redirectTo('keranjang/keranjang.php');
}else {
    redirectTo("home/home.php");
}

?>