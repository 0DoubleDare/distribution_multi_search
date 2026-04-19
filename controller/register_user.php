<?php
session_start();
require '../config.php';
require '../model/main.php';

// Проверка - существует ли пользователь с таким же именем / почтой
$sql = "SELECT * FROM users WHERE username = :username OR email = :email";
$stmt = $pdo->prepare($sql);
$stmt->bindParam(":username", $_POST['username']);
$stmt->bindParam(":email", $_POST['email']);
$stmt->execute();

// TODO: Добавить конструкцию try - catch
// Проверка - совпадают ли пароли
if ($_POST['password'] != $_POST['repeat_password'] || $stmt->rowCount() > 0) {
    http_response_code(422);
    header('Location: ../view/user/register_user.php');
} else {
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $data = [
        'display_name' => $_POST['display_name'],
        'username' => $_POST['username'],
        'password' => $password,
        'email' => $_POST['email'],
    ];
    $user_id = registrationUser($pdo, $data);
    if (isset($_POST['remember_me'])) {
        $_SESSION['user_id'] = $user_id;
    }
}
