<?php
# Reads from Raspberry Pi one-wire interface. Define sensor below.
define('READER_LOCATION', '/home/late/dev/dhtreader/read.sh');

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
    if($a == 'getHumidity'){

        $raw_data = shell_exec('sudo '.READER_LOCATION);
        if($raw_data !== false && $raw_data !== ''){

          //Split lines
          $temp = explode("\n", $raw_data);
          if(isset($temp[1])){

            //Set response
            $data = $temp[1];
            $response['status'] = 'OK';
            $response['data'] = $data;

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
