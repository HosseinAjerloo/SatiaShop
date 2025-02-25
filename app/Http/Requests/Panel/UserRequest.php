<?php

namespace App\Http\Requests\Panel;

use App\Rules\MobileFormat;
use App\Rules\NationalCode;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

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
        $user=request()->user();
        return [
            "name"=>'required',
            'family'=>'required',
            'national_code'=>['required',new NationalCode,'unique:users,national_code,'.$user->id],
            "mobile"=>["required",new MobileFormat(),'unique:users,mobile,'.$user->id],
            "password"=>['required',Password::min(8)->mixedCase()->uncompromised()],
            "tel"=>'required|digits:11',
            'email'=>'email|required',
            ''


        ];
    }
}
