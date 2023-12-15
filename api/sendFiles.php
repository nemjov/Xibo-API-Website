<?php
require_once __DIR__ . '/../vendor/autoload.php';
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

function sendFiles($dir,$APIServer)
{
    $client = new Client();
    $directory = '../upload/' . $dir . '/';
    $files = scandir($directory);
    $files = array_diff($files, array('.', '..'));

    $postData = [
        'multipart' => [
            [
                'name' => 'tags[]', // Change the name to 'tags[]'
                'contents' => $dir,
            ],
        ],
    ];

    foreach ($files as $item) {
        $fileFullPath = $directory . $item;
        $fileContent = file_get_contents($fileFullPath);

        if ($fileContent !== false) {
            // Sanitize the filename by removing null bytes
            $sanitizedFilename = str_replace("\0", '', $item);
            $randomNumber = substr(uniqid('', true), 0, 2) . mt_rand(1000, 9999);
            $sanitizedFilenameDir= $dir .'_'.$randomNumber. '_' .$sanitizedFilename;


            $postData['multipart'][] = [
                'name' => 'files[]',
                'contents' => $fileContent,
                'filename' => $sanitizedFilenameDir,
            ];
        } else {
            // Handle the case where file reading failed for $fileFullPath
            // For example: echo "Failed to read file: $fileFullPath\n";
        }
    }

    // Add the Authorization header with the access token
    $headers = [
        'Authorization' => 'Bearer ' . $_SESSION['access_token'],
    ];

    $options = [
        'headers' => $headers,
        'multipart' => $postData['multipart'],
    ];

    try {
        $response = $client->request('POST', $APIServer . '/api/library', $options);
        $jsonString = $response->getBody();

// Decode the JSON string into a PHP array
        $data = json_decode($jsonString, true);

// Check if decoding was successful
        if ($data !== null) {
            // Encode the array back to a formatted JSON string
            $prettyJson = json_encode($data, JSON_PRETTY_PRINT);

            // Echo the formatted JSON in a <pre> tag for better readability
            //echo '<pre>' . htmlspecialchars($prettyJson) . '</pre>';
            echo '<div class="centered"><b>Files sucessfully transfered</b></div>';
        } else {
            // Handle decoding error
            echo 'Error decoding JSON response';
        }
    } catch (RequestException $e) {
        echo 'Guzzle error: ' . $e->getMessage();
    }
}
?>
