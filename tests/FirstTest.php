<?php

use Laravel\Lumen\Testing\DatabaseTransactions;
use Firebase\JWT\JWT;

class FirstTest extends TestCase
{
    public function testPing()
    {
        $this->get('/v1/ping');
        $this->assertEquals(json_decode($this->response->getContent()), 'pong');
    }

    public function testCross()
    {
        $this->get('/v1/ping');
        $this->assertNotEmpty($this->response->headers);
    }

    public function testJwt()
    {
        $this->get('/v1/jwt');
        $json = json_decode($this->response->getContent());

        $this->assertNotEmpty($json->jwt);

        $token = $decoded = JWT::decode($json->jwt, env('APP_KEY'), array('HS256'));
        $this->assertEquals($token, 'I work!');
    }

    public function testRepository()
    {
        /*
        $user = factory('App\User')->make(
            [
                'email' => 'cd_print@mail.ru'
            ]
        );
        */

        // Adding Relations To Models
        $user = factory('App\Models\User')
            ->create(
                [
                    'email' => 'cd_print@mail.ru'
                ]
            )
            ->each(function ($user) {
                $user->profile->save(factory('App\Models\UserProfile')->make());
            });

        var_dump($user);
    }
}
