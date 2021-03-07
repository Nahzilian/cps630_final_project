<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Devil May Air</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
    <script type="text/javascript">
      window.FontAwesomeConfig = { autoReplaceSvg: false }
      </script>
      <?php
      if(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on')
      $url = "https://";
      else
      $url = "http://";
      // Append the host(domain name, ip) to the URL.
      $url.= $_SERVER['HTTP_HOST'];

      // Append the requested resource location to the URL
      $url.= $_SERVER['REQUEST_URI'];

      ?>
    <?php if (strpos($url, "service.php") !== false): ?>
    <?php endif; ?>
    <link rel="shortcut icon" href="/res/img/logo.ico" type="image/x-icon">
    <link rel="stylesheet" href="./res/css/index.css">
    <link rel="stylesheet" href="./res/css/fontawsome/css/all.min.css">
    <link rel="stylesheet" href="./res/css/materialize/css/materialize.min.css">
    <script type="text/javascript" src="./res/css/materialize/js/materialize.min.js"></script>
    <script type="text/javascript" src="./res/css/fontawsome/js/all.min.js"></script>
  </head>

  <body>
