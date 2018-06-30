<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Starter Template for Bootstrap</title>

    <!-- Bootstrap core CSS -->
    <link href="../../public/css/bootstrap.min.css" rel="stylesheet">


    <!-- Custom styles for this template -->
    <link href="../../public/css/starter-template.css" rel="stylesheet">


    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>

    <nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#">Project name</a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
          <ul class="nav navbar-nav">
            <li class="active"><a href="/index">Авторизация</a></li>
            <li><a href="/reg">Регистрация</a></li>
            <li><a href="/user/all">Список пользователей</a></li>
            <li><a href="/file/user">Список файлов</a></li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>

    <div class="container">
    <h1>Запретная зона, доступ только авторизированному пользователю</h1>
      <h2>Информация выводится из базы данных</h2>
        <div>
            <a href="/user/allReverse">Сортировать пользователей по возрасту (DESC)</a>
        </div>
        <div>
            <a href="/user/all">Сортировать пользователей по возрасту (ASC)</a>
        </div>
      <table class="table table-bordered">
        <tr>
          <th>Пользователь(логин)</th>
          <th>Имя</th>
          <th>возраст</th>
          <th>описание</th>
          <th>Фотография</th>
          <th>Действия</th>
        </tr>
        <?php foreach ($data as $user) :    ?>
            <tr>
               <td><?= $user['login'] ?></td>
               <td><?= $user['name'] ?></td>
               <td><?= $user['birthday'] ?></td>
               <td><?= $user['description'] ?></td>
               <td>
                   Загружено: <?=count($user['files']) ?>
                   <?php if (count($user['files'])) {
                       echo '<img src="' . $user['files'][count($user['files'])-1]['file_url'] . '">';
                   }
                   ?>
               </td>
                <td>
                    <a href="/user/delete?id=<?= $user['id'] ?>">Удалить пользователя</a>
                </td>
              </tr>
          <?php endforeach; ?>
      </table>

    </div><!-- /.container -->


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="../../public/js/main.js"></script>
    <script src="../../public/js/bootstrap.min.js"></script>
  </body>
</html>
