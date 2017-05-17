<?php

namespace App\Http\Controllers;

use App\Service\TemplateBuilder;
use Laravel\Lumen\Routing\Controller;

class FrontController extends Controller
{
    public function index(TemplateBuilder $builder)
    {
        $data = $builder->init()->get();

        // dd($data->getHeader());

        return view('front.index', ['data' => $data]);
    }
}
