var e=document.querySelectorAll('option')
e.forEach(x=>{
if(x.textContent.length>20)
x.textContent=x.textContent.substring(0,20)+'...';
})


// Vezivanje enter tastera na tastaturi sa html dugmetom
const Enter = document.getElementById('Enter');
window.onkeydown = function(event){
    if(event.keyCode == 13){
        Enter.classList.add('save-btn-clicked');
        Enter.click();
        setTimeout(function(){Enter.classList.remove('save-btn-clicked');},200);
    }
}