<?php
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
	    $html = "<table align='center' class='mytable' cellspacing='0' cellpadding='0'>";

	    $html .= "<tr><th>Date</th><th>Time</th><th>Event</th><th>Location</th><th>Operation</th></tr>";
	    foreach ($response as $key => $value) {
		    $statement2 = mysqli_prepare($connect, "SELECT * FROM event1 WHERE event_id = ?"); 
		    mysqli_stmt_bind_param($statement2, "s", $value['event_id']);
		    mysqli_stmt_execute($statement2);
		    mysqli_stmt_store_result($statement2);
		    $count2 = mysqli_stmt_num_rows($statement2);
		    $response2 = array();
		    if($count2 > 0){
		    	mysqli_stmt_bind_result($statement2, $colEventID, $colEventDate, $colEventTime, $colEventName, $colEventLocation);
			    while(mysqli_stmt_fetch($statement2)){
			        $response2["event_id"] = isset($colEventID) ? $colEventID : ''; 
			        $response2["event_date"] = isset($colEventDate) ? $colEventDate : '';     
			        $response2["event_time"] = isset($colEventTime) ? $colEventTime : '';       
			        $response2["event_name"] = isset($colEventName) ? $colEventName : '';
			        $response2["event_loaction"] = isset($colEventLocation) ? $colEventLocation : '';
			    }
			    $html .= "<tr><td>".$response2["event_date"]."</td><td><input type='text' value="."'".$response2['event_time']."'"." /></td><td><input type='text' value="."'".$response2['event_name']."'"." /></td><td><input type='text' value="."'".$response2['event_loaction']."'"." /></td><td><button onclick='save(this)' class='save' tid=".$response2["event_id"].">save</button><button onclick='del(this)' class='del' tid=".$response2["event_id"].">del</button></td></tr>";

		    }	    	

		}
		$html .= "</table>";

		echo $html;

    }


    // $statement = mysqli_prepare($connect, "SELECT * FROM schedule WHERE user_id = ? order by UNIX_TIMESTAMP(date) asc"); 
    // mysqli_stmt_bind_param($statement, "s", $userid);
    // mysqli_stmt_execute($statement);
    // mysqli_stmt_store_result($statement);
    // $count = mysqli_stmt_num_rows($statement);
    // mysqli_stmt_bind_result($statement, $ID, $colUserID, $colDate, $colMsg);

    // if($count > 0){
	   //  $response = array();
	   //  $key = 0;
	   //  while(mysqli_stmt_fetch($statement)){
	   //      $response[$key]["id"] = isset($ID) ? $ID : ''; 
	   //      $response[$key]["user_id"] = isset($colUserID) ? $colUserID : '';          
	   //      $response[$key]["date"] = isset($colDate) ? $colDate : '';
	   //      $response[$key]["msg"] = isset($colMsg) ? $colMsg : '';
	   //      $key++;
	   //  }

	   //  $html = "<table align='center' class='mytable' cellspacing='0' cellpadding='0'>";
	   //  foreach ($response as $key => $value) {
	   //  	$html .= "<tr><th>".$response[$key]["date"]."</th><th>".$response[$key]["msg"]."</th></tr>";
	   //  }
	   //  $html .= "</table>";
	   //  echo $html;
    // }else{
    // 	echo "";
    // }
?>