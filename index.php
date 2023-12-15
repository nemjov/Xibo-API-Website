<!DOCTYPE html>
<html lang="en">

<head>
  <meta name="description" content="Webpage description goes here" />
  <meta charset="utf-8">
  <title>XIBO API INTERFACE</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="css/style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js" defer></script>

    <script src="scripts/scripts.js"></script>
</head>
<!-- SCRIPT START -->


<?php
require_once __DIR__ . '/vendor/autoload.php';
session_start(); // Start the session
?>
<!-- SCRIPT END -->
<body>
<div id="header_div"> <!-- HEADER START -->

    <?php include ('./page/header.php');?>
</div> <!-- HEADER END */ -->


<div id="main_div" > <!-- MAIN DIV START -->
    <br>

    <?php

    // Check if the session variable is empty
    if (empty($_SESSION['access_token'])) {
        // if empty show login
        include ('./page/login.php');
    } else {

        include ('./page/main.php');

    }

    ?>

</div><!--MAIN DIV END -->

</body>
</html>

