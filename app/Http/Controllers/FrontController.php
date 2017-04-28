<?php

namespace App\Http\Controllers;

use App\Repository\BenefitsRepository;
use App\Repository\HeaderRepository;
use Laravel\Lumen\Routing\Controller;

class FrontController extends Controller
{
    public function index(BenefitsRepository $benefitsRepository, HeaderRepository $headerRepository)
    {
        $data = [
            'products' => [
                'title' => 'Шведские стенки для взрослых и детей'
            ],

            'reviews' => [
                'title' => 'А мы уже купили шведскую стенку!',
                'list' => [
                    [
                        'avatar' => '/front/005.jpg',
                        'name' => 'Лилия',
                        'text' => 'Спасибо Вам огромное за шведскую стенку! Сына от неё не оттащишь! Комплектация просто отличная! Заглушки болтов и перекладины с покрытием против скольжения. Качество чувствуется в мелочах! За такую цену это самый толковый и укомплектованный детский спортивный комплекс. Буду рекомендовать друзьям!',
                        'url' => 'https://vk.com/id32161717'
                    ],
                    [
                        'avatar' => '',
                        'name' => '',
                        'text' => '',
                        'url' => ''
                    ],
                ]
            ]
        ];

        // шапка сайта
        $data['header'] = $headerRepository->get()->toArray();


        //dd($data['header']);

        // преимущества
        $data['benefits']['list'] = [];
        $list = $benefitsRepository->getList();

        foreach ($list as $value) {
            $data['benefits']['list'][] = [
                'cover' => $value->getPath(),
                'title' => $value->title,
                'description' => $value->description,
            ];
        }

        return view('front.index', ['data' => $data]);
    }
}
