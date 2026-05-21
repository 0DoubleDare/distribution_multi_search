<?php
session_start()
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
    <title>Форум</title>
</head>
<body>
<div class="container">
    <div class="form-floating">
        <select class="form-select select-distro-list" id="floatingSelect select-distro-list" aria-label="Floating label select example" disabled>
        </select>
        <label for="floatingSelect">Дистрибутив</label>
    </div>
    <form action="../controller/forum.php?id=<?= $_GET['id'] ?>" class="form-floating" method="post">
        <select name="category_sort" class="form-select select-category" id="floatingSelect" aria-label="Floating label select example">
            <option selected value="-1">Все</option>
        </select>
        <label for="floatingSelect">Категория поста</label>
        <button class="btn btn-outline-primary" type="submit">Сортировать</button>
    </form>
    <a href="../view/add_post_view.php?id=<?= $_GET['id']?>" class="btn btn-outline-secondary">Добавить пост</a>
    <a href="../index.php" class="btn btn-outline-secondary">На главную страницу</a>
    <div class="container posts">
    </div>
</div>
<script src="../js/get_method.js"></script>
<script src="../js/common.js"></script>
<script>
    getPostsCategories();
    getDistroListAsCategory(<?= $_GET['id'] ?>);
    let session = <?= json_encode($_SESSION['user_info'] ?? []) ?>;

    // WARN: СОРТИРОВКА ПО КАТЕГОРИЯМ НЕ РАБОТАЕТ
    sort_posts(-1);
    function sort_posts(category_id) {
        getPostsByDistroIdAndCategory(<?= $_GET['id' ]?>, session, category_id);
    }

</script>
</body>
</html>