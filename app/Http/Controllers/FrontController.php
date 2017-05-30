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

        // dd($data->getForm()['modal']);

        return view('front.index', ['data' => $data]);
    }

    public function products(TemplateBuilder $builder)
    {
        $data = $builder->init()->get();

        return view('front.products', ['data' => $data]);
    }

    public function call(TemplateBuilder $builder)
    {
        $data = $builder->init()->get();

        return view('front.call', ['data' => $data]);
    }

    public function mail(Request $request)
    {
        $name = $request->get('name');
        $phone = $request->get('phone');

        $name = mb_substr($name, 0, 255);
        $phone = preg_replace('/[^0-9]/', '', $phone);

        if (strlen($phone) !== 10 && strlen($phone) !== 11) {
            return response('Ok');
        }

        $apiKey = "key-3b880a64e4179faf1e4dbab02d03deed";
        $domain = "atorgi.pro";

        /*
        $mailList = [
            'ms@autodeviz.info',
            'partner@atorgi.ru',
            'dmitriy.rudenskiy@gmail.com'
        ];
        */

        $mailList = [
            'atorgitender1@atorgi.ru'
        ];

        $body = sprintf(
            "Заявка на просчёт\n\tИмя: %s\n\tТелефон: %s",
            $name,
            $phone
        );


        $mgClient = new Mailgun($apiKey);

        foreach ($mailList as $value) {
            $mgClient->sendMessage($domain, array(
                'from'    => 'Почтовый агент <mailgun@atorgi.pro>',
                'to'      => $value,
                'subject' => '[' . $request->getHost() . '] Заявка с сайта',
                'text'    => $body
            ));
        }

        return response('Ok');
    }
}
