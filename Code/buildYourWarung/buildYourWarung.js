var cardPaket = document.getElementsByClassName("cardPaket");
var cardPaket1 = document.getElementsByClassName("cardPaket1");
var cardPaket2 = document.getElementsByClassName("cardPaket2");

for(let i=0; i<cardPaket1.length; i++){
    cardPaket[i].addEventListener('mouseenter', function(){
        cardPaket1[i].classList.toggle("displayNone");
        cardPaket2[i].classList.toggle("displayNone");
    })

    cardPaket[i].addEventListener('mouseleave', function(){
        cardPaket1[i].classList.toggle("displayNone");
        cardPaket2[i].classList.toggle("displayNone");
    })
}