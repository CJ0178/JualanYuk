buttonSave = document.getElementsByClassName('tulisanKeranjang')[0]
form = document.getElementById('buttonSave')

buttonSave.addEventListener('click', ()=>{
    if(confirm('Yakin data sudah benar?')){
        form.submit()
    }
})

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