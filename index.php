<?php
session_start();
require 'config.php';
require 'model/main.php';

$distros = getAllLinuxDistributions($pdo);
if (isset($_SESSION['user_id'])) {
    $user = getUserById($pdo, $_SESSION['user_id']);
}
include "view/main_page.php"
?>