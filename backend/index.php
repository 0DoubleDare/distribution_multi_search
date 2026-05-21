<?php
session_start();

require "./config.php";
require "./functions/methods/get_query.php";
require "./functions/methods/post_query.php";

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
header("Access-Control-Allow-Methods: *");
header("Content-type: application/json");

$method = $_SERVER["REQUEST_METHOD"];
$path = $_GET["q"] ?? "";
$params = explode("/", $path) ?? "";

$type = $params[0] ?? "";
$id = $params[1] ?? "";

switch ($method) {
    case "GET":
        switch ($type) {
            case "distros":
                echo getAllLinuxDistributions($pdo);
                break;
            case "posts":
                if (isset($id)) {
                    echo getPostsByDistributionId($pdo, $id);
                    break;
                }
            case "comments":
                if (isset($id)) {
                     echo json_encode(getCommentsByPostId($pdo, $id));
                }
                break;
            case "users":
                if (isset($id)) {
                    echo getUserById($pdo, $id);
                }
                break;
                case "categories":
                    echo json_encode(getAllPostCategories($pdo));
                    break;
        }
        break;
    case "POST":
        $form_data = file_get_contents("php://input");
        $data = json_decode($form_data, true);
        switch ($type) {
            case "registration":
                $user_info = registrationUserByForm($pdo, $data);
                if (isset($user_info['user_id']) && isset($data['remember_me'])) {
                    $_SESSION['user_info'] = $user_info;
                }
                if (isset($user_info['message'])) {
                    $_SESSION['message'] = $user_info['message'];
                }
                echo json_encode($user_info);

                break;
            case "authorization":
                $user_info = authorizationUser($pdo, $data['username'], $data['password']);
                if (isset($user_info['user_id']) && isset($data['remember_me'])) {
                    $_SESSION['user_info'] = $user_info;
                }
                if (isset($user_info['message'])) {
                    $_SESSION['message'] = $user_info['message'];
                }
                echo json_encode($user_info);
                break;
            case "posts":
                if (isset($id)) {
                    $result = insertPost($pdo, $data);
                    echo json_encode($result);
                }
                break;
            case "comments":
                if (isset($id)) {
                    $result = addCommentToPost($pdo, $id, $data);
                    echo json_encode($result);
                }
                break;
        }
        break;
}
