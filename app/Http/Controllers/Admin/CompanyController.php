<?php
namespace App\Http\Controllers\Admin;

use App\Repository\CityRepository;
use App\Repository\CompanyRepository;
use App\Repository\PostRepository;
use App\Repository\UserRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Laravel\Lumen\Routing\Controller;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;


class CompanyController extends Controller
{
    const COUNT_ON_PAGE = 15;

    public function index(CompanyRepository $repository, Request $request)
    {
        $list = $repository->getList(self::COUNT_ON_PAGE);

        return view('admin.company.index', ['list' => $list]);
    }

    public function add(CityRepository $repository)
    {
        $cities = $repository->getList();

        return view('admin.company.add', ['cities' => $cities]);
    }

    public function insert(CompanyRepository $repository, Request $request)
    {
        $data = $request->only(['city_id', 'name', 'address', 'work_times', 'phone', 'site']);
        $company = $repository->create($data);

        return redirect()->route('admin_company_view', ['id' => $company->id]);
    }

    public function view($id, CompanyRepository $repository, CityRepository $cityRepository)
    {
        $company = $repository->find($id);
        $cities = $cityRepository->getList();
        
        return view(
            'admin.company.view',
            [
                'company' => $company,
                'cities' => $cities
            ]
        );
    }

    public function update(CompanyRepository $repository, Request $request)
    {
        $companyId = $request->get('company_id');
        $company = $repository->find($companyId);

        $data = $request->only(['city_id', 'name', 'address', 'work_times', 'phone', 'site']);


        // работаем с координатами
        if (!empty($data["address"]) && $company->address !== $data["address"]) {
            $this->prepare($data, $company->city->name);
        }

        // обновляем запись
        $repository->update($data, $companyId);

        return redirect()->route('admin_company_view', ['id' => $company]);
    }

    public function hide(UserRepository $repository, Request $request)
    {
        // $list = $repository->getList(self::COUNT_ON_PAGE);
        $users = $repository->all();

        return view('admin.company.add', ['users' => $users]);
    }

    /**
     * Установка координат в массиве
     *
     * @param array $data
     */
    protected function prepare(&$data, $city)
    {
        try {
            $response = $this->getAddress($city . ', '. $data["address"]);

            if ($response !== null) {
                $tmp = explode(', ', $response->getAddress());
                unset($tmp[0]);
                unset($tmp[1]);

                $address = trim(implode(', ', $tmp));

                $data["address"] = $address;
                $data["latitude"] = $response->getLatitude();
                $data["longitude"] = $response->getLongitude();
            } else {
                $data["latitude"] = null;
                $data["longitude"] = null;
            }
        } catch (\Exception $e) {

        }
    }

    /**
     * @param string $address
     * @return null|\Yandex\Geo\GeoObject
     * @throws \Yandex\Geo\Exception
     * @throws \Yandex\Geo\Exception\CurlError
     * @throws \Yandex\Geo\Exception\ServerError
     */
    protected function getAddress($address)
    {
        return (new \Yandex\Geo\Api())
            ->setQuery($address)
            ->setLimit(1)
            ->setLang(\Yandex\Geo\Api::LANG_RU)
            ->load()
            ->getResponse()
            ->getFirst();
    }

}
