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
    <title>Build Your Warung</title>
    <link rel="stylesheet" href="../header/header.css">
    <link rel="stylesheet" href="../footer/footer.css">
    <link rel="stylesheet" href="buildYourWarung.css">
    <link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet'>
</head>
<body>
    <!-- header -->
    <?php require '../header/headerWithoutSearch.php' ?>

    <!-- body -->
    <div class="main">
        <div class="judul">
            <div class="judulAtas">
                <p class="tulisanJudul">BUILD YOUR WARUNG</p>
                <div class="garis10"></div>
            </div>
            <div class="deskripsi">
                <p class="deskripsi1">
                    Dengan Build Your Warung, kalian bisa dengan mudah membuka warung dimanapun kalian berada dan mendapatkan harga produk <span style="font-weight:bold;">LEBIH MURAH</span> daripada harga satuan lohh!
                </p>
                <p class="deskripsi2">
                    Kami memudahkan kalian untuk mendapatkan lapak berjualan yang mudah diletakkan dimana saja!
                </p>
            </div>
        </div>
        <div class="bawah">
            <div class="boothBundle">
                <div class="sub">
                    <p class="subJudul">Container Booth + Bundle</p>
                    <div class="garis11"></div>
                </div>
                <div class="paket">
                    <div class="cardPaket">
                        <div class="cardPaket1" style="background-image: url(../image/bg1.png);">
                            <div class="kiri1" style="background-image: url(../image/kiri1.png);"></div>
                            <div class="tengah1">
                                <p class="judulCard1">WARUNG KESEHATAN</p>
                                <p class="deskripsiCard1">Dapatkan Booth Container
                                    berikut dengan isinya!</p>
                                <div class="beliCard1">BELI SEKARANG!</div>
                            </div>
                            <div class="kanan1" style="background-image: url(../image/kanan1.png);"></div>
                        </div>
                        <div class="cardPaket2 displayNone" style="background-image: url(../image/bg2.png);">
                            <div class="kiri2" style="background-image: url(../image/hover1.png);"></div>
                            <div class="tengah2">
                                <p class="judulCard2">WARUNG KESEHATAN</p>
                                <div class="deskripsiCard2">
                                    <div class="deskripsiKiriCard2">
                                        Warna: Hitam 
                                        <br> Dimensi: 4x3x2.5 m 
                                        <br> 
                                        <br> Mendapatkan: 
                                        <br> Container Booth 
                                        <br> Bundle Obat-obatan
                                        <br> (8 Jenis Produk)
                                        <br>
                                        <br> *Termasuk Ongkir
                                    </div>
                                    <div class="deskripsiKananCard2">
                                        Isi Bundle Obat-obatan: <br>
                                        Antis - 50 pcs <br>
                                        Minyak angin - 120 pcs <br>
                                        Tolak angin - 200 pcs <br>
                                        Blackmores - 40 pcs <br>
                                        Vitacimin - 240 pcs <br>
                                        Betadine - 120 pcs <br>
                                        Diapet - 200 pcs <br>
                                        Adem sari - 200 pcs
                                    </div>
                                </div>
                            </div>
                            <div class="kanan2">
                                <div class="garis12"></div>
                                <div class="bagKanan">
                                    <p class="harga10">Rp9.600.000</p>
                                    <form action="../checkoutBundle/checkoutBundle.php" method="get" class="formBeli">
                                        <input type="hidden" name="bundle" value="1">
                                        <input type="hidden" name="qtyBeli" value="1">
                                    </form>
                                    <div class="beliCard2 buttonBeli">BELI SEKARANG!</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="cardPaket">
                        <div class="cardPaket1" style="background-image: url(../image/bg1.png);">
                            <div class="kiri1" style="background-image: url(../image/kiri2.png);"></div>
                            <div class="tengah1">
                                <p class="judulCard1">WARUNG SEKOLAH</p>
                                <p class="deskripsiCard1">Dapatkan Booth Container
                                    berikut dengan isinya!</p>
                                <div class="beliCard1">BELI SEKARANG!</div>
                            </div>
                            <div class="kanan1" style="background-image: url(../image/kanan2.png);"></div>
                        </div>
                        <div class="cardPaket2 displayNone" style="background-image: url(../image/bg2.png);">
                            <div class="kiri2" style="background-image: url(../image/hover2.png);"></div>
                            <div class="tengah2">
                                <p class="judulCard2">WARUNG SEKOLAH</p>
                                <div class="deskripsiCard2">
                                    <div class="deskripsiKiriCard2">
                                        Warna: Hijau 
                                        <br> Dimensi: 5x4x2.5 m 
                                        <br> 
                                        <br> Mendapatkan: 
                                        <br> Container Booth 
                                        <br> Bundle Cemilan
                                        <br> (8 Jenis Produk)
                                        <br>
                                        <br> *Termasuk Ongkir
                                    </div>
                                    <div class="deskripsiKananCard2">
                                        Isi Bundle Cemilan: <br>
                                        Kusuka - 50 pcs <br>
                                        Chitato - 50 pcs <br>
                                        Cimory - 60 pcs <br>
                                        Freshtea - 60 pcs <br>
                                        Oreo - 120 pcs <br>
                                        Tango - 80 pcs <br>
                                        Rebo - 60 pcs <br>
                                        Pocky - 50 pcs
                                    </div>
                                </div>
                            </div>
                            <div class="kanan2">
                                <div class="garis12"></div>
                                <div class="bagKanan">
                                    <p class="harga10">Rp5.700.000</p>
                                    <form action="../checkoutBundle/checkoutBundle.php" method="get" class="formBeli">
                                        <input type="hidden" name="bundle" value="2">
                                        <input type="hidden" name="qtyBeli" value="1">
                                    </form>
                                    <div class="beliCard2 buttonBeli">BELI SEKARANG!</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="cardPaket">
                        <div class="cardPaket1" style="background-image: url(../image/bg1.png);">
                            <div class="kiri1" style="background-image: url(../image/kiri3.png);"></div>
                            <div class="tengah1">
                                <p class="judulCard1">WARUNG SEMBAKO</p>
                                <p class="deskripsiCard1">Dapatkan Booth Container
                                    berikut dengan isinya!</p>
                                <div class="beliCard1">BELI SEKARANG!</div>
                            </div>
                            <div class="kanan1" style="background-image: url(../image/kanan3.png);"></div>
                        </div>
                        <div class="cardPaket2 displayNone" style="background-image: url(../image/bg2.png);">
                            <div class="kiri2" style="background-image: url(../image/hover3.png);"></div>
                            <div class="tengah2">
                                <p class="judulCard2">WARUNG SEMBAKO</p>
                                <div class="deskripsiCard2">
                                    <div class="deskripsiKiriCard2">
                                        Warna: Hitam 
                                        <br> Dimensi: 4x3x2.5 m 
                                        <br> 
                                        <br> Mendapatkan: 
                                        <br> Container Booth 
                                        <br> Bundle Kebutuhan RT
                                        <br> (8 Jenis Produk)
                                        <br>
                                        <br> *Termasuk Ongkir
                                    </div>
                                    <div class="deskripsiKananCard2">
                                        Isi Bundle Kebutuhan RT: <br>
                                        Pepsodent - 50 pcs <br>
                                        Biore - 60 pcs <br>
                                        Sunlight - 120 pcs <br>
                                        MamyPoko - 50 pcs <br>
                                        Rinso - 60 pcs <br>
                                        Indomie - 200 pcs <br>
                                        Kapal Api - 200 pcs <br>
                                        Wipol - 80 pcs
                                    </div>
                                </div>
                            </div>
                            <div class="kanan2">
                                <div class="garis12"></div>
                                <div class="bagKanan">
                                    <p class="harga10">Rp10.200.000</p>
                                    <form action="../checkoutBundle/checkoutBundle.php" method="get" class="formBeli">
                                        <input type="hidden" name="bundle" value="3">
                                        <input type="hidden" name="qtyBeli" value="1">
                                    </form>
                                    <div class="beliCard2 buttonBeli">BELI SEKARANG!</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="cardPaket">
                        <div class="cardPaket1" style="background-image: url(../image/bg1.png);">
                            <div class="kiri1" style="background-image: url(../image/kiri4.png);"></div>
                            <div class="tengah1">
                                <p class="judulCard1">WARUNG ALAT TULIS</p>
                                <p class="deskripsiCard1">Dapatkan Booth Container
                                    berikut dengan isinya!</p>
                                <div class="beliCard1">BELI SEKARANG!</div>
                            </div>
                            <div class="kanan1" style="background-image: url(../image/kanan4.png);"></div>
                        </div>
                        <div class="cardPaket2 displayNone" style="background-image: url(../image/bg2.png);">
                            <div class="kiri2" style="background-image: url(../image/hover4.png);"></div>
                            <div class="tengah2">
                                <p class="judulCard2">WARUNG ALAT TULIS</p>
                                <div class="deskripsiCard2">
                                    <div class="deskripsiKiriCard2">
                                        Warna: Hitam 
                                        <br> Dimensi: 4x3x2.5 m 
                                        <br> 
                                        <br> Mendapatkan: 
                                        <br> Container Booth 
                                        <br> Bundle Alat Tulis
                                        <br> (8 Jenis Produk)
                                        <br>
                                        <br> *Termasuk Ongkir
                                    </div>
                                    <div class="deskripsiKananCard2">
                                        Isi Bundle Alat Tulis: <br>
                                        Pena - 240 pcs <br>
                                        Pensil - 240 pcs <br>
                                        Penggaris - 120 pcs <br>
                                        Penghapus - 240 pcs <br>
                                        Stapler - 120 pcs <br>
                                        Stipo - 240 pcs <br>
                                        Busur - 120 pcs <br>
                                        Peruncing - 120 pcs
                                    </div>
                                </div>
                            </div>
                            <div class="kanan2">
                                <div class="garis12"></div>
                                <div class="bagKanan">
                                    <p class="harga10">Rp7.700.000</p>
                                    <form action="../checkoutBundle/checkoutBundle.php" method="get" class="formBeli">
                                        <input type="hidden" name="bundle" value="4">
                                        <input type="hidden" name="qtyBeli" value="1">
                                    </form>
                                    <div class="beliCard2 buttonBeli">BELI SEKARANG!</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="bundle">
                <div class="sub2">
                    <p class="subJudul2">Bundle</p>
                    <div class="garis13"></div>
                </div>
                <div class="kategoriBundle">
                    <div class="cardBundle">
                        <div class="kiriBundle" style="background-image: url(../image/bgBundle.png);">
                            <div class="isiKiriBundle" style="background-image: url(../image/bundle1.png);"></div>
                        </div>
                        <div class="tengahBundle">
                            <div class="judulBundle">Bundle Kesehatan</div>
                            <div class="deskripsiBundle">Deskripsi</div>
                            <div class="isiBundle">
                                <span style="font-weight:bold;">Isi Bundle Obat-obatan:</span><br>
                                Antis - 50 pcs <br>
                                Minyak angin - 120 pcs <br>
                                Tolak angin - 200 pcs <br>
                                Blackmores - 40 pcs <br>
                                Vitacimin - 240 pcs <br>
                                Betadine - 120 pcs <br>
                                Diapet - 200 pcs <br>
                                Adem sari - 200 pcs
                            </div>
                        </div>
                        <div class="kananBundle">
                            <p class="harga11">Rp7.600.000</p>
                            <div class="kotakJumlah">
                                <div class="kotakMin">-</div>
                                <div class="kotakAngka">
                                    <form action="../checkoutBundle/checkoutBundle.php" method="get" class="formBeli">
                                        <input type="hidden" name="bundle" value="5">
                                        <input type="text" name="qtyBeli" class="inputText qtyBeli" value="1">
                                    </form>
                                </div>
                                <div class="kotakTambah">+</div>
                            </div>
                            <div class="beliCard3 buttonBeli">BELI SEKARANG!</div>
                        </div>
                    </div>
                    <div class="cardBundle">
                        <div class="kiriBundle" style="background-image: url(../image/bgBundle.png);">
                            <div class="isiKiriBundle" style="background-image: url(../image/bundle2.png);"></div>
                        </div>
                        <div class="tengahBundle">
                            <div class="judulBundle">Bundle Cemilan</div>
                            <div class="deskripsiBundle">Deskripsi</div>
                            <div class="isiBundle">
                                <span style="font-weight:bold;">Isi Bundle Cemilan:</span><br>
                                Kusuka - 50 pcs <br>
                                Chitato - 50 pcs <br>
                                Cimory - 60 pcs <br>
                                Freshtea - 60 pcs <br>
                                Oreo - 120 pcs <br>
                                Tango - 80 pcs <br>
                                Rebo - 60 pcs <br>
                                Pocky - 50 pcs
                            </div>
                        </div>
                        <div class="kananBundle">
                            <p class="harga11">Rp3.700.000</p>
                            <div class="kotakJumlah">
                                <div class="kotakMin">-</div>
                                <div class="kotakAngka">
                                    <form action="../checkoutBundle/checkoutBundle.php" method="get" class="formBeli">
                                        <input type="hidden" name="bundle" value="6">
                                        <input type="text" name="qtyBeli" class="inputText qtyBeli" value="1">
                                    </form>
                                </div>
                                <div class="kotakTambah">+</div>
                            </div>
                            <div class="beliCard3 buttonBeli">BELI SEKARANG!</div>
                        </div>
                    </div>
                    <div class="cardBundle">
                        <div class="kiriBundle" style="background-image: url(../image/bgBundle.png);">
                            <div class="isiKiriBundle" style="background-image: url(../image/bundle3.png);"></div>
                        </div>
                        <div class="tengahBundle">
                            <div class="judulBundle">Bundle Kebutuhan RT</div>
                            <div class="deskripsiBundle">Deskripsi</div>
                            <div class="isiBundle">
                                <span style="font-weight:bold;">Isi Bundle Kebutuhan RT:</span><br>
                                Pepsodent - 50 pcs <br>
                                Biore - 60 pcs <br>
                                Sunlight - 120 pcs <br>
                                MamyPoko - 50 pcs <br>
                                Rinso - 60 pcs <br>
                                Indomie - 200 pcs <br>
                                Kapal Api - 200 pcs <br>
                                Wipol - 80 pcs
                            </div>
                        </div>
                        <div class="kananBundle">
                            <p class="harga11">Rp8.200.000</p>
                            <div class="kotakJumlah">
                                <div class="kotakMin">-</div>
                                <div class="kotakAngka">
                                    <form action="../checkoutBundle/checkoutBundle.php" method="get" class="formBeli">
                                        <input type="hidden" name="bundle" value="7">
                                        <input type="text" name="qtyBeli" class="inputText qtyBeli" value="1">
                                    </form>
                                </div>
                                <div class="kotakTambah">+</div>
                            </div>
                            <div class="beliCard3 buttonBeli">BELI SEKARANG!</div>
                        </div>
                    </div>
                    <div class="cardBundle">
                        <div class="kiriBundle" style="background-image: url(../image/bgBundle.png);">
                            <div class="isiKiriBundle" style="background-image: url(../image/bundle4.png);"></div>
                        </div>
                        <div class="tengahBundle">
                            <div class="judulBundle">Bundle Alat Tulis</div>
                            <div class="deskripsiBundle">Deskripsi</div>
                            <div class="isiBundle">
                                <span style="font-weight:bold;">Isi Bundle Alat Tulis:</span><br>
                                Pena - 240 pcs <br>
                                Pensil - 240 pcs <br>
                                Penggaris - 120 pcs <br>
                                Penghapus - 240 pcs <br>
                                Stapler - 120 pcs <br>
                                Stipo - 240 pcs <br>
                                Busur - 120 pcs <br>
                                Peruncing - 120 pcs
                            </div>
                        </div>
                        <div class="kananBundle">
                            <p class="harga11">Rp5.700.000</p>
                            <div class="kotakJumlah">
                                <div class="kotakMin">-</div>
                                <div class="kotakAngka">
                                    <form action="../checkoutBundle/checkoutBundle.php" method="get" class="formBeli">
                                        <input type="hidden" name="bundle" value="8">
                                        <input type="text" name="qtyBeli" class="inputText qtyBeli" value="1">
                                    </form>
                                </div>
                                <div class="kotakTambah">+</div>
                            </div>
                            <div class="beliCard3 buttonBeli">BELI SEKARANG!</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- footer -->
    <?php include '../footer/footer.php' ?>
    
    <script src="../header/headerWithoutSearch.js"></script>
    <script src="buildYourWarung.js"></script>
</body>
</html>