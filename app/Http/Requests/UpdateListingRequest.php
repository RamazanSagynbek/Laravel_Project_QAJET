<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateListingRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()->id === $this->route('listing')->user_id || $this->user()->role === 'admin';
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
}
