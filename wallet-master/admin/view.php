<?php
  require_once "db.php";
  session_start();
  $user = getSessionUserElseRedirectToLoginPage();
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>viewUsers</title>
    <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="https://www.w3schools.com/w3css/4/w3.css">
    <style>
      .button_link {padding: 20px 0px;text-align: right;}
      .button_link a{color: #428a8e;text-decoration: none; background-color: FFF;padding: 8px 20px;font-size: 0.8em;border: #428a8e 1px solid; border-radius: 8px;}
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
  
  <!-- Showing users' detail -->

  <div class="w3-row-padding w3-container">
    <div class="w3-col w3-center">
      <h2>Users detail</h2>
      <div class="button_link"><a href="add.php">Add new user record</a></div>
        <table class="w3-table-all w3-hoverable">
          <thead>
            <tr class="w3-green">
              <th>DOB</th>
              <th>Phone</th>
              <th>Address</th>
              <th>Social</th>
              <th>Hobbies</th>
              <th>Biography</th>
              <th colspan="2">Action</th>
            </tr>
          </thead>

          <tbody>
            <?php
              $sql = "SELECT dob, phone, address, social, hobbies, bio, user_id FROM personal_profile";
              $result = mysqli_query($mysqli, $sql);
              if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
            ?>
      			<tr>
      				<td><?=$row["dob"]?></td>
      				<td><?=$row["phone"]?></td>
      				<td><?=$row["address"]?></td>
              		<td><?=$row["social"]?></td>
              		<td><?=$row["hobbies"]?></td>
              		<td><?=$row["bio"]?></td>

      				<!-- action -->
              <td class="table-row" colspan="2">
                <a href="edit.php?id=<?=$row["user_id"]?>" class="link">Edit</a>
                <a href="delete.php?id=<?=$row["user_id"]?>" class="link">Delete</a>
              </td>
      			</tr>
      			<?php
      					}
      				}
      			?>
          </tbody>
        </table>
      </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
</body>
</html>
