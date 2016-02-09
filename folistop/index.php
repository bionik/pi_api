<?php
# This API uses the Föli mobile bus stop page, which is parsed with phpQuery
define('API_LOCATION', 'http://data.foli.fi/siri/sm/');

//Set content type
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');

require_once('phpQuery-onefile.php');

//Response array and shorthand for request
$response = array();
$r = $_REQUEST;

$stops = json_decode(file_get_contents('stops.json'), true);

//If a parameter is set
if(isset($r) && isset($r['a'])){
    $a = $r['a'];

    //readPin action
    if($a == 'getStop' && isset($r['stop'])){
        $stop = $r['stop'];

        //Execute request
        $result = json_decode(file_get_contents(API_LOCATION.$stop.'/pretty'), true);

        $data = array();

        if($result !== false && $result !== NULL){

            $stop_name = $stops[$stop]['stop_name'];

            foreach ($result['result'] as $row) {
                $temp = array();

                $temp['time'] = date('H:i', (int)$row['aimedarrivaltime']);
                $temp['line'] = $row['lineref'];
                $temp['dest'] = $row['destinationdisplay'];

                $data[] = $temp;
            }

        }

        if(count($data) > 0){
            //Set response
            $response['status'] = 'OK';
            $response['data'] = $data;
            $response['stop'] = $stop_name;
        } else {
            $response['status'] = 'FAIL';
            $response['message'] = 'FETCH_FAILED';
        }

    }

}

//If there's no response, do FAIL
if(count($response) === 0){
    $response['status'] = 'FAIL';
    $response['message'] = 'PARAMETER_ERROR';
}

die(json_encode($response));
