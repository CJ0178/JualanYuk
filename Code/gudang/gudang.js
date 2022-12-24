var edit = document.getElementsByClassName("edit")
var centang = document.getElementsByClassName("centang");
var centangKosong = document.getElementsByClassName("centangKosong");
var sampah = document.getElementsByClassName("sampah");
var namaAwal = document.getElementsByClassName("namaAwal");
var nama = document.getElementsByClassName("nama");
var stokAwal = document.getElementsByClassName("stokAwal");
var stok2 = document.getElementsByClassName("stok2");
var hargaAwal = document.getElementsByClassName("hargaAwal");
var harga2 = document.getElementsByClassName("harga2");

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

// Untuk header

window.onload = function(){
    buttonSearch = document.getElementById('search1')
    kotakMuncul = document.getElementById('search2')
    buttonSearch.addEventListener('click', ()=>{
        kotakMuncul.classList.toggle('displayNone')
        buttonSearch.classList.add('displayNone')
    })
}

function checkSubmit(e) {
    if(e && e.keyCode == 13) {
       document.forms[0].submit();
    }
 }