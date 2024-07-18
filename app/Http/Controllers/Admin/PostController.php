<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CategoryModel;
use App\Models\PostModel;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $posts = PostModel::getPosts();



        $categories = CategoryModel::getCategories();
        return view('Admin.Posts.index', [
            'posts' => $posts,
            'categories' => $categories
        ]);
    }

    public function filterPostBySlugCate($slug)
    {
        $posts =  PostModel::getPostByCate($slug);
        if (!empty($posts)) {
            $categories = CategoryModel::getCategories();
            return view('Admin.Posts.index', [
                'posts' => $posts,
                'categories' => $categories
            ]);
        }
    }

    public function filter_category_id($id_category)
    {
        dd($id_category);
        // $posts = PostModel::getPostsFilterCategory_id($id_category);
        // $categories = CategoryModel::getCategories();
        // return view('Admin.Posts.index', [
        //     'posts' => $posts,
        //     'categories' => $categories
        // ]);
    }
    /**
     * Show the form for creating a new resource.
     */

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $posts = new PostModel;
        if (!empty($request->file('image'))) {
            $file = $request->file('image');
            $ext = $file->getClientOriginalExtension();
            $randomStr = Str::random(20);
            $fileName = strtolower($randomStr) . '.' . $ext;
            $file->move('upload/', $fileName);
            $posts->image = trim($fileName);
        }
        $posts->title = trim($request->title);
        $posts->category_id = trim($request->category_id);
        $posts->excerpt = trim($request->excerpt);
        $posts->content = trim($request->content);
        $posts->slug = Str::slug($request->title);

        $posts->save();
        return response()->json([
            "status" => true,
            'message' => 'Thêm bài viết thành công'
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $post = PostModel::getPostDetail($id);

        return view('Admin.posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $post = PostModel::getPostDetail($id);

        // $id_category =
        return response()->json([
            'status' => true,
            'post' => $post,
            'id_category' => $post->c_id
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // dd($request->all());

        $post = PostModel::find($id);

        if (!empty($request->file('image'))) {
            $file = $request->file('image');
            $ext = $file->getClientOriginalExtension();
            $randomStr = Str::random(20);
            $fileName = strtolower($randomStr) . '.' . $ext;
            $file->move('upload/', $fileName);
            $post->image = trim($fileName);
        }
        $post->id = trim($request->id);
        $post->title = trim($request->title);
        $post->category_id = trim($request->category_id);
        $post->excerpt = trim($request->excerpt);
        $post->content = trim($request->content);
        $post->slug = Str::slug($request->title);
        $post->save();
        return response()->json([
            'status' => true,
            'message' => 'Cập nhật thành công'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $posts = PostModel::find($request->id);
        $posts->delete();
        return response()->json(
            [
                'status' => true,
                'message' => 'Xóa thành công'
            ]

        );
    }
}
