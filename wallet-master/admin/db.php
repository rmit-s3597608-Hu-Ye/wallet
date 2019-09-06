<?php

session_start();

$mysqli = new mysqli('localhost', 'root', 'rmitwal789', 'rmitwallet');
if ($mysqli->connect_errno) {
    throw new Exception('Database connection failed!');
}

function getUserId() {
    return $_SESSION["userid"];
}

function getSessionUser() {
    global $mysqli;

    $userId = getUserId();

    $stmt = $mysqli->prepare("SELECT * FROM user WHERE user_id = ?");
    $stmt->bind_param("d", $userId);
    $stmt->execute();

    $user = $stmt->get_result()->fetch_assoc();
    $stmt->close();

    return $user;
}

function getSessionUserElseRedirectToLoginPage() {
    $user = getSessionUser();
    if (!$user) {
        header("Location: ../login.html");
        exit;
    }
    return $user;
}
