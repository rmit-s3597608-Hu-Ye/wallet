<?php
	$id = $_POST['id'];

	$connect = mysqli_connect("localhost", "root",  "rmitwal789", "rmitwallet");

    $statement = mysqli_prepare($connect, "DELETE FROM event1 WHERE event_id=?");
    mysqli_stmt_bind_param($statement, "s", $id);
    mysqli_stmt_execute($statement);

    $statement = mysqli_prepare($connect, "DELETE FROM event2 WHERE event_id=?");
    mysqli_stmt_bind_param($statement, "s", $id);
    mysqli_stmt_execute($statement);

    echo "yes";
?>