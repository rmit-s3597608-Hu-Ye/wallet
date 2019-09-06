<?php
require_once 'aws.phar';

use Aws\S3\S3Client;

$s3Client = new S3Client([
    'version'     => 'latest',
    'region'      => 'us-west-2',
    'credentials' => [
        'key'    => 'AKIAJ3NILXDNHOT2S7WQ',
        'secret' => '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',
    ]
]);

$s3Bucket = "webapp-student";

/*function queryS3Files($prefix) {
    global $s3Client;
    global $s3Bucket;

    $result = $s3Client->listObjectsV2([
        'Bucket' => $s3Bucket,
        'Prefix' => $prefix,

    ]);

    return $result;
}

function getFileNameAndUrl($prefix) {
    $queryResult = queryS3Files($prefix);
    $contents = $queryResult['Contents'];

    $result = array();

    foreach ($contents as $obj) {
        $key = $obj['Key'];

        array_push($result, [
            'Name' => getFileName($key),
            'URL' => getFileUrl($key)
        ]);
    }

    return $result;
}*/

function getS3FileUrl($fileKey) {
    global $s3Client;
    global $s3Bucket;

    $url = $s3Client->getObjectUrl($s3Bucket, $fileKey);
    return $url;
}

function deleteS3File($fileKey) {
    global $s3Client;
    global $s3Bucket;

    $s3Client->deleteObject([
        'Bucket' => $s3Bucket,
        'Key' => $fileKey,
    ]);
}

function renameMoveS3File($oldFileKey, $newFileKey) {
    global $s3Client;
    global $s3Bucket;

    $oldObject = $s3Client->getObject(array(
        'Bucket' => $s3Bucket,
        'Key' => $oldFileKey
    ));

    $s3Client->copyObject(array(
        'Bucket'     => $s3Bucket,
        'Key'        => $newFileKey,
        'CopySource' => "{$s3Bucket}/{$oldFileKey}",
        'ContentType' => $oldObject['ContentType'],
        'ACL' => 'public-read',
        'StorageClass' => 'REDUCED_REDUNDANCY'
    ));

    $s3Client->deleteObject(array(
        'Bucket' => $s3Bucket,
        'Key' => $oldFileKey
    ));
}
