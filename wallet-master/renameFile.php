<?php
require_once 'util/dbUtils.php';

session_start();

$id = $_POST['id'];
$newNameWithoutExt = $_POST['name'];

renameFile($id, $newNameWithoutExt);
header("Location: {$_SERVER['HTTP_REFERER']}");
