<?php

  function db_connect() {
    global $conn; // db connection variable
    $db_server = "localhost";
    $username = "sdmceghv_insigniadbadmin";
    $password = "u{KPEDePs(6+";
    $db_name = "sdmceghv_insignia2022";

    // create a connection
    $conn = new mysqli($db_server, $username, $password, $db_name);

    // check connection for errors
    if ($conn->connect_error) {
      die("Error: " . $conn->connect_error);
    }
  }

  function redirect_to($url) {
    header("Location: " . $url);
      exit();
  }

  
?>