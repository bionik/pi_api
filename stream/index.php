<?php
# Plays a stream

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
    if($a == 'playStream' && isset($r['stream'])){
      $temp = explode(' ', $r['stream']);
      $stream = escapeshellcmd($temp[0]);

      //Kill mplayer(s)
      shell_exec('sudo -u pi killall -u pi mplayer');

      //Play stream
      shell_exec('sudo -u pi nohup mplayer -slave > /dev/null 2>&1 &');

      $response['status'] = 'OK';

    } else if($a == 'stopStream'){
      shell_exec('sudo -u pi killall -u pi mplayer');
      $response['status'] = 'OK';

    }

}

//If there's no response, do FAIL
if(count($response) === 0){
    $response['status'] = 'FAIL';
    $response['message'] = 'PARAMETER_ERROR';
}

die(json_encode($response));
