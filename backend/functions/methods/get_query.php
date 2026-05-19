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

function getUserById($pdo, $id) {
    $sql = "SELECT * FROM users WHERE users.id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([":id" => $id]);
    $data = $stmt->fetch(PDO::FETCH_ASSOC);
    return json_encode($data);
}

function getCommentsByPostId($pdo, $id) {
    $sql = "
        SELECT
    users.avatar_path,
    users.id AS user_id,
    posts.id AS post_id,
    users.display_name,
    comments.comment_created_at,
    comments.content
FROM users JOIN comments ON users.id = comments.user_id
JOIN posts ON comments.post_id = posts.id WHERE posts.id = :id;
    ";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([':id' => $id]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
//    return json_encode($comments);
}

function getAllPostCategories($pdo) {
    $sql = "SELECT * FROM post_categories";
    $stmt = $pdo->query($sql);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}


