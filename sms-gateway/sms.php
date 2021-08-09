<?php
const API_TOKEN = "simecsystem-ec8699b7-9228-487b-89fb-b2e3b7722f3e";
const SID = "SIMECSYSTEM";
const DOMAIN = "https://smsplus.sslwireless.com";

//Example:
//const API_TOKEN = "e97a0e5c-e058-4527-914a-e7aac4508ec6"; //put ssl provided api_token here
//const SID = "TESTSID"; // put ssl provided sid here
//const DOMAIN = "https://smsplus.sslwireless.com"; //api domain

// echo singleSms($msisdn, $messageBody, $csmsId);

function singleSms($msisdn, $messageBody, $csmsId)
{
    $params = [
        "api_token" => API_TOKEN,
        "sid" => SID,
        "msisdn" => $msisdn,
        "sms" => $messageBody,
        "csms_id" => $csmsId
    ];
    $url = trim(DOMAIN, '/')."/api/v3/send-sms";
    $params = json_encode($params);

    return callApi($url, $params);
}

function callApi($url, $params)
{
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
    curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        'Content-Type: application/json',
        'Content-Length: ' . strlen($params),
        'accept:application/json'
    ));

    $response = curl_exec($ch);

    curl_close($ch);

    return object_to_array($response);
}

function object_to_array($data)
{
    if (is_array($data) || is_object($data))
    {
        $result = array();
        foreach ($data as $key => $value)
        {
            $result[$key] = object_to_array($value);
        }
        return $result;
    }
    return $data;
}
