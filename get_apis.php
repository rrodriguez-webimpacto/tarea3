<?php

$location_iq_key = 'pk.95a74013a5899c1d168cecddca563108';
$open_weather_map_key = '41c2577638a54991419c3ee772dd9113';

if(isset($_GET['locationIQ']) && isset($_GET['latitude']) && isset($_GET['longitude'])){

    $key = $location_iq_key;
    $latitude = $_GET['latitude'];
    $longitude = $_GET['longitude'];

    $full_url = 'https://eu1.locationiq.com/v1/reverse.php?key=' . $key . '&lat=' . $latitude . '&lon=' . $longitude . '&format=json';

    //GET a la API
    $file = file_get_contents($full_url);
    $json_file = json_decode($file);


    // Información en: https://locationiq.com/docs-html/index.html#address-details
    function getAddress(){
        global $json_file;

        if($json_file->address->town){
            return $json_file->address->town;

        }elseif($json_file->address->state){
            return $json_file->address->state;

        }elseif($json_file->address->village){
            return $json_file->address->village;

        }elseif($json_file->address->locality){
            return $json_file->address->locality;

        }elseif($json_file->address->borough){
            return $json_file->address->borough;

        }elseif($json_file->address->city_district){
            return $json_file->address->city_district;

        }elseif($json_file->address->quarter){
            return $json_file->address->quarter;

        }elseif($json_file->address->hamlet){
            return $json_file->address->hamlet;

        }elseif($json_file->address->neighbourhood){
            return $json_file->address->neighbourhood;

        }elseif($json_file->address->municipality){
            return $json_file->address->municipality;
        }
    }

    $adress;
    $address = getAddress();


    if(strlen(str_replace(" ", "", $address)) < strlen($address)){
        $address = str_replace(" ", "+", $address);
    }

    die($address);

}elseif(isset($_GET['openWeather']) && isset($_GET['response'])){

    $key = $open_weather_map_key;
    $city_name = $_GET['response'];

    $full_url = 'http://api.openweathermap.org/data/2.5/weather?q=' . $city_name . '&appid=' . $key;

    //GET a la API
    $file = file_get_contents($full_url);
    $json_file = json_decode($file);


    $json_array = json_encode(array(['name'=>$json_file->name, 'temperature'=>$json_file->main->temp, 'country'=>$json_file->sys->country, 'humidity'=>$json_file->main->humidity]));

    die($json_array);
}

?>