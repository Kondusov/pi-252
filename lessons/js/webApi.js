// Получение HTML-элементов
document.querySelector('.selector') //Возвращает первый элемент, соответствующий CSS-селектору (например, '.my-class', '#my-id', 'div > p').
document.querySelectorAll('selector') //Возвращает коллекцию (NodeList) всех найденных элементов.
document.getElementById('id') //Самый быстрый способ получить элемент по уникальному ID.
document.getElementsByClassName('class') // Возвращает живую HTML-коллекцию элементов с указанным классом. 

// Изменение содержимого и атрибутов
// После получения элемента (let elem = ...) можно менять его свойства:
elem.textContent = 'Новый текст' // Безопасно меняет текст внутри элемента, игнорируя HTML-теги.
elem.innerHTML = '<strong>Новый HTML</strong>' // Заменяет содержимое элемента, интерпретируя строку как HTML.
elem.style.color = 'red' // Изменение CSS-стилей напрямую.
elem.setAttribute('src', 'image.jpg') // Установка значения атрибута (например, src, href, disabled).
elem.value = 'Новое значение' // Установка значения для форм (input, textarea, select). 

// Создание и вставка новых элементов
document.createElement('tagName') // Создает новый элемент (например, div).
parent.append(element) // Добавляет элемент в конец родителя.
parent.prepend(element) // Добавляет элемент в начало родителя.