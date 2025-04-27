<?php

namespace App\Http\Requests\Admin\ResidChargeCapsule;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class ResidChargeCapsuleSearchRequest extends FormRequest
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
            'operator_name' => 'sometimes|string',
            'count_capsule' => 'sometimes|integer|min:1',
            'reside_id' => 'sometimes|integer|min:1',
            'created_at' => 'sometimes|integer|min:13|max:13',
            'customer_name' => 'sometimes|string',
        ];
    }

    public function attributes()
    {
        return [
            'customer_name' => 'نام مشتری',
            'created_at' => 'تاریخ',
            'reside_id' => 'شماره رسید',
            'count_capsule' => 'تعداد کپسول',
            'operator_name' => 'نام پذیرنده'
        ];
    }

    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'success' => false,
            'errors' => $validator->errors()
        ], 422));
    }
}
