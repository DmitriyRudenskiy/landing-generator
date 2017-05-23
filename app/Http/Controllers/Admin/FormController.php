<?php
namespace App\Http\Controllers\Admin;

use App\Repository\FormRepository as Repository;
use Illuminate\Http\Request;
use Laravel\Lumen\Routing\Controller;

class FormController extends Controller
{
    /**
     * @var Repository
     */
    private $repository;

    public function __construct(Repository $repository)
    {
        $this->repository = $repository;
    }

    public function index()
    {
        $list = $this->repository->getAllList();

        // dd($list);

        return view('admin.form.index', ['list'=> $list]);
    }

    public function add()
    {
        return view('admin.form.add');
    }

    public function insert(Request $request)
    {
        $data = array_map(
            'trim',
            $request->only(
                [
                    'form_title',
                    'name_label',
                    'phone_label',
                    'name_placeholder',
                    'phone_placeholder',
                    'button_title'
                ]
            )
        );

        $model = $this->repository->add($data);

        if (!empty($model->id)) {
            return redirect()->route('admin_form_index');
        }

        throw new \RuntimeException();
    }

}
