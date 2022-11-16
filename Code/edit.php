<?php 

require 'functions.php';

// Jika masuk dengan cara yang benar
if(
    isset($_POST['id']) &&
    isset($_POST['nama']) &&
    isset($_POST['qtyPerPcs']) &&
    isset($_POST['harga']) &&
    isset($_POST['stok']) &&
    isset($_POST['kategori']) &&
    isset($_POST['deskripsi'])
){
    $id = $_POST['id'];
    $nama = $_POST['nama'];
    $qtyPerPcs = $_POST['qtyPerPcs'];
    $harga = $_POST['harga'];
    $stok = $_POST['stok'];
    $kategori = $_POST['kategori'];
    $deskripsi = $_POST['deskripsi'];

    $strQuery = "
        UPDATE item
            SET categoryId = $kategori,
            itemName = '$nama',
            itemStock = $stok,
            qtyPerItem = $qtyPerPcs,
            buyPrice = $harga,
            itemDescription = '$deskripsi'
        WHERE itemId = $id
    ";

    mysqli_query($conn, $strQuery);

    if(mysqli_affected_rows($conn) > 0){
        // Jika berhasil update
        alertMessage('Edit berhasil');
    } else{
        // Jika gagal update
        alertMessage('Edit gagal');
    }
    redirectTo('editStok/editStok.php');
}else {
    redirectTo("home/home.php");
}


?>