<?php
use Illuminate\Support\Arr;

function responseSuccess($message, $data = array())
{
    $response = [
        'success' => true,
        'status' => 'success',
        'message' => $message,
    ];

    if (Arr::exists($data, 'draw')) {
        $response = array_merge($response, $data);
    }else{
        $response['data'] = $data;
    }

    return $response;
}

function responseFail($message, $data = array())
{
    $response = [
        'success' => false,
        'status' => 'fails',
        'message' => $message,
        'messages' => $data
    ];

    return $response;
}
