<?php
	$p = isset($_GET['p']) ? $_GET['p'] : '';

	$connect = mysqli_connect("localhost", "root", "rmitwal789", "rmitwallet");

	if($_POST){
        $str = base64_decode($p);
        $arr = explode('+',$str);

        if($_POST['pwd'] != $_POST['pwd2']){
        $url = "";
        echo "<script> alert('error');parent.location.href='$url'; </script>"; 
        return false;
        }

        $passwordHash = password_hash($_POST['pwd'], PASSWORD_DEFAULT);
        $statement = mysqli_prepare($connect, "UPDATE user SET password=? WHERE username=?"); 
        mysqli_stmt_bind_param($statement, "ss", $passwordHash, $arr[0]);
        mysqli_stmt_execute($statement);
        $url = "index.html";
        echo "<script> alert('sucess');parent.location.href='$url'; </script>"; 
	}

	if(!empty($p)){
		$str = base64_decode($p);
		$arr = explode('+',$str);
        if(count($arr) != 2){
            return false;
        }

        $statement = mysqli_prepare($connect, "SELECT * FROM user WHERE username = ?"); 
        mysqli_stmt_bind_param($statement, "s", $arr[0]);
        mysqli_stmt_execute($statement);
        mysqli_stmt_store_result($statement);
        mysqli_stmt_bind_result($statement, $colUserID, $colFirstname, $colLastname, $colEmail, $colUsername, $colPassword, $colQuestion, $colAnswer);

		while(mysqli_stmt_fetch($statement)){
			$response["username"] = $colUsername;
			$response["user_id"] = $colUserID;

			$key = md5($colUsername.$colUserID);
			if($arr[1] != $key){
				return false;
			}

	    }
	}else{
        return false;
    }

?>



<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>RMIT Wallet</title>

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    <!-- Custom styles for this template -->
    <link href="css/site.css" rel="stylesheet">

    <style>
        .page-container {
            width: 100%;
            padding-right: 15px;
            padding-left: 15px;
            margin: auto;
        }

        @media (min-width: 576px) {
            .page-container {
                max-width: 540px;
            }
        }

        @media (min-width: 768px) {
            .page-container {
                max-width: 720px;
            }
        }
    </style>
</head>

<body>
<form action="" method="POST">

<div class="page-container">
    <div class="row">
        <div class="col-md-5 mb-4 text-center text-md-right">
            <img class="wallet-logo" src="images/wallet_logo.png" alt="RMIT Wallet">
        </div>
        <h1 class="col-md-7 mb-3 text-light text-center text-md-left align-self-center">RMIT WALLET</h1>
    </div>

    <form method="post">
        <div class="row">
            <div class="col-md-12">
                <input type="text" name="pwd" maxlength="40" class="form-control mb-2" placeholder="Password" required autofocus>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <input type="text" name="pwd2" maxlength="40" class="form-control mb-2" placeholder="Password2" required autofocus>
            </div>
        </div>
        <button class="btn btn-success btn-block mb-2" type="submit">Save</button>
    </form>

    <p class="mt-5 mb-3 text-muted">&copy; 2018 RMIT University</p>
</div>

</body>
</html>

