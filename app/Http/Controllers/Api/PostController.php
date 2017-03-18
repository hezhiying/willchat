<?php

namespace App\Http\Controllers\Api;

use App\Post;
use Illuminate\Http\Request;

class PostController extends BaseController
{
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * 文章列表.
     *
     * @param Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function lists(Request $request)
    {
        $posts = Post::paginate();

        return response()->json(compact('posts'));
    }

    /**
     * 文章详情.
     *
     * @param $id
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $post = Post::findOrFail($id);

        return response()->json(compact('post'));
    }
}
