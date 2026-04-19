<?php
session_start();
require "../config.php";
require "../model/main.php";

if (empty($_SESSION['user_id'])) {
    header("Location: ../index.php");
} else {
    $distros = getAllLinuxDistributions($pdo);
    $categories = getAllPostCategory($pdo);

    include "../view/add_post_view.php";
}