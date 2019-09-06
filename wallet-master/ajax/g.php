<?php
	$date = $_POST['date'];

	$connect = mysqli_connect("localhost", "root",  "rmitwal789", "rmitwallet");

	$userid = "145";

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
		    $statement2 = mysqli_prepare($connect, "SELECT * FROM event1 WHERE event_id = ? AND event_date = ?"); 
		    mysqli_stmt_bind_param($statement2, "ss", $value['event_id'], $date);
		    mysqli_stmt_execute($statement2);
		    mysqli_stmt_store_result($statement2);
		    $count2 = mysqli_stmt_num_rows($statement2);

		    if($count2 > 0){
		    	mysqli_stmt_bind_result($statement2, $colEventID, $colEventDate, $colEventTime, $colEventName, $colEventLocation);
			    while(mysqli_stmt_fetch($statement2)){
			        $response2["event_id"] = isset($colEventID) ? $colEventID : ''; 
			        $response2["event_date"] = isset($colEventDate) ? $colEventDate : '';          
			        $response2["event_name"] = isset($colEventName) ? $colEventName : '';
			        $response2["event_loaction"] = isset($colEventLocation) ? $colEventLocation : '';
			        $response2["event_time"] = isset($colEventTime) ? $colEventTime : '';
			    }

			    echo json_encode(["msg"=>$response2["event_name"],"area"=>$response2["event_loaction"],"time"=>$response2["event_time"]]);die;
		    }
	    }
	    echo json_encode(["msg"=>"","area"=>"","time"=>""]);
    }else{
    	echo json_encode(["msg"=>"","area"=>"","time"=>""]);
    }


?>