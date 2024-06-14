<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ApiController extends Controller
{
    public function success($messager, $data = [])
    {
        return response()->json([
            'message' => $messager,
            'data' => $data,
        ]);
    }
    public function show_error($messager)
    {
        return response()->json([
            'message' => $messager,
            'data' => null
        ]);
    }
}
