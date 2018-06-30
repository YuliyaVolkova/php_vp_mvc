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
      <h2>Информация выводится из списка файлов</h2>
        <form action="/file/create" method="post" id="" enctype="multipart/form-data">
            <div class="form-group">
                <!-- <input type="hidden" name="MAX_FILE_SIZE" value="1048576" /> -->
                <label for="inputPhoto" class="col-sm-2 control-label">Фото</label>
                <input type="file" class="form-control" id="inputPhoto" name="photo" accept="image/*">
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-submit" name="submit">Загрузить фото</button>
            </div>
        </form>
      <table class="table table-bordered">
        <tr>
          <th>Название файла</th>
          <th>Фотография</th>
          <th>Действия</th>
        </tr>
          <?php foreach ($files as $file) : ?>
              <tr>
                  <td><?= $file->file_url; ?></td>
                  <td><img src="<?= $file->file_url; ?>"></td>
                  <td>
                      <a href="/file/delete?id=<?= $file->id ?>">Удалить аватарку пользователя</a>
                  </td>
              </tr>
          <?php endforeach; ?>
      </table>

    </div><!-- /.container -->


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="../../public/js/bootstrap.min.js"></script>

  </body>
</html>
