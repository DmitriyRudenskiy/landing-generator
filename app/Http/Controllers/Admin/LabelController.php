<?php
namespace App\Http\Controllers\Admin;

use App\Models\PrefixInterface;
use App\Models\Product;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Http\Request;
use App\Repository\ProductRepository;
use Laravel\Lumen\Routing\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use Imagine\Gd\Imagine;

class LabelController extends Controller
{
    /**
     * @var ProductRepository
     */
    private $repository;

    public function __construct(ProductRepository $repository)
    {
        $this->repository = $repository;
    }

    public function index()
    {
        $list = $this->repository->all();

        return view('admin.product.index', ['list' => $list]);
    }

    public function add()
    {
        return view('admin.product.add', ['model' => []]);
    }

    public function edit($id)
    {
        $model = $this->repository->find($id);

        return view('admin.product.edit', ['model' => $model]);
    }

    public function insert(Request $request)
    {
        $data = array_map(
            'trim',
            $request->only(
                [
                    'equipment',
                    'engine',
                    'power',
                    'transmission',
                    'drive_unit',
                    'body_type',
                    'colour'
                ]
            )
        );

        $model = $this->repository->add($data);

        if ($model instanceof Product && $model->id > 0) {
            return redirect()->route('admin_product_edit', ['id' => $model->id]);
        }

        throw new \RuntimeException();
    }

    public function update(Request $request)
    {
        $id = $request->get('id');

        $data = array_map(
            'trim',
            $request->only(
                [
                    'priority',
                    'equipment',
                    'engine',
                    'power',
                    'transmission',
                    'drive_unit',
                    'body_type',
                    'colour'
                ]
            )
        );

        $this->repository->update($data, $id);

        return redirect()->route('admin_product_index');
    }


    public function hide($id)
    {
        $model = $this->repository->find($id);
        $model->visible = 0;
        $model->save();

        return redirect()->route('admin_product_index');
    }

    public function show($id)
    {
        $model = $this->repository->find($id);
        $model->visible = 1;
        $model->save();

        return redirect()->route('admin_product_index');
    }
}
