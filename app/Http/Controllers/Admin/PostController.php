<?php
namespace App\Http\Controllers\Admin;

use App\Models\Post;
use App\Models\PostImage;
use App\Repository\PostRepository;
use App\Repository\UserRepository;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use Laravel\Lumen\Routing\Controller;
use Imagine\Gd\Imagine;
use Imagine\Image\Box;
use Imagine\Image\ImageInterface;

class PostController extends Controller
{
    const COUNT_ON_PAGE = 15;

    public function index(PostRepository $repository, Request $request)
    {
        $list = $repository->getList(self::COUNT_ON_PAGE);

        return view('admin.post.index', ['list' => $list]);
    }

    public function add(UserRepository $repository, Request $request)
    {
        // $list = $repository->getList(self::COUNT_ON_PAGE);
        $users = $repository->all();

        return view('admin.post.add', ['users' => $users]);
    }

    public function insert(PostRepository $repository, Request $request)
    {
        $data = $request->only(['user_id', 'text']);
        $post = $repository->create($data);

        $this->multipleUpload(Input::file('images'), $post);

        return redirect()->route('admin_post_index');
    }

    protected function multipleUpload($files, Post $post)
    {
        if (sizeof($files) < 1) {
            return false;
        }

        foreach($files as $file) {
            if ($file !== null) {
                $this->addImage($file, $post);
            }
        }

        return true;
    }

    /**
     * @param UploadedFile $file
     * @param Post $post
     * @return bool
     */
    protected function addImage(UploadedFile $file, Post $post)
    {
        $validator = Validator::make(
            ['image' => $file],
            ['image' => 'image']
        );

        if ($validator->fails()) {
            return false;
        }

        // имя файла
        $filename = md5(microtime() . $file->getClientOriginalName()) . "." . $file->getClientOriginalExtension();
        $directory = base_path(env('PATH_PUBLIC')) . '/post/' .substr($filename, 0, 3);

        // сохраняем в базу данных
        $postImage = PostImage::create([
            'post_id' => $post->id,
            'path' => $filename
        ]);

        if (empty($postImage)) {
            return false;
        }

        $filesystem = new Filesystem();

        // создание директории
        if ($filesystem->exists($directory) !== true) {
            $filesystem->makeDirectory($directory, 0755, true);
        }

        // сохраняем изображение
        $thumbnail = (new Imagine())->open($file->path());

        $thumbnail->thumbnail(new Box(400, 300), ImageInterface::THUMBNAIL_INSET)
            ->save($directory . DIRECTORY_SEPARATOR . '400_300_' . $filename);

        $thumbnail->thumbnail(new Box(120, 90), ImageInterface::THUMBNAIL_INSET)
            ->save($directory . DIRECTORY_SEPARATOR . '120_90_' . $filename);

        return true;
    }
}
