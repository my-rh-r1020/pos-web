<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;

class BaseResponseController extends Controller
{
    /**
     * Success response method
     */
    public function sendResponse($result, $message)
    {
        $response = [
            'success' => true, 'data' => $result, 'message' => $message
        ];

        return response()->json($response, 200);
    }

    /**
     * Error response method
     */
    public function sendError($error, $errorMessage = [], $code = 404)
    {
        $response = [
            'success' => false, 'message' => $error
        ];

        if (!empty($errorMessage)) {
            $response['data'] = $errorMessage;
        }

        return response()->json($response, $code);
    }
}
