<?php
require 'config.php';
require 'model/main.php';

$distros = getAllLinuxDistributions($pdo);

include "view/main_page.php"
?>