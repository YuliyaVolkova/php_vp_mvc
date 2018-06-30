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
    <div class="admin-create">
        <a href="/admin/create">Добавить нового пользователя</a>
    </div>
    <table class="table table-bordered">
        <tr>
            <th>Id</th>
            <th>Логин</th>
            <th>Имя</th>
            <th>Дата рождения</th>
            <th>Eмаil</th>
            <th>описание</th>
            <th>Фотография</th>
            <th>Действия</th>
        </tr>
        <?php foreach ($users as $user) :    ?>
                <td><?=$user['id']?></a></td>
                <td><?=$user['login']?></a></td>
                <td><?=$user['name']?></a></td>
                <td><?=$user['birthday']?></a></td>
                <td><?=$user['email']?></a></td>
                <td><?=$user['description']?></a></td>
                <td>
                    Загружено: <?=count($user['files']) ?>
                    <?php if (is_array($user['files'])) {
                        echo '<img src="' . $user['files'][count($user['files']) - 1]['file_url'] . '">';
                    }
                    ?>
                </td>
                <td>
                    <a href="/admin/edit?id=<?= $user['id'] ?>">Редактировать</a>
                    <a href="/admin/delete?id=<?= $user['id'] ?>">Удалить</a>
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
