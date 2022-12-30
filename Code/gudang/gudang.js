bagianTengahBawah = document.getElementsByClassName('bagianTengahBawah')[0]
queryItem = document.getElementsByClassName('queryItem')[0].innerHTML
exactItems = document.getElementsByClassName('exactItem')
paket2 = document.getElementsByClassName('paket2')
paket = document.getElementsByClassName('paket')

edit = document.getElementsByClassName("edit")
centang = document.getElementsByClassName("centang");
centangKosong = document.getElementsByClassName("centangKosong");
sampah = document.getElementsByClassName("sampah");
itemId = document.getElementsByClassName('itemId')
namaAwal = document.getElementsByClassName("namaAwal");
nama = document.getElementsByClassName("nama");
stokAwal = document.getElementsByClassName("stokAwal");
stok2 = document.getElementsByClassName("stok2");
hargaAwal = document.getElementsByClassName("hargaAwal");
harga2 = document.getElementsByClassName("harga2");
formItem = document.getElementsByClassName("formItem");
temp = document.getElementsByClassName('temp')[0]
userId = document.getElementsByClassName('userId')[0]

for(let i=0; i<edit.length; i++){
    // Untuk tombol edit munculin sampah dan centang
    edit[i].addEventListener('click', function(){
        centangKosong[i].classList.toggle("displayNone")
        edit[i].classList.toggle("displayNone")
        sampah[i].classList.toggle("displayNone")
    })
    
    sampah[i].addEventListener('click', function(){
        isConfirm = confirm('Yakin hapus barang ini?')
        
        if(isConfirm){
            var userIdVal = userId.innerHTML
            var itemIdVal = itemId[i].innerHTML

            // Buat object ajax
            var xhr = new XMLHttpRequest()
            // Cek kesiapan ajax
            xhr.onreadystatechange = function(){
                if(xhr.readyState == 4 && xhr.status == 200){
                    exactItems[i].style.display = "none"
                    paket2[i].style.display = "none"
                    temp.innerHTML = xhr.responseText
                }
            }
            // Eksekusi ajax
            xhr.open('GET','../deleteGudangProcess.php?userId='+userIdVal+'&itemId='+itemIdVal+'&query='+queryItem, true)
            xhr.send()
        }
    })

    // Ketika centang ditekan
    centang[i].addEventListener('click', function(){
        centangKosong[i].classList.toggle("displayNone")
        edit[i].classList.toggle("displayNone")
        sampah[i].classList.toggle("displayNone")

        // Buat object ajax
        var xhr = new XMLHttpRequest()
    
        var userIdVal = userId.innerHTML
        var itemIdVal = itemId[i].innerHTML
        var stokVal = stok2[i].value
        var hargaVal = harga2[i].value

        // Cek kesiapan ajax
        xhr.onreadystatechange = function(){
            if(xhr.readyState == 4 && xhr.status == 200){
                exactItems[i].innerHTML = xhr.responseText
            }
        }
        // Eksekusi ajax
        xhr.open('GET','../editGudangProcess.php?userId='+userIdVal+'&itemId='+itemIdVal+'&stok='+stokVal+'&harga='+hargaVal+'&query='+queryItem, true)
        xhr.send()
    })

    // untuk hover centang
    centangKosong[i].addEventListener('mouseenter', function(){
        centang[i].classList.toggle("displayNone")
        centangKosong[i].classList.toggle("displayNone")
    })
    centangKosong[i].addEventListener('mouseleave', function(){
        centang[i].classList.toggle("displayNone")
        centangKosong[i].classList.toggle("displayNone")
    })

    // untuk edit stok -> mati hidupin form
    edit[i].addEventListener('click', function(){
        stokAwal[i].classList.toggle("displayNone");
        stok2[i].classList.toggle("displayNone");
        stok2[i].disabled=false;
    })
    centang[i].addEventListener('click', function(){
        stokAwal[i].classList.toggle("displayNone");
        stok2[i].classList.toggle("displayNone");
        stok2[i].disabled=true;
    })

    edit[i].addEventListener('click', function(){
        hargaAwal[i].classList.toggle("displayNone");
        harga2[i].classList.toggle("displayNone");
        harga2[i].disabled=false;
    })
    centang[i].addEventListener('click', function(){
        hargaAwal[i].classList.toggle("displayNone");
        harga2[i].classList.toggle("displayNone");
        harga2[i].disabled=true;
    })
}