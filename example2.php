<?php
  require("OpenLDBSVWS.php");
  $OpenLDBSVREFWS = new OpenLDBSVREFWS("YOUR_ACCESS_TOKEN");
  $response = $OpenLDBSVREFWS->GetTOCList();
  header("Content-Type: text/plain");
  print_r($response);
?>
