<?php
$env = parse_ini_file('.env');

$dsn = "mysql:host=" . $env['HOST'] . ';dbname=' . $env['DBNAME'];
$user = $env['USER'];
$password = $env['PASSWORD'];
try {
   $pdo = new PDO($dsn, $user, $password);
} catch (PDOException $error) {
    echo $error->getMessage();
}
