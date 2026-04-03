let statickText = document.querySelector('span').textContent;
let dinamicText = document.querySelector('p');
console.log(dinamicText);
// dinamicText.append(statickText);
dinamicText.textContent += statickText;
let span_id_1 = document.getElementById('span_id_1').textContent;
let blockText = document.getElementById('blockText');
blockText.innerHTML = "<p>"+span_id_1+"</p>";

let main_form = document.querySelector('form');
main_form.addEventListener('submit', (event)=>{
    event.preventDefault();
    let user_name = document.getElementById('user_name').value;
    let user_message = document.getElementById('user_message').value;
    blockText.innerHTML += "<p>"+user_name+user_message+"</p>";
    main_form.reset();
})