<?php
require '../config.php';
require '../model/main.php';

if (empty($_GET['id'])) {
    $posts = getAllPosts($pdo);
} else {
    $posts = getPostsByDistribution($pdo, $_GET['id']);
}
//$posts = getAllPosts($pdo);
$distros = getAllLinuxDistributions($pdo);
$categories = getAllPostCategory($pdo);

include '../view/main_forum.php';

