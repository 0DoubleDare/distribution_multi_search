<?php
session_start();
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
    <link rel="stylesheet" href="style/css/main.css">
    <title>Каталог</title>
</head>
<body>
<header class="d-flex flex-wrap align-items-center justify-content-center justify-content-md-between py-3 mb-4 border-bottom" >
    <a href="/" class="d-flex align-items-center col-md-3 mb-2 mb-md-0 text-dark text-decoration-none">
        <img class="me-2" src="style/images/img.png" alt="main-site-icon" height="40">
    </a>
    <ul class="nav col-12 col-md-auto mb-2 justify-content-center mb-md-0">
        <li><a href="#" class="nav-link px-2 link-secondary">Главная</a></li>
        <li><a href="#" class="nav-link px-2 link-dark">Посетить форум</a></li>
        <li><a href="#" class="nav-link px-2 link-dark">FAQs</a></li>
        <li><a href="#" class="nav-link px-2 link-dark">О нас</a></li>
    </ul>
    <div class="col-md-3 text-end">
    <?php if (empty($_SESSION['user_id'])): ?>
        <a href="view/user/authorization_user.php" class="btn btn-outline-primary me-2">Войти</a>
        <a href="view/user/register_user.php" class="btn btn-primary">Зарегистрироваться</a>
    <?php else: ?>
        <a href="" class="btn btn-outline-primary me2">Выйти</a>
    <?php endif; ?>
    </div>
</header>
<main class="main-content">
    <div class="row row-cols-1 row-cols-md-3 g-4">
        <?php foreach($distros as $dist):?>
            <div class="col">
                <div class="card h-100">
                    <a href="./controller/forum.php?id=<?=$dist['id']?>" class="go-to-distro-wiki"><img src="style/images/<?= $dist['icon_name']?>.png" class="card-img-top distro-card-image" alt="..."></a>
                    <div class="card-body">
                        <h5 class="card-title"><?= $dist['name']?></h5>
                        <small class="card-text"><?= $dist['description']?></small>
                    </div>
                    <div class="card-footer d-flex justify-content-between align-items-center">
                        <small class="text-body-secondary"> Количество постов: <?= $dist['posts_count'] ?></small>
                        <a href="<?= $dist['official_wiki_url'] ?>" class="text-body-secondary">Go</a>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</main>
</body>
</html>

