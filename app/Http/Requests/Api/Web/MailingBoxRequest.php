<?php

namespace App\Http\Requests\Api\Web;

use Illuminate\Foundation\Http\FormRequest;

class MailingBoxRequest extends FormRequest
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
            'email' => ['required', 'email', 'unique:mailing_boxes,email', 'max:255'],
        ];
    }
}
