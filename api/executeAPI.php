<?php

// REQUIRED FUNCTIONS
require('getMedia.php');
require('deleteMedia.php');
require('sendFiles.php');
require('ignoreEmptyDir.php');
require('../config/conf.php');
// PROCESS START
session_start();
$mediaId=[];
$weekdays = [];
$weekdays = getEmptyDir();

// GET OLD MEDIA INFO
foreach ($weekdays as $day) {
    $mediaId[]=getMedia($day,$APIServer);
}
// FILTER EMPTY
$mediaId = array_filter($mediaId, function($value, $key) {
    return $value !== '' && $value !== null;
}, ARRAY_FILTER_USE_BOTH);
// Reindex the array to fix the keys
$mediaId = array_values($mediaId);

// DELETE OLD MEDIA
foreach ($mediaId as $i){
    deleteMedia($i,$APIServer);
}

// UPLOAD
foreach ($weekdays as $dir) {
    $msg = sendFiles($dir,$APIServer);
    echo $msg;
}

// SESSION END 
session_destroy();

// Delete old files in the target directory
foreach ($weekdays as $day) {
    $oldFiles = glob('../upload/'.$day. '/*');
    foreach ($oldFiles as $oldFile) {
        unlink($oldFile);
    }
}

?>
