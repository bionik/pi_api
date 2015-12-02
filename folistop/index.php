<?php
# This API uses the Föli mobile bus stop page, which is parsed with phpQuery
define('API_LOCATION', 'http://turku.seasam.com/nettinaytto/web?view=mobile&command=quicksearch');

//Set content type
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');

require_once('phpQuery-onefile.php');

//Response array and shorthand for request
$response = array();
$r = $_REQUEST;

//If a parameter is set
if(isset($r) && isset($r['a'])){
    $a = $r['a'];

    //readPin action
    if($a == 'getStop' && isset($r['stop'])){
        $stop = $r['stop'];

        //Execute request
        $result = file_get_contents(API_LOCATION.'&stopid='.$stop);

        $doc = phpQuery::newDocument($result);
        phpQuery::selectDocument($doc);

        $data = array();
        $i = 0;

        $stop_name = trim(str_replace(array(chr(194).chr(160), "&nbsp;"), '', strip_tags(pq('#stopname')->html())));

        foreach(pq('table.deptable tr') as $row) {

            //Skip first
            if($i == 0) {
                $i++;
                continue;
            }

            $temp = array();
            $temp['time'] = pq($row)->find('.timecol')->html();
            $temp['line'] = pq($row)->find('.linecol')->html();
            $temp['dest'] = pq($row)->find('.destcol')->html();

            if($temp['time'] !== '' && $temp['line'] !== '' && $temp['dest'] !== ''){
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
