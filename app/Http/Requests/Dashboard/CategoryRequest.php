<?php

namespace App\Http\Requests\Dashboard;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CategoryRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $id = $this->input('id');
        $rules = [
            'name.ar' => ['required', 'string', 'max:255', Rule::unique('categories', 'name->ar')->ignore($id)],
            'name.en' => ['required', 'string', 'max:255', Rule::unique('categories', 'name->en')->ignore($id)],
            'slug.ar' => ['required', 'string', 'max:255', Rule::unique('categories', 'slug->ar')->ignore($id)],
            'slug.en' => ['required', 'string', 'max:255', Rule::unique('categories', 'slug->en')->ignore($id)],
            'parent' => ['nullable', 'exists:categories,id'],
            'status' => ['nullable', 'boolean'],
            'icon' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif,svg,webp', 'max:2048'],
        ];

        return $rules;
    }

}
