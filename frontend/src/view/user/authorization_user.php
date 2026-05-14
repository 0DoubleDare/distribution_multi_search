<?php
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css"
          rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="stylesheet" href="../../style/css/main.css">
    <title>Document</title>
</head>
<body>
<div class="container">
    <form action="../../controller/authorization_user.php" method="post">
        <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">Имя пользователя</label>
            <input name="username" type="text" class="form-control" id="exampleInputPassword1" required>
<!--            <div id="emailHelp" class="form-text">Уникальное имя пользователя</div>-->
        </div>
<!--        <div class="mb-3">-->
<!--            <label for="exampleInputEmail1" class="form-label">Адрес электронной почты</label>-->
<!--            <input name="email" type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" required>-->
<!--            <div id="emailHelp" class="form-text">Не показывайте свою почту кому попало</div>-->
<!--        </div>-->
        <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">Пароль</label>
            <input name="password" type="password" class="form-control" id="exampleInputPassword1" required>
<!--            <div id="emailHelp" class="form-text">Ваш пароль</div>-->
        </div>
        <div class="mb-3 form-check">
            <input name="remember_me" type="checkbox" value="true" class="form-check-input" id="exampleCheck1">
            <label class="form-check-label" for="exampleCheck1" >Запомнить меня</label>
        </div>
        <button type="submit" class="btn btn-primary">Войти</button>
    </form>
</div>
</body>
</html>
