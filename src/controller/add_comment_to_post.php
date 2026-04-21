<?php
session_start();
require '../config.php';
require '../model/main.php';

//print_r($_POST);
//print_r($_GET);

if (isset($_SESSION['user_info']['user_id'])) {
    addCommentToPost($pdo, $_POST['post_id'], $_SESSION['user_info']['user_id'], $_POST['content']);
}
header("Location: forum.php?id=" . $_GET['id']);