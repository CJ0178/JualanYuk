<?php 


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <style>
        *{
            margin: 0;
        }

        .card{
            border: 2px solid black;
            width: 50%;
            padding: 10px;
            margin-top: 10px;
        }
        
        .tombol{
            background-color: pink;
            width: 20px;
            border-radius: 50%;
            text-align: center;
            display: inline-block;
        }

        .tombol:hover{
            background-color: salmon;
            cursor: pointer;
        }

    </style>
</head>
<body>
    <h1>List Semua Produk</h1>

    <div class="card">
        <h3>Chitato Barbekyu</h3>
        <p>Stok: 10</p>
        <p>Kategori: Makanan Ringan</p>
        <p>Rating: 4.5</p>
        <p>Isi satuan: 30</p>
        <p>Harga: 30000</p>

        <form action="" method="post">
            <div class="tombol" id="minus1">-</div>
                <input type="text" size="1" value="0" id="qty">
            <div class="tombol" id="plus1">+</div>
            <button type="submit">Checkout</button>
        </form>
    </div>

    <script>
        buttonMinus = document.getElementById('minus1');
        buttonPlus = document.getElementById('plus1');
        inputQty = document.getElementById('qty');

        buttonMinus.addEventListener('click', ()=>{
            if(parseInt(inputQty.value, 10) - 1 >= 0){
                inputQty.value = parseInt(inputQty.value, 10) - 1;
            } else {
                inputQty.value = 0;
            }
        } );
        
        buttonPlus.addEventListener('click', ()=>{
            inputQty.value = parseInt(inputQty.value, 10) + 1;
        } );
    </script>
</body>
</html>