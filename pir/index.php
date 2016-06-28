<?php
define('STATUS_FILE_LOCATION', '/home/late/dev/pir/status/status.txt');

//Set content type
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');

//Response array and shorthand for request
$response = array();
$r = $_REQUEST;

//If a parameter is set
if(isset($r) && isset($r['a'])){
    $a = $r['a'];

    if($a == 'getStatus') {

      $heater = array();

      $status = file_get_contents(STATUS_FILE_LOCATION);

      $response['status'] = 'OK';
      $response['timestamp'] = $status;
      if((int)$status == 0){
        $response['time'] = "the beginning of time";
      } else {
        $response['time'] = date('H:i \o\n l', (int)$status);
      }

    }

}

//If there's no response, do FAIL
if(count($response) === 0){
    $response['status'] = 'FAIL';
    $response['message'] = 'PARAMETER_ERROR';
}

die(json_encode($response));
