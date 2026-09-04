<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GetMenuItemsRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'search' => 'nullable|string|max:100',
            'category_id' => 'nullable|string|max:50',
            'lang' => 'nullable|string|in:ar,en',
        ];
    }
}
