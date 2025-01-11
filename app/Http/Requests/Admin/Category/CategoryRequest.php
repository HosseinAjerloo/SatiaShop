<?php

namespace App\Http\Requests\Admin\Category;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Route;

class CategoryRequest extends FormRequest
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
            'name' => 'required|min:3',
            'file' => [$routeCurrent->getName() == 'admin.category.update' ? 'nullable' : 'required', 'file', 'mimes:jpg,png,jpeg'],
            'view_sort' => 'required',
            'status' => 'required|in:active,inactive',
            'menu_id' => 'required|exists:menus,id',
            'category_id' => 'nullable|exists:categories,id',
        ];
    }
}
