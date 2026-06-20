<?php

namespace App\Http\Requests\Dashboard;

use CodeZero\UniqueTranslation\UniqueTranslationRule;
use Illuminate\Foundation\Http\FormRequest;

class PageRequest extends FormRequest
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
        return [
            'title.*' => ['required', 'string', 'min:5', 'max:265', UniqueTranslationRule::for('pages')->ignore($this->id)],
            'details.*' => ['required', 'string', 'min:5'],
            'photo' => [$this->id ? 'nullable' : 'required', 'image', 'mimes:png,jpg,jpeg,gif,svg,webp'],
            'status' => ['required', 'in:0,1'],
        ];
    }
}
