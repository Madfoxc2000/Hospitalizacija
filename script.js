document.querySelector('.mobile-menu-icon').addEventListener('click', function () {
    document.querySelector('.menu').classList.toggle('active');
  });


var e=document.querySelectorAll('option')
e.forEach(x=>{
if(x.textContent.length>20)
x.textContent=x.textContent.substring(0,20)+'...';
})