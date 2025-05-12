<?php

namespace App\Http\Requests\Admin\Role;

use Illuminate\Foundation\Http\FormRequest;

class RoleRequest extends FormRequest
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
            'permission_id'=>'array|required|exists:permissions,id',
            'name'=>'required|min:2'
        ];
    }

    protected function prepareForValidation(): void
    {
        $permission=request()->get('permission_id')??'';
        $this->merge([
            'permission_id' =>explode(',',$permission)
        ]);
    }
}
