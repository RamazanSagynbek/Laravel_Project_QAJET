<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateServiceRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()->id === $this->route('service')->user_id || $this->user()->role === 'admin';
    }

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
