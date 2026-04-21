<?php
require '../config.php';
require '../model/main.php';

if (empty($_GET['id'])) {
    $posts = getAllPosts($pdo);
} else {
    if (!empty($_POST['category_sort']) && $_POST['category_sort'] >= 0) {
        $posts = getPostsByCategoryAndDistribution($pdo, $_POST['category_sort'], $_GET['id']);
    } else {
        $posts = getPostsByDistribution($pdo, $_GET['id']);
    }
}
$distros = getAllLinuxDistributions($pdo);
$categories = getAllPostCategory($pdo);
$comments = getCommentaryByDistribution($pdo, $_GET['id']);

include '../view/main_forum.php';

