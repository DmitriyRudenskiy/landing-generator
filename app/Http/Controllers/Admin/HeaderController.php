<?php
namespace App\Http\Controllers\Admin;

use App\Repository\HeaderRepository;
use Laravel\Lumen\Routing\Controller;

class HeaderController extends Controller
{
    const PREFIX_BENEFITS = 'header';

    /**
     * @var HeaderRepository
     */
    private $repository;

    public function __construct(HeaderRepository $repository)
    {
        $this->repository = $repository;
    }

    public function index()
    {
        $list = $this->repository->all();

        return view('admin.header.index', ['list' => $list]);
    }

    public function add()
    {
        return view('admin.header.index');
    }

    public function edit()
    {
        return view('admin.header.index');
    }

    public function insert()
    {

    }

    public function update()
    {

    }

    public function remove()
    {

    }
}
