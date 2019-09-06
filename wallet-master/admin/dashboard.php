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
    <title>AdminDashboard</title>
    <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="https://www.w3schools.com/w3css/4/w3.css">
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
  <!-- Showing user's last activity -->
  <div class="w3-row-padding w3-container">
    <div class="w3-col s3 w3-center"><p></p></div>
    <div class="w3-col s6 w3-center">
      <h2>User last activity</h2>
      <br></br>
        <table class="w3-table-all w3-hoverable">
          <thead>
            <tr class="w3-green">
              <th>UserID</th>
              <th>Username</th>
              <th>Last Login</th>
            </tr>
          </thead>
          <tbody>
            <?php
              $sql = "SELECT user_id, username, date FROM log";
              $result = mysqli_query($mysqli, $sql);
              if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
            ?>
            <tr>
              <td><?=$row['user_id']?></td>
              <td><?=$row['username']?></td>
              <td><?=$row['date']?></td>
            </tr>
            <?php
                }
              }
            ?>
          </tbody>
        </table>
    </div>
    <div class="w3-col s3 w3-center"><p></p></div>
  </div>

  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
</body>
</html>
