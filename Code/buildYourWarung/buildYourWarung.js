var cardPaket1 = document.getElementsByClassName("cardPaket1");
var cardPaket2 = document.getElementsByClassName("cardPaket2");

for(let i=0; i<cardPaket1.length; i++){
    cardPaket1[i].addEventListener('mouseenter', function(){
        // console.log("hai")
        cardPaket1[i].classList.toggle("displayNone");
        cardPaket2[i].classList.toggle("displayNone");
    })
    
    cardPaket1[i].addEventListener('mouseleave', function(){
        cardPaket1[i].classList.toggle("displayNone");
        cardPaket2[i].classList.toggle("displayNone");
    })
}