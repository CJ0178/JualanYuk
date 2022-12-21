var edit = document.getElementById("edit");
var centang = document.getElementById("centang");
var centangKosong = document.getElementById("centangKosong");
var sampah = document.getElementById("sampah");

function muncul(){
    centangKosong.classList.toggle("displayNone")
    edit.classList.toggle("displayNone")
    sampah.classList.toggle("displayNone")
}

edit.addEventListener('click', muncul)
centang.addEventListener('click', muncul)

centangKosong.addEventListener('mouseenter', function(){
    centang.classList.toggle("displayNone")
    centangKosong.classList.toggle("displayNone")
})

centangKosong.addEventListener('mouseleave', function(){
    centang.classList.toggle("displayNone")
    centangKosong.classList.toggle("displayNone")
})