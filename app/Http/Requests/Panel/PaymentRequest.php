<?php

namespace App\Http\Requests\Panel;

use App\Rules\RuleProductCount;
use Illuminate\Foundation\Http\FormRequest;

class PaymentRequest extends FormRequest
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
            'product_ids' => 'required|array|exists:products,id',
            'product' => ['required','array',new RuleProductCount],
            'payment_type'=>'required|exists:banks,id'
        ];
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'product_ids' => array_keys($this->get('product'))
        ]);
    }
}
