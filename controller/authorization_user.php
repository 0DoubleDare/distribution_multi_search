<?php
session_start();
require "../config.php";
require "../model/main.php";

$value = checkAuthorizedUser($pdo, $_POST['username'], $_POST['password']);
print_r($_POST);

//echo $value;
if (isset($value)) {
    $_SESSION['user_id'] = $value;
    header('Location: ../index.php');
} else {
    header('Location: ../view/user/authorization_user.php');
}
