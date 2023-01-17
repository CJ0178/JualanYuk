<?php 
// Connect Database
$conn = mysqli_connect("localhost", "root", "", "jualanyuk");

function alertMessage($message){
    // Function ini cuma untuk alert dengan tulisan tertentu

    echo "<script> alert('$message') </script>";
}

function redirectTo($url){
    // Function ini untuk redirect ke url tertentu

    echo "<script> document.location.href = '$url' </script>;";
}

function query($strQuery){
    // Function query return array associative
    global $conn;

    // Ambil hasil select dari query
    $result = mysqli_query($conn, $strQuery);

    // Convert ke array associative
    $temp = [];

    while($row = mysqli_fetch_assoc($result)){
        $temp[] = $row;
    }

    return $temp;
}

function signup($data){
    // Function ini return true jika berhasil
    // dan return false jika gagal

    global $conn;

    $username = htmlspecialchars($data["username"]) ;
    $password = htmlspecialchars($data["password"]);
    $confirmPassword = htmlspecialchars($data["confirmPassword"]);

    // Cek apakah ada salah satu yang kosong
    if( strlen($username) === 0 ||
        strlen($password) === 0 ||
        strlen($confirmPassword) === 0){
        
        return false;
    }

    // Cek apakah password dan confirmnya beda
    if($password != $confirmPassword){
        return false;
    }

    // Hash password untuk disimpan dalam database
    $password = password_hash($password, PASSWORD_DEFAULT);

    // Query database
    $result = mysqli_query($conn, "INSERT INTO user(username,password) VALUES ('$username', '$password')");

    // Jika berhasil, maka return true
    if(mysqli_affected_rows($conn) > 0){
        return true;
    } else{
        return false;
    }
}

function login($data){
    // Function ini return bilangan asli jika berhasil
    // dan return -1 jika gagal

    $username = $data["username"];
    $password = $data["password"];

    $result = query("SELECT * FROM user WHERE username='$username'");

    // Kalau tidak ada username yang dimaksud
    if(sizeof($result) === 0){
        return -1;
    } else {
        $result = $result[0];
    }

    if(password_verify($password, $result["password"])){
        return $result["userId"];
    } else{
        return -1;
    }
}

function detailUser($id){
    // Function ini akan return array yang berisi informasi dari user dengan id tertentu

    $result = query("SELECT * FROM user WHERE userId=$id")[0];

    return $result;
}

function tambahItem($data){
    global $conn;

    // Function ini akan return true jika berhasil dan false jika gagal
    $nama = htmlspecialchars($data['nama']);
    $qtyPerPcs = htmlspecialchars($data['qtyPerPcs']);
    $harga = htmlspecialchars($data['harga']);
    $stok = htmlspecialchars($data['stok']);
    $kategori = htmlspecialchars($data['kategori']);
    $deskripsi = htmlspecialchars($data['deskripsi']);
    $rating = sprintf("%.2f",rand(40,50))/10;

    // Upload gambar
    $namaFile = $_FILES['gambar']['name'];
    $tmpName = $_FILES['gambar']['tmp_name'];

    // Cek apakah ekstensi file sesuai
    $ekstensiGambarValid = ['jpg', 'jpeg', 'png'];
    $ekstensiGambar = explode('.', $namaFile);
    $ekstensiGambar = strtolower(end($ekstensiGambar));
    if(!in_array($ekstensiGambar, $ekstensiGambarValid)){
        alertMessage('Pastikan yang kamu upload adalah gambar png/jpg/jpeg');
        return false;
    }

    // Ubah nama
    $namaFileBaru = uniqid();
    $namaFileBaru .= '.'.$ekstensiGambar;

    // Pindah penyimpanan gambar
    move_uploaded_file($tmpName, 'image/Produk/' .$namaFileBaru);
    
    // String query
    $strQuery = "INSERT INTO item VALUES
    (NULL, $kategori, '$nama',$stok,$rating,$qtyPerPcs,$harga,'$namaFileBaru','$deskripsi')
    ";


    mysqli_query($conn, $strQuery);

    // Jika berhasil, maka return true
    if(mysqli_affected_rows($conn) > 0){
        return true;
    } else{
        return false;
    }
}

function getItemStock($itemId){
    // Function ini akan mengembalikan stock sebuah item
    $query = "SELECT itemStock FROM item WHERE itemId = $itemId";
    $stock = query($query)[0];
    
    return $stock;
}

function substractStock($itemId, $qtyBuy){
    // Function ini akan return true jika berhasil dan false jika gagal
    global $conn;

    if(getItemStock($itemId) >= $qtyBuy){
        // Kurangin stok
        $query = "UPDATE item SET itemStock = itemStock - $qtyBuy WHERE itemId = $itemId";
        mysqli_query($conn, $query);

        // Cek jika berhasil
        if(mysqli_affected_rows($conn) > 0){
            return true;
        } else{
            return false;
        }
    } else{
        return false;
    }
}

?>