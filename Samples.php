<?php

function request_post($url = '', $post_data = array(), $session_id = null) {
    $json_data = json_encode($post_data);

    $ch = curl_init($url);

    if($session_id)
        $headers = array("Content-type: application/json","Accept: application/json","X-MSTR-AuthToken: ".$session_id);
    else
        $headers = array("Content-type: application/json","Accept: application/json");

    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $json_data);

    $data = curl_exec($ch);
    curl_close($ch);

    return $data;
}

function request_get($url = '', $post_data = array(), $session_id = null) {
    $json_data = json_encode($post_data);

    $ch = curl_init($url);

    if($session_id)
        $headers = array("Content-type: application/json","Accept: application/json","X-MSTR-AuthToken: ".$session_id);
    else
        $headers = array("Content-type: application/json","Accept: application/json");

    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

    $data = curl_exec($ch);
    curl_close($ch);

    return $data;
}

function request_delete($url = '', $post_data = array(), $session_id = null) {
    $json_data = json_encode($post_data);

    $ch = curl_init($url);

    if($session_id)
        $headers = array("Content-type: application/json","Accept: application/json","X-MSTR-AuthToken: ".$session_id);
    else
        $headers = array("Content-type: application/json","Accept: application/json");

    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");
    curl_setopt($ch, CURLOPT_POSTFIELDS, $json_data);

    $data = curl_exec($ch);
    curl_close($ch);

    return $data;
}

function create_session($login,$password) {
    global $api_base;
    $url = $api_base.'sessions';
    $post_data['server']       = 'server_name';
    $post_data['login']      = $login;
    $post_data['password'] = $password;
    $post_data['project']    = 'MicroStrategy Tutorial';
    $post_data['authMode']    = 1;
    $post_data['locale']    = 'en';
    $post_data['flags']    = 0;
    $res = request_post($url, $post_data);
    print_r($res);
}

function delete_object($object_id,$sessionid){
    global $api_base;
    $object_type = 8;
    $url = $api_base.'objects/'.$object_id.'?type='.$object_type;
    $res = request_delete($url, null,$sessionid);
    print_r($res);
}

function create_folder($token,$userid,$linkid,$session_id){

    global $api_base;
    $url = $api_base.'folders';
    $post_data['name'] = $userid;
    $post_data['description'] = $token;
    $post_data['parent'] = $linkid;
    $res = request_post($url, $post_data,$session_id);
    print_r($res);

}

function execute_dashboard($object_id,$session_id){
    global $api_base;
    $url = $api_base.'dashboards/'.$object_id;
    $post_data = null;
    $res = request_get($url, $post_data,$session_id);
    print_r($res);
}

$api_base = 'http://localhost:8085/api/';
$sessionid = 'D5A19434A057C2F1F811C3ABD5A1D909SERVER-X7:1033';

// Sample 1: Create I-Server session
// Method: POST
// Endpoint: /api/sessions
create_session('administrator','');

// Sample 2: Create a folder under shared folder
// Method: POST
// Endpoint: /api/folders
create_folder('description','folder_name','D3C7D461F69C4610AA6BAA5EF51F4125',$sessionid);

// Sample 3: delete an object
// Method: DELETE
// Endpoint: /api/objects/{id}
delete_object('DEDA32E64D0529A17A2257A7BB8FE154',$sessionid);


// Sample 4: Export dashboard
// Method: GET
// Endpoint: /api/dashboards/{id}
execute_dashboard('233AE5EF48F48E84B4626D8E0E8806DE',$sessionid);


?>
