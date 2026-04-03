<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()->id === $this->route('product')->user_id || $this->user()->role === 'admin';
    }

    public function rules(): array
    {
        return [
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'condition' => 'required|in:new,like_new,used,poor',
            'category_id' => 'nullable|exists:categories,id',
            'image' => 'nullable|image|max:2048',
        ];
    }
}
