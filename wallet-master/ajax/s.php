<?php
	$date =  $_POST['date'];
	$msg = $_POST['zt'];
    $area = $_POST['zt2'];
    $time = $_POST['zt3'];

	$userid = "145";

	$connect = mysqli_connect("localhost", "root",  "rmitwal789", "rmitwallet");

    $statement = mysqli_prepare($connect, "SELECT * FROM event2 WHERE user_id = ?"); 
    mysqli_stmt_bind_param($statement, "s", $userid);
    mysqli_stmt_execute($statement);
    mysqli_stmt_store_result($statement);
    $count = mysqli_stmt_num_rows($statement);
    mysqli_stmt_bind_result($statement, $colEventID, $colUserID);

    $response = array();
    $key = 0;

    if($count > 0){
        while(mysqli_stmt_fetch($statement)){
            $response[$key]["event_id"] = isset($colEventID) ? $colEventID : ''; 
            $response[$key]["user_id"] = isset($colUserID) ? $colUserID : ''; 
            $key++;         
        }

        foreach ($response as $key => $value) {
            $statement2 = mysqli_prepare($connect, "SELECT * FROM event1 WHERE event_id = ? AND event_date = ? AND event_time = ?"); 
            mysqli_stmt_bind_param($statement2, "sss", $value['event_id'], $date, $time);
            mysqli_stmt_execute($statement2);
            mysqli_stmt_store_result($statement2);
            $count2 = mysqli_stmt_num_rows($statement2);

            if($count2 > 0){ //updating
                $statementt = mysqli_prepare($connect, "UPDATE event1 SET event_name=?,event_time=?,event_location=? WHERE event_id=?"); 
                mysqli_stmt_bind_param($statementt, "ssss", $msg, $time, $area, $value['event_id']);
                mysqli_stmt_execute($statementt);
                echo "yes";
                die;
            }
        }

        //insert event2
        $statement = mysqli_prepare($connect, "INSERT INTO event2 (user_id) VALUES (?)");
        mysqli_stmt_bind_param($statement, "s", $userid);
        mysqli_stmt_execute($statement);

        //insert event1  need to get the id from event2
        $statement = mysqli_prepare($connect, "SELECT max(event_id) AS event_id FROM event2"); 
        mysqli_stmt_execute($statement);
        mysqli_stmt_store_result($statement);
        while(mysqli_stmt_fetch($statement)){
            $response["event_id"] = isset($colEventID) ? $colEventID : ''; 
        }

        $statement2 = mysqli_prepare($connect, "INSERT INTO event1 (event_id,event_date,event_time,event_name,event_location) VALUES (?,?,?,?,?)");
        mysqli_stmt_bind_param($statement2, "sssss", $response["event_id"], $date, $time, $msg, $area);
        mysqli_stmt_execute($statement2);

        echo "yesS";

    }else{  //no insert
        //insert event2
        
        $statement = mysqli_prepare($connect, "INSERT INTO event2 (user_id) VALUES (?)");
        mysqli_stmt_bind_param($statement, "s", $userid);
        mysqli_stmt_execute($statement);

        //insert event1 need to require event2's id
        $statement = mysqli_prepare($connect, "SELECT max(event_id) AS event_id FROM event2"); 
        mysqli_stmt_execute($statement);
        mysqli_stmt_store_result($statement);
        while(mysqli_stmt_fetch($statement)){
            $response["event_id"] = isset($colEventID) ? $colEventID : ''; 
        }

        $statement = mysqli_prepare($connect, "INSERT INTO event1 (event_id,event_date,event_time,event_name,event_location) VALUES (?,?,?,?,?)");
        mysqli_stmt_bind_param($statement, "sssss", $response["event_id"], $date, $time, $msg, $area);
        mysqli_stmt_execute($statement);

        echo "Successful";
        
    }


?>