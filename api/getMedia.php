<?php
function getMedia($day,$APIServer)
{

    $curl = curl_init();

    curl_setopt_array($curl, array(
        CURLOPT_URL => $APIServer .'/api/library?tags=' . urlencode($day),
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'GET',
        CURLOPT_HTTPHEADER => array(
            'Accept: application/json',
            'Authorization: Bearer ' . $_SESSION['access_token']
        ),
    ));

    $response = curl_exec($curl);
    curl_close($curl);

//echo 'cURL Response: ' . $response;

// Decode the JSON response into a PHP associative array
    $data = json_decode($response, true);

// Check if decoding was successful and if the response is not empty
    if ($data === null || empty($data)) {
        $msg = 'Error decoding JSON response or empty response.<br>';

    } else {
        // Access the "mediaId" field from the first element in the array
        return $data[0]['mediaId'];
    }
}// Function ends