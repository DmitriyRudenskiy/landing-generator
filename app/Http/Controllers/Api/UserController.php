<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Laravel\Lumen\Routing\Controller;

class UserController extends Controller
{
    public function login(Request $request)
    {
        $login = strtolower(trim($request->get('login')));
        $password = trim($request->get('password'));
        
        return response()->json([$login, $password]);
    }
}
