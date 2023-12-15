<?php
session_start(); // Start the session

require '../vendor/autoload.php';
require '../config/conf.php';
use League\OAuth2\Client\Provider\GenericProvider;

$redirectUri = $WebServer . '/api/auth.php';
$authorizationEndpoint = $APIServer . '/api/authorize';
$tokenEndpoint = $APIServer . '/api/authorize/access_token';

$provider = new GenericProvider([
    'clientId'                => $clientId,
    'clientSecret'            => $clientSecret,
    'redirectUri'             => $redirectUri,
    'urlAuthorize'            => $authorizationEndpoint,
    'urlAccessToken'          => $tokenEndpoint,
    'urlResourceOwnerDetails' => null,
]);

// Check if the authorization code is present in the query parameters
if (empty($_GET['code'])) {
    // If the authorization code is not present, redirect the user to the authorization endpoint
    header('Location: ' . $provider->getAuthorizationUrl());
    exit;
}

// If the code is present, exchange it for an access token
$token = $provider->getAccessToken('authorization_code', [
    'code' => $_GET['code'],
]);

// Save the access token in a session variable
$_SESSION['access_token'] = $token->getToken();
$_SESSION['token_expires_at'] = time() + $token->getExpires(); // Store the expiration timestamp
// Redirect to the main website or another page
header('Location:'.$WebServer. '/index.php');
exit;
