<?php
$uploadDir = '/var/www/html/upload/';

// List of days
$days = ['monday', 'tuesday'];

foreach ($days as $day) {
    $targetDir = $uploadDir . $day . '/';

    // Check if the target directory exists
    if (is_dir($targetDir)) {
        // Get the list of files in the directory
        $files = scandir($targetDir);

        // Remove "." and ".." from the list
        $files = array_diff($files, array('.', '..'));

        // Echo the filenames for the current day
        echo "Files in $day folder: " . implode(', ', $files) . "<br>";
    } else {
        echo "$day folder does not exist.<br>";
    }
}
?>