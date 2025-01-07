<?php

namespace App\Http\Requests\Admin\Product;

use Illuminate\Foundation\Http\FormRequest;

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
        return [
            'supplier_id'=>'required|exists:suppliers,id',
            'invoiceDesc'=>'required|string|min:3',
            'product_id.*'=>'required|exists:products,id',
            'description.*'=>'required|min:3',
            'price.*'=>'required|numeric|min:3',
            'amount.*'=>'required|numeric',
        ];
    }
}
