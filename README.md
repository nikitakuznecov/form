# form
 Сделать html-страничку с формой обратной связи - обязательные поля: имя, номер телефона, email и возможностью добавлять любое количество файлов, которая отправляет аяксом данные на сервер и сохраняет их в базе
 
<strong>Как использовать?</strong>

Клонируем репозиторий на виртуальный сервер или на боевой сервер;<br>
Импортируем базу данных - form.sql.zip;<br>
Правим кофиг в папке config - config.php;

<strong>Внимание!</strong>
Желательно для корректной работы использовать php >= 7.4.0
 
<strong>Какие компоненты использовал:</strong>
 
Фронт - HTML5,Bootstrap,Less,JQuery,Axios,JQuery Validate<br>
Бек - Php,Composer,Fenom, для работы с бд использовал простенький класс хотя можно было использовать xpdo и сгенерировать модель и таблицу из xml файлика, но думаю и так компонентов слишком для такой задачи<br> 

<strong>Какой концепции придерживался:</strong>

За основу взял модель проктирования MVC, внутри проекта использовал Di(Dependency injection) - контейнер в который внедрялись зависимости, паттерн Singleton для упрощения организации некоторых вопросов например подлючения к базе данных,так же используется единая точка входа файл bootstrap.php в котором ведется вся инициализацию и он же выступает как view.

<strong>Почему так все усложнил можно же решить данную задучу намного проще и мобильнее?</strong>
 
Это просто показательная работа, как можно организовать задучу с использованием обьектно ориентированного подхода, а так же построением модели дабы не использовать сырые данные полученные с фронтенда<br>
Ну и работать с ООП гараздо приятнее нежели всю обработку положить в 1 файл<br> 
А так вполне можно обойтись jquery и одним файликом php
