<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Request;

class PostModel extends Model
{
    use HasFactory;
    protected $table = 'posts';
    protected $fillable = [
        'category_id',
        'title',
        'excerpt',
        'content',
        'image',
        'view',
    ];

    static public function getPosts()
    {
        if (!empty(Request::get('category_id'))) {
            return self::select(
                'p.id as p_id',
                'p.title as p_title',
                'p.excerpt as p_excerpt',
                'p.content as p_content',
                'p.image as p_image',
                'p.view as p_view',
                'c.name as c_name',
                'c.id as c_id',
                'p.created_at as p_created_at'
            )
                ->from('posts as p')
                ->join('categories as c', 'c.id', '=', 'p.category_id')
                ->where('c.id', '=', Request::get('category_id'))
                ->paginate(5);
        } else {
            return self::select(
                'p.id as p_id',
                'p.title as p_title',
                'p.excerpt as p_excerpt',
                'p.content as p_content',
                'p.image as p_image',
                'p.view as p_view',
                'c.name as c_name',
                'c.id as c_id',
                'p.created_at as p_created_at'
            )
                ->from('posts as p')
                ->join('categories as c', 'c.id', '=', 'p.category_id')
                ->paginate(5);
        }
    }

    static  public function getPostDetail($id)
    {
        return self::select(
            'p.id as p_id',
            'p.title as p_title',
            'p.excerpt as p_excerpt',
            'p.content as p_content',
            'p.image as p_image',
            'p.view as p_view',
            'c.name as c_name',
            'c.slug as c_slug',
            'c.id as c_id',
            'p.created_at as p_created_at'
        )
            ->from('posts as p')
            ->join('categories as c', 'c.id', '=', 'p.category_id')
            ->where('p.id', '=', $id)
            ->get()
            ->first();
    }
    // admin
    static public function getOnePostLatest()
    {
        return self::select(
            'p.id as p_id',
            'p.title as p_title',
            'p.excerpt as p_excerpt',
            'p.image as p_image',
            'p.view as p_view',
            'c.slug as c_slug',
            'p.slug as p_slug',
            'c.name as c_name',
            'p.created_at as p_created_at'
        )
            ->from('posts as p')
            ->join('categories as c', 'c.id', '=', 'p.category_id')
            ->orderBy('view', 'desc')
            ->limit(1)
            ->get()
            ->first();
    }

    static public function getPostLatest($id)
    {
        return self::select(
            'p.id as p_id',
            'p.title as p_title',
            'p.excerpt as p_excerpt',
            'p.image as p_image',
            'p.view as p_view',
            'c.slug as c_slug',
            'p.slug as p_slug',
            'c.name as c_name',
            'p.created_at as p_created_at'
        )
            ->from('posts as p')
            ->join('categories as c', 'c.id', '=', 'p.category_id')
            ->orderBy('p.id', 'desc')
            ->where('p.id', '<>', $id)
            ->limit(6)

            ->get();
    }

    static public function getTop5PostViewMost()
    {
        return self::select(
            'p.id as p_id',
            'p.title as p_title',
            'p.excerpt as p_excerpt',
            'p.image as p_image',
            'p.view as p_view',
            'c.slug as c_slug',
            'p.slug as p_slug',
            'c.name as c_name',
            'p.created_at as p_created_at'
        )
            ->from('posts as p')
            ->join('categories as c', 'c.id', '=', 'p.category_id')
            ->orderBy('view', 'desc')
            ->limit(5)
            ->get();
    }

    static public function getSingleProduct($slug)
    {
        return self::select(
            'p.id as p_id',
            'p.title as p_title',
            'p.excerpt as p_excerpt',
            'p.content as p_content',
            'p.image as p_image',
            'p.view as p_view',
            'c.slug as c_slug',
            'p.slug as p_slug',
            'c.name as c_name',
            'p.created_at as p_created_at'
        )
            ->from('posts as p')
            ->join('categories as c', 'c.id', '=', 'p.category_id')
            ->where('p.slug', '=', $slug)
            ->get()
            ->first();
    }
    static public function getPostByCate($slug)
    {
        if ($slug) {
            return self::select(
                'p.id as p_id',
                'p.title as p_title',
                'p.excerpt as p_excerpt',
                'p.content as p_content',
                'p.image as p_image',
                'p.view as p_view',
                'c.slug as c_slug',
                'p.slug as p_slug',
                'c.name as c_name',
                'p.created_at as p_created_at'
            )
                ->from('posts as p')
                ->join('categories as c', 'c.id', '=', 'p.category_id')
                ->where('c.slug', '=', $slug)
                ->orderBy('p.id', 'desc')
                ->paginate(5);
        }
    }

  
    

    static public function getPostBySearch()
    {
        if (!empty(Request::get('keyword'))) {
            return self::select(
                'p.id as p_id',
                'p.title as p_title',
                'p.excerpt as p_excerpt',
                'p.content as p_content',
                'p.image as p_image',
                'p.view as p_view',
                'c.slug as c_slug',
                'p.slug as p_slug',
                'c.name as c_name',
                'p.created_at as p_created_at'
            )
                ->from('posts as p')
                ->join('categories as c', 'c.id', '=', 'p.category_id')
                ->where('p.title', 'like', '%' . Request::get('keyword') . '%')
                ->orderBy('p.id', 'desc')
                ->paginate(100);
        }
    }

    static public function getPostFull()
    {
        return self::select(
            'p.id as p_id',
            'p.title as p_title',
            'p.excerpt as p_excerpt',
            'p.content as p_content',
            'p.image as p_image',
            'p.view as p_view',
            'c.slug as c_slug',
            'p.slug as p_slug',
            'c.name as c_name',
            'p.created_at as p_created_at'
        )
            ->from('posts as p')
            ->join('categories as c', 'c.id', '=', 'p.category_id')
            ->orderBy('p.id', 'desc')
            ->paginate(5);
    }
    // side bar
    static public function getPostPopular()
    {
        return self::select(
            'p.id as p_id',
            'p.title as p_title',
            'p.excerpt as p_excerpt',
            'p.image as p_image',
            'p.view as p_view',
            'c.slug as c_slug',
            'p.slug as p_slug',
            'c.name as c_name',
            'p.created_at as p_created_at'
        )
            ->from('posts as p')
            ->join('categories as c', 'c.id', '=', 'p.category_id')
            ->orderBy('p.view', 'desc')
            ->limit(5)
            ->get();
    }

    static public function getPostlatestSidebar()
    {
        return self::select(
            'p.id as p_id',
            'p.title as p_title',
            'p.excerpt as p_excerpt',
            'p.image as p_image',
            'p.view as p_view',
            'c.slug as c_slug',
            'p.slug as p_slug',
            'c.name as c_name',
            'p.created_at as p_created_at'
        )
            ->from('posts as p')
            ->join('categories as c', 'c.id', '=', 'p.category_id')
            ->orderBy('p.created_at', 'desc')
            ->limit(5)
            ->get();
    }

    static public function getPostNearest()
    {
        return self::select(
            'p.id as p_id',
            'p.title as p_title',
            'p.excerpt as p_excerpt',
            'p.image as p_image',
            'p.view as p_view',
            'c.slug as c_slug',
            'p.slug as p_slug',
            'c.name as c_name',
            'p.created_at as p_created_at'
        )
            ->from('posts as p')
            ->join('categories as c', 'c.id', '=', 'p.category_id')
            ->orderBy('p.id', 'asc')
            ->limit(5)
            ->get();
    }
}
