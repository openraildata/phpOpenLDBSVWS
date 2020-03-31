<?php
  class OpenLDBSVWS
  {
    private $accessToken;

    private $trace;

    private $wsdl = '<?xml version="1.0" encoding="utf-8"?>
      <wsdl:definitions
        xmlns:wsdl="http://schemas.xmlsoap.org/wsdl/"
        xmlns:soap12="http://schemas.xmlsoap.org/wsdl/soap12/"
        xmlns:sv="http://thalesgroup.com/RTTI/2017-10-01/ldbsv/"
        targetNamespace="http://thalesgroup.com/RTTI/2017-10-01/ldbsv/">
        <wsdl:import
          namespace="http://thalesgroup.com/RTTI/2017-10-01/ldbsv/"
          location="http://lite.realtime.nationalrail.co.uk/OpenLDBSVWS/rtti_2017-10-01_ldbsv.wsdl"/>
        <wsdl:service name="ldbsv">
          <wsdl:port name="LDBSVServiceSoap12" binding="sv:LDBSVServiceSoap12">
            <soap12:address location="http://lite.realtime.nationalrail.co.uk/OpenLDBSVWS/ldbsv12.asmx"/>
          </wsdl:port>
        </wsdl:service>
      </wsdl:definitions>';

    function __construct($accessToken,$trace=FALSE)
    {
      $this->accessToken = $accessToken;

      $this->trace = $trace;

      $soapOptions = array("trace"=>$this->trace,"soap_version"=>SOAP_1_2,"features"=>SOAP_SINGLE_ELEMENT_ARRAYS);

      if (extension_loaded("zlib")) $soapOptions["compression"] = SOAP_COMPRESSION_ACCEPT|SOAP_COMPRESSION_GZIP;

      $this->soapClient = new SoapClient("data:text/plain;base64,".base64_encode($this->wsdl),$soapOptions);

      $soapVar = new SoapVar(array("ns2:TokenValue"=>$this->accessToken),SOAP_ENC_OBJECT);

      $soapHeader = new SoapHeader("http://thalesgroup.com/RTTI/2010-11-01/ldb/commontypes","AccessToken",$soapVar,FALSE);

      $this->soapClient->__setSoapHeaders($soapHeader);
    }

    private function call($method,$params)
    {
      try
      {
        $response = $this->soapClient->$method($params);
      }
      catch(SoapFault $soapFault)
      {
        if ($this->trace)
        {
          $traceOutput["soapFaultMessage"] = $soapFault->getMessage();

          $traceOutput["soapClientRequest"] = str_replace($this->accessToken,"",$this->soapClient->__getLastRequest());

          $traceOutput["soapClientResponse"] = $this->soapClient->__getLastResponse();

          print_r($traceOutput);
        }
      }

      return (isset($response)?$response:FALSE);
    }

    function GetBoardByCRS($method,$numRows,$crs,$time,$timeWindow,$filtercrs,$filterType,$filterTOC,$services,$getNonPassengerServices)
    {
      $params = array();

      if ($numRows) $params["numRows"] = $numRows;

      if ($crs) $params["crs"] = $crs;

      if ($time) $params["time"] = $time;

      if ($timeWindow) $params["timeWindow"] = $timeWindow;

      if ($filtercrs) $params["filtercrs"] = $filtercrs;

      if ($filterType) $params["filterType"] = $filterType;

      if ($filterTOC) $params["filterTOC"] = $filterTOC;

      if ($services) $params["services"] = $services;

      if ($getNonPassengerServices) $params["getNonPassengerServices"] = $getNonPassengerServices;

      return $this->call($method,$params);
    }

    function GetArrivalDepartureBoardByCRS($numRows="",$crs="",$time="",$timeWindow="",$filtercrs="",$filterType="",$filterTOC="",$services="",$getNonPassengerServices="")
    {
      return $this->GetBoardByCRS("GetArrivalDepartureBoardByCRS",$numRows,$crs,$time,$timeWindow,$filtercrs,$filterType,$filterTOC,$services,$getNonPassengerServices);
    }

    function GetArrivalBoardByCRS($numRows="",$crs="",$time="",$timeWindow="",$filtercrs="",$filterType="",$filterTOC="",$services="",$getNonPassengerServices="")
    {
      return $this->GetBoardByCRS("GetArrivalBoardByCRS",$numRows,$crs,$time,$timeWindow,$filtercrs,$filterType,$filterTOC,$services,$getNonPassengerServices);
    }

    function GetDepartureBoardByCRS($numRows="",$crs="",$time="",$timeWindow="",$filtercrs="",$filterType="",$filterTOC="",$services="",$getNonPassengerServices="")
    {
      return $this->GetBoardByCRS("GetDepartureBoardByCRS",$numRows,$crs,$time,$timeWindow,$filtercrs,$filterType,$filterTOC,$services,$getNonPassengerServices);
    }

    function GetArrDepBoardWithDetails($numRows="",$crs="",$time="",$timeWindow="",$filtercrs="",$filterType="",$filterTOC="",$services="",$getNonPassengerServices="")
    {
      return $this->GetBoardByCRS("GetArrDepBoardWithDetails",$numRows,$crs,$time,$timeWindow,$filtercrs,$filterType,$filterTOC,$services,$getNonPassengerServices);
    }

    function GetArrBoardWithDetails($numRows="",$crs="",$time="",$timeWindow="",$filtercrs="",$filterType="",$filterTOC="",$services="",$getNonPassengerServices="")
    {
      return $this->GetBoardByCRS("GetArrBoardWithDetails",$numRows,$crs,$time,$timeWindow,$filtercrs,$filterType,$filterTOC,$services,$getNonPassengerServices);
    }

    function GetDepBoardWithDetails($numRows="",$crs="",$time="",$timeWindow="",$filtercrs="",$filterType="",$filterTOC="",$services="",$getNonPassengerServices="")
    {
      return $this->GetBoardByCRS("GetDepBoardWithDetails",$numRows,$crs,$time,$timeWindow,$filtercrs,$filterType,$filterTOC,$services,$getNonPassengerServices);
    }

    function GetBoardByTIPLOC($method,$numRows,$tiploc,$time,$timeWindow,$filterTiploc,$filterType,$filterTOC,$services,$getNonPassengerServices)
    {
      $params = array();

      if ($numRows) $params["numRows"] = $numRows;

      if ($tiploc) $params["tiploc"] = $tiploc;

      if ($time) $params["time"] = $time;

      if ($timeWindow) $params["timeWindow"] = $timeWindow;

      if ($filterTiploc) $params["filterTiploc"] = $filterTiploc;

      if ($filterType) $params["filterType"] = $filterType;

      if ($filterTOC) $params["filterTOC"] = $filterTOC;

      if ($services) $params["services"] = $services;

      if ($getNonPassengerServices) $params["getNonPassengerServices"] = $getNonPassengerServices;

      return $this->call($method,$params);
    }

    function GetArrivalDepartureBoardByTIPLOC($numRows="",$tiploc="",$time="",$timeWindow="",$filterTiploc="",$filterType="",$filterTOC="",$services="",$getNonPassengerServices="")
    {
      return $this->GetBoardByTIPLOC("GetArrivalDepartureBoardByTIPLOC",$numRows,$tiploc,$time,$timeWindow,$filterTiploc,$filterType,$filterTOC,$services,$getNonPassengerServices);
    }

    function GetArrivalBoardByTIPLOC($numRows="",$tiploc="",$time="",$timeWindow="",$filterTiploc="",$filterType="",$filterTOC="",$services="",$getNonPassengerServices="")
    {
      return $this->GetBoardByTIPLOC("GetArrivalBoardByTIPLOC",$numRows,$tiploc,$time,$timeWindow,$filterTiploc,$filterType,$filterTOC,$services,$getNonPassengerServices);
    }

    function GetDepartureBoardByTIPLOC($numRows="",$tiploc="",$time="",$timeWindow="",$filterTiploc="",$filterType="",$filterTOC="",$services="",$getNonPassengerServices="")
    {
      return $this->GetBoardByTIPLOC("GetDepartureBoardByTIPLOC",$numRows,$tiploc,$time,$timeWindow,$filterTiploc,$filterType,$filterTOC,$services,$getNonPassengerServices);
    }

    function GetDepartures($method,$crs,$filterList,$time,$timeWindow,$filterTOC,$services)
    {
      $params = array();

      if ($crs) $params["crs"] = $crs;

      if ($filterList) $params["filterList"] = $filterList;

      if ($time) $params["time"] = $time;

      if ($timeWindow) $params["timeWindow"] = $timeWindow;

      if ($filterTOC) $params["filterTOC"] = $filterTOC;

      if ($services) $params["services"] = $services;

      return $this->call($method,$params);
    }

    function GetNextDepartures($crs="",$filterList="",$time="",$timeWindow="",$filterTOC="",$services="")
    {
      return $this->GetDepartures("GetNextDepartures",$crs,$filterList,$time,$timeWindow,$filterTOC,$services);
    }

    function GetFastestDepartures($crs="",$filterList="",$time="",$timeWindow="",$filterTOC="",$services="")
    {
      return $this->GetDepartures("GetFastestDepartures",$crs,$filterList,$time,$timeWindow,$filterTOC,$services);
    }

    function GetNextDeparturesWithDetails($crs="",$filterList="",$time="",$timeWindow="",$filterTOC="",$services="")
    {
      return $this->GetDepartures("GetNextDeparturesWithDetails",$crs,$filterList,$time,$timeWindow,$filterTOC,$services);
    }

    function GetFastestDeparturesWithDetails($crs="",$filterList="",$time="",$timeWindow="",$filterTOC="",$services="")
    {
      return $this->GetDepartures("GetFastestDeparturesWithDetails",$crs,$filterList,$time,$timeWindow,$filterTOC,$services);
    }

    function GetServiceDetailsByRID($rid="")
    {
      $params = array();

      if ($rid) $params["rid"] = $rid;

      return $this->call("GetServiceDetailsByRID",$params);
    }

    function QueryServices($serviceID="",$sdd="",$filterTime="",$filtercrs="",$tocFilter="")
    {
      $params = array();

      if ($serviceID) $params["serviceID"] = $serviceID;

      if ($sdd) $params["sdd"] = $sdd;

      if ($filterTime) $params["filterTime"] = $filterTime;

      if ($filtercrs) $params["filtercrs"] = $filtercrs;

      if ($tocFilter) $params["tocFilter"] = $tocFilter;

      return $this->call("QueryServices",$params);
    }

    function GetDisruptionList($CRSList="")
    {
      $params = array();

      if ($CRSList) $params["CRSList"] = $CRSList;

      return $this->call("GetDisruptionList",$params);
    }
  }

  class OpenLDBSVREFWS
  {
    private $accessToken;

    private $trace;

    private $wsdl = '<?xml version="1.0" encoding="utf-8"?>
      <wsdl:definitions
        xmlns:wsdl="http://schemas.xmlsoap.org/wsdl/"
        xmlns:soap12="http://schemas.xmlsoap.org/wsdl/soap12/"
        xmlns:sv="http://thalesgroup.com/RTTI/2017-10-01/ldbsv/"
        targetNamespace="http://thalesgroup.com/RTTI/2017-10-01/ldbsv/">
        <wsdl:import
          namespace="http://thalesgroup.com/RTTI/2015-05-14/ldbsv_ref/"
          location="http://lite.realtime.nationalrail.co.uk/OpenLDBSVWS/rtti_2015-05-14_ldbsv_ref.wsdl"/>
        <wsdl:service name="ldbsv">
          <wsdl:port name="LDBSVRefServiceSoap12" binding="ref:LDBSVRefServiceSoap12">
            <soap12:address location="http://lite.realtime.nationalrail.co.uk/OpenLDBSVWS/ldbsvref.asmx"/>
          </wsdl:port>
        </wsdl:service>
      </wsdl:definitions>';

    function __construct($accessToken,$trace=FALSE)
    {
      $this->accessToken = $accessToken;

      $this->trace = $trace;

      $soapOptions = array("trace"=>$this->trace,"soap_version"=>SOAP_1_2,"features"=>SOAP_SINGLE_ELEMENT_ARRAYS);

      if (extension_loaded("zlib")) $soapOptions["compression"] = SOAP_COMPRESSION_ACCEPT|SOAP_COMPRESSION_GZIP;

      $this->soapClient = new SoapClient("data:text/plain;base64,".base64_encode($this->wsdl),$soapOptions);

      $soapVar = new SoapVar(array("ns2:TokenValue"=>$this->accessToken),SOAP_ENC_OBJECT);

      $soapHeader = new SoapHeader("http://thalesgroup.com/RTTI/2010-11-01/ldb/commontypes","AccessToken",$soapVar,FALSE);

      $this->soapClient->__setSoapHeaders($soapHeader);
    }

    private function call($method,$params)
    {
      try
      {
        $response = $this->soapClient->$method($params);
      }
      catch(SoapFault $soapFault)
      {
        if ($this->trace)
        {
          $traceOutput["soapFaultMessage"] = $soapFault->getMessage();

          $traceOutput["soapClientRequest"] = str_replace($this->accessToken,"",$this->soapClient->__getLastRequest());

          $traceOutput["soapClientResponse"] = $this->soapClient->__getLastResponse();

          print_r($traceOutput);
        }
      }

      return (isset($response)?$response:FALSE);
    }

    function GetReasonCode($reasonCode="")
    {
      $params = array();

      if ($reasonCode) $params["reasonCode"] = $reasonCode;

      return $this->call("GetReasonCode",$params);
    }

    function GetReasonCodeList()
    {
      $params = array();

      return $this->call("GetReasonCodeList",$params);
    }

    function GetSourceInstanceNames()
    {
      $params = array();

      return $this->call("GetSourceInstanceNames",$params);
    }

    function GetTOCList($currentVersion="")
    {
      $params = array();

      if ($currentVersion) $params["currentVersion"] = $currentVersion;

      return $this->call("GetTOCList",$params);
    }

    function GetStationList($currentVersion="")
    {
      $params = array();

      if ($currentVersion) $params["currentVersion"] = $currentVersion;

      return $this->call("GetStationList",$params);
    }
  }
?>