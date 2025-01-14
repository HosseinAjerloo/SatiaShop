<?php

namespace App\Http\Requests\Admin\Product;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Route;

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
        $routeCurrent = Route::current();

        return [
                'title'=>'required|min:3',
                'price'=>'required|numeric:min:10000',
                'category_id'=>'required|exists:categories,id',
                'brand_id'=>'required|exists:brands,id',
                'status'=>'required|in:active,inactive',
                'type'=>'required|in:goods,service',
                'description'=>'required|min:3',
                'file' => [$routeCurrent->getName() == 'admin.product.update' ? 'nullable' : 'required', 'file', 'mimes:jpg,png,jpeg'],
        ];
    }
    public function attributes()
    {
        return [
            'type' => 'نوع محصول'
        ];
    }
}
