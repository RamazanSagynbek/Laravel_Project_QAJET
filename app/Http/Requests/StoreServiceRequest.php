<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreServiceRequest extends FormRequest
{
    public function authorize(): bool { return true; }

    public function rules(): array
    {
        return [
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'price_type' => 'required|in:fixed,hourly,negotiable',
            'category_id' => 'nullable|exists:categories,id',
            'image' => 'nullable|image|max:2048',
        ];
    }
}
