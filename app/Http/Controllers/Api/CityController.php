<?php

namespace App\Http\Controllers\Api;

use App\Repository\CityRepository;
use Laravel\Lumen\Routing\Controller;

class CityController extends Controller
{
    public function index(CityRepository $repository)
    {
        $cities = $repository->getList();

        return response()->json($cities);
    }
}
