var edit = document.getElementById("edit");
var centang = document.getElementById("centang");
var sampah = document.getElementById("sampah");

function muncul(){
    centang.classList.toggle("displayNone")
    edit.classList.toggle("displayNone")
    sampah.classList.toggle("displayNone")
}

edit.addEventListener('click', muncul)
centang.addEventListener('click', muncul)

centang.addEventListener('mouseenter', function(){
    centang.style.backgroundColor='Red';
})

centang.addEventListener('mouseleave', function(){
    centang.style.backgroundColor='white';
})