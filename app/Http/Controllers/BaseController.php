<?php

namespace App\Http\Controllers;

use Illuminate\Http\Exceptions\HttpResponseException;

class BaseController extends Controller
{
    
     /**
     * success response method.
     *
     * @return \Illuminate\Http\Response
     */
    public function sendSuccess($message, $status = 200, $data = null)
    {
        return response()->json(['message' => $message, 'data' => $data], $status);
    }


    /**
     * return error response.
     *
     * @return \Illuminate\Http\Response
     */
    public function sendError($message, $code = 404, $errors = null)
    {
        throw new HttpResponseException(response()->json(['message' => $message, 'errors' => $errors], $code));
    }
}
