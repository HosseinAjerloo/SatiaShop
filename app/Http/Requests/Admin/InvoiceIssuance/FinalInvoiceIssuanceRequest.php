<?php

namespace App\Http\Requests\Admin\InvoiceIssuance;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Route;

class FinalInvoiceIssuanceRequest extends FormRequest
{

    protected $reside;
    protected $totalPrice=0;

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
        if (Route::current()->hasParameter('reside')) {
            $this->reside = $this->route('reside');
            if ($this->reside->reside_type=='recharge'){
                $this->totalPrice=$this->reside->totalPrice();
            }else{
                $this->totalPrice=$this->reside->totalPriceSale();
            }
        }
        return [
            'description' => 'nullable|string',
            'discountDecimal' => 'nullable|numeric|min:0|max:100',
            'discount_price' => 'nullable|numeric|min:10000|max:'.$this->totalPrice,
            'sodurFactor' => 'sometimes|required|in:yes',
            'commission' => 'sometimes|required|in:yes',
            'discountFile' => 'array',
            'discountFile.*' => 'file|mimes:jpg,jpeg,png|max:' . env('FILE_SIZE')
        ];
    }

    public function attributes()
    {
        return ['sodurFactor' => 'گزینه صدور فاکتور معتبر نمیباشد',
            "discountFile.*"=>"فایل ضمیمه تخفیف"];
    }
}
