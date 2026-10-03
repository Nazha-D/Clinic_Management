<?php

namespace App\Traits;

trait ResponseTrait
{
    /**
     * Success response
     */
    public function successResponse(
        $data = [],
        $message = 'Success',
        $httpCode = 200
    )
    {
        return response()->json([
            'success' => true,
            'message' => $message,
            'data' => $data,
            'timestamp' => now(),
        ], $httpCode);
    }

    /**
     * Error response
     */
    public function errorResponse(
        $message = 'Error',
        $httpCode = 500,
        $errors = null
    )
    {
        $response = [
            'success' => false,
            'message' => $message,
            'timestamp' => now(),
        ];

        // validation errors
        if ($errors) {
            $response['errors'] = $errors;
        }

        return response()->json($response, $httpCode);
    }

    /**
     * Validation error response
     */
    public function validationErrorResponse($errors)
    {
        return $this->errorResponse(
            'Validation failed',
            422,
            $errors
        );
    }

    /**
     * Not found response
     */
    public function notFoundResponse($message = 'Resource not found')
    {
        return $this->errorResponse($message, 404);
    }

    /**
     * Unauthorized response
     */
    public function unauthorizedResponse($message = 'Unauthorized')
    {
        return $this->errorResponse($message, 401);
    }

    /**
     * Forbidden response
     */
    public function forbiddenResponse($message = 'Forbidden')
    {
        return $this->errorResponse($message, 403);
    }
}