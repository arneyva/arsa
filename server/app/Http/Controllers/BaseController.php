<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BaseController extends Controller
{
    public function successResponse($data = [], $msg = 'success', $code = null)
    {
        $code = $code ?? 200;

        return response()->json([
            'success' => true,
            'data' => (object) $data,
            'message' => $msg,
        ], $code);
    }

    // respon ketika gagal
    public function errorResponse($msg = 'failed', $code = 400)
    {
        return response()->json([
            'success' => false,
            'data' => (object) [],
            'message' => $msg,
        ], $code);
    }
}
