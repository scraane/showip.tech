<?php
#require 'vendor/autoload.php';
#use GeoIp2\Database\Reader;

$userIP = getRealIP();
echo $userIP;

        $visitor_details = visitor_country($userIP); // Output Country name [Ex: United States]
        $country = $visitor_details['countryName'];

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

        function visitor_country($remote)
        {
            $client  = @$_SERVER['HTTP_CLIENT_IP'];
            $forward = @$_SERVER['HTTP_X_FORWARDED_FOR'];
            #$remote  = $_SERVER['REMOTE_ADDR'];
            $result  = "Unknown";
            if(filter_var($client, FILTER_VALIDATE_IP))
            {
                $ip = $client;
            }
            elseif(filter_var($forward, FILTER_VALIDATE_IP))
            {
                $ip = $forward;
            }
            else
            {
                $ip = $remote;
            }

            $ip_data = @json_decode(file_get_contents("http://www.geoplugin.net/json.gp?ip=" . $ip));

            if($ip_data && $ip_data->geoplugin_countryName != null)
            {
                $result = array('ip' => $ip,
                                'continentCode' => $ip_data->geoplugin_continentCode,
                                'countryCode' => $ip_data->geoplugin_countryCode,
                                'countryName' => $ip_data->geoplugin_countryName,
                                );
            }
            return $result;
        }



?>
