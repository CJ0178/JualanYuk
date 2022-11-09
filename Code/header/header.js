buttonSearch = document.getElementById('search1')
kotakMuncul = document.getElementById('search2')
buttonSearch.addEventListener('click', ()=>{
    kotakMuncul.classList.toggle('displayNone')
    buttonSearch.classList.add('displayNone')
})

