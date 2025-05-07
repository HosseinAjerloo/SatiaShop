<?php

namespace App\Http\Requests\Admin\InvoiceIssuance;

use App\Rules\RuleProductCount;
use Illuminate\Foundation\Http\FormRequest;
use function PHPUnit\Framework\isArray;

class InvoiceIssuanceRequest extends FormRequest
{
    private $allData = [];

    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    protected function prepareForValidation(): void
    {
        $this->removeNullParameter(request()->all());
        $this->merge($this->allData);
    }


    private function removeNullParameter($dataRequest)
    {

        foreach ($dataRequest as $key => $value) {
            if (is_array($value)) {
                $validParameter=array_filter($value,function ($value){
                       return isset($value);
                });
                $this->allData[$key]=$validParameter;
            } else {
                if (isset($value))
                {
                    $this->allData[$key]=$value;
                }
            }
        }

    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        /*new RuleProductCount*/
        return [
            'product_id'=>['array','required','exists:products,id',new RuleProductCount],
            'balloons'=>'nullable|in:internal,external',
            'salary'=>'nullable|numeric:min:10000'
        ];
    }
}
