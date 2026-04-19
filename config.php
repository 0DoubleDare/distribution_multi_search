<?php
$env = parse_ini_file('.env');

$dsn = "mysql:host=" . $env['HOST'] . ';dbname=' . $env['DBNAME'];

try {
   $pdo = new PDO($dsn, $env['USER'], $env['PASSWORD']);
} catch (PDOException $error) {
    echo $error->getMessage();
}
