<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProductRequest extends FormRequest
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
        $productId = $this->route('product')?->id;

        return [
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'description' => 'nullable|string',
            'sku' => ['required', Rule::unique('products', 'sku')->ignore($productId)],
            'slug' => ['required', Rule::unique('products', 'slug')->ignore($productId)],
            'discount_amount' => 'required|numeric|min:0',
            'stock_quantity' => 'required|numeric|min:0',
            'sold_quantity' => 'required|numeric|min:0',
            'category_id' => 'required|exists:categories,id',
            'sub_category_id' => 'nullable|exists:sub_categories,id'
        ];
    }
}
