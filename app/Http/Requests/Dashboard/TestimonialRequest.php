<?php

namespace App\Http\Requests\Dashboard;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class TestimonialRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $id = $this->input('id');
        $rules = [
            'name' => ['required', 'array'],
            'name.ar' => ['required', 'string', 'max:255', Rule::unique('testimonials', 'name->ar')->ignore($id)],
            'name.en' => ['required', 'string', 'max:255', Rule::unique('testimonials', 'name->en')->ignore($id)],
            'title' => ['required', 'array'],
            'title.ar' => ['required', 'string', 'max:255'],
            'title.en' => ['required', 'string', 'max:255'],
            'content' => ['required', 'array'],
            'content.ar' => ['required', 'string'],
            'content.en' => ['required', 'string'],
            'rating' => ['required', 'integer', 'min:1', 'max:5'],
            'image' => ['required_without:id', 'image', 'mimes:jpeg,png,jpg,gif,svg,webp', 'max:2048'],
            'status' => ['required', 'in:0,1'],
        ];

        return $rules;
    }
}
