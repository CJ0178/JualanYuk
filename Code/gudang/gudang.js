var bagianTengahBawah = document.getElementsByClassName('bagianTengahBawah')[0]
var queryItem = document.getElementsByClassName('queryItem')[0].innerHTML
var exactItems = document.getElementsByClassName('exactItem')

var edit = document.getElementsByClassName("edit")
var centang = document.getElementsByClassName("centang");
var centangKosong = document.getElementsByClassName("centangKosong");
var sampah = document.getElementsByClassName("sampah");
var itemId = document.getElementsByClassName('itemId')
var namaAwal = document.getElementsByClassName("namaAwal");
var nama = document.getElementsByClassName("nama");
var stokAwal = document.getElementsByClassName("stokAwal");
var stok2 = document.getElementsByClassName("stok2");
var hargaAwal = document.getElementsByClassName("hargaAwal");
var harga2 = document.getElementsByClassName("harga2");
var formItem = document.getElementsByClassName("formItem");
var temp = document.getElementsByClassName('temp')[0]
var userId = document.getElementsByClassName('userId')[0]

for(let i=0; i<edit.length; i++){
    edit[i].addEventListener('click', function(){
        centangKosong[i].classList.toggle("displayNone")
        edit[i].classList.toggle("displayNone")
        sampah[i].classList.toggle("displayNone")
    })
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
        namaAwal[i].classList.toggle("displayNone");
        nama[i].classList.toggle("displayNone");
        nama[i].disabled=false;
    })
    centang[i].addEventListener('click', function(){
        namaAwal[i].classList.toggle("displayNone");
        nama[i].classList.toggle("displayNone");
        nama[i].disabled=true;
    })

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