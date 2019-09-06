<?php
$connect = mysqli_connect("localhost", "root", "rmitwal789", "rmitwallet");

$firstname = $_POST["firstname"];
$lastname = $_POST["lastname"];
$email = $_POST["email"];
$username = $_POST["username"];
$password = $_POST["password"];
$passwordConfirm = $_POST["passwordConfirm"];
$question = $_POST["question"];
$answer = $_POST["answer"];

function registerUser(){
    global $connect, $firstname, $lastname, $email, $username, $password, $passwordConfirm, $question, $answer;

    if ($password !== $passwordConfirm) {
        $url = "register.html";
        echo "<script> alert('Passwords mismatch. Please enter again!');parent.location.href='$url'; </script>"; 
        return false;
    }

    $passwordHash = password_hash($password, PASSWORD_DEFAULT);
    $answerHash = password_hash($answer, PASSWORD_DEFAULT);
    $statement = mysqli_prepare($connect, "INSERT INTO user (firstname, lastname, email, username, password, question, answer) VALUES (?, ?, ?, ?, ?, ?, ?)");
    mysqli_stmt_bind_param($statement, "sssssss", $firstname, $lastname, $email, $username, $passwordHash, $question, $answerHash);

    $success = mysqli_stmt_execute($statement);
    mysqli_stmt_close($statement);

    return $success;
}

$response = array();
$response["success"] = false;
if (registerUser()) {
    $response["success"] = true;
    $url = "login.html";
    echo "<script> alert('You have been registered successfully');parent.location.href='$url'; </script>";
} else {
    $url = "register.html";
    echo "<script> alert('The email/username has been registered. Please try another one!');parent.location.href='$url'; </script>";
}
echo json_encode($response);
?>