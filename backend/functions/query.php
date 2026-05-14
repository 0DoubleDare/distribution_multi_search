<?php

function getAllLinuxDistributions($pdo) {
    $sql = "SELECT * FROM linux_distributions";
    $distros = $pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    return json_encode($distros);
}

function getPostsByDistributionId($pdo, $id) {
//    $sql = "SELECT * FROM posts WHERE posts.distribution_id = :id";
    $sql = "
        SELECT
            u.username,
            u.display_name AS user_display_name,
            u.avatar_path AS user_avatar,
            u.id AS user_id,
            d.name AS distro_name,
            p.post_created_at,
            p.title,
            p.content,
            p.id AS post_id,
            c.name AS category
        FROM posts p
                 JOIN users u ON p.user_id = u.id
                 JOIN linux_distributions d ON p.distribution_id = d.id
                 JOIN post_categories c ON p.category_id = c.id
        WHERE p.distribution_id = :id
        ORDER BY p.post_created_at DESC;
    ";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([':id' => $id]);
    $posts = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return json_encode($posts);
}

function registrationUser($pdo, $data) {
    $sql = "
        INSERT INTO users(display_name, username, email, password) 
        VALUES(:display_name, :username, :email, :password)
    ";
    $stmt = $pdo->prepare($sql);
    $stmt->execute($data);
    $user_id = $pdo->lastInsertId();

    $stmt = $pdo->prepare("SELECT id, user_role_id FROM users WHERE users.id = :id");
    $stmt->execute(['id' => $user_id]);
    $user_info = $stmt->fetch(PDO::FETCH_ASSOC);
    return json_encode([
        "user_id" => $user_info['id'],
        "user_role_id" => $user_info['user_role_id']
    ]);
}

function authorizationUser($pdo, $data) {

}

function getUserById($pdo, $id) {
    $sql = "SELECT * FROM users WHERE users.id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([":id" => $id]);
    $data = $stmt->fetch(PDO::FETCH_ASSOC);
    return json_encode($data);
}