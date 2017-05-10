<?php
namespace App\Http\Controllers\Admin;

use App\Models\Benefits;
use App\Models\PrefixInterface;
use App\Repository\BenefitsRepository;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Imagine\Gd\Imagine;
use Laravel\Lumen\Routing\Controller;

class BenefitController extends Controller implements PrefixInterface
{
    /**
     * @var BenefitsRepository
     */
    private $repository;

    public function __construct(BenefitsRepository $repository)
    {
        $this->repository = $repository;
    }

    public function index()
    {
        $list = $this->repository->getAllList();

        return view('admin.benefit.index', ['list' => $list]);
    }

    public function add()
    {
        return view('admin.benefit.add');
    }

    public function edit($id)
    {
        $model = $this->repository->find($id);

        return view('admin.benefit.edit', ['model' => $model]);
    }

    public function insert(Request $request)
    {
        $data = array_map(
            'trim',
            $request->only(['title', 'description'])
        );

        $model = $this->repository->add($data);

        if ($model instanceof Benefits && $model->id > 0) {
            return redirect()->route('admin_benefits_edit', ['id' => $model->id]);
        }

        throw new \RuntimeException();
    }

    public function update(Request $request)
    {
        $id = $request->get('id');

        $data = array_map(
            'trim',
            $request->only(['priority', 'title', 'description'])
        );

        $this->repository->update($data, $id);

        return redirect()->route('admin_benefits_index');
    }

    /**
     * Загружаем изображение для приимуществ
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function cover(Request $request, Filesystem $filesystem)
    {
        $id = $request->get('id');
        $model = $this->repository->find($id);

        /* @var \Illuminate\Http\UploadedFile $file */
        $file = Input::file('image');

        $validator = Validator::make(
            ['image' => $file],
            ['image' => 'image']
        );

        if ($validator->fails()) {
            dd('Ошибка');

        }

        // имя файла
        $filename = md5(microtime() . $model) . "." . $file->getClientOriginalExtension();

        // сохраняем путь к картинке
        $model->cover = $filename;
        $model->save();

        $directory = base_path(env('PATH_PUBLIC')) . DIRECTORY_SEPARATOR . self::PREFIX_BENEFITS;

        // создание директории
        if ($filesystem->exists($directory) !== true) {
            $filesystem->makeDirectory($directory, 0755, true);
        }

        $path = $directory . DIRECTORY_SEPARATOR . $filename;

        // сохраняем изображение
        $image = (new Imagine())->open($file->path());
        $image->save($path);

        return redirect()->route('admin_benefits_edit', ['id' => $model->id]);
    }

    public function hide($id)
    {
        $model = $this->repository->find($id);
        $model->visible = 0;
        $model->save();

        return redirect()->route('admin_benefits_index');
    }

    public function show($id)
    {
        $model = $this->repository->find($id);
        $model->visible = 1;
        $model->save();

        return redirect()->route('admin_benefits_index');
    }
}
