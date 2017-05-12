<?php
namespace App\Http\Controllers\Admin;

use App\Models\Label;
use Illuminate\Http\Request;
use Laravel\Lumen\Routing\Controller;

class LabelController extends Controller
{
    /**
     * @var Label
     */
    private $repository;

    public function __construct(Label $repository)
    {
        $this->repository = $repository;
    }

    public function index()
    {
        $list = $this->repository
            ->orderBy('visible', 'desc')
            ->orderBy('priority', 'desc')
            ->get();

        return view('admin.label.index', ['list' => $list]);
    }

    public function edit($id)
    {
        $model = $this->repository->find($id);

        return view('admin.label.edit', ['model' => $model]);
    }

    public function update(Request $request)
    {
        $id = $request->get('id');

        $model = $this->repository->find($id);

        $data = array_map(
            'trim',
            $request->only(
                [
                    'priority',
                    'label',
                ]
            )
        );

        $model->update($data);

        return redirect()->route('admin_label_index');
    }


    public function hide($id)
    {
        $model = $this->repository->find($id);
        $model->visible = 0;
        $model->save();

        return redirect()->route('admin_label_index');
    }

    public function show($id)
    {
        $model = $this->repository->find($id);
        $model->visible = 1;
        $model->save();

        return redirect()->route('admin_label_index');
    }
}
