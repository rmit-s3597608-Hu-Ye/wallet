<?php

	$email = $_POST['email'];

	$connect = mysqli_connect("localhost", "root",  "rmitwal789", "rmitwallet");

	$checkE = json_decode(checkEmail());
	echo $checkE->msg;

	function checkEmail(){
        global $connect, $email;
        $statement = mysqli_prepare($connect, "SELECT * FROM user WHERE email = ?"); 
        mysqli_stmt_bind_param($statement, "s", $email);
        mysqli_stmt_execute($statement);
        mysqli_stmt_store_result($statement);
        $count = mysqli_stmt_num_rows($statement);
        mysqli_stmt_close($statement); 

        if ($count < 1){
            return json_encode(['code'=>400,'msg'=>'error']); 
        }else {
            return json_encode(['code'=>200,'msg'=>'success']); 
        }
	}

?>