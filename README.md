Стартовая страница %URL%/
1. Модель пользователя  App\Model\User.php
2. Реализация сохранения модели в БД и получение модели из базы, там же.
База loftmvcdb.sql
3. Регистрация и авторизация пользователя реализована в 
App\Model\User.php App\Controller\User.php.
4. Модель сообщения App\Model\Blog.php
5. Реализация блога App\Model\Blog.php App\Controller\Blog.php.
6. Api метод реализован в App\Model\Blog.php App\Controller\Blog.php.
методами - apiAction(); getAllById.
7. Константа с ID администратора расположена в файле конфига БД и является ID
назначенного юзера. Только админ видит кнопку удалить во всех выводимых сообщениях,
и реализует функционал по их удалению.


По ДЗ № 5

Необходимо update composer для подключения папки vendor ( включена в .gitignor)

5.1. Отправка письма посредством библиотеки swiftmailer
реализована без применения MVC отдельным файлом с подключением класса

composer.json
{
  "require": {
    "twig/twig":"^2.9.0",
    "intervention/image":"dev-master"
  },

  "autoload": {
    "psr-4": {"App\\": "App/","Base\\": "src/"}
  }
}


5.2. подключена библиотека twig через composer

src/View.php добавлен метод getTwig(), который использован в методе render, таким образом
весь вывод идет через шаблонизатор twig.
подключение - use Twig;

app/View/Blog/blog.twig - основная страница проекта ВП № 1 полностью реализована 
с использованием синтаксиса шаблонизатора и работает аналогично варианту без 
шаблонизатора

Доступ к реализации:
Domain/   -> login
Domain/blog/allposts

5.3. подключена библиотека "intervention/image"
use Intervention\Image\ImageManagerStatic as Image;

app\Controller\Blog\Blog.php добавлен метод imageAction(), который
используя метод watermark() добавляет WATERMARK на требуемую картинку,
также метод resize изменяет ширину до 200px с соблюдением пропорций.

Доступ к реализации через router - pre
Domain/pre
папка images должна быть расположена в корне сайта ( в одной локации с index.php )




