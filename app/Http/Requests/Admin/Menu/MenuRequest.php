<?php

namespace App\Http\Requests\Admin\Menu;

use App\Models\Menu;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Route;

class MenuRequest extends FormRequest
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
        $roue=Route::current();
        $validation=[
            'name'=>'required|min:3',
            'status'=>'required|in:active,inactive',
            'view_sort'=>'required|unique:menus,view_sort',
        ];
        if ($roue->getName()=='admin.menu.update' and $menu=$roue->parameters['menu'])
        {
            $validation['view_sort']='required|unique:menus,view_sort,'.$menu->id;
        }
        return $validation;
    }
}
