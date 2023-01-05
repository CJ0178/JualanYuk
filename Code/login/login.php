<?php 

session_start();
require '../functions.php';

// Cek apakah current user sudah ada
if(isset($_SESSION["currentUserId"])){
    // Jika udah akun tapi masuk ke login,
    $currentUserData = detailUser($_SESSION["currentUserId"]);
    $currentUsername = $currentUserData["username"];

    if($currentUsername == 'admin'){
        header("Location: ../editStok/editStok.php");
    } else{
        redirectTo('../home/home.php');
    }
}

// Jika user sudah pencet tombol login
if(isset($_POST["submit"])){
    $_SESSION["currentUserId"] = login($_POST);
    if($_SESSION["currentUserId"] != -1){
        // Kalau login berhasil
        alertMessage('Login berhasil');
        redirectTo('../home/home.php');
    } else {
        // Kalau login gagal
        session_destroy();
        alertMessage('Login gagal');
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Masuk</title>
    <link rel="stylesheet" href="../header/header.css">
    <link rel="stylesheet" href="../signup/signup.css">
    <link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet'>
</head>
<body>
    <!-- header -->
    <div class="container">
        <!-- logo -->
        <div class="logo" style="background-image: url(../image/logo.svg) ;"></div>
    </div>

    <!-- tulisan judul -->
    <div class="titleBox">
        MASUK
        <div class="underline"></div>
    </div>

    <div class="box">
        <form action="" method="post">
            <!-- Nama Pengguna -->
            <label for="username">Nama Pengguna</label>
            <div class="kotakInput">
                <div class="logoInput">
                    <svg width="21" height="21" viewBox="0 0 21 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M10.5 10.5C12.9162 10.5 14.875 8.54125 14.875 6.125C14.875 3.70875 12.9162 1.75 10.5 1.75C8.08375 1.75 6.125 3.70875 6.125 6.125C6.125 8.54125 8.08375 10.5 10.5 10.5Z" stroke="white"/>
                        <path d="M14.875 12.25H15.183C15.8227 12.2502 16.4403 12.4839 16.9198 12.9074C17.3993 13.3308 17.7077 13.9147 17.787 14.5495L18.1291 17.283C18.1599 17.5293 18.1379 17.7792 18.0647 18.0163C17.9915 18.2535 17.8687 18.4723 17.7044 18.6583C17.5402 18.8443 17.3382 18.9933 17.112 19.0953C16.8857 19.1973 16.6404 19.2501 16.3922 19.25H4.60774C4.35958 19.2501 4.11424 19.1973 3.88801 19.0953C3.66178 18.9933 3.45983 18.8443 3.29557 18.6583C3.13131 18.4723 3.00849 18.2535 2.93527 18.0163C2.86205 17.7792 2.84009 17.5293 2.87087 17.283L3.21212 14.5495C3.29148 13.9144 3.60011 13.3303 4.07997 12.9068C4.55983 12.4833 5.17787 12.2498 5.81787 12.25H6.12499" stroke="white" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </div>
                <input type="text" name="username" id="username" placeholder="Masukkan Nama Pengguna" class="styleInput" autocomplete="off">
            </div>

            <!-- Kata Sandi -->
            <label for="password">Kata Sandi</label>
            <div class="kotakInput">
                <div class="logoInput">
                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M13.125 1.25C12.2466 1.2498 11.3804 1.45535 10.5958 1.85019C9.81115 2.24503 9.12991 2.81818 8.60666 3.5237C8.08342 4.22922 7.73271 5.0475 7.58264 5.91296C7.43257 6.77842 7.48732 7.66701 7.7425 8.5075L1.25 15V18.75H5L11.4925 12.2575C12.2662 12.4923 13.0814 12.5576 13.8826 12.4489C14.6838 12.3402 15.4522 12.06 16.1353 11.6275C16.8184 11.195 17.4003 10.6203 17.8412 9.94256C18.2822 9.26483 18.5718 8.5 18.6904 7.70021C18.8091 6.90041 18.7539 6.08444 18.5286 5.3079C18.3033 4.53137 17.9133 3.81252 17.3851 3.20035C16.8569 2.58818 16.203 2.09708 15.4678 1.76051C14.7326 1.42394 13.9335 1.24981 13.125 1.25ZM13.125 11.25C12.6947 11.2498 12.2668 11.1862 11.855 11.0612L11.1381 10.8438L10.6088 11.3731L8.62063 13.3612L7.75875 12.5L6.875 13.3837L7.73687 14.2456L6.74563 15.2369L5.88375 14.375L5 15.2587L5.86187 16.1206L4.4825 17.5H2.5V15.5175L8.62625 9.39125L9.15625 8.86188L8.93875 8.145C8.67161 7.26437 8.68897 6.32193 8.98834 5.45173C9.28772 4.58153 9.85388 3.82789 10.6063 3.29802C11.3587 2.76814 12.259 2.48901 13.1792 2.50033C14.0994 2.51165 14.9926 2.81285 15.7317 3.36107C16.4708 3.9093 17.0183 4.67664 17.2961 5.55394C17.574 6.43124 17.5682 7.37382 17.2795 8.24761C16.9907 9.12141 16.4338 9.88191 15.688 10.4209C14.9421 10.96 14.0453 11.2501 13.125 11.25Z" fill="white"/>
                    <path d="M13.75 7.5C14.4404 7.5 15 6.94036 15 6.25C15 5.55964 14.4404 5 13.75 5C13.0596 5 12.5 5.55964 12.5 6.25C12.5 6.94036 13.0596 7.5 13.75 7.5Z" fill="white"/>
                    </svg>
                </div>
                <input type="password" name="password" id="password" placeholder="Masukkan Kata Sandi" class="styleInput" autocomplete="off">
            </div>

            <!-- Button Buat Akun -->
            <div class="wrapSubmit">
                <input type="submit" name="submit" value="Masuk" onclick="return confirm('Yakin?');" class="buttonSubmit">
            </div>

            <div class="kataPenutup">
                Belum Punya Akun? <a href="../signup/signup.php">DAFTAR</a>
            </div>


        </form>

    </div>


    <script src="../header/header.js"></script>
</body>
</html>