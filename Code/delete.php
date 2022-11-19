<?php 

require 'functions.php';

// Jika masuk dengan cara yang benar
if(
    isset($_GET['id'])
){
    $id = $_GET['id'];

    $strQuery = "DELETE FROM item WHERE itemId=$id";

    mysqli_query($conn, $strQuery);

    if(mysqli_affected_rows($conn) > 0){
        // Jika berhasil delete
        alertMessage('Delete berhasil');
    } else{
        // Jika gagal delete
        alertMessage('Delete gagal');
    }
    redirectTo('editStok/editStok.php');
}else {
    redirectTo("home/home.php");
}


?>