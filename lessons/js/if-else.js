// https://developer.mozilla.org/ru/docs/Web/JavaScript/Reference/Statements/if...else

let a = 1;
let b = 'строка это';
let c = '2'; // тип данных строка
let d = true; //булев тип данных
let e = false; //булев тип данных
let f = ''; // пустая строка


if(b){
  console.log('if отработал успешно')
}else{
    console.log('else отработал!')
}
////////// задача приветствие в зависимости от времени суток
let date = new Date();
let current_hour = date.getHours();
let hello = ['Добрый вечер', 'Добрый день', 'Добрый день'];
console.log(current_hour);
if(current_hour>17){
  console.log(hello[0]);
}
else if(current_hour>12){
      console.log(hello[1]);
}
else{
    console.log(hello[2])
}