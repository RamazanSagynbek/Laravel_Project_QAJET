<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreListingRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'address' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'rooms' => 'required|integer|min:1',
            'roommates_needed' => 'required|integer|min:1',
            'type' => 'required|in:looking_for_room,offering_room',
            'image' => 'nullable|image|max:2048',
        ];
    }

    public function messages(): array
    {
        return [
            'title.required' => 'Please enter a title for your listing.',
            'price.required' => 'Please specify the monthly price.',
            'address.required' => 'Please enter the address.',
            'type.required' => 'Please select whether you are offering or looking for a room.',
        ];
    }
}
