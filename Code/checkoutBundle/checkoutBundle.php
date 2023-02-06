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
    $currentUsername = "YOUR NAME";
    redirectTo('../home/home.php');
}

if(isset($_GET['bundle'])){
    $bundleId = $_GET['bundle'];
    $qtyBeli = $_GET['qtyBeli'];
    $listImage = ['','kiri1.png','kanan2.png', 'kiri3.png', 'kanan4.png', 'bundle1.png', 'bundle2.png','bundle3.png','bundle4.png'];
    $listNama = ['','WARUNG KESEHATAN', 'WARUNG SEKOLAH', 'WARUNG SEMBAKO', 'WARUNG ALAT TULIS', 'BUNDLE KESEHATAN', 'BUNDLE CEMILAN', 'BUNDLE KEBUTUHAN RT', 'BUNDLE ALAT TULIS'];
    $query = "SELECT * FROM bundleH bh  WHERE bh.idBundle = $bundleId";
    $items = query($query)[0    ];
} else{
    redirectTo('../home/home.php');
}

// Total harga
$grandTotal = 0;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>
    <link rel="stylesheet" href="../header/header.css">
    <link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet'>
    <link rel="stylesheet" href="../footer/footer.css">
    <link rel="stylesheet" href="checkoutBundle.css">
    <link rel="stylesheet" href="../pembayaran/pembayaran.css">
    
</head>
<body>
    <div class="bg" id="bg"></div>

    <!-- header -->
    <?php require '../header/headerWithoutSearch.php' ?>

    <!-- body -->
    <div class="main mainContainer">
        <div class="kotakAtas">
            <div class="tulisanCheckOut">
                CHECKOUT
            </div>
            <div class="garis"></div>
        </div>
        <div class="alamatPengiriman">
            <div class="alamatSvg">
                <svg width="26" height="30" viewBox="0 0 26 30" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M12.9408 -0.00012207C9.50992 0.00353737 6.22073 1.2374 3.79475 3.4308C1.36876 5.6242 0.00406125 8.59804 1.37677e-05 11.7C-0.00409539 14.2349 0.911726 16.701 2.60699 18.72C2.60699 18.72 2.95992 19.1402 3.01756 19.2008L12.9408 29.782L22.8687 19.1955C22.9205 19.1391 23.2746 18.72 23.2746 18.72L23.2757 18.7168C24.9702 16.6987 25.8856 14.2337 25.8815 11.7C25.8775 8.59804 24.5128 5.6242 22.0868 3.4308C19.6608 1.2374 16.3716 0.00353737 12.9408 -0.00012207ZM12.9408 15.9546C12.0101 15.9546 11.1003 15.705 10.3264 15.2375C9.55256 14.77 8.94941 14.1056 8.59325 13.3281C8.23708 12.5507 8.14389 11.6953 8.32546 10.87C8.50704 10.0446 8.95521 9.28655 9.61332 8.69153C10.2714 8.09652 11.1099 7.69131 12.0227 7.52715C12.9356 7.36298 13.8817 7.44724 14.7416 7.76926C15.6014 8.09128 16.3364 8.6366 16.8534 9.33626C17.3705 10.0359 17.6465 10.8585 17.6465 11.7C17.6449 12.8279 17.1487 13.9093 16.2665 14.7069C15.3844 15.5045 14.1883 15.9532 12.9408 15.9546Z" fill="white"/>
                </svg>                    
            </div>
            <p class="tulisanAlamat">Alamat Pengiriman</p>
        </div>
        <div class="kotakBawah">
            <form action="">
                <div class="nama">
                    <label for="namaId" class="judulEdit namaClass">Nama :</label>
                    <input type="text" name="namaName" id="namaId" class="isiEdit">
                </div>
                <div class="alamatLengkap">
                    <label for="alamatLengkapId" class="judulEdit alamatLengkapClass">Alamat Lengkap :</label>
                    <textarea name="alamatLengkapName" id="alamatLengkapId" cols="30" rows="4" class="isiEdit2"></textarea>
                </div>
                <div class="telp">
                    <label for="telpId" class="judulEdit telpClass">No. Telp :</label>
                    <input type="text" name="telpName" id="telpId" class="isiEdit">
                </div>
            </form>
        </div>
        <div class="listItem">
            <div class="cardItem">
               <div class="kotakFoto" style="background-image:url(../image/<?=$listImage[$bundleId]?>"></div>
               <div class="kotakTengah">
                    <p class="judul"><?=$listNama[$bundleId]?></p>
                    <p class="harga">Rp<?=number_format($items['price'])?></p>
                    <p class="jumlah">Jumlah: <?=$qtyBeli?></p>
               </div>
               <div class="kotakTotalHarga">
                    <p class="judul">Total:</p>
                    <p class="harga"><?=number_format($items['price'] * $qtyBeli)?></p>
                    <?php $grandTotal += $items['price'] * $qtyBeli?>
               </div>
            </div> 
        </div>
        <div class="kirimDanBayar">
            <div class="pengiriman">
                <div class="kirimSvg" style="background-image:url(../image/pengiriman.svg) ;"></div>
                <p class="tulisanKirim">Pengiriman</p>
                <p class="harga tulisan2">GRATIS</p>
            </div>
            <div class="pembayaran">
                <div class="bayarSvg" style="background-image:url(../image/pembayaran.svg) ;"></div>
                <p class="tulisanBayar">Pembayaran</p>
                <p class="harga tulisan2" id="buttonPilih">PILIH</p>
            </div>
        </div>
        <div class="bagianBawah">
            <div class="kotakDalam">
                <div class="atas">
                    <div class="tulisanSub">SUBTOTAL</div>
                    <div class="garis3"></div>
                </div>
                <div class="bawah">
                    <div class="totalPengiriman">
                        <p class="tulis">Pengiriman</p>
                        <p class="harga">GRATIS</p>
                    </div>
                    <div class="totalHrg">
                        <p class="tulis">Total Harga</p>
                        <p class="harga"><?= "Rp".number_format($grandTotal) ?></p>
                    </div>
                    <div class="garis4"></div>
                    <div class="totalBayar">
                        <p class="tulis">Total Pembayaran</p>
                        <!-- Ini harga plus ongkir 10k -->
                        <p class="harga"><?= "Rp".number_format($grandTotal) ?></p>
                    </div>
                </div>

                <!-- Untuk checkout form backend -->
                <div class="bundle displayNone"><?=$bundleId?></div>
                <div class="qtyBeli displayNone"><?=$qtyBeli?></div>

                <!-- Akhir dari checkout form backend -->

                <div class="tombol">
                    <button type="submit" class="tombolCekot" onclick="openPopUp()">
                    <p class="tulisanCekot">CHECKOUT</p>
                    </button>
                </div>
            </div>
        </div>
        <div class="popUp" id="popUp">
            <div class="isiDalam">
                <p class="berhasil">CHECKOUT BERHASIL</p>
                <div class="svgBerhasil">
                    <svg width="114" height="114" viewBox="0 0 154 154" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <g clip-path="url(#clip0_210_1671)">
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M100.751 34.43C100.751 28.0921 98.2332 22.0137 93.7516 17.5321C89.27 13.0505 83.1917 10.5328 76.8537 10.5328C70.5158 10.5328 64.4374 13.0505 59.9558 17.5321C55.4742 22.0137 52.9565 28.0921 52.9565 34.43V39.2095H100.751V34.43ZM110.31 34.43V39.2095H143.766V134.798C143.766 139.869 141.752 144.732 138.167 148.317C134.581 151.902 129.719 153.916 124.648 153.916H29.0592C23.9889 153.916 19.1262 151.902 15.5409 148.317C11.9556 144.732 9.94141 139.869 9.94141 134.798V39.2095H43.3976V34.43C43.3976 25.5569 46.9224 17.0472 53.1966 10.773C59.4709 4.49871 67.9806 0.973877 76.8537 0.973877C85.7268 0.973877 94.2365 4.49871 100.511 10.773C106.785 17.0472 110.31 25.5569 110.31 34.43ZM104.135 85.6084C105.032 84.7109 105.536 83.4937 105.536 82.2245C105.536 80.9553 105.032 79.7381 104.135 78.8407C103.237 77.9432 102.02 77.439 100.751 77.439C99.4818 77.439 98.2646 77.9432 97.3671 78.8407L72.0743 104.143L61.1198 93.179C60.6754 92.7347 60.1478 92.3822 59.5672 92.1417C58.9866 91.9012 58.3643 91.7774 57.7359 91.7774C57.1075 91.7774 56.4852 91.9012 55.9046 92.1417C55.324 92.3822 54.7964 92.7347 54.3521 93.179C53.9077 93.6234 53.5552 94.151 53.3147 94.7316C53.0742 95.3122 52.9504 95.9344 52.9504 96.5629C52.9504 97.1913 53.0742 97.8136 53.3147 98.3942C53.5552 98.9748 53.9077 99.5024 54.3521 99.9467L68.6904 114.285C69.1344 114.73 69.6618 115.083 70.2425 115.324C70.8231 115.565 71.4456 115.689 72.0743 115.689C72.7029 115.689 73.3254 115.565 73.9061 115.324C74.4867 115.083 75.0141 114.73 75.4581 114.285L104.135 85.6084Z" fill="#604E49"/>
                        </g>
                        <defs>
                        <clipPath id="clip0_210_1671">
                        <rect width="152.942" height="152.942" fill="white" transform="translate(0.382324 0.973877)"/>
                        </clipPath>
                        </defs>
                    </svg>                        
                </div>
                <button type="button" class="kembali" onclick="closePopUp()">KEMBALI KE BERANDA</button>
            </div>
        </div>
    </div>

    <!-- Pop up pembayaran -->
    <div class="popUpBayar displayNone">
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
    </div>

    <!-- footer -->
    <?php include '../footer/footer.php' ?>

    <!-- Hidden -->
    <div class="hidden">
<?php if(isset($_GET['list'])): ?>
<?=$_GET['list']?>
<?php else: ?>
<?=$itemId.",".$qty?>
<?php endif; ?>
    </div>

    <script src="../header/headerWithoutSearch.js"></script>
    <script src="checkoutBundle.js"></script>
</body>
</html>