<?php
namespace App\Http\Controllers\Admin;

use App\Models\Video;
use App\Repository\VideoRepository;
use Illuminate\Http\Request;
use Laravel\Lumen\Routing\Controller;

class VideoController extends Controller
{
    /**
     * @var VideoController
     */
    private $repository;

    public function __construct(VideoRepository $repository)
    {
        $this->repository = $repository;
    }

    public function index()
    {
        $list = $this->repository->getAllList();

        return view('admin.video.index', ['list' => $list]);
    }

    public function add()
    {
        return view('admin.video.add');
    }

    public function edit($id)
    {
        $model = $this->repository->find($id);

        return view('admin.video.edit', ['model' => $model]);
    }

    public function insert(Request $request)
    {
        $data = array_map(
            'trim',
            $request->only(['url', 'title', 'description'])
        );

        $model = $this->repository->add($data);

        if ($model instanceof Video && $model->id > 0) {
            return redirect()->route('admin_video_edit', ['id' => $model->id]);
        }

        throw new \RuntimeException();
    }

    public function update(Request $request)
    {
        $id = $request->get('id');

        $data = array_map(
            'trim',
            $request->only(['url', 'title', 'description'])
        );

        $this->repository->update($data, $id);

        return redirect()->route('admin_video_index');
    }

    public function hide($id)
    {
        $model = $this->repository->find($id);
        $model->visible = 0;
        $model->save();

        return redirect()->route('admin_video_index');
    }

    public function show($id)
    {
        $model = $this->repository->find($id);
        $model->visible = 1;
        $model->save();

        return redirect()->route('admin_video_index');
    }
}
