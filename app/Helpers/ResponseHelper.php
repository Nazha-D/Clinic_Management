<?php
namespace App\Helpers;

Class  ResponseHelper{

 public static function success($data = [], $message = 'Success', $httpCode = 200)
    {
        return response()->json([
            'success' => true,
            'message' => $message,
            'data' => $data,
            'timestamp' => now(),
        ], $httpCode);
    }

    public static function error($message = 'Error', $httpCode = 500, $errors = null)
    {
        $response = [
            'success' => false,
            'message' => $message,
            'timestamp' => now(),
        ];

        if ($errors) {
            $response['errors'] = $errors;
        }

        return response()->json($response, $httpCode);
    }
}