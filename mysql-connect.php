<?php
  include("config/config.php");

  // Create connection
  $conn = new mysqli($servername, $username, $password, $db);

  // Check connection
  if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
  }

  // Helper function for displaying datetimes
  function displaytime($timestr) {
    if ($timestr == null || $timestr == "")
      return "";
    $timezone = new DateTimeZone("America/Detroit");

    $t = new DateTime($timestr);
    $t->setTimezone($timezone);
    // HACK dunno why this is necessary
    $t->sub(date_interval_create_from_date_string("4 hours"));

    return $t->format('l F jS g:ia Y');
  }

  // Helper function for getting the bash command to ssh into the spec runner
  function remotecmd($row) {
    $ip = $row["runner_ip"];
    if ($ip == null || $ip == "")
      return "echo \"I'm dumb\"";
    else
      return "ssh -t " . $row["runner_ip"] . " tmux a -t " . $row["app"] . ":0.0";
  }
?>
