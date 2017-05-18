<?php

namespace App\Http\Controllers;

use App\Service\TemplateBuilder;
use Illuminate\Http\Request;
use Mailgun\Mailgun;
use Laravel\Lumen\Routing\Controller;

class FrontController extends Controller
{
    public function index(TemplateBuilder $builder)
    {
        $data = $builder->init()->get();

        // dd($data->getHeader());

        return view('front.index', ['data' => $data]);
    }

    public function mail(Request $request)
    {
        $data = $request->only('name', 'phone');

        $apiKey = "key-3b880a64e4179faf1e4dbab02d03deed";
        $domain = "atorgi.pro";
        $mailList = [
            'ms@autodeviz.info',
            'partner@atorgi.ru',
            'dmitriy.rudenskiy@gmail.com'
        ];

        $mgClient = new Mailgun($apiKey);

        foreach ($mailList as $value) {
            $mgClient->sendMessage($domain, array(
                'from'    => 'Что тут написать? <mailgun@atorgi.pro>',
                'to'      => $value,
                'subject' => 'Пиши текст!',
                'text'    => 'Продумай шаблон: данные ' .json_encode($data)
            ));
        }

        return response('Ok');
    }
}
