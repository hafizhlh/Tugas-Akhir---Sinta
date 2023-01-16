<?php

function is_uuid($uuid) {
    $re = '/^[a-z0-9\-]{36}$/i';
    preg_match_all($re, $uuid, $matches, PREG_SET_ORDER, 0);
    if(!$matches){
        $response = responseFail(trans('messages.check_uuid-fail'),['uuid'=> $uuid]);
        $return = response()->json($response, 500, [], JSON_PRETTY_PRINT);
        $return->throwResponse();
    }
}
