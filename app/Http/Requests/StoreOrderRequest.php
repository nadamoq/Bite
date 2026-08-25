<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreOrderRequest extends FormRequest
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
            'order_type' => 'nullable|string|in:delivery,dine-in,takeaway',
            'table_number' => 'nullable|string|max:50',
            'promo_code' => 'nullable|string|max:50',
            'items' => 'required|array|min:1',
            'items.*.menuitem_id' => 'required|integer|exists:menu_items,id',
            'items.*.quantity' => 'required|integer|min:1|max:100',
            'items.*.unit_price' => 'required|numeric|min:0',
            'items.*.special_instructions' => 'nullable|string|max:500',
            'items.*.addon_ids' => 'nullable|array',
            'items.*.addon_ids.*' => 'integer|exists:addons,id',
        ];
    }

    /**
     * Custom validation messages
     */
    public function messages(): array
    {
        return [
            'items.required' => __('menu_page.cart.empty'),
            'items.min' => __('menu_page.cart.empty'),
            'items.*.menuitem_id.exists' => 'Selected menu item does not exist.',
            'items.*.quantity.min' => 'Quantity must be at least 1.',
        ];
    }
}
