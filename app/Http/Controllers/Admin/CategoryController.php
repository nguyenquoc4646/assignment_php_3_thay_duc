<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Models\CategoryModel;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = CategoryModel::all();
        
        return view('Admin.Categories.index', ['categories' => $categories]);
    }

    /**
     * Show the form for creating a new resource.
     */


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $category = new CategoryModel;
        $category->name = $request->name;
        $category->slug = Str::slug($request->name);
        $category->save();
        return response()->json(
            [
                'status' => true,
                'message' => 'Thêm thành công'
            ]

        );
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $category = CategoryModel::find($id);
        return view('Admin.Categories.show', ['category' => $category]);
    }

    /**
     * Show the form for editing the specified resource.
     */

    /**
     * Update the specified resource in storage.
     */
    public function edit($id)
    {
        $category = CategoryModel::find($id);
        return response()->json([
            'status' => true,
            'category' => $category
        ]);
    }
    public function update(Request $request, $id)
    {
      
        $category = CategoryModel::find($id);
        $category->id = $id;
        $category->name = $request->name;
        $category->slug = Str::slug($request->name);
        $category->save();
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
        $category = CategoryModel::find($request->id);
        $category->delete();
        return response()->json(
            [
                'status' => true,
                'message' => 'Xóa thành công'
            ]

        );
    }
}
