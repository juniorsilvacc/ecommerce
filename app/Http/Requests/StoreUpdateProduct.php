<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUpdateProduct extends FormRequest
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
            'name' => [
                'required',
                'min:3',
                'max:255',
                "unique:categories,id,{$this->id},id",
            ],
            'description' => [
                'nullable',
                'min:3',
                'max:255',
            ],
            'price' => [
                'required',
                "regex:/^\d+(\.\d{1,2})?$/",
            ],
            'category_id' => [
                'required',
                'exists:categories,id',
            ],
            'image' => [
                'required',
                'image',
                'max:1024',
                'mimes:png,jpg',
            ],
        ];

        if ($this->method() == 'PUT') {
            $rules['image'] = ['nullable', 'image', 'max:1024', 'mimes:png,jpg'];
        }

        return $rules;
    }
}
