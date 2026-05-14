<?php
require "../config.php";
require "../model/main.php";

//echo '<pre>';
//print_r($_POST);
//echo '</pre>';

//$id = $_POST['distro_id'];
//unset($_POST['distro_id']);

insertPost($pdo, $_POST);

header("Location: forum.php?id=" . $_POST['distribution_id']);