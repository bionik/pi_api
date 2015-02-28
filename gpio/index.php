<?php
# This API uses the WiringPi GPIO interface. Info here: http://wiringpi.com/the-gpio-utility/
# The line below points to the gpio utility installed together with WiringPi.
define('GPIO_LOCATION', '/usr/local/bin/gpio');

//Set content type
header('Content-Type: application/json');

//Response array and shorthand for request
$response = array();
$r = $_REQUEST;

//If a parameter is set
if(isset($r) && isset($r['a'])){
    $a = $r['a'];

    //readPin action 
    if($a == 'readPin' && isset($r['pin'])){
        $pin = (int)$r['pin'];

        //Execute gpio read
        exec(GPIO_LOCATION.' read '.$pin, $data, $retval);

        //Set response
        if($retval === 0){
            $response['status'] = 'OK';
            $response['data'] = $data[0];
        }

    }

}

//If there's no response, do FAIL
if(count($response) === 0){
    $response['status'] = 'FAIL';
    $response['message'] = 'PARAMETER_ERROR';
}

die(json_encode($response));
