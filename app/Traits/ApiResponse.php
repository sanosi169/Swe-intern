<?php
namespace App\Traits;

use Illuminate\Http\JsonResponse;


trait ApiResponse
{

/**
     * 
     *
     * @param mixed $data
     * @param string|null $message
     * @param int $status
     * @return JsonResponse
     */
    public function apiresponse($data, $message = null, $status ){
        $array= ([
            'status' => $status,
            'message' => $message,
            'data' => $data
            ]);

            return response($array,$status );
    }

    





}