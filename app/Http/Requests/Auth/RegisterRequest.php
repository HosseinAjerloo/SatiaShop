<?php

namespace App\Http\Requests\Auth;

use App\Rules\MobileFormat;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class RegisterRequest extends FormRequest
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
            'code'=>'required',
            "mobile"=>["required",new MobileFormat(),'unique:users,mobile'],
            "password"=>[Password::min(8)->mixedCase()->uncompromised()],
        ];
    }
}
