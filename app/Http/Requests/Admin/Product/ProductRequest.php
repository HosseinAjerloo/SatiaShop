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
            'category_id'=>'required|exists:categories,id',
            'supplier_id'=>'required|exists:suppliers,id',
            'title'=>'required|min:3',
            'description'=>'required|min:3',
            'type'=>'required|in:service,goods',
            'status'=>'required|in:active,inactive',
            'price'=>'required|numeric',
            'amount'=>'required|numeric',
            'file' => 'required|file|mimes:jpg,png,jpeg',
        ];
    }
}
