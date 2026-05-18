<?php

function registrationUserByForm($pdo, $data) {
    try {
        if ($data['password'] == $data['repeat_password']) {
            if (checkUserIsExist($pdo, $data['username'], $data['email'])) {
                return [ "message" => "Имя пользователя или почта уже заняты"];
            }
        } else {
            return [ "message" => "Пароли не совпадают"];
        }
//        checkAuthorizedUser($pdo, $data['username'], $data['password']);
        $sql = "
        INSERT INTO users(display_name, username, email, password) 
        VALUES(:display_name, :username, :email, :password)
    ";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            'display_name' => $data['display_name'],
            'username' => $data['username'],
            'email' => $data['email'],
            'password' => password_hash($data['password'], PASSWORD_DEFAULT)
        ]);
        $user_id = $pdo->lastInsertId();

        $stmt = $pdo->prepare("SELECT id, user_role_id FROM users WHERE users.id = :id");
        $stmt->execute(['id' => $user_id]);
        $user_info = $stmt->fetch(PDO::FETCH_ASSOC);
        return [
            "user_id" => $user_info['id'],
            "user_role_id" => $user_info['user_role_id']
        ];
    } catch (PDOException $e) {
        return ["error" => $e->getMessage()];
    }
}

function checkUserIsExist($pdo, $username, $email): bool {
    $stmt = $pdo->prepare("SELECT id FROM users WHERE username = :username OR email = :email");
    $stmt->execute([
        'username' => $username,
        'email' => $email
    ]);
    $user_id = $stmt->fetch(PDO::FETCH_ASSOC);
    if (empty($user_id)) {
       return false;
    }
    return true;
}

function authorizationUser($pdo, $data) {
    try {

    } catch (PDOException $e) {
        return ["error" => $e->getMessage()];
    }

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
function addCommentToPost($pdo, $post_id, $user_id, $comment) {
    $sql =
        "INSERT INTO comments(post_id, user_id, content) 
        VALUES(:post_id, :user_id, :content)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        ':post_id' => $post_id,
        ':user_id' => $user_id,
        ':content' => $comment
    ]);
    return json_encode($pdo->lastInsertId());
}

function insertPost($pdo, $data) {
    $sql = "INSERT INTO posts(user_id, title, content, distribution_id, category_id)
    VALUES(:user_id, :title, :content, :distribution_id, :category_id)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute($data);
    return $pdo->lastInsertId();
}