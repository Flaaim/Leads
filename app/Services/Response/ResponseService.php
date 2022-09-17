<?php 

namespace App\Services\Response;

class ResponseService {
    public static function ResponseParams($status, $errors, $data){
        return [
            'status' => $status,
            'errors' => (object) $errors,
            'date' => (object) $data,
        ];
    }

    public static function sendJsonResponse($status, $code = 200, $errors = [], $data = []){
        return response()->json(self::ResponseParams($status, $errors, $data), $code);
    }
}