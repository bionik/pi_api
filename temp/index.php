<?php
# Reads from Raspberry Pi one-wire interface. Define sensor below.
define('DS18B20_LOCATION', '/sys/bus/w1/devices/10-000800ee70d8/w1_slave');

//Set content type
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');

//Response array and shorthand for request
$response = array();
$r = $_REQUEST;

//If a parameter is set
if(isset($r) && isset($r['a'])){
    $a = $r['a'];

    //getTemp action
    if($a == 'getTemp'){
        $raw_data = file_get_contents(DS18B20_LOCATION);

        if($raw_data !== false && $raw_data !== ''){

          //Split lines
          $temp = explode("\n", $raw_data);
          if(isset($temp[1])){

            //Read temp, if it exists in the raw data
            $temp = explode("t=", $temp[1]);

            if(isset($temp[1])){
                //Set response
               $data = $temp[1]/1000;
               $response['status'] = 'OK';
               $response['data'] = $data;

            }
          }
        }

    }

}

//If there's no response, do FAIL
if(count($response) === 0){
    $response['status'] = 'FAIL';
    $response['message'] = 'PARAMETER_ERROR';
}

die(json_encode($response));
