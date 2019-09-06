<?php
session_start();
require("password.php");
$connect = mysqli_connect("localhost", "root", "rmitwal789", "rmitwallet");

//Get user's input for username & password
@$username = $_POST["username"];
@$password = $_POST["password"];

//Finding everything from user table where username or email has been selected
$statement = mysqli_prepare($connect, "SELECT * FROM user WHERE username = ? OR email = ?");
mysqli_stmt_bind_param($statement, "ss", $username, $username);
mysqli_stmt_execute($statement);
mysqli_stmt_store_result($statement);
mysqli_stmt_bind_result($statement, $colUserId, $colFirstname, $colLastname, $colEmail, $colUsername, $colPassword, $colQuestion, $colAnswer);

$response = array();
$response["success"] = false;

//If user is an administrator, redirect to dashboard, otherwise redirect to index page
while (mysqli_stmt_fetch($statement)) {
    if (password_verify($password, $colPassword)) {
        $response["success"] = true;
        $response["user_id"] = $colUserId;
        $response["firstname"] = $colFirstname;
        $response["lastname"] = $colLastname;
        $response["email"] = $colEmail;
        $response["username"] = $colUsername;
        $response["question"] = $colQuestion;
        $response["answer"] = $colAnswer;
        $_SESSION["userid"] = $colUserId;

        if ($username == 'administrator') {
          header('Location: http://'.$_SERVER['HTTP_HOST'].'/webapp/combine/admin/dashboard.php');
          exit;
        }
        else {
          header('Location: http://'.$_SERVER['HTTP_HOST'].'/webapp/combine/index.php');
          exit;
        }
      }
    }

echo json_encode($response);
?>