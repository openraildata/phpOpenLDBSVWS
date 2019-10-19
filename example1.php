<?php
  require("OpenLDBSVWS.php");
  date_default_timezone_set("Europe/London");
  $OpenLDBSVWS = new OpenLDBSVWS("YOUR_ACCESS_TOKEN");
  $response = $OpenLDBSVWS->GetDepartureBoardByCRS(10,"PAD",date("H:i:s",time()),120);
  header("Content-Type: text/plain");
  print_r($response);
?>
