<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Admin\PostController;
use App\Models\PostModel;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index()
    {
        // $posts = PostModel::getOnePostLatest();
        $getOnePostLatest = PostModel::getOnePostLatest();
        $getPostLatest = PostModel::getPostLatest($getOnePostLatest->p_id);
        $postTop6Chunk = array_chunk($getPostLatest->toArray(), 3);
        $getTop5PostViewMost = PostModel::getTop5PostViewMost();

        // đời sống


        return view('Clients.Home', [
            'getOnePostLatest' => $getOnePostLatest,
            'postTop6Chunk' => $postTop6Chunk,
            'getTop5PostViewMost' => $getTop5PostViewMost
        ]);
    }

    public function shop($slug)
    {


        $getSinglePost = PostModel::getSingleProduct($slug);
        $getPostByCate = PostModel::getPostByCate($slug);

        if (!empty($getSinglePost)) {
            $getPostPopular = PostModel::getPostPopular();
            $getPostlatestSidebar = PostModel::getPostlatestSidebar();
            $getPostNearest = PostModel::getPostNearest();
            return view('Clients.Post-detail', [

                'getSinglePost' => $getSinglePost,
                'getPostPopular' => $getPostPopular,
                'getPostlatestSidebar' => $getPostlatestSidebar,
                'getPostNearest' => $getPostNearest,
            ]);
        } elseif (!empty($getPostByCate)) {
            $getPostPopular = PostModel::getPostPopular();
            $getPostlatestSidebar = PostModel::getPostlatestSidebar();
            $getPostNearest = PostModel::getPostNearest();
            return view('Clients.List-post-cate', [
                'getPostByCate' => $getPostByCate,
                'getPostPopular' => $getPostPopular,
                'getPostlatestSidebar' => $getPostlatestSidebar,
                'getPostNearest' => $getPostNearest,
            ]);
        }
    }

    public function fullPost()
    {
        $getPostPopular = PostModel::getPostPopular();
        $getPostlatestSidebar = PostModel::getPostlatestSidebar();
        $getPostNearest = PostModel::getPostNearest();
        $getPostFull = PostModel::getPostFull();
        return view('Clients.List-post-cate', [
            'getPostByCate' => $getPostFull,
            'getPostPopular' => $getPostPopular,
            'getPostlatestSidebar' => $getPostlatestSidebar,
            'getPostNearest' => $getPostNearest,
        ]);
    }


    public function getPostsSearch()
    {
        // echo 11111;
        // exit;


        $getPostsSearch = PostModel::getPostBySearch();
        $getPostPopular = PostModel::getPostPopular();
        $getPostlatestSidebar = PostModel::getPostlatestSidebar();
        $getPostNearest = PostModel::getPostNearest();

        if (!empty($getPostsSearch)) {
            return view('Clients.List-post-cate', [
                'getPostByCate' => $getPostsSearch,
                'getPostPopular' => $getPostPopular,
                'getPostlatestSidebar' => $getPostlatestSidebar,
                'getPostNearest' => $getPostNearest,
            ]);
        }
    }
}
