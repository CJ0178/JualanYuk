<?php 
session_start();

require '../functions.php';
$categories = query("SELECT * FROM category");

// Cek apakah current user sudah ada
if(isset($_SESSION["currentUserId"])){
    // Jika masuk memlalui login,
    $currentUserData = detailUser($_SESSION["currentUserId"]);
    $currentUsername = $currentUserData["username"];
} else{
    // Jika masuk melalui url
    $currentUsername = "YOUR NAME";
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Stok</title>
    <link rel="stylesheet" href="../header/header.css">
    <link rel="stylesheet" href="../editProduk/editProduk.css">
    <link rel="stylesheet" href="../footer/footer.css">
    <link rel="stylesheet" href="addStok.css">
    <link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet'>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <script src="addStok.js"></script>
</head>
<body>
    <!-- header -->
    <?php require '../header/headerWithoutSearch.php' ?>

    <!-- body -->
    <div class="main">
        <form action="../insertItem.php" method="post" enctype="multipart/form-data" id="form">
        <div class="gambarProduk" style="background-image:url(../image/plus.png) ;">
                <input type="file" name="gambar" id="addPhoto" class="addPhoto" onchange="readURL(this);">
        </div>
            <div class="bawahProduk">
                <div class="deskripsiKiri">
                    <div class="namaProduk">
                        <p>TAMBAH PRODUK</p>
                    </div>
                    <div class="deskripsiProduk">
                        <div class="edit">
                            <div class="nama">
                                <p class="judulEdit">Nama Produk:</p>
                                <input type="text" autocomplete="off" name="nama" class="isiEdit">
                            </div>
                            <div class="qtyPerPcs">
                                <p class="judulEdit">Qty (Pcs):</p>
                                <input type="text" autocomplete="off" name="qtyPerPcs" class="isiEdit">
                            </div>
                            <div class="harga">
                                <p class="judulEdit">Harga:</p>
                                <input type="text" autocomplete="off" name="harga" class="isiEdit">
                            </div>
                            <div class="stok">
                                <p class="judulEdit">Stok:</p>
                                <input type="text" autocomplete="off" name="stok" class="isiEdit">
                            </div>
                            <div class="kategoriProduk">
                                <p class="judulEdit">Kategori:</p>
                                    <select name="kategori" class="optionKategori">
                                        <option value="">Pilih Kategori</option>
                                        <?php foreach($categories as $category): ?>
                                            <option value="<?=$category['categoryId']?>"><?=$category['categoryName']?></option>
                                        <?php endforeach; ?>
                                    </select>
                            </div>
                        </div>
                        <div class="tulisanDeskripsi">
                            Deskripsi Barang:
                        </div>
                        <div class="isiDeskripsi">
                                <textarea name="deskripsi" id="isiEdit2" class="isiEdit2" cols="100" rows="200"></textarea>
                        </div>
                    </div>
                </div>
                <div class="deskripsiKanan">
                    <div class="tulisanKeranjang" id="buttonSimpan">SIMPAN</div>
                </div>
            </div>
        </div>
        </form>
    </div>

    <!-- footer -->
    <?php include '../footer/footer.php' ?>

    <script src="../addStok/addStok.js"></script>
</body>
</html>