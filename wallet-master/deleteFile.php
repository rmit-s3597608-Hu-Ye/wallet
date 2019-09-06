<?php
require_once "util/dbUtils.php";

session_start();

$fileId = $_POST["id"];

deleteFile($fileId);
header("Location: {$_SERVER['HTTP_REFERER']}");
