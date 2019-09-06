<?php

	include 'db.php';

	if (isset($_GET['id'])) {
		$sql = "DELETE FROM personal_profile WHERE user_id=".$_GET['id'];
		if (mysqli_query($mysqli, $sql)) {
			header('location: view.php');
		}
		else {
			echo "Connection error. Please try again!".mysqli_error($mysqli);
		}
	}

?>
