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

      <div class="form-container">
<form action="reg" method="post" id="regForm" enctype="multipart/form-data">
                        <h2>Регистрация</h2>
                        <div class='form-mes_reg' id=formMes></div>
                        <div class="form-group form-group-left-align">
                            <div class="form-subgroup2-left">
                                <label for="inputName">Имя</label>
                                <input type="text" class="form-control" id="inputName" placeholder="Введите Ваше имя" name="name" required>
                            </div>
                            <div class="form-subgroup2-right">
                                <label for="birthday">Дата рождения</label>
                                <input type="date" class="form-control" id="birthday" placeholder="Введите дату рождения" name="birthday" required>
                            </div>
                        </div>


                        <div class="form-group">
                            <label for="inputDescription">Описание</label>
                            <textarea class="form-control" id="inputDescription" rows="2" placeholder="Напишите пару слов о себе" name="description"></textarea>
                        </div>

                        <div class="form-group">
                            <!-- <input type="hidden" name="MAX_FILE_SIZE" value="1048576" /> -->
                            <label for="inputPhoto" class="col-sm-2 control-label">Фото</label>
                            <input type="file" class="form-control" id="inputPhoto" name="photo" accept="image/*">
                        </div>
    
                        <div class="form-group form-group-left-align">
                            <div class="form-subgroup3-left">
                                <label for="inputLogin">Логин</label>
                                <input type="text" class="form-control" id="inputLogin" placeholder="Придумайте логин" name="login" required>
                            </div>
                            <div class="form-subgroup3-left">
                                <label for="inputEmail">Email</label>
                                <input type="text" class="form-control" id="inputEmail" placeholder="Введите email" name="email" required>
                            </div>
                            <div class="form-subgroup3-left">
                                <label for="inputPassword1">Пароль</label>
                                <input type="password" class="form-control" id="inputPassword1" placeholder="Придумайте пароль" name="password" required>
                            </div>
                            <div class="form-subgroup3-right">
                                <label for="inputPassword2">Повтор пароля</label>
                                <input type="password" class="form-control" id="inputPassword2" placeholder="Ещё раз пароль" name="password-again" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="g-recaptcha" style="display: inline-block;" data-sitekey="{{ captchaSiteKey }}"></div>
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-submit" name="submit">Зарегистрироваться</button>
                            <br><br>
                            Зарегистрированы? &nbsp;<a href="/index">Авторизируйтесь</a>
                        </div>


                    </form>
      </div>

    </div><!-- /.container -->


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="../../public/js/reg.js"></script>
    <script src="../../public/js/bootstrap.min.js"></script>

  </body>
</html>
