<?php

namespace App\Http\Requests\Admin\Supplier;

use App\Rules\MobileFormat;
use Illuminate\Foundation\Http\FormRequest;

class SupplierRequest extends FormRequest
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
            "supplier_category_id"=>'nullable|exists:supplier_categories,id',
            'name'=>'required|min:3',
            "mobile"=>["required",new MobileFormat(),'unique:users,mobile'],
            'phone'=>'required|min:11|max:11',
            'status'=>'required|in:active,inactive',
            'address'=>'required|min:3'
        ];
    }
}
