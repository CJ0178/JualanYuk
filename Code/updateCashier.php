<?php 
require 'functions.php';
session_start();

// Jika masuk dengan cara yang benar
if(
    isset($_GET['itemId']) &&
    isset($_GET['qtyBeli']) &&
    isset($_SESSION["currentUserId"])
){

    $itemId = $_GET['itemId'];
    $qtyBeli = $_GET['qtyBeli'];
    $currentUserId = $_SESSION['currentUserId'];

    $strQuery = "UPDATE Cashier SET qty=$qtyBeli WHERE itemId=$itemId AND userId=$currentUserId";

    mysqli_query($conn, $strQuery);

    if(mysqli_affected_rows($conn) > 0){
        // Jika berhasil Update
    } else{
        // Jika gagal Update
    }
    redirectTo('kasir/kasir.php');
}else {
    redirectTo("home/home.php");
}

?>