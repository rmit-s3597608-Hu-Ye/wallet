<?php
require_once "util/s3Utils.php";
require_once "util/dbUtils.php";

session_start();

$file = $_FILES['file'];

$referrer = $_SERVER['HTTP_REFERER'];

function returnBackAndExit() {
    global $referrer;
    header("Location: $referrer");
    exit;
}

if ($file["error"]) {
    returnBackAndExit();
}


$userId = getUserId();
$user = getSessionUserElseRedirectToLoginPage();
$settings = getUserSettings();
$currentProfilePic = $settings['path'];
if ($currentProfilePic) {
    deleteS3File($currentProfilePic);
}


$profileType = $_POST['type'];
$fileName = $file["name"];
$pathInBucket = "$userId/profilePic/$fileName";

$result = $s3Client->putObject([
    'Bucket'     => $s3Bucket,
    'Key'        => $pathInBucket,
    'SourceFile' => $file["tmp_name"],
    'ContentType' => $file["type"],
    'ACL' => 'public-read',
    'StorageClass' => 'REDUCED_REDUNDANCY'
]);

putProfilePicture($pathInBucket);

$mysqli->close();
returnBackAndExit();
