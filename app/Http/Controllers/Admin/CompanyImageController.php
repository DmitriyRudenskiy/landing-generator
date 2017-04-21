<?php
namespace App\Http\Controllers\Admin;

use App\Repository\CompanyImageRepository;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use Laravel\Lumen\Routing\Controller;
use Imagine\Gd\Imagine;
use Imagine\Image\Box;
use Imagine\Image\ImageInterface;

class CompanyImageController extends Controller
{

    public function add(CompanyImageRepository $repository, Request $request)
    {
        /* @var UploadedFile $file */
        $file = Input::file('image');
        $companyId = $request->get('company_id');

        $validator = Validator::make(
            ['image' => $file],
            ['image' => 'image']
        );

        if ($validator->fails()) {
            return redirect()->route('admin_company_view', ['id' => $companyId]);
        }

        // имя файла
        $filename = md5(microtime() . $file->getClientOriginalName()) . "." . $file->getClientOriginalExtension();
        $directory = base_path(env('PATH_PUBLIC')) . '/company/' .substr($filename, 0, 3);

        // сохраняем в базу данных
        $repository->create([
            'company_id' => $companyId,
            'path' => $filename
        ]);

        $filesystem = new Filesystem();

        // создание директории
        if ($filesystem->exists($directory) !== true) {
            $filesystem->makeDirectory($directory, 0755, true);
        }

        // сохраняем изображение
        $thumbnail = (new Imagine())->open($file->path());

        $thumbnail->save($directory . DIRECTORY_SEPARATOR . 'original_' . $filename);

        $thumbnail->thumbnail(new Box(400, 300), ImageInterface::THUMBNAIL_INSET)
            ->save($directory . DIRECTORY_SEPARATOR . '400_300_' . $filename);

        $thumbnail->thumbnail(new Box(120, 90), ImageInterface::THUMBNAIL_INSET)
            ->save($directory . DIRECTORY_SEPARATOR . '120_90_' . $filename);

        return redirect()->route('admin_company_view', ['id' => $companyId]);
    }

    public function remove(CompanyImageRepository $repository, $id)
    {
        $image = $repository->find($id);
        $companyId = $image->company_id;

        $repository->delete($id);

        return redirect()->route('admin_company_view', ['id' => $companyId]);
    }

    public function cover()
    {

    }

}
