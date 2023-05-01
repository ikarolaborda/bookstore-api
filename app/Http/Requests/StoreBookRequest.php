<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreBookRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'ISBN' => 'required|numeric|unique:books',
            'value' => 'required|numeric',
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
