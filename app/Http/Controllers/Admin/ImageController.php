<?php
namespace App\Http\Controllers\Admin;

use App\Repository\UserRepository;
use Folklore\Image\Facades\Image;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use Laravel\Lumen\Routing\Controller;
use Imagine\Gd\Imagine;
use Imagine\Image\Box;
use Imagine\Image\ImageInterface;

class ImageController extends Controller
{
    private $filesystem;

    public function __construct(Filesystem $filesystem)
    {
        $this->filesystem = $filesystem;
    }


    public function avatar(Request $request, UserRepository $repository)
    {
        $id = $request->get('user_id');
        $user = $repository->find($id);

        /* @var \Illuminate\Http\UploadedFile $file */
        $file = Input::file('image');

        $validator = Validator::make(
            ['image' => $file],
            ['image' => 'image']
        );

        if ($validator->fails()) {
            redirect()->back();
        }

        // имя файла
        $filename = md5(microtime() . $file->getClientOriginalName()) . "." . $file->getClientOriginalExtension();
        $directory = base_path(env('PATH_PUBLIC')) . '/avatar/' .substr($filename, 0, 3);

        // сохраняем у пользователя
        $user->avatar = $filename;
        $user->save();

        // создание директории
        if ($this->filesystem->exists($directory) !== true) {
            $this->filesystem->makeDirectory($directory, 0755, true);
        }

        // сохраняем изображение
        $thumbnail = (new Imagine())->open($file->path());

        $thumbnail->thumbnail(new Box(100, 100), ImageInterface::THUMBNAIL_INSET)
            ->save($directory . DIRECTORY_SEPARATOR . 'b_' . $filename);

        $thumbnail->thumbnail(new Box(100, 100), ImageInterface::THUMBNAIL_OUTBOUND)
            ->save($directory . DIRECTORY_SEPARATOR . 's_' . $filename);

        return redirect()->route('admin_user_view', ['id' => $id]);
    }


    public function ajaxUploadImage()
    {
        $dir = base_path('public_html');

        //PATH_PUBLIC

        $file = Input::file('image');
        $input = array('image' => $file);

        $destinationPath = 'uploads/';

        Input::file('image')->move($destinationPath, $filename);
        return Response::json(['success' => true, 'file' => asset($destinationPath . $filename)]);

    }

    public function upload_image()
    {
        $file = Request::file('image');

        $file = $this->userRepo->updateAvatar($file,Auth::user()->user);

        return response()->json(['success' => true, 'file' => $file ]);
    }

    public function updateAvatar($file,$user)
    {
        // Move the uploaded file to public/uploads/ folder

        $destinationPath = 'uploads/';

        $filename = $file->getClientOriginalName();

        $file->move($destinationPath, $filename);

        // save the file path on user avatar

        $user = User::where('id',$user->id)->first();

        $user->avatar = $destinationPath.$filename;

        $user->save();

        return asset($destinationPath.$filename);
    }
}