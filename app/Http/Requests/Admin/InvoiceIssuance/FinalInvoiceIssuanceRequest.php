<?php

namespace App\Http\Requests\Admin\InvoiceIssuance;

use Illuminate\Foundation\Http\FormRequest;

class FinalInvoiceIssuanceRequest extends FormRequest
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
            'description'=>'nullable|string',
            'discount'=>'nullable|numeric|min:1|max:100',
            'sodurFactor'=>'sometimes|in:yes'
        ];
    }
    public function attributes()
    {
        return ['sodurFactor'=>'گزینه صدور فاکتور معتبر نمیباشد'];
    }
}
