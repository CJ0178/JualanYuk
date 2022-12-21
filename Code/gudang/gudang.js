var edit = document.getElementsByClassName("edit")
var centang = document.getElementsByClassName("centang");
var centangKosong = document.getElementsByClassName("centangKosong");
var sampah = document.getElementsByClassName("sampah");

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
}

