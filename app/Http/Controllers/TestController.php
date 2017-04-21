<?php

namespace App\Http\Controllers;

use Laravel\Lumen\Routing\Controller;
use Firebase\JWT\JWT;

class TestController extends Controller
{
    public function ping()
    {
        return response()->json('pong');
    }

    public function jwt()
    {
        $token = 'I work!';

        $jwt = JWT::encode($token, env('APP_KEY'));

        return response()->json(compact('jwt'));
    }
}
