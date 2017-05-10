<?php
namespace App\Http\Controllers\Admin;

use App\Models\Header;
use App\Models\PrefixInterface;
use App\Repository\HeaderRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use Laravel\Lumen\Routing\Controller;
use Illuminate\Filesystem\Filesystem;
use Imagine\Gd\Imagine;

class HeaderController extends Controller implements PrefixInterface
{
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
        return view('admin.header.add');
    }

    public function edit($id)
    {
        $model = $this->repository->find($id);

        return view('admin.header.edit', ['model' => $model]);
    }

    public function insert(Request $request)
    {
        $data = array_map(
            'trim',
            $request->only(['title', 'sub_title'])
        );

        $model = $this->repository->add($data);

        if ($model instanceof Header && $model->id > 0) {
            return redirect()->route('admin_header_edit', ['id' => $model->id]);
        }

        throw new \RuntimeException();
    }

    public function update(Request $request)
    {
        $id = $request->get('id');

        $data = array_map(
            'trim',
            $request->only(['title', 'sub_title'])
        );

        $this->repository->update($data, $id);

        return redirect()->route('admin_header_index');
    }

    /**
     * Загружаем изображение для приимуществ
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function bg(Request $request, Filesystem $filesystem)
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
        $model->bg = $filename;
        $model->save();

        $directory = base_path(env('PATH_PUBLIC')) . DIRECTORY_SEPARATOR . self::PREFIX_HEADERS;

        // создание директории
        if ($filesystem->exists($directory) !== true) {
            $filesystem->makeDirectory($directory, 0755, true);
        }

        $path = $directory . DIRECTORY_SEPARATOR . $filename;

        // сохраняем изображение
        $image = (new Imagine())->open($file->path());
        $image->save($path);

        return redirect()->route('admin_header_edit', ['id' => $model->id]);
    }

    public function show($id)
    {
        Header::where('id', '>', 0)->update(['visible' => 0]);

        $model = $this->repository->find($id);
        $model->visible = 1;
        $model->save();

        return redirect()->route('admin_header_index');
    }
}
