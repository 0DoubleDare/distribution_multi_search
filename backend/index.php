<?php
require "./config.php";
require "./functions/query.php";

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
header("Access-Control-Allow-Methods: *");
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
        }
        break;
    case "POST":
        switch ($type) {
            case "users":
                if (empty($id)) {
                    echo registrationUser($pdo, $_POST);
                } else {
//                    echo autho
                }
                break;

            case "posts":
                if (isset($id)) {

                }
        }
        break;
}
