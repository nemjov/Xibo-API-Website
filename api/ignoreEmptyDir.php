<?php
function getEmptyDir()
{
    $baseDir = '../upload/';

// Get all subdirectories in the base directory
    $subdirectories = glob($baseDir . '*', GLOB_ONLYDIR);

    foreach ($subdirectories as $subdirectory) {
        $files = scandir($subdirectory);
        $files = array_diff($files, array('.', '..'));

        if (!empty($files)) {
// If the subdirectory contains files, add it to the $weekdays array
            $weekdays[] = basename($subdirectory);
        }
    }
    return $weekdays;
}
?>