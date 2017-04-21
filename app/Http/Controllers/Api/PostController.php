<?php

namespace App\Http\Controllers\Api;

use App\Models\Post;
use Laravel\Lumen\Routing\Controller;

class PostController extends Controller
{
    public function index()
    {
        /* @var \Illuminate\Pagination\LengthAwarePaginator $list */
        $list = Post::orderBy('created_at', 'DESC')->paginate(env('ITEM_ON_PAGE_POST'));

        if ($list->count() < 1) {
            return response()->json(['empty']);
        }

        $data = [];

        foreach ($list as $post) {
            $tmp = [
                'user' => [
                    'name' => $post->user->name,
                    'avatar' => $post->user->pathUrl('s_')
                ],
                'post' => [
                    'text' => $post->text,
                    'create_at' => $post->created_at->getTimestamp()
                ]
            ];

            foreach ($post->images as $image) {
                /* @var  \App\Models\PostImage $image */
                $tmp['post']['images'][] = $image->pathUrl('400_300_');
            }

            $data[] = $tmp;
        }

        return response()->json($data);
    }
}
