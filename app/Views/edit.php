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
            <a class="navbar-brand" href="#">Project name</a>
        </div>
        <div id="navbar" class="collapse navbar-collapse admin-title">
            <a href="/admin/all">Административная панель</a></div>
        </div><!--/.nav-collapse -->
    </div>
</nav>

<div class="container">

    <div class="form-container">
        <form action="/admin/update?id=<?= $user->id ?>" method="post" id="regForm" enctype="multipart/form-data">
            <h2>Редактировать пользователя</h2>
            <div class='form-mes_reg' id=formMes></div>
            <div class="form-group form-group-left-align">
                <div class="form-subgroup2-left">
                    <label for="inputName">Имя</label>
                    <input type="text" class="form-control" id="inputName" value="<?= $user->name?>" name="name" required>
                </div>
                <div class="form-subgroup2-right">
                    <label for="birthday">Дата рождения</label>
                    <input type="date" class="form-control" id="birthday" value="<?= $user->birthday?>" name="birthday" required>
                </div>
            </div>


            <div class="form-group">
                <label for="inputDescription">Описание</label>
                <textarea class="form-control" id="inputDescription" rows="2" value="<?= $user->description?>" name="description"></textarea>
            </div>

            <div class="form-group">
                <!-- <input type="hidden" name="MAX_FILE_SIZE" value="1048576" /> -->
                <label for="inputPhoto" class="col-sm-2 control-label">Фото</label>
                <input type="file" class="form-control" id="inputPhoto" name="photo" accept="image/*">
            </div>

            <div class="form-group form-group-left-align">
                <div class="form-subgroup3-left">
                    <label for="inputLogin">Логин</label>
                    <input type="text" class="form-control" id="inputLogin" value="<?= $user->login?>" name="login" required>
                </div>
                <div class="form-subgroup3-left">
                    <label for="inputEmail">Email</label>
                    <input type="text" class="form-control" id="inputEmail" value="<?= $user->email?>" name="email" required>
                </div>
                <div class="form-subgroup3-left">
                    <label for="inputPassword1">Пароль</label>
                    <input type="password" class="form-control" id="inputPassword1" value="<?= $user->password?>" name="password" required>
                </div>
            </div>

            <div class="form-group">
                <div class="g-recaptcha" style="display: inline-block;" data-sitekey="{{ captchaSiteKey }}"></div>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-submit" name="submit">Обновить данные о пользователе</button>
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
