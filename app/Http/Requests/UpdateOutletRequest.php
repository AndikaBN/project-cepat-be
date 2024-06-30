<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateOutletRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'no_telp' => 'required|string|max:15',
            'type' => 'required|string|max:255',
            'limit' => 'required|integer',
            'image_ktp' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'image_outlet' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ];
    }
}
