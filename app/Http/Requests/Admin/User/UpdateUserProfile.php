<?php

namespace App\Http\Requests\Admin\User;

use App\Rules\MobileFormat;
use App\Rules\NationalCode;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Validation\Rules\Password;
use Illuminate\Validation\Validator;

class UpdateUserProfile extends FormRequest
{
    protected $route;

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
        $this->route = Route::current();

        $user = $this->route->parameters['user'];
        if ($this->route()->getName() == 'admin.user.update' and isset($user)) {
            return [
                'name' => 'required|min:3',
                'family' => 'required|min:3',
                'mobile' => ['min:11', 'max:11', new MobileFormat, 'unique:users,mobile,' . $user->id],
                'national_code' => ['required', new NationalCode, 'unique:users,national_code,' . $user->id],
                'address' => 'nullable',
                'roles' => 'required'
            ];
        } else {
            $user = Auth::user();
            return [

                'name' => 'required|min:3',
                'family' => 'required|min:3',
                'tel' => 'min:11|max:11',
                'mobile' => ['min:11', 'max:11', new MobileFormat, 'unique:users,mobile,' . $user->id],
                'national_code' => ['required', new NationalCode, 'unique:users,national_code,' . $user->id],
                'email' => 'required|email|unique:users,email,' . $user->id,
                'oldPass' => 'required',
                'password' => [Password::min(8)->mixedCase()->uncompromised(), 'confirmed'],
                'password_confirmation' => 'required',
                'address' => 'required'
            ];
        }
    }

    public function after(): array
    {
        $this->route = Route::current();

        if ($this->route->getName() != 'admin.user.update') {
            return [
                function (Validator $validator) {
                    if ($validator->errors()->count()) {
                        $validator->errors()->add('updateUserProfile', 'مقدا های داده شده در انتظار سیاست های امنیتی ما نیست');
                    }
                }
            ];
        }
        return [];
    }
    protected function prepareForValidation(): void
    {
        $permission=request()->get('permission_id')??'';
        $this->merge([
            'permission_id' =>explode(',',$permission)
        ]);
    }
}
