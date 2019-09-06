<?php
	require("tools/email.class.php");

	$email = $_POST['email'];
	$question = $_POST['question'];
	$answer = $_POST['answer'];

	$connect = mysqli_connect("localhost", "root",  "rmitwal789", "rmitwallet");

	$checkE = json_decode(checkEmail());

	if($checkE->code == 200){
		$checkA = json_decode(checkAnswer());
		if($checkA->code == 200){
			$generateU = json_decode(generateUrl());
			
			if($generateU->code == 200){
				$sResult = json_decode(sendEmail($generateU->msg));
				if($sResult->code == 200){
		//			echo 'success';
echo $sResult->msg;
				}else{
					echo 'error';
				}
			}
		}else{
		    echo $checkA->msg;
		}
	}else{
	    echo $checkE->msg;
	}

	function checkEmail(){
        global $connect, $email;
        $statement = mysqli_prepare($connect, "SELECT * FROM user WHERE email = ?"); 
        mysqli_stmt_bind_param($statement, "s", $email);
        mysqli_stmt_execute($statement);
        mysqli_stmt_store_result($statement);
        $count = mysqli_stmt_num_rows($statement);
        mysqli_stmt_close($statement); 

        if ($count < 1){
            return json_encode(['code'=>400,'msg'=>'error on email']); 
        }else {
            return json_encode(['code'=>200,'msg'=>'y']); 
        }
	}

	function checkAnswer(){
		global $connect, $question, $answer;
        $statement = mysqli_prepare($connect, "SELECT * FROM user WHERE question = ?"); 
        mysqli_stmt_bind_param($statement, "s", $question);
        mysqli_stmt_execute($statement);
        mysqli_stmt_store_result($statement);
        $count = mysqli_stmt_num_rows($statement);
        mysqli_stmt_close($statement); 

        if ($count < 1){
			return json_encode(['code'=>400,'msg'=>'error on question']);
        }else {
            // $answerHash = password_hash($answer, PASSWORD_DEFAULT);
	        $statement = mysqli_prepare($connect, "SELECT * FROM user WHERE question = ? "); 
	        mysqli_stmt_bind_param($statement, "s", $question);
	        mysqli_stmt_execute($statement);
	        mysqli_stmt_store_result($statement);
	        mysqli_stmt_bind_result($statement, $colUserID, $colFirstname, $colLastname, $colEmail, $colUsername, $colPassword, $colQuestion, $colAnswer);
	        
	        while(mysqli_stmt_fetch($statement)){
	            $response["answer"] = $colAnswer;
	        }
	        mysqli_stmt_close($statement); 
	        if (password_verify($answer, $colAnswer)){
	        	return json_encode(['code'=>200,'msg'=>'y']);
	        }else{
	        	return json_encode(['code'=>400,'msg'=>'error on answer']);
	        }
        }
	}

	function generateUrl(){
		global $connect, $email;
        $statement = mysqli_prepare($connect, "SELECT * FROM user WHERE email = ?"); 
        mysqli_stmt_bind_param($statement, "s", $email);
        mysqli_stmt_execute($statement);
        mysqli_stmt_store_result($statement);
        mysqli_stmt_bind_result($statement, $colUserID, $colFirstname, $colLastname, $colEmail, $colUsername, $colPassword, $colQuestion, $colAnswer);

		while(mysqli_stmt_fetch($statement)){
            $response["success"] = true; 
			$response["user_id"] = $colUserID;			
            $response["firstname"] = $colFirstname;
			$response["lastname"] = $colLastname;
			$response["email"] = $colEmail;
			$response["username"] = $colUsername;
			$response["question"] = $colQuestion;
			$response["answer"] = $colAnswer;
	    }

	    $key = md5($colUsername.$colUserID);
	    $string = base64_encode( $colUsername.'+'.$key );
	    $url = 'http://ec2-52-26-43-77.us-west-2.compute.amazonaws.com/webapp/student/changeUserPassword.php?p='.$string;
	    return json_encode(['code'=>200,'msg'=>$url]);
	}

	function sendEmail($msg){
		global $email;

        $smtpserver = "smtp.qq.com";//SMTP server
        $smtpserverport = 25;//SMTP port 
        $smtpusermail = "1196635173@qq.com";//SMTP email
        $smtpemailto = $email;//sent to user
        $smtpuser = "1196635173@qq.com";//account
        $smtppass = "irhzrrudbksfbaga";//password
        $mailsubject = "Reset password";//email subject
        $mailbody = "<h1> ".$msg." </h1>";//email content
        $mailtype = "HTML";//email form
        
        $smtp = new smtp($smtpserver,$smtpserverport,true,$smtpuser,$smtppass);
        $smtp->debug = true;
        $res=$smtp->sendmail($smtpemailto, $smtpusermail, $mailsubject, $mailbody, $mailtype);
        return json_encode(['code'=>200,'msg'=>$res]);
	}

?>