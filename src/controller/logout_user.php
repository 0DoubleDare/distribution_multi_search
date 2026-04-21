<?php
session_start();
require "../config.php";
require "../model/main.php";

unset($_SESSION['user_info']);

header("Location: ../index.php");

