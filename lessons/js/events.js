let resultView = document.getElementById("dinamic-text");
document.addEventListener('mousemove', (e)=>{
    resultView.innerHTML = `По Х: ${e.layerX}<br>По Y: ${e.clientY}`;
});
let sqare = document.getElementById('blockText');
sqare.style.cssText = 'height:200px; background-color: #fff54f;';
sqare.addEventListener('mouseenter', (e)=>{
    sqare.innerHTML = 'Курсор пришел на элемент';
});
sqare.addEventListener('mouseleave', (e)=>{
    sqare.innerHTML = 'Курсор покинул элемент';
});
window.addEventListener('keypress', (e)=>{
    sqare.textContent = e.key;
});
