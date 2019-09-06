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
$profileType = $_POST['type'];
$fileName = $file["name"];
$pathInBucket = "$userId/$profileType/$fileName";

//Put object into S3 Client
$result = $s3Client->putObject([
    'Bucket'     => $s3Bucket,
    'Key'        => $pathInBucket,
    'SourceFile' => $file["tmp_name"],
    'ContentType' => $file["type"],
    'ACL' => 'public-read',
    'StorageClass' => 'REDUCED_REDUNDANCY'
]);

addFileRecord($pathInBucket, $profileType);

$mysqli->close();
returnBackAndExit();
