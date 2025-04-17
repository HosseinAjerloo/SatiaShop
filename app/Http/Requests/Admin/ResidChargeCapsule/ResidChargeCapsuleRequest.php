<?php

namespace App\Http\Requests\Admin\ResidChargeCapsule;

use App\Rules\MobileFormat;
use App\Rules\NationalCode;
use App\Rules\ResidChargeCapsuleProductDescription;
use App\Rules\ResidChargeCapsuleProductStatus;
use Illuminate\Foundation\Http\FormRequest;

class ResidChargeCapsuleRequest extends FormRequest
{
    protected $validate=[];
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

        if (request()->get('customer_type') and (request()->input('customer_type') == 'natural_person' or request()->input('customer_type') == 'juridical_person')) {

             $this->validationField();
             return $this->validate;
        } else {
            return [
                'customer_type' => 'required|in:natural_person'
            ];
        }

    }

    private function validationField()
    {
        $this->generateDefaultValidation();
        if (request()->input('customer_type') == 'natural_person') {

            $this->validate=array_merge(
                $this->validate
                ,[
                'customer_type' => 'required|in:natural_person,juridical_person',
                'name' => 'required|min:2',
                'family' => 'required|min:2',
                'mobile' => ['required','min:11','max:11',new MobileFormat],
                'address' => 'required|min:5',
                'national_code'=>['required',new NationalCode]
            ]);
        } else {
            $this->validator=array_merge(
                $this->validate,
                [
                    'customer_type' => 'required|in:natural_person,juridical_person',
                    'organizationORcompanyName'=>'required|min:2',
                    'registration_number'=>'required|min:2',
                    'national_id'=>'required|min:2',
                    'representative_name'=>'required|min:1',
                    'economic_code'=>'required|min:2',
                    'tel'=>'required|min:2'
                ]);
        }
    }

    private function generateDefaultValidation()
    {
        $this->validate['product_status']=['required','array',new ResidChargeCapsuleProductStatus];
        $this->validate['product_description']=['required','array',new ResidChargeCapsuleProductDescription];
    }

    public function attributes()
    {
        return [
            'product_status'=>'وضعیت کپسول',
            'product_description'=>'توضیحات کپسول'
        ];
    }


}
