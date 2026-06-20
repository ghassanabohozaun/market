<?php

namespace App\Http\Requests\Dashboard;

use Illuminate\Foundation\Http\FormRequest;

class TagRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $id = $this->route('tag') ?? $this->id;
        return [
            'name' => 'required|array',
            'name.ar' => [
                'required',
                'string',
                'max:255',
                \Illuminate\Validation\Rule::unique('tags', 'name->ar')->ignore($id)
            ],
            'name.en' => [
                'required',
                'string',
                'max:255',
                \Illuminate\Validation\Rule::unique('tags', 'name->en')->ignore($id)
            ],
            'status' => 'nullable|boolean',
        ];
    }

    public function attributes(): array
    {
        return [
            'name.ar' => __('tags.name_ar'),
            'name.en' => __('tags.name_en'),
        ];
    }
}
