// https://developer.mozilla.org/ru/docs/Web/JavaScript/Guide/Functions

function summ(a,b){
    // console.log(a,b); // если не передали, то undefined  
    if(a&&b){
        return a+b;
    }else{console.log('Функция не получила слагаемое');
    }
}
let result = summ(1,4);
console.log(result);