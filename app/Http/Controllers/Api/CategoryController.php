<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Http\Resources\CategoryResource;
use Auth;

class CategoryController extends Controller
{

    public function index()
    {
        return CategoryResource::collection(Category::paginate());
    }


    public function store(StoreCategoryRequest $request)
    {
        $request->validated();

        $currentUser =Auth::user();
        $category = new Category();
        $category->name = $request->name;
        $category->slug = $request->slug;
        $category->icon_image = $request->icon_image;
        $category->icon_code = $request->icon_code;
        $category->status_id = 1;
        $category->created_by = $currentUser->id;
        $category->save();

        return response()->json(New CategoryResource($category),201);
    }


    public function show($id)
    {
        return New CategoryResource(Category::find($id));
    }


    public function update(UpdateCategoryRequest $request, $id)
    {
        $currentUser =Auth::user();
        $category = Category::find($id);
        $category->name = $request->name;
        $category->slug = $request->slug;
        $category->icon_image = $request->icon_image;
        $category->icon_code = $request->icon_code;
        $category->status_id = $request->status_id;
        $category->updated_by = $currentUser->id;
        $category->save();

        return response()->json(New CategoryResource($category),202);
    }


    public function destroy($id)
    {
        Category::destroy($id);
        return response()->json(null,204);
    }
}
