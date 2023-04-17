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

function requiredIf($var)
{
    return $var ? 'nullable' : 'required';
}

function getEnumValues(string $table, string $column): array
{
    $type = DB::select(DB::raw("SHOW COLUMNS FROM $table WHERE Field = '$column'"))[0]->Type;
    preg_match('/^enum\((.*)\)$/', $type, $matches);
    $values = [];
    foreach (explode(',', $matches[1]) as $value) {
        $values[trim($value, "'")] = trim($value, "'");
    }
    return $values;
}

