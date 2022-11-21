<?php 
require 'functions.php';
session_start();

// Jika masuk dengan cara yang benar
if(
    isset($_GET['itemId']) &&
    isset($_GET['qtyKeranjang']) &&
    isset($_SESSION["currentUserId"])
){

    $itemId = $_GET['itemId'];
    $qtyKeranjang = $_GET['qtyKeranjang'];
    $currentUserId = $_SESSION['currentUserId'];

    $strQuery = "UPDATE trolly SET qty=$qtyKeranjang WHERE itemId=$itemId AND userId=$currentUserId";

    mysqli_query($conn, $strQuery);

    if(mysqli_affected_rows($conn) > 0){
        // Jika berhasil Update
    } else{
        // Jika gagal Update
    }
    redirectTo('keranjang/keranjang.php');
}else {
    redirectTo("home/home.php");
}

?>