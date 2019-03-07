<?php
    /**
     * Header Template
     *
     * Displays all of the head element and everything up until the "site-content" div.
     */
?>

<!-- DOM Elements -->

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Project Title
    </title>
    <meta name="language" content="en">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0">
    <?php wp_head(); ?>
    <link rel="stylesheet" href="assets/css/app.css">
  </head>
  <body>
    <div id="site-wrapper">
