<?php
session_start();
require "../config.php";
require "../model/main.php";

$value = checkAuthorizedUser($pdo, $_POST['username'], $_POST['password']);
//echo $value;
echo $_SESSION['user_id'];
if (isset($value)) {
    $_SESSION['user_id'] = $value;
    header('Location: ../index.php');
} else {
    header('Location: ../view/user/authorization_user.php');
}
