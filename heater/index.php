<?php
# Controls heater
define('HEATER_CLIENT_LOCATION', '/home/late/dev/heater/client.py');

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
    if($a == 'startHeater'){

      //Start heater
      shell_exec('python '.HEATER_CLIENT_LOCATION.' on');
      $response['status'] = 'OK';

    } else if($a == 'stopHeater'){

      //Stop heater
      shell_exec('python '.HEATER_CLIENT_LOCATION.' off');
      $response['status'] = 'OK';

    }

}

//If there's no response, do FAIL
if(count($response) === 0){
    $response['status'] = 'FAIL';
    $response['message'] = 'PARAMETER_ERROR';
}

die(json_encode($response));
