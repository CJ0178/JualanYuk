<?php 

session_start();
require 'functions.php';

// Jika masuk dengan cara yang benar
if(
    isset($_GET['itemId'])
){
    $itemId = $_GET['itemId'];
    $userId = $_SESSION['currentUserId'];

    $strQuery = "DELETE FROM cashier WHERE itemId=$itemId AND userId = $userId";

    mysqli_query($conn, $strQuery);

    if(mysqli_affected_rows($conn) > 0){
        // Jika berhasil delete
        alertMessage('Delete berhasil');
    } else{
        // Jika gagal delete
        alertMessage('Delete gagal');
    }
    redirectTo('kasir/kasir.php');
}else {
    redirectTo("home/home.php");
}

?>