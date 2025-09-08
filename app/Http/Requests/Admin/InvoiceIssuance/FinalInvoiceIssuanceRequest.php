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
        dd(request()->all());
        return [
            'description'=>'nullable|string',
            'discount'=>'nullable|numeric|min:0|max:100',
            'sodurFactor'=>'sometimes|required|in:yes',
            'commission'=>'sometimes|required|in:yes',
            'discountFile'=>'file|mimes:jpg,jpeg,png|max:'.env('FILE_SIZE')
        ];
    }
    public function attributes()
    {
        return ['sodurFactor'=>'گزینه صدور فاکتور معتبر نمیباشد'];
    }
}
