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
        if (empty(env('MAILGUN_API_KEY')) || empty(env('MAILGUN_DOMAIN'))) {
            throw new \RuntimeException();
        }

        $name = $request->get('name');
        $phone = $request->get('phone');

        $name = mb_substr($name, 0, 255);
        $phone = preg_replace('/[^0-9]/', '', $phone);

        if (strlen($phone) !== 10 && strlen($phone) !== 11) {
            return response('Ok');
        }

        $apiKey = env('MAILGUN_API_KEY');
        $domain = env('MAILGUN_DOMAIN');

        $mailList = [
            'klub15@inbox.ru',
            'ms@autodeviz.info',
            'partner@atorgi.ru',
            'dmitriy.rudenskiy@gmail.com'
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
