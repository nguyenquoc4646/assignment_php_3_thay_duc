<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryModel extends Model
{
    use HasFactory;
    protected $table = 'categories';
  protected $fillabel = [
        'name '
    ];

    static public function getCategories(){
        return self::select(
            'id',
            'name',
            'slug'
        )->get();
    }

    //  public function post(){
    //     return $this->hasMany(PostModel::class,'category_id');
    //  }
}
