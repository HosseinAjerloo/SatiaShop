<?php

namespace App\Http\Requests\Admin\User;

use App\Rules\MobileFormat;
use App\Rules\NationalCode;
use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
            'name' => 'required|min:3',
            'family' => 'required|min:3',
            'mobile' => ['min:11', 'max:11', new MobileFormat, 'unique:users,mobile,' ],
            'national_code' => ['required', new NationalCode, 'unique:users,national_code,'],
            'address' => 'nullable',
            'roles' => 'required|array|exists:roles,id',
            'customer_type'=>'nullable|in:admin'
        ];
    }

    protected function prepareForValidation(): void
    {
        $permission = request()->get('roles') ?? '';
        $this->merge([
            'roles' => explode(',', $permission)
        ]);
    }
    public function attributes()
    {
        return ['type'=>'نوع کاربر'];
    }
}
