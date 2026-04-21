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

    $stmt = $pdo->prepare("SELECT id, user_type_id FROM users WHERE users.id = :id");
    $stmt->execute(['id' => $user_id]);
    $user_info = $stmt->fetch(PDO::FETCH_ASSOC);

    return $user_info;
}

function loginUser($pdo, $data) {

}

function getAllUserInformation($pdo) {
    $sql = "";
}
function insertPost($pdo, $data) {
    $sql = "INSERT INTO posts(user_id, title, content, distribution_id, category_id)
    VALUES(:user_id, :title, :content, :distribution_id, :category_id)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute($data);
    return $pdo->lastInsertId();
}

function removePost($pdo, $data) {

}

function getUserById($pdo, $id) {
    $sql = "SELECT * FROM users WHERE users.id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([':id' => $id]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
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
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function getAllPostCategory($pdo) {
    $sql = "SELECT * FROM post_categories";
    $stmt = $pdo->query($sql);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function getCommentaryByDistribution($pdo, $post_id) {
    $sql = "
        SELECT
    users.avatar_path,
    users.id AS user_id,
    posts.id AS post_id,
    users.display_name,
    comments.comment_created_at,
    comments.content
FROM users JOIN comments ON users.id = comments.user_id
JOIN posts ON comments.post_id = posts.id WHERE posts.distribution_id = :id;
    ";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([':id' => $post_id]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function checkAuthorizedUser($pdo, $username, $password) {
    try {
        $sql = "SELECT id, password, user_role_id FROM users WHERE username = :username";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':username', $username);
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
//            print_r($user);
            if (password_verify($password, $user['password'])) {
                $response = [
                    'user_id' => $user['id'],
                    'user_role_id' => $user['user_role_id']
                ];
                return $response;
            }
        }
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
}
