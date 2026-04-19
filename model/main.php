<?php
function getAllLinuxDistributions($pdo) {
    $sql = "SELECT * FROM linux_distributions";
    $distros = $pdo->query($sql)->fetchAll();
    return $distros;
}

function registrationUser($pdo, $data) {
    $sql = "
        INSERT INTO users(display_name, username, email, password) 
        VALUES(:display_name, :username, :email, :password)
    ";
    $stmt = $pdo->prepare($sql);
    $stmt->execute($data);

    $user_id = $pdo->lastInsertId();

    return $user_id;
}

function loginUser($pdo, $data) {

}

function addPost($pdo, $data) {

}

function removePost($pdo, $data) {

}

function getAllPosts($pdo) {
    $sql = "SELECT * FROM posts";
    $stmt = $pdo->query($sql);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function getPostsByDistribution($pdo, $id) {
//    $sql = "SELECT * FROM posts WHERE posts.distribution_id = :id";
    $sql = "
        SELECT
            u.username,
            u.avatar_path AS user_avatar,
            u.id AS user_id,
            d.name AS distro_name,
            p.post_created_at,
            p.title,
            p.content,
            p.id AS post_id,
            c.name AS category -- Используем алиас c
        FROM posts p
                 JOIN users u ON p.user_id = u.id
                 JOIN linux_distributions d ON p.distribution_type = d.id
                 JOIN post_categories c ON p.category = c.id -- Добавляем связь с категориями
        WHERE p.distribution_type = :id
        ORDER BY p.post_created_at DESC;
    ";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['id' => $id]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function getAllPostCategory($pdo) {
    $sql = "SELECT * FROM post_categories";
    $stmt = $pdo->query($sql);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function checkAuthorizedUser($pdo, $username, $password) {
    try {
        $sql = "SELECT id, password FROM users WHERE username = :username";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':username', $username);
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
//            print_r($user);
            if (password_verify($password, $user['password'])) {
                return $user['id'];
            }
        }
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
}
