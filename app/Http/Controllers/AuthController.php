<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function create()
    {
        return view('auth.signin');
    }

    public function registration(Request $request)
    {
        $validated = $request->validate([
            'name'     => 'required|string|min:2|max:100',
            'email'    => 'required|email|max:150',
            'password' => 'required|string|min:8|max:100',
        ]);

        return response()->json([
            'status' => 'ok',
            'data'   => $validated,
        ], 200, [], JSON_UNESCAPED_UNICODE);
    }
}
