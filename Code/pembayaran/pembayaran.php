<?php 
session_start();
require '../functions.php';

// Cek apakah current user sudah ada
if(isset($_SESSION["currentUserId"])){
    // Jika masuk memlalui login,
    $currentUserData = detailUser($_SESSION["currentUserId"]);
    $currentUsername = $currentUserData["username"];

    // Jika dia adalah admin, langsung lempar
    if($currentUsername == 'admin'){
        header("Location: ../editStok/editStok.php");
    }
} else{
    // Jika masuk melalui url
    redirectTo('../login/login.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pembayaran</title>
    <link rel="stylesheet" href="../header/header.css">
    <link rel="stylesheet" href="../footer/footer.css">
    <link rel="stylesheet" href="pembayaran.css">
    <link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet'>
</head>
<body>
    <!-- header -->
    <?php require '../header/headerWithoutSearch.php' ?>

    <!-- body -->
    <div class="main">
        <div class="judul">
            <p class="tulisanPembayaran">PEMBAYARAN</p>
            <div class="garis10"></div>
        </div>
        <p class="e-wallet">e-wallet</p>
        <div class="pilihan">
            <div class="cardPilihan">
                <div class="svgLogo" style="background-image: url(../image/dana.png);"></div>
                <p class="caraBayar">DANA</p>
                <div class="svgPanah">
                    <svg width="28" height="28" viewBox="0 0 28 28" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M14 19.6L19.6 14L14 8.4L12.04 10.36L14.28 12.6H8.4V15.4H14.28L12.04 17.64L14 19.6ZM14 28C12.0633 28 10.2433 27.6323 8.54 26.8968C6.83667 26.1623 5.355 25.165 4.095 23.905C2.835 22.645 1.83773 21.1633 1.1032 19.46C0.367733 17.7567 0 15.9367 0 14C0 12.0633 0.367733 10.2433 1.1032 8.54C1.83773 6.83667 2.835 5.355 4.095 4.095C5.355 2.835 6.83667 1.83727 8.54 1.1018C10.2433 0.367267 12.0633 0 14 0C15.9367 0 17.7567 0.367267 19.46 1.1018C21.1633 1.83727 22.645 2.835 23.905 4.095C25.165 5.355 26.1623 6.83667 26.8968 8.54C27.6323 10.2433 28 12.0633 28 14C28 15.9367 27.6323 17.7567 26.8968 19.46C26.1623 21.1633 25.165 22.645 23.905 23.905C22.645 25.165 21.1633 26.1623 19.46 26.8968C17.7567 27.6323 15.9367 28 14 28Z" fill="white"/>
                    </svg>                        
                </div>
            </div>
            <div class="cardPilihan">
                <div class="svgLogo" style="background-image: url(../image/ovo.png);"></div>
                <p class="caraBayar">OVO</p>
                <div class="svgPanah">
                    <svg width="28" height="28" viewBox="0 0 28 28" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M14 19.6L19.6 14L14 8.4L12.04 10.36L14.28 12.6H8.4V15.4H14.28L12.04 17.64L14 19.6ZM14 28C12.0633 28 10.2433 27.6323 8.54 26.8968C6.83667 26.1623 5.355 25.165 4.095 23.905C2.835 22.645 1.83773 21.1633 1.1032 19.46C0.367733 17.7567 0 15.9367 0 14C0 12.0633 0.367733 10.2433 1.1032 8.54C1.83773 6.83667 2.835 5.355 4.095 4.095C5.355 2.835 6.83667 1.83727 8.54 1.1018C10.2433 0.367267 12.0633 0 14 0C15.9367 0 17.7567 0.367267 19.46 1.1018C21.1633 1.83727 22.645 2.835 23.905 4.095C25.165 5.355 26.1623 6.83667 26.8968 8.54C27.6323 10.2433 28 12.0633 28 14C28 15.9367 27.6323 17.7567 26.8968 19.46C26.1623 21.1633 25.165 22.645 23.905 23.905C22.645 25.165 21.1633 26.1623 19.46 26.8968C17.7567 27.6323 15.9367 28 14 28Z" fill="white"/>
                    </svg>                        
                </div>
            </div>
            <div class="cardPilihan">
                <div class="svgLogo" style="background-image: url(../image/gopay.png);"></div>
                <p class="caraBayar">GOPAY</p>
                <div class="svgPanah">
                    <svg width="28" height="28" viewBox="0 0 28 28" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M14 19.6L19.6 14L14 8.4L12.04 10.36L14.28 12.6H8.4V15.4H14.28L12.04 17.64L14 19.6ZM14 28C12.0633 28 10.2433 27.6323 8.54 26.8968C6.83667 26.1623 5.355 25.165 4.095 23.905C2.835 22.645 1.83773 21.1633 1.1032 19.46C0.367733 17.7567 0 15.9367 0 14C0 12.0633 0.367733 10.2433 1.1032 8.54C1.83773 6.83667 2.835 5.355 4.095 4.095C5.355 2.835 6.83667 1.83727 8.54 1.1018C10.2433 0.367267 12.0633 0 14 0C15.9367 0 17.7567 0.367267 19.46 1.1018C21.1633 1.83727 22.645 2.835 23.905 4.095C25.165 5.355 26.1623 6.83667 26.8968 8.54C27.6323 10.2433 28 12.0633 28 14C28 15.9367 27.6323 17.7567 26.8968 19.46C26.1623 21.1633 25.165 22.645 23.905 23.905C22.645 25.165 21.1633 26.1623 19.46 26.8968C17.7567 27.6323 15.9367 28 14 28Z" fill="white"/>
                    </svg>                        
                </div>
            </div>
            <div class="cardPilihan">
                <div class="svgLogo" style="background-image: url(../image/shopeepay.png);"></div>
                <p class="caraBayar">SHOPEE PAY</p>
                <div class="svgPanah">
                    <svg width="28" height="28" viewBox="0 0 28 28" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M14 19.6L19.6 14L14 8.4L12.04 10.36L14.28 12.6H8.4V15.4H14.28L12.04 17.64L14 19.6ZM14 28C12.0633 28 10.2433 27.6323 8.54 26.8968C6.83667 26.1623 5.355 25.165 4.095 23.905C2.835 22.645 1.83773 21.1633 1.1032 19.46C0.367733 17.7567 0 15.9367 0 14C0 12.0633 0.367733 10.2433 1.1032 8.54C1.83773 6.83667 2.835 5.355 4.095 4.095C5.355 2.835 6.83667 1.83727 8.54 1.1018C10.2433 0.367267 12.0633 0 14 0C15.9367 0 17.7567 0.367267 19.46 1.1018C21.1633 1.83727 22.645 2.835 23.905 4.095C25.165 5.355 26.1623 6.83667 26.8968 8.54C27.6323 10.2433 28 12.0633 28 14C28 15.9367 27.6323 17.7567 26.8968 19.46C26.1623 21.1633 25.165 22.645 23.905 23.905C22.645 25.165 21.1633 26.1623 19.46 26.8968C17.7567 27.6323 15.9367 28 14 28Z" fill="white"/>
                    </svg>                        
                </div>
            </div>
            <div class="cardPilihan">
                <div class="svgLogo" style="background-image: url(../image/linkaja.png);"></div>
                <p class="caraBayar">LINK AJA</p>
                <div class="svgPanah">
                    <svg width="28" height="28" viewBox="0 0 28 28" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M14 19.6L19.6 14L14 8.4L12.04 10.36L14.28 12.6H8.4V15.4H14.28L12.04 17.64L14 19.6ZM14 28C12.0633 28 10.2433 27.6323 8.54 26.8968C6.83667 26.1623 5.355 25.165 4.095 23.905C2.835 22.645 1.83773 21.1633 1.1032 19.46C0.367733 17.7567 0 15.9367 0 14C0 12.0633 0.367733 10.2433 1.1032 8.54C1.83773 6.83667 2.835 5.355 4.095 4.095C5.355 2.835 6.83667 1.83727 8.54 1.1018C10.2433 0.367267 12.0633 0 14 0C15.9367 0 17.7567 0.367267 19.46 1.1018C21.1633 1.83727 22.645 2.835 23.905 4.095C25.165 5.355 26.1623 6.83667 26.8968 8.54C27.6323 10.2433 28 12.0633 28 14C28 15.9367 27.6323 17.7567 26.8968 19.46C26.1623 21.1633 25.165 22.645 23.905 23.905C22.645 25.165 21.1633 26.1623 19.46 26.8968C17.7567 27.6323 15.9367 28 14 28Z" fill="white"/>
                    </svg>                        
                </div>
            </div>
            <div class="cardPilihan">
                <div class="svgLogo" style="background-image: url(../image/jenius.png);"></div>
                <p class="caraBayar">JENIUS</p>
                <div class="svgPanah">
                    <svg width="28" height="28" viewBox="0 0 28 28" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M14 19.6L19.6 14L14 8.4L12.04 10.36L14.28 12.6H8.4V15.4H14.28L12.04 17.64L14 19.6ZM14 28C12.0633 28 10.2433 27.6323 8.54 26.8968C6.83667 26.1623 5.355 25.165 4.095 23.905C2.835 22.645 1.83773 21.1633 1.1032 19.46C0.367733 17.7567 0 15.9367 0 14C0 12.0633 0.367733 10.2433 1.1032 8.54C1.83773 6.83667 2.835 5.355 4.095 4.095C5.355 2.835 6.83667 1.83727 8.54 1.1018C10.2433 0.367267 12.0633 0 14 0C15.9367 0 17.7567 0.367267 19.46 1.1018C21.1633 1.83727 22.645 2.835 23.905 4.095C25.165 5.355 26.1623 6.83667 26.8968 8.54C27.6323 10.2433 28 12.0633 28 14C28 15.9367 27.6323 17.7567 26.8968 19.46C26.1623 21.1633 25.165 22.645 23.905 23.905C22.645 25.165 21.1633 26.1623 19.46 26.8968C17.7567 27.6323 15.9367 28 14 28Z" fill="white"/>
                    </svg>                        
                </div>
            </div>
            <div class="cardPilihan">
                <div class="svgLogo" style="background-image: url(../image/sakuku.png);"></div>
                <p class="caraBayar">SAKUKU</p>
                <div class="svgPanah">
                    <svg width="28" height="28" viewBox="0 0 28 28" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M14 19.6L19.6 14L14 8.4L12.04 10.36L14.28 12.6H8.4V15.4H14.28L12.04 17.64L14 19.6ZM14 28C12.0633 28 10.2433 27.6323 8.54 26.8968C6.83667 26.1623 5.355 25.165 4.095 23.905C2.835 22.645 1.83773 21.1633 1.1032 19.46C0.367733 17.7567 0 15.9367 0 14C0 12.0633 0.367733 10.2433 1.1032 8.54C1.83773 6.83667 2.835 5.355 4.095 4.095C5.355 2.835 6.83667 1.83727 8.54 1.1018C10.2433 0.367267 12.0633 0 14 0C15.9367 0 17.7567 0.367267 19.46 1.1018C21.1633 1.83727 22.645 2.835 23.905 4.095C25.165 5.355 26.1623 6.83667 26.8968 8.54C27.6323 10.2433 28 12.0633 28 14C28 15.9367 27.6323 17.7567 26.8968 19.46C26.1623 21.1633 25.165 22.645 23.905 23.905C22.645 25.165 21.1633 26.1623 19.46 26.8968C17.7567 27.6323 15.9367 28 14 28Z" fill="white"/>
                    </svg>                        
                </div>
            </div>
        </div>
        <p class="lainnya">Lainnya</p>
        <div class="cardPilihan2">
            <div class="svgLogo" style="background-image: url(../image/virtual.png);"></div>
            <p class="caraBayar">BANK VIRTUAL ACCOUNT</p>
            <div class="svgPanah">
                <svg width="28" height="28" viewBox="0 0 28 28" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M14 19.6L19.6 14L14 8.4L12.04 10.36L14.28 12.6H8.4V15.4H14.28L12.04 17.64L14 19.6ZM14 28C12.0633 28 10.2433 27.6323 8.54 26.8968C6.83667 26.1623 5.355 25.165 4.095 23.905C2.835 22.645 1.83773 21.1633 1.1032 19.46C0.367733 17.7567 0 15.9367 0 14C0 12.0633 0.367733 10.2433 1.1032 8.54C1.83773 6.83667 2.835 5.355 4.095 4.095C5.355 2.835 6.83667 1.83727 8.54 1.1018C10.2433 0.367267 12.0633 0 14 0C15.9367 0 17.7567 0.367267 19.46 1.1018C21.1633 1.83727 22.645 2.835 23.905 4.095C25.165 5.355 26.1623 6.83667 26.8968 8.54C27.6323 10.2433 28 12.0633 28 14C28 15.9367 27.6323 17.7567 26.8968 19.46C26.1623 21.1633 25.165 22.645 23.905 23.905C22.645 25.165 21.1633 26.1623 19.46 26.8968C17.7567 27.6323 15.9367 28 14 28Z" fill="white"/>
                </svg>                        
            </div>
        </div>
    </div>

    <!-- footer -->
    <?php include '../footer/footer.php' ?>
    
</body>
</html>