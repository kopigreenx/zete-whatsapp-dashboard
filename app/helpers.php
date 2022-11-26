<?php
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Cache;

/**
* @method static sessionStatus
* @method static addSession
* @method static removeSession
**/


if(! function_exists('sessionStatus')){
    function sessionStatus($id){
        $base_url = config('app.wa_api_url');
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => $base_url . "/sessions/status/" . $id,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
        ));
        $result = curl_exec($curl);
        curl_close($curl);

        return json_decode($result);
    }
}

if(! function_exists('addSession')){
    function addSession($id, $isLegacy){
        $base_url = config('app.wa_api_url');
        $curl = curl_init();
        // new post
        $data = array(
            'id' => $id,
            'isLegacy' => $isLegacy
        );
        curl_setopt_array($curl, array(
            CURLOPT_URL => $base_url . "/sessions/add",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => json_encode($data),
            CURLOPT_HTTPHEADER => array(
                "Content-Type: application/json"
            ),
        ));
        $result = curl_exec($curl);
        curl_close($curl);

        return json_decode($result);
    }
}

if(! function_exists('removeSession')){
    function removeSession($id){
        $base_url = config('app.wa_api_url');
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => $base_url . "/sessions/delete/" . $id,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "DELETE",
        ));
        $result = curl_exec($curl);
        curl_close($curl);
        return json_decode($result);
    }
}