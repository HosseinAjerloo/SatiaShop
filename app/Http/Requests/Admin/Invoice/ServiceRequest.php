<?php

namespace App\Http\Requests\Admin\Invoice;

use App\Http\Traits\HasProduct;
use Illuminate\Foundation\Http\FormRequest;

class ServiceRequest extends FormRequest
{
    use HasProduct;
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
            'supplier_id'=>'required|exists:suppliers,id',
            'invoiceDesc'=>'nullable|string|min:3',
            'product_id.*'=>'required|exists:products,id',
            'description.*'=>'nullable|string|min:3',
            'price.*'=>'required|numeric|min:3'
        ];
    }
    public function attributes()
    {
        $items=$this->separationOfArraysFromText(request()->all());
        $attributes=[];
        foreach ($items as $key=> $item) {
            foreach ($item as $index =>$value)
            {
                array_push($attributes,$key.'.'.$index);
            }
        }
        $attributesLang=$this->lang($attributes);
        $attributes=array_combine($attributes,$attributesLang);
        return $attributes;
    }
}
