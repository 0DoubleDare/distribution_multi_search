<?php
session_start();
require 'config.php';
require 'model/main.php';

$distros = getAllLinuxDistributions($pdo);
$user =
include "view/main_page.php"
?>