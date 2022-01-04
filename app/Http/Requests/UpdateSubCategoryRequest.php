<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSubCategoryRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {

        $id = $this->request->get('id');
        return [
            'name' => 'required|max:100|unique:categories,name,'.$id,
            'slug' => 'required|max:100|unique:categories,name,'.$id,
            'icon_image' => 'mimes:jpeg,png,jpg|max:2048',
            'category_id' => 'required',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'name.required' => 'Category Name is Required',
            'name.unique' => 'Category Name Already Exist',
            'slug.required' => 'Category Name is Required',
            'slug.unique' => 'Category Name Already Exist',
            'icon_image.mimes' => 'We only accept :values ',
            'category_id.required' => 'Select Category Name',
        ];
    }
}
