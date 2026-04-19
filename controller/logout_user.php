<?php
session_start();
require "../config.php";
require "../model/main.php";

unset($_SESSION['user_id']);

header("Location: ../index.php");

