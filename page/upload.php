<?php
$uploadDir = '/var/www/html/upload/';

if (!empty($_FILES['file']) && isset($_GET['day'])) {
    $uploadedFile = $_FILES['file'];
    $targetDir = $uploadDir . $_GET['day'];

    // Create the target directory if it doesn't exist
    if (!is_dir($targetDir)) {
        mkdir($targetDir, 0755, true);
    }

    // Delete old files in the target directory
    $oldFiles = glob($targetDir . '/*');
    foreach ($oldFiles as $oldFile) {
        unlink($oldFile);
    }

    // Move the new file to the target directory
    $uploadPath = $targetDir . '/' . basename($uploadedFile['name']);
    if (move_uploaded_file($uploadedFile['tmp_name'], $uploadPath)) {
        echo $uploadedFile['name'] . ' uploaded to [' . $_GET['day'] . "]";
    } else {
        echo 'Error uploading file.';
    }
} else {
    echo 'No file received or day not specified.';
}
?>
