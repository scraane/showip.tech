<?phprequire_once("geoip2.phar");
use GeoIp2\Database\Reader;
// City DB
$reader = new Reader('GeoLite2-City.mmdb');
$record = $reader->city($_SERVER['REMOTE_ADDR']);



$userIP = getRealIP();
$locationIP = getLocationData($userIP);
echo $userIP.'<br/>';
$country_code = $locationIP['country_code']; 
$country_name = $locationIP['country_name']; 
$region_code = $locationIP['region_code']; 
$region_name = $locationIP['region_name']; 
$city = $locationIP['city']; 
$zip_code = $locationIP['zip_code']; 
$latitude = $locationIP['latitude']; 
$longitude = $locationIP['longitude']; 
$time_zone = $locationIP['time_zone']; 

echo 'Country Name: '.$country_name.'<br/>'; 
echo 'Country Code: '.$country_code.'<br/>'; 
echo 'Region Code: '.$region_code.'<br/>'; 
echo 'Region Name: '.$region_name.'<br/>'; 
echo 'City: '.$city.'<br/>'; 
echo 'Zipcode: '.$zip_code.'<br/>'; 
echo 'Latitude: '.$latitude.'<br/>'; 
echo 'Longitude: '.$longitude.'<br/>'; 
echo 'Time Zone: '.$time_zone;

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