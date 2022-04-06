<?php
require_once("geoip2.phar");
use GeoIp2\Database\Reader;
// City DB





$userIP = getRealIP();
$locationIP = getLocationData($userIP);
echo $userIP.'<br/>';

function getRealIP() {  
    if (!empty($_SERVER['HTTP_CLIENT_IP']))   
    {
        $userIP = $_SERVER['HTTP_CLIENT_IP'];
    }
    //whether ip is from proxy
    elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))  
    {
        $userIP = $_SERVER['HTTP_X_FORWARDED_FOR'];
    }
    //whether ip is from remote address
    else
    {
         $userIP = $_SERVER['REMOTE_ADDR'];
    }
     return $userIP;  
}  


function getLocationData($userIP) {
    $reader = new Reader('GeoLite2-City.mmdb');
    $record = $reader->city($userIP);
    print($record->country->isoCode . "\n");
    print($record->country->name . "\n");
    print($record->country->names['zh-CN'] . "\n");
    print($record->mostSpecificSubdivision->name . "\n");
    print($record->mostSpecificSubdivision->isoCode . "\n");
    print($record->city->name . "\n");
    print($record->postal->code . "\n");
    print($record->location->latitude . "\n");
    print($record->location->longitude . "\n");
    
    if(!empty($locationIP)){ 
        return $locationIP;
    }else{ 
        return ('IP data is not found!'); 
    }
}
 
?>