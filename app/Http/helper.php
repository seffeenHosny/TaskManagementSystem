<?php
/**
 * [message return the api responses]
 * @param  boolean $status  [status true success false for failure]
 * @param  array   $data    [object will be sent]
 * @param  string  $message [message will be sent]
 * @param  integer  $code [for response code]
 * @return Response
 */
function message($status = true, $data = [], $message = '', $code = 200)
{
    return response()->json([
        'status' => $status,
        'data' => $data ?? [],
        'message' => $message,
        'code' => $code,
    ],$code);
}

function check_required($status){
    if($status){
        return 'nullable';
    }
    
    return 'required';

}

