<?php
/**
 * [message return the api responses]
 * @param  boolean $status  [status true success false for failure]
 * @param  array   $data    [object will be sent]
 * @param  string  $message [message will be sent]
 * @param  integer  $code [for response code]
 * @return Response
 */

if(!function_exists('message')){
    function message($status = true, $data = [], $message = '', $code = 200)
    {
        return response()->json([
            'status' => $status,
            'data' => $data ?? [],
            'message' => $message,
            'code' => $code,
        ],$code);
    }
}

if(!function_exists('requiredIf')){
    function requiredIf($var)
    {
        return $var ? 'nullable' : 'required';
    }
}

if(!function_exists('getEnumValues')){
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
}

if(!function_exists('getPaginatedData')){
    function getPaginatedData($data){

        return [
            'current_page' => $data->currentPage(),
            'total' => $data->total(),
            'count' => $data->count(),
            'per_page' => $data->perPage(),
            'total_pages' => $data->lastPage(),
            'path' =>$data->path(),
            'next_page_url' =>$data->nextPageUrl(),
            'previous_page_url' =>$data->previousPageUrl()
        ];
    }
}

