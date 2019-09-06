<?php
require_once "util/fileTypeUtils.php";
require_once "util/dbUtils.php";

session_start();

$type = $_GET['type'];
if (!$type) {
    $type = 'personal';
}

$user = getSessionUserElseRedirectToLoginPage();
$personalProfile = getUserPersonalProfile();
$settings = getUserSettings();
$fileRecords = getFileRecords($type);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>RMIT Wallet</title>

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">

    <!-- Custom styles for this template -->
    <link href="css/site.css" rel="stylesheet">
    <link href="css/profiles.css" rel="stylesheet">
</head>
<body>

<header>
    <nav class="navbar navbar-expand navbar-dark fixed-top">
        <!--<a class="navbar-brand" href="#">Carousel</a>-->
        <button type="button" id="sidebarCollapse" class="btn btn-outline">
            <i class="fas fa-bars"></i>
        </button>
        <ul class="navbar-nav mr-auto">
            <!--<li class="nav-item">
                <a class="nav-link" href="#">Link</a>
            </li>-->
        </ul>
        <div>
            <a class="text-light mr-2"><?php echo $user['firstname'] . ' ' . $user['lastname'] ?></a>
            <a href="logout.php" class="text-light mr-2">Logout</a>
            <img src="<?php echo $settings['path'] ?>" class="nav-profilePic rounded-circle">
        </div>
    </nav>
</header>

<!-- Sidebar -->
<nav id="sidebar" class="border-right">
    <div id="sidebar-dismiss" class="p-2">
        <i class="fas fa-arrow-left"></i>
    </div>

    <img class="wallet-logo" src="images/wallet_logo.png" alt="RMIT Wallet">

    <ul id="sidebar-items" class="list-unstyled">
        <li>
            <a class="active" href="index.php"><i class="fas fa-fw fa-home mr-2"></i>Home</a>
        </li>
        <li>
            <a href="settings.php"><i class="fas fa-fw fa-cog mr-2"></i>Settings</a>
        </li>
        <li>
            <a href="event.php"><i class="fas fa-fw fa-calendar-alt mr-2"></i>Events</a>
        </li>
    </ul>
</nav>

<main role="main">
    <!-- Main Content -->
    <div class="container">
        <select id="profileTypesSelect" class="form-control d-flex justify-content-center d-sm-none mt-3" onchange="location = this.value;">
            <option name="work" value="profiles.php?type=work">Work Profile</option>
            <option name="educational" value="profiles.php?type=educational">Educational Profile</option>
            <option name="personal" value="profiles.php?type=personal">Personal Profile</option>
            <option name="credits" value="profiles.php?type=credits">Credits</option>
        </select>

        <div id="profileTypesBtnGroup" class="btn-group d-none d-sm-flex justify-content-center mt-3" role="group" aria-label="Profile Types">
            <a href="profiles.php?type=work" role="button" name="work" class="btn btn-outline-secondary">Work Profile</a>
            <a href="profiles.php?type=educational" name="educational" class="btn btn-outline-secondary">Educational Profile</a>
            <a href="profiles.php?type=personal" name="personal" class="btn btn-outline-secondary">Personal Profile</a>
            <a href="profiles.php?type=credits" name="credits" class="btn btn-outline-secondary">Credits</a>
        </div>

        <div id="personalInfo" class="py-2">
            <?php if ($type === 'personal') { ?>
                <div class="row px-2 py-1 border-top border-bottom">
                    <div class="col-sm-3">First Name</div>
                    <input type="text" name="firstname" class="col-sm-6 border-0" disabled value="<?php echo $user['firstname'] ?>" />
                    <a href="#" class="editInfo col-3">Edit</a>
                </div>
                <div class="row px-2 py-1 border-top border-bottom">
                    <div class="col-sm-3">Last Name</div>
                    <input type="text" name="lastname" class="col-sm-6 border-0" disabled value="<?php echo $user['lastname'] ?>" />
                    <a href="#" class="editInfo col-3">Edit</a>
                </div>
                <div class="row px-2 py-1 border-bottom">
                    <div class="col-sm-3">DOB</div>
                    <input type="date" name="dob" class="col-sm-6 border-0" disabled value="<?php echo $personalProfile['dob'] ?>" />
                    <a href="#" class="editInfo col-3">Edit</a>
                </div>
                <div class="row px-2 py-1 border-bottom">
                    <div class="col-sm-3">Address</div>
                    <input type="text" name="address" class="col-sm-6 border-0" disabled value="<?php echo $personalProfile['address'] ?>" />
                    <a href="#" class="editInfo col-3">Edit</a>
                </div>
                <div class="row px-2 py-1 border-bottom">
                    <div class="col-sm-3">Phone No</div>
                    <input type="text" name="phone" class="col-sm-6 border-0" disabled value="<?php echo $personalProfile['phone'] ?>" />
                    <a href="#" class="editInfo col-3">Edit</a>
                </div>
                <div class="row px-2 py-1 border-bottom">
                    <div class="col-sm-3">Email</div>
                    <input type="email" class="col-sm-6 border-0" disabled value="<?php echo $user['email'] ?>" />
                </div>
                <div class="row px-2 py-1 border-bottom">
                    <div class="col-sm-3">Hobbies</div>
                    <input type="text" name="hobbies" class="col-sm-6 border-0" disabled value="<?php echo $personalProfile['hobbies'] ?>" />
                    <a href="#" class="editInfo col-3">Edit</a>
                </div>
                <div class="row px-2 py-1 border-bottom">
                    <div class="col-sm-3">Biography</div>
                    <input type="text" name="bio" class="col-sm-6 border-0" disabled value="<?php echo $personalProfile['bio'] ?>" />
                    <a href="#" class="editInfo col-3">Edit</a>
                </div>
                <div class="row px-2 py-1 border-bottom">
                    <div class="col-sm-3">Social media links</div>
                    <input type="text" name="social" class="col-sm-6 border-0" disabled value="<?php echo $personalProfile['social'] ?>" />
                    <a href="#" class="editInfo col-3">Edit</a>
                </div>
            <?php } ?>

            <div class="row px-2 py-1 border-bottom">
                <div class="col-9">User personal files</div>
                <a href="#" class="col-3" data-toggle="modal" data-target="#askUploadSourceModal">Upload</a>
            </div>

            <!--Desktop-->
            <table class="d-none d-md-table table py-1">
                <thead>
                <tr>
                    <th scope="col">Name</th>
                    <th scope="col">Last opened</th>
                    <th scope="col">Actions</th>
                </tr>
                </thead>
                <tbody>
                <?php
                foreach ($fileRecords as $myFile) {
                    $id = $myFile['id'];
                    $name = $myFile['name'];
                    $nameWithoutExt = $myFile['nameWithoutExt'];
                    $link = $myFile['link'];
                    $faIconClass = $myFile['faIconClass'];
                    $lastOpened = $myFile['last_opened'];

                    echo <<<EOT
                    <tr>
                        <td>
                            <i class="far fa-fw fa-lg $faIconClass"></i>
                            <a href="$link">$name</a>
                        </td>
                        <td class="lastOpened">$lastOpened</td>
                        <td>
                            <div class="dropdown">
                                <button type="button" class="btn btn-sm btn-outline-secondary dropdown-toggle" data-toggle="dropdown" data-display="static" aria-haspopup="true" aria-expanded="false"></button>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <button class="dropdown-item" type="button" data-toggle="modal" data-target="#renameFileModal" onclick="setRenameModalData($id, '$nameWithoutExt')">Rename</button>
                                    <button class="dropdown-item" type="button" data-toggle="modal" data-target="#deleteFileModal" onclick="setDeleteModalFileId($id)">Delete</button>
                                </div>
                            </div>
                        </td>
                    </tr>
EOT;
                }
                ?>
                </tbody>

            </table>

            <!--Mobile-->
            <div class="d-block d-md-none pt-1 pb-5">
                <?php
                foreach ($fileRecords as $myFile) {
                    $id = $myFile['id'];
                    $name = $myFile['name'];
                    $nameWithoutExt = $myFile['nameWithoutExt'];
                    $link = $myFile['link'];
                    $faIconClass = $myFile['faIconClass'];
                    $lastOpened = $myFile['last_opened'];

                    echo <<<EOT
                    <div class="d-flex align-items-center fileItem">
                        <i class="far fa-fw fa-lg mr-2 $faIconClass"></i>
                        <div class="flex-grow-1">
                            <a class="d-block px-auto" href="$link">$name</a>
                            <small class="d-block lastOpened">$lastOpened</small>
                        </div>
                        <div class="btn-group">
                            <button type="button" class="btn btn-outline-secondary dropdown-toggle" data-toggle="dropdown" data-display="static" aria-haspopup="true" aria-expanded="false"></button>
                            <div class="dropdown-menu dropdown-menu-right">
                                <button class="dropdown-item" type="button" data-toggle="modal" data-target="#renameFileModal" onclick="setRenameModalData($id, '$nameWithoutExt')">Rename</button>
                                <button class="dropdown-item" type="button" data-toggle="modal" data-target="#deleteFileModal" onclick="setDeleteModalFileId($id)">Delete</button>
                            </div>
                        </div>
                    </div>
EOT;
                }
                ?>
            </div>

        </div>

    </div>

</main>

<!-- Upload file modal -->
<div class="modal" id="askUploadSourceModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Upload file</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" action="profileFileUpload.php" enctype="multipart/form-data" class="d-flex flex-column">
                    <label for="inputFile">Select file from your computer</label>
                    <input required type="file" name="file" id="inputFile" class="form-control mb-2"
                           <?php if ($type !== 'personal') echo 'accept=".pdf"' ?>
                    />
                    <input hidden type="text" name="type" value="<?php echo $type ?>">
                    <button class="btn btn-primary align-self-end" type="submit">Upload</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Rename file modal -->
<div class="modal" id="renameFileModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Rename file</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" action="renameFile.php" class="d-flex flex-column">
                    <label>Enter new file name without extension</label>
                    <input hidden type="text" name="id" value="">
                    <input class="form-control mb-2" type="text" pattern="^[\w\s-]{1,100}$" autocomplete="off" name="name" value="">
                    <button class="btn btn-primary align-self-end" type="submit">Rename</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Delete file modal -->
<div class="modal" id="deleteFileModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Delete file</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" action="deleteFile.php" class="d-flex flex-column">
                    <label>Do you want to delete this file?</label>
                    <input hidden type="text" name="id" value="">
                    <button class="btn btn-danger align-self-end" type="submit">Delete</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Dark Overlay element -->
<div id="sidebar-overlay"></div>

<script src="https://code.jquery.com/jquery-3.3.1.min.js" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
<script defer src="https://use.fontawesome.com/releases/v5.3.1/js/all.js" integrity="sha384-kW+oWsYx3YpxvjtZjFXqazFpA7UP/MbiY4jvs+RWZo2+N94PFZ36T6TFkc9O3qoB" crossorigin="anonymous"></script>
<script defer src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.2/moment.js" integrity="sha256-59IZ5dbLyByZgSsRE3Z0TjDuX7e1AiqW5bZ8Bg50dsU=" crossorigin="anonymous"></script>

<script src="js/site.js"></script>
<script src="js/profiles.js"></script>

<script>
    $('#profileTypesSelect > [name="<?php echo $type ?>"]').prop('selected', true);

    $('#profileTypesBtnGroup > button').removeClass('active');
    $('#profileTypesBtnGroup > [name="<?php echo $type ?>"]').addClass('active');
</script>

</body>
</html>