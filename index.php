<?php
$userIP = getRealIP();
$locationIP = getLocationData($userIP);
echo $userIP;

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
    // IP address 
    #$userIP = '162.222.198.75'; 
    
    // API end URL 
    $apiURL = 'https://freegeoip.app/json/'.$userIP; 
    
    // Create a new cURL resource with URL 
    $ch = curl_init($apiURL); 
    
    // Return response instead of outputting 
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); 
    
    // Execute API request 
    $apiResponse = curl_exec($ch); 
    
    // Close cURL resource 
    curl_close($ch); 
    
    // Retrieve IP data from API response 
    $locationIP = json_decode($apiResponse, true); 
    
    if(!empty($locationIP)){ 
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
        return $locationIP;
    }else{ 
        return ('IP data is not found!'); 
    }
}
 
?>