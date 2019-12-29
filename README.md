phpOpenLDBSVWS
==============

Very simple PHP object encapsulation of the National Rail Enquiries live departure boards SOAP web service staff version (OpenLDBSVWS) as documented at http://lite.realtime.nationalrail.co.uk/OpenLDBSVWS/

Notes
=====

* Historic methods are no longer supported by the SOAP web services.  Archived service metrics and service detail can be obtained from the [Historical Service Performance](https://wiki.openraildata.com/index.php?title=HSP) API.

* Separated out top level WSDL XML for the Main and Reference services is required for compatibility with PHP's SOAP client

Usage (Main)
============

    <?php
      require("OpenLDBSVWS.php");
      $OpenLDBSVWS = new OpenLDBSVWS("YOUR_ACCESS_TOKEN");
    ?>

To enable the trace option in the SoapClient and to display fault message, last request and last response on error, initiate using:

    <?php
      require("OpenLDBSVWS.php");
      $OpenLDBSVWS = new OpenLDBSVWS("YOUR_ACCESS_TOKEN",TRUE);
    ?>

Methods (Main)
==============

    stdClass GetArrivalDepartureBoardByCRS( $numRows , $crs , $time , $timeWindow [, $filtercrs="" , $filterType="" , $filterTOC="" , $services="" , $getNonPassengerServices="" )

    stdClass GetArrivalBoardByCRS( $numRows , $crs , $time , $timeWindow [, $filtercrs="" , $filterType="" , $filterTOC="" , $services="" , $getNonPassengerServices="" )

    stdClass GetDepartureBoardByCRS( $numRows , $crs , $time , $timeWindow [, $filtercrs="" , $filterType="" , $filterTOC="" , $services="" , $getNonPassengerServices="" )

    stdClass GetArrDepBoardWithDetails( $numRows , $crs , $time , $timeWindow [, $filtercrs="" , $filterType="" , $filterTOC="" , $services="" , $getNonPassengerServices="" )

    stdClass GetArrBoardWithDetails( $numRows , $crs , $time , $timeWindow [, $filtercrs="" , $filterType="" , $filterTOC="" , $services="" , $getNonPassengerServices="" )

    stdClass GetDepBoardWithDetails( $numRows , $crs , $time , $timeWindow [, $filtercrs="" , $filterType="" , $filterTOC="" , $services="" , $getNonPassengerServices="" )

    stdClass GetArrivalDepartureBoardByTIPLOC( $numRows , $tiploc , $time , $timeWindow [, $filterTiploc="" , $filterType="" , $filterTOC="" , $services="" , $getNonPassengerServices="" )

    stdClass GetArrivalBoardByTIPLOC( $numRows , $tiploc , $time , $timeWindow [, $filterTiploc="" , $filterType="" , $filterTOC="" , $services="" , $getNonPassengerServices="" )

    stdClass GetDepartureBoardByTIPLOC( $numRows , $tiploc , $time , $timeWindow [, $filterTiploc="" , $filterType="" , $filterTOC="" , $services="" , $getNonPassengerServices="" )

    stdClass GetNextDepartures( $crs , $filterList , $time , $timeWindow [, $filterTOC="" , $services="" )

    stdClass GetFastestDepartures( $crs , $filterList , $time , $timeWindow [, $filterTOC="" , $services="")

    stdClass GetNextDeparturesWithDetails( $crs , $filterList , $time , $timeWindow [, $filterTOC="" , $services="" )

    stdClass GetFastestDeparturesWithDetails( $crs , $filterList , $time , $timeWindow [, $filterTOC="" , $services="" )

    stdClass GetServiceDetailsByRID( $rid )

    stdClass QueryServices( $serviceID , $sdd [, $filterTime="" , $filtercrs , $tocFilter="" ] )

    stdClass GetDisruptionList( $CRSList )

Usage (Reference)
=================

    <?php
      require("OpenLDBSVWS.php");
      $OpenLDBSVREFWS = new OpenLDBSVREFWS("YOUR_ACCESS_TOKEN");
    ?>

To enable the trace option in the SoapClient and to display fault message, last request and last response on error, initiate using:

    <?php
      require("OpenLDBSVWS.php");
      $OpenLDBSVREFWS = new OpenLDBSVREFWS("YOUR_ACCESS_TOKEN",TRUE);
    ?>

Methods (Reference)
===================

    stdClass GetReasonCode( $reasonCode = "" )

    stdClass GetReasonCodeList( )

    stdClass GetSourceInstanceNames( )

    stdClass GetTOCList ( [ $currentVersion = "" ] )

    stdClass GetStationList ( [ $currentVersion = "" ] )

Example 1
=========

Request the next 10 departures from London Paddington (PAD), display stdClass response using print_r():

    <?php
      require("OpenLDBSVWS.php");
      date_default_timezone_set("Europe/London");
      $OpenLDBSVWS = new OpenLDBSVWS("YOUR_ACCESS_TOKEN");
      $response = $OpenLDBSVWS->GetDepartureBoardByCRS(10,"PAD",date("H:i:s",time()),120);
      header("Content-Type: text/plain");
      print_r($response);
    ?>

Live demo:

https://railalefan.co.uk/phpOpenLDBSVWS/example1.php

(response cached for 60s)

Example 2
=========

Request the TOC list from the reference service, display stdClass response using print_r():

    <?php
      require("OpenLDBSVWS.php");
      $OpenLDBSVREFWS = new OpenLDBSVREFWS("YOUR_ACCESS_TOKEN");
      $response = $OpenLDBSVREFWS->GetTOCList();
      header("Content-Type: text/plain");
      print_r($response);
    ?>

Live demo:

https://railalefan.co.uk/phpOpenLDBSVWS/example2.php

(response cached for 60s)