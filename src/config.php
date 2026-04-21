<?php
$host = "db";
$dbname = "distro_multi_search";
//$user = getenv('DB_USER');
$user = "admin";
//$password = getenv('PASSWORD');
$password = "12345678";

$dsn = "mysql:host=$host;dbname=$dbname";
try {
   $pdo = new PDO($dsn, $user, $password);
} catch (PDOException $error) {
    echo $error->getMessage();
}
