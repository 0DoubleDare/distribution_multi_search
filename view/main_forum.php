<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css"
          rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <title>Форум</title>
</head>
<body>
<div class="container">
    <div class="form-floating">
        <select class="form-select" id="floatingSelect" aria-label="Floating label select example">
            <?php foreach($distros as $dist): ?>
                <option value="<?php echo $dist['id'] ?>" <?= $dist['id'] == $_GET['id'] ? 'selected' : '' ?>>
                    <?php echo $dist['name'] ?>
                </option>
            <?php endforeach; ?>
        </select>
        <label for="floatingSelect">Дистрибутив</label>
    </div>
    <div class="form-floating">
        <select class="form-select" id="floatingSelect" aria-label="Floating label select example">
            <option selected>Все</option>
            <?php foreach($categories as $category): ?>
                <option value="<?php echo $category['id'] ?>"><?php echo $category['name'] ?></option>
            <?php endforeach; ?>
        </select>
        <label for="floatingSelect">Категория поста</label>
    </div>
    <a href="./add_post_redirect_controller.php" class="btn btn-outline-secondary">Добавить пост</a>
    <div class="container">
    <?php foreach($posts as $post): ?>
        <div class="card shadow-sm mb-4 mx-auto">
            <!-- Шапка: Аватар, Ник, Время, Дистрибутив -->
            <div class="card-header bg-white border-0 d-flex align-items-center justify-content-between py-3">
                <div class="d-flex align-items-center">
                    <a href="/" class="me-0">
<!--                        <img class="me-2" src="style/images/img.png" alt="main-site-icon" height="40">-->
                        <img src="../storage/default_avatar.webp" class="rounded-circle me-3" alt="Avatar" width="45" height="45">
                    </a>
                    <div>
                        <h6 class="mb-0 fw-bold"><?= htmlspecialchars($post['user_display_name'] ?? '') ?></h6>
                        <small class="text-muted"><?= htmlspecialchars($post['post_created_at']) ?></small>
                    </div>
                </div>
                <div>
                    <span class="badge rounded-pill bg-success text-light fs-6"><?php echo htmlspecialchars($post['category']) ?></span>
                    <span class="badge bg-info text-dark fs-6"><?php echo htmlspecialchars($post['distro_name']) ?></span>
                </div>
            </div>
            <!-- Тело: Заголовок и Содержимое -->
            <div class="card-body py-2">
                <h5 class="card-title fw-bold"><?php echo htmlspecialchars($post['title']) ?></h5>
                <p class="card-text text-secondary">
                    <?php echo htmlspecialchars($post['content']) ?>
                </p>
            </div>
            <!-- Футер: Лайки/Дизлайки -->
            <div class="card-footer bg-white border-top-0 d-flex align-items-center py-3">
                <div class="btn-group me-3" role="group">
                    <button type="button" class="btn btn-outline-success btn-sm"><i class="bi bi-hand-thumbs-up"></i> 42</button>
                    <button type="button" class="btn btn-outline-danger btn-sm"><i class="bi bi-hand-thumbs-down"></i> 3</button>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
    </div>
</div>
</body>
</html>