<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SubCategory;
use App\Http\Requests\StoreSubCategoryRequest;
use App\Http\Requests\UpdateSubCategoryRequest;
use App\Http\Resources\SubCategoryResource;
use Auth;

class SubCategoryController extends Controller
{

    public function index()
    {
        return SubCategoryResource::collection(SubCategory::paginate());
    }


    public function store(StoreSubCategoryRequest $request)
    {
        $request->validated();

        $currentUser =Auth::user();
        $subcategory = new SubCategory();
        $subcategory->name = $request->name;
        $subcategory->slug = $request->slug;
        $subcategory->icon_image = $request->icon_image;
        $subcategory->icon_code = $request->icon_code;
        $subcategory->status_id = 1;
        $subcategory->created_by = $currentUser->id;
        $subcategory->save();

        $subcategory->categories()->sync($request->category_id,false);

        return response()->json(New SubCategoryResource($subcategory),201);
    }


    public function show($id)
    {
        return New SubCategoryResource(SubCategory::find($id));
    }


    public function update(UpdateSubCategoryRequest $request, $id)
    {
        $currentUser =Auth::user();
        $subcategory = SubCategory::find($id);
        $subcategory->name = $request->name;
        $subcategory->slug = $request->slug;
        $subcategory->icon_image = $request->icon_image;
        $subcategory->icon_code = $request->icon_code;
        $subcategory->category_id = $request->category_id;
        $subcategory->status_id = $request->status_id;
        $subcategory->updated_by = $currentUser->id;
        $subcategory->save();

        $subcategory->categories()->sync($request->category_id,true);

        return response()->json(New SubCategoryResource($subcategory),202);
    }


    public function destroy($id)
    {
        SubCategory::destroy($id);
        return response()->json(null,204);
    }
}
