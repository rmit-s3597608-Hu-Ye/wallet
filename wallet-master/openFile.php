<?php
require_once 'util/dbUtils.php';
require_once 'util/s3Utils.php';

session_start();

$fileId = $_GET['id'];

$fileKey = getFileKey($fileId);

// update last opened
$stmt = $mysqli->prepare("UPDATE user_files SET last_opened = current_timestamp WHERE id = ?");
$stmt->bind_param('i', $fileId);
$stmt->execute();

$fileUrl = getS3FileUrl($fileKey);
header("Location: $fileUrl");
