<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SubCategory;
use App\Http\Requests\StoreSubCategoryRequest;
use App\Http\Requests\UpdateSubCategoryRequest;

class SubCategoryController extends Controller
{

    public function index()
    {
        return SubCategory::paginate();
    }


    public function store(StoreCategoryRequest $request)
    {
        $request->validated();

        $subCategory = new SubCategory();
        $subCategory->name = $request->name;
        $subCategory->save();

        return response()->json($subCategory,201);
    }


    public function show($id)
    {
        return SubCategory::find($id);
    }


    public function update(UpdateCategoryRequest $request, $id)
    {
        $subCategory = SubCategory::find($id);
        $subCategory->name = $request->name;
        $subCategory->save();

        return response()->json($subCategory,202);
    }


    public function destroy($id)
    {
        SubCategory::destroy($id);
        return response()->json(null,204);
    }
}
