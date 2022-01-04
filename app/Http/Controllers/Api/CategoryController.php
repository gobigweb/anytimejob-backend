<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;

class CategoryController extends Controller
{

    public function index()
    {
        return Category::paginate();
    }


    public function store(StoreCategoryRequest $request)
    {
        $request->validated();

        $category = new Category();
        $category->name = $request->name;
        $category->save();

        return response()->json($category,201);
    }


    public function show($id)
    {
        return Category::find($id);
    }


    public function update(UpdateCategoryRequest $request, $id)
    {
        $category = Category::find($id);
        $category->name = $request->name;
        $category->save();

        return response()->json($category,202);
    }


    public function destroy($id)
    {
        Category::destroy($id);
        return response()->json(null,204);
    }
}
