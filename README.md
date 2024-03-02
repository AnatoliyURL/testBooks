
Краткая информация
-------------------

Данное тестовое задание было выполнено на базовом шаблоне проекта yii2 для вакансии PSenior РНР Developer (YII) для ООО Компания ИнфоТек

Установка
------------

Тут всё стандартно как и на обычном проекте:
- Скачиваем
- Устанавливаем зависимости с помощью composer
- Прописываем подключение к БД
```php
return [
    'class' => 'yii\db\Connection',
    'dsn' => 'mysql:host=localhost;dbname=yii2basic',
    'username' => 'root',
    'password' => '1234',
    'charset' => 'utf8',
];
```
- Выполняем миграции

Особенности
------------

- Доступ осуществляется по 
~~~
admin \ admin
~~~

- У книг не проставлены авторы. 
- Тестовый ключ прописан в config/params для удобства. Я его не стал выносить в params-local, как на реальном сервере.
- Хранение "Год выпуска" в формате data так как у книги может быть известна точная дата. Просто форматирую под нужный вид
- Отчет имеет настолько примитивный вид, что даже стыдно за такое, но на данный момент только такой. (как с search модель для него)
- Нет нормального вывода и трекинга ошибок сохранения, отправки данных и т.д.
- Верстка ещё на коленке
- Сохранение файлов производится в папку проекта - страшная штука, но представим что есть нормальное хранилище в которое улетают файлы и возвращается ID файла по которому мы можем получить его для отображения
- Мне рекрут сказал, чтобы было Идеальное тестове. Не думаю что оно таким вышло.

Тестовое задание
------------

Тестовое задание находится в корне проекта, файл

~~~
Тестовое задание программист.rtf
~~~