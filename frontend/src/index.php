<?php
ini_set('session.cookie_secure', 1);
ini_set('session.cookie_samesite', 'Lax');
session_start();
//var_dump($_SESSION);
//require 'config.php';
//require './model/main.php';

if (isset($_SESSION['user_info']['user_id'])) {
    $user = file_get_contents("http://localhost/distro_multi_search/backend/users/" . $_SESSION['user_info']['user_id']);
    $user = json_decode($user, true);
}
include "view/main_page.php"
?>