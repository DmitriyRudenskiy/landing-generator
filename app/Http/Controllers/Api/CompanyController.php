<?php

namespace App\Http\Controllers\Api;

use App\Repository\CityRepository;
use App\Repository\CompanyRepository;
use Laravel\Lumen\Routing\Controller;

class CompanyController extends Controller
{
    const SIZE_MINI = '120_90_';

    public function index(CompanyRepository $repository, $cityId)
    {
        $list = $repository->findWhere(['city_id' => $cityId]);
        $companies = [];

        foreach ($list as $value) {
            $image = $value->images()->first();


            $companies[] = [
                "id" => $value->id,
                "name" => $value->name,
                "address" => $value->address,
                "work_times" => $value->work_times,
                "cover" => $image->pathUrl(self::SIZE_MINI)
            ];
        }

        return response()->json($companies);
    }

    /**
     * Для карты
     *
     * @param CompanyRepository $repository
     * @param $cityId
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function map(CompanyRepository $repository, $cityId)
    {
        $list = $repository->findWhere(['city_id' => $cityId]);
        $companies = [];

        foreach ($list as $value) {
            $image = $value->images()->first();


            $companies[] = [
                "id" => $value->id,
                "name" => $value->name,
                "address" => $value->address,
                "work_times" => $value->work_times,
                "cover" => $image->pathUrl(self::SIZE_MINI)
            ];
        }

        return response()->json($companies);
    }

    public function view(CompanyRepository $repository, $id)
    {
        $company = $repository->find($id);
        $company->images();

        return response()->json($company);
    }
}
