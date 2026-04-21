<?php
require "../config.php";
require "../model/main.php";

echo '<pre>';
print_r($_POST);
echo '</pre>';

insertPost($pdo, $_POST);

header("Location: ../index.php");