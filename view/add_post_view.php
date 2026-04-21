<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css"
          rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <title>Добавление поста</title>
</head>
<body>
<div class="container">
    <form action="insert_post.php" method="post">
        <div class="mb-3">
            <input name="title" placeholder="Заголовок поста" type="text" class="form-control" id="exampleInputPassword1" required>
        </div>
        <div class="row g-2">
            <div class="col-md-6">
                <div class="form-floating">
                    <select name="distribution_id" class="form-select" id="floatingSelect" aria-label="Floating label select example">
                        <?php foreach($distros as $dist): ?>
                            <option value="<?php echo $dist['id'] ?>">
                                <?php echo $dist['name'] ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                    <label for="floatingSelect">Дистрибутив</label>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-floating">
                    <select name="category_id" class="form-select" id="floatingSelect" aria-label="Floating label select example">
                        <?php foreach($categories as $category): ?>
                            <option value="<?= $category['id'] ?>"><?= $category['name'] ?></option>
                        <?php endforeach; ?>
                    </select>
                    <label for="floatingSelect">Категория поста</label>
                </div>
            </div>
        </div>
        <div class="mb-3">
            <label for="exampleFormControlTextarea1" class="form-label">Текст поста</label>
            <textarea name="content" class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
        </div>
        <input name="user_id" type="hidden" value="<?= $_SESSION['user_info']['user_id'] ?>">
        <button class="btn btn-primary" type="submit">Создать</button>
    </form>
</div>
</body>
</html>
