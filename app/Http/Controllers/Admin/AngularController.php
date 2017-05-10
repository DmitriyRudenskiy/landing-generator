<?php
namespace App\Http\Controllers\Admin;

use App\Service\TemplateBuilder;
use Laravel\Lumen\Routing\Controller;

class AngularController extends Controller
{
    public function index(TemplateBuilder $builder)
    {
        $data = $builder->init()->get();
        
        return view('front.index', ['data' => $data]);
    }
}
