<?php 

require 'functions.php';

if(tambahItem($_POST)){
    
    alertMessage('Tambah item berhasil');
    redirectTo('editStok/editStok.php');
} else{
    alertMessage('Tambah item gagal');
    redirectTo('home/home.php');
}

?>