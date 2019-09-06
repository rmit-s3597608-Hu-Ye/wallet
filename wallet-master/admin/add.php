<?php
	include 'db.php';
	if (isset($_POST['submit'])) {
		$sql = "INSERT INTO personal_profile(dob, phone, address, social, hobbies, bio) VALUES ('" . $_POST['dob'] . "','" . $_POST['phone'] . "','" . $_POST['address'] . "','" . $_POST['social'] . "','" . $_POST['hobbies'] . "','" . $_POST['bio'] . "')";
		if (mysqli_query($mysqli, $sql)) {
			header('Location: view.php');
		}
		else {
			echo "Connection error. Please try again!". mysqli_error($mysqli);
		}
	}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>addNewUserDetail</title>
    <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="https://www.w3schools.com/w3css/4/w3.css">
		<style>
			.button_link a:hover, a:active {background-color: #00ff00;}
		</style>
  </head>

	<body>
	<!-- Add navigation bar -->
	<nav class="navbar navbar-light navbar-expand-md bg-faded navbar-grey justify-content-center">
	    <a href="dashboard.php" class="navbar-brand d-flex w-75 mr-auto">Admin Dashboard</a>
	    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsingNavbar">
	        <span class="navbar-toggler-icon"></span>
	    </button>
	    <div class="navbar-collapse collapse w-100" id="collapsingNavbar">
	      <ul class="navbar-nav w-100 justify-content-center">
	        <div class="w3-bar w3-white">
	          <a href="view.php" class="w3-bar-item w3-button w3-hover-none w3-text-black w3-hover-text-grey">Users Information</a>
	        </div>
	      </ul>
	      <ul class="nav navbar-nav ml-auto w-100 justify-content-end">
	        <div>
            <a class="text-light mr-2"><?php echo 'Welcome,' . ' ' .$user['firstname'] . ' ' . $user['lastname'] ?></a>
            <a href="../logout.php" class="text-light mr-2">Logout</a>
        </div>
	      </ul>
	    </div>
  	</nav>

  	<br></br>
  	
	<!-- Add new user's detail -->

	<div class="w3-row-padding w3-container">
    <div class="w3-col" style="width:33%"><p></p></div>
    <div class="w3-col w3-center" style="width:34%">
			<h2>Add a new user record</h2>
			<form name="" method="POST" action="">
      	<div class="button_link"><a href="view.php">Back to users</a></div>
				<table border="0" cellpadding="8px" cellspacing="0" width="50%" align="center">
						<tbody>
							<tr>
								<td><label>DOB</label></td>
								<td><input name="dob" class="txtField"></td>
							</tr>
							<tr>
								<td><label>Phone</label></td>
								<td><input name="phone" class="txtField"></td>
							</tr>
							<tr>
								<td><label>Address</label></td>
								<td><input name="address" class="txtField"></td>
							</tr>
							<tr>
								<td><label>Social</label></td>
								<td><input name="social" class="txtField"></td>
							</tr>
							<tr>
								<td><label>Hobbies</label></td>
								<td><input name="hobbies" class="txtField"></td>
							</tr>
							<tr>
								<td><label>Biography</label></td>
								<td><input name="bio" class="txtField"></td>
							</tr>
								<td></td>
								<td><input type="submit" name="submit"></td>
							</tr>
						</tbody>
					</table>
				</form>
			</div>
			<div class="w3-col" style="width:33%"><p></p></div>
		</div>

	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
</body>
</html>
