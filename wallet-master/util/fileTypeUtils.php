<?php

$fileTypesMap = [
    'archive' => ['rar', 'zip', '7z', 'tar', 'bz2'],
    'audio' => ['mp3', 'wav', 'm4a', 'ogg', 'aac'],
    'code' => ['c', 'cpp', 'java', 'xml', 'php', 'html', 'kt', 'go', 'rb', 'swift', 'js', 'css', 'json'],
    'excel' => ['xlsx', 'xls'],
    'image' => ['jpg', 'jpeg', 'png', 'bmp'],
    'pdf' => ['pdf'],
    'powerpoint' => ['pptx', 'ppt'],
    'alt' => ['txt', 'rtf', 'md'],
    'video' => ['mp4', 'm4v', 'mkv', 'avi', 'flv', 'gif'],
    'word' => ['docx', 'doc']
];


function getFileNameWithoutExt($filePath) {
    $fileName = getFileName($filePath);

    $dotIndex = strrpos($fileName, '.');
    if ($dotIndex) {
        return substr($fileName, 0, $dotIndex);
    }
    return $fileName;
}


function getFileExt($filePath) {
    $dotIndex = strrpos($filePath, '.');
    if ($dotIndex < 0) return '';

    $fileExt = substr($filePath, $dotIndex + 1);
    return strtolower($fileExt);
}


function getFontAwesomeIconClass($filePath) {
    $ext = getFileExt($filePath);

    global $fileTypesMap;
    foreach ($fileTypesMap as $className => $exts) {
        if (in_array($ext, $exts)) {
            return 'fa-file-'.$className;
        }
    }

    return 'fa-file';
}


function getFileName($filePath) {
    $lastSlashIndex = strrpos($filePath, '/');
    if ($lastSlashIndex) {
        return substr($filePath, $lastSlashIndex + 1);
    }
    else return $filePath;
}


function getFileParentPath($filePath) {
    $lastSlashIndex = strrpos($filePath, '/');
    if ($lastSlashIndex) return substr($filePath, 0, $lastSlashIndex);
    else return '';
}
