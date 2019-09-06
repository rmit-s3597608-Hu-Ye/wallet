<?php
require_once 'fileTypeUtils.php';
require_once 's3Utils.php';

session_start();

$mysqli = new mysqli('localhost', 'root', 'rmitwal789', 'rmitwallet');
if ($mysqli->connect_errno) {
    throw new Exception('Database connection failed!');
}

function getUserId() {
    return $_SESSION["userid"];
}



function _getUserPersonalProfile() {
    global $mysqli;

    $userId = getUserId();

    $stmt = $mysqli->prepare("SELECT * FROM personal_profile WHERE user_id = ?");
    $stmt->bind_param("s", $userId);
    $stmt->execute();

    $personalProfile = $stmt->get_result()->fetch_assoc();

    return $personalProfile;
}


function getUserPersonalProfile() {
    global $mysqli;

    $personalProfile = _getUserPersonalProfile();
    if (!$personalProfile) {
        $stmt = $mysqli->prepare("INSERT INTO personal_profile (user_id) VALUES(?)");
        $stmt->bind_param("s", getUserId());
        $stmt->execute();
    }

    $personalProfile = _getUserPersonalProfile();
    return $personalProfile;
}


function updatePersonalProfile($table, $field, $value) {
    global $mysqli;

    $stmt = $mysqli->prepare("UPDATE $table SET $field = ? WHERE user_id = ?");
    $stmt->bind_param("ss", $value, getUserId());
    return $stmt->execute();
}




function _getUserSettings() {
    global $mysqli;

    $userId = getUserId();

    $stmt = $mysqli->prepare("SELECT * FROM settings WHERE user_id = ?");
    $stmt->bind_param("s", $userId);
    $stmt->execute();

    $settings = $stmt->get_result()->fetch_assoc();

    $profilePicFileKey = $settings['path'];
    if ($profilePicFileKey) {
        $settings['path'] = getS3FileUrl($profilePicFileKey);
    }
    else {
        $settings['path'] = 'images/wallet_logo.png';
    }

    return $settings;
}


function getUserSettings() {
    global $mysqli;

    $settings = _getUserSettings();
    if (!$settings) {
        $stmt = $mysqli->prepare("INSERT INTO settings (user_id) VALUES(?)");
        $stmt->bind_param("s", getUserId());
        $stmt->execute();
    }

    $settings = _getUserSettings();
    return $settings;
}


function updateSettings($field, $value) {
    global $mysqli;

    $stmt = $mysqli->prepare("UPDATE settings SET $field = ? WHERE user_id = ?");
    $stmt->bind_param("ss", $value, getUserId());
    return $stmt->execute();
}



function addFileRecord($pathInBucket, $profileType) {
    global $mysqli;

    $userId = getUserId();

    $stmt = $mysqli->prepare("INSERT INTO user_files (userId, path, type) VALUES (?, ?, ?)");
    $stmt->bind_param("dss", $userId, $pathInBucket, $profileType);
    $stmt->execute();
    $stmt->close();
}


function getFileRecords($profileType) {
    global $mysqli;

    $userId = getUserId();

    $stmt = $mysqli->prepare("SELECT id, path, last_opened FROM user_files WHERE userId = ? AND type = ? ORDER BY path");
    $stmt->bind_param("ds", $userId, $profileType);
    $stmt->execute();

    $stmt->bind_result($id, $path, $last_opened);

    $fileRecords = [];

    while($stmt->fetch()) {
        $fileRecords[] = [
            'id' => $id,
            'path' => $path,
            'last_opened' => $last_opened,

            'name' => getFileName($path),
            'nameWithoutExt' => getFileNameWithoutExt($path),
            'ext' => getFileExt($path),
            'link' => "openFile.php?id=$id",
            'faIconClass' => getFontAwesomeIconClass($path)
        ];
    }
    $stmt->close();

    return $fileRecords;
}


function getFileKey($fileId) {
    global $mysqli;

    $stmt = $mysqli->prepare("SELECT path FROM user_files WHERE userId = ? AND id = ?");
    $stmt->bind_param('dd', getUserId(), $fileId);
    $stmt->execute();

    $stmt->bind_result($fileKey);
    $stmt->fetch();
    $stmt->close();

    return $fileKey;
}


function deleteFile($fileId) {
    global $mysqli;

    $fileKey = getFileKey($fileId);

    $stmt = $mysqli->prepare("DELETE FROM user_files WHERE id = ?");
    $stmt-> bind_param("d", $fileId);
    $stmt->execute();
    $stmt->close();

    deleteS3File($fileKey);
}


function renameFile($fileId, $newNameWithoutExt) {
    global $mysqli;

    $fileKey = getFileKey($fileId);

    $newKey = getFileParentPath($fileKey) . '/' . $newNameWithoutExt . '.' . getFileExt($fileKey);

    $stmt = $mysqli->prepare("UPDATE user_files SET path = ? WHERE id = ?");
    $stmt->bind_param("sd", $newKey, $fileId);
    $stmt->execute();
    $stmt->close();

    renameMoveS3File($fileKey, $newKey);
}

function getSessionUser() {
    global $mysqli;

    $userId = getUserId();

    if (!$userId) return null;

    $stmt = $mysqli->prepare("SELECT * FROM user WHERE user_id = ?");
    $stmt->bind_param("d", $userId);
    $stmt->execute();

    $user = $stmt->get_result()->fetch_assoc();

    $stmt->close();

    return $user;
}

function getSessionUserElseRedirectToLoginPage() {
    $user = getSessionUser();
    if (!$user) {
        header("Location: login.html");
        exit;
    }
    return $user;
}

function putProfilePicture($pathInBucket) {
    global $mysqli;

    $userId = getUserId();
    $stmt = $mysqli->prepare("UPDATE settings SET path = ? WHERE user_id = ?");
    $stmt->bind_param("sd", $pathInBucket, $userId);
    $stmt->execute();
    $stmt->close();
}

function changePassword($password) {
    global $mysqli;

    $userId = getUserId();
    $passwordHash = password_hash($password, PASSWORD_DEFAULT);

    $stmt = $mysqli->prepare("UPDATE `user` SET `password` = ? WHERE `user_id` = ?");
    $stmt->bind_param("sd", $passwordHash, $userId);
    $result = $stmt->execute();
    $stmt->close();

    if (!$result) {
        echo "password: $password";
        echo "hash: $passwordHash";
    }

    return $result;
}
