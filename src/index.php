<?php
ini_set('session.cookie_secure', 1);
ini_set('session.cookie_samesite', 'Lax');
session_start();
//var_dump($_SESSION);
require 'config.php';
require './model/main.php';

$distros = getAllLinuxDistributions($pdo);
if (isset($_SESSION['user_info']['user_id'])) {
    $user = getUserById($pdo, $_SESSION['user_info']['user_id']);
}
include "view/main_page.php"
?>