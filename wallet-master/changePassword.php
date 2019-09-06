<?php
require_once "util/dbUtils.php";

$password = $_POST['password'];
$passwordConfirm = $_POST['passwordConfirm'];

if ($password && $password === $passwordConfirm && changePassword($password)) {
    header("Location: {$_SERVER['HTTP_REFERER']}");
}
else {
    echo "Error changing password. Please try again later!";
}