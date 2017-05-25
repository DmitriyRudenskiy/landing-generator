<?php
namespace App\Http\Controllers\Admin;

use App\Repository\ProjectsRepository as Repository;
use Illuminate\Http\Request;
use Laravel\Lumen\Routing\Controller;

class ProjectController extends Controller
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
        $list = $this->repository->getList();

        return view('admin.projects.index', ['list' => $list]);
    }
    public function insert(Request $request)
    {
        $data = array_map(
            'trim',
            $request->only(['title', 'alias'])
        );

        $this->repository->create($data);

        return redirect()->route('admin_projects_index');
    }

    public function update(Request $request)
    {
        $id = $request->get('id');

        if ($id < 1) {
            throw new \RuntimeException();
        }

        $model = $this->repository->find($id);

        $data = array_map(
            'trim',
            $request->only(['title', 'alias'])
        );

        $model->update($data);

        return redirect()->route('admin_projects_index');
    }
}
