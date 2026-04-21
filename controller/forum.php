<?php
require '../config.php';
require '../model/main.php';

if (empty($_GET['id'])) {
    $posts = getAllPosts($pdo);
} else {
    $posts = getPostsByDistribution($pdo, $_GET['id']);
}
$distros = getAllLinuxDistributions($pdo);
$categories = getAllPostCategory($pdo);
$comments = getCommentaryByDistribution($pdo, $_GET['id']);

include '../view/main_forum.php';

