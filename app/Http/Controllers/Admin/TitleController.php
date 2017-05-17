<?php
namespace App\Http\Controllers\Admin;

use App\Models\Title;
use App\Repository\TitleRepository;
use Illuminate\Http\Request;
use Laravel\Lumen\Routing\Controller;

class TitleController extends Controller
{
    /**
     * @var TitleRepository
     */
    private $repository;

    public function __construct(TitleRepository $repository)
    {
        $this->repository = $repository;
    }

    public function index()
    {
        $list = $this->repository->getList();

        return view('admin.title.index', ['list'=> $list]);
    }

    public function update(Request $request)
    {
        $data = $request->all();
        $keys = Title::getKeys();

        foreach ($data as $key => $value) {
            if (isset($keys[$key])) {
                $this->repository->add($keys[$key], $key, trim($value));
            }
        }

        return redirect()->route('admin_title_index');
    }
}
