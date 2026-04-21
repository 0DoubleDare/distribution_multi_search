<?php
session_start();
require "../config.php";
require "../model/main.php";

$user_info = checkAuthorizedUser($pdo, $_POST['username'], $_POST['password']);
print_r($_POST);

//echo $value;
if (isset($user_info)) {
    $_SESSION['user_info'] = $user_info;
    header('Location: ../index.php');
} else {
    header('Location: ../view/user/authorization_user.php');
}
