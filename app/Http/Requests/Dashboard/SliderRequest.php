<?php

namespace App\Http\Requests\Dashboard;

use Illuminate\Foundation\Http\FormRequest;

class SliderRequest extends FormRequest
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
        $rules = [
            'title.*' => 'required|string|max:255',
            'subtitle.*' => 'required|string|max:255',
            'details.*' => 'required|string',
            'url.*' => 'nullable',
            'status' => 'required|in:0,1',
            'details_status' => 'required|in:0,1',
            'button_status' => 'required|in:0,1',
            'order' => 'nullable|integer',
        ];

        $rules['photo'] = ($this->id || $this->route('slider')) ? 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048' : 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048';

        return $rules;
    }

    public function messages()
    {
        return [
            // Custom messages if needed, otherwise translation files cover them
        ];
    }
}
