<?php
namespace App\Http\Controllers\Admin;

use App\Models\Menu;
use App\Models\PrefixInterface;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Imagine\Gd\Imagine;
use Laravel\Lumen\Routing\Controller;

class MenuController extends Controller implements PrefixInterface
{
    /**
     * @var Menu
     */
    private $repository;

    public function __construct(Menu $repository)
    {
        $this->repository = $repository;
    }

    public function index()
    {
        $logo = $this->repository->getLogo();
        $phone = $this->repository->getPhone();
        $items = $this->repository->getItems();

        // dd($items);

        return view(
            'admin.menu.index',
            [
                'logo' => $logo,
                'phone' => $phone,
                'list'=> $items
            ]
        );
    }

    public function insert(Request $request)
    {
        $data = array_map(
            'trim',
            $request->only(['priority', 'title', 'url'])
        );

        $data['type_id'] = Menu::TYPE_ITEM;
        $data['visible'] = true;

        $this->repository->create($data);

        return redirect()->route('admin_menu_index');
    }

    public function update(Request $request)
    {
        $id = $request->get('id');
        $model = $this->repository->find($id);

        $data = array_map(
            'trim',
            $request->only(['priority', 'title', 'description'])
        );

        dd($data);

        $model->update($data);

        return redirect()->route('admin_menu_index');
    }

    public function logo(Filesystem $filesystem)
    {
        $model = Menu::getLogo();

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
        $model->title = $filename;
        $model->save();

        $directory = base_path(env('PATH_PUBLIC')) . DIRECTORY_SEPARATOR . self::PREFIX_MENU_LOGO;

        // создание директории
        if ($filesystem->exists($directory) !== true) {
            $filesystem->makeDirectory($directory, 0755, true);
        }

        $path = $directory . DIRECTORY_SEPARATOR . $filename;

        // сохраняем изображение
        $image = (new Imagine())->open($file->path());
        $image->save($path);

        return redirect()->route('admin_menu_index');
    }
}
