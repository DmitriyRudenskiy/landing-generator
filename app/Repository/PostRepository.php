<?php
namespace App\Repository;

use App\Models\Post;
use Prettus\Repository\Eloquent\BaseRepository;

class PostRepository extends BaseRepository
{
    /**
     * @return string
     */
    public function model()
    {
        return Post::class;
    }

    public function getList($limit)
    {
        return Post::paginate($limit);
    }
}