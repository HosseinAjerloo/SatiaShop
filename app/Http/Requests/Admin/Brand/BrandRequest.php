<?php

namespace App\Http\Requests\Admin\Brand;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Route;

class BrandRequest extends FormRequest
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
        $route = Route::current();
            return [
                'name' => 'required|min:3',
                'status' => 'required|in:active,inactive',
                'file' => [
                    $route->getName() == 'admin.brand.update'?'nullable':'required',
                    'file','mimes:jpg,png,jpeg'
                ],
            ];

    }
}
//$route->getName() == 'admin.brand.update'? 'nullable':'required' .'|file|mimes:jpg,png,jpeg',
