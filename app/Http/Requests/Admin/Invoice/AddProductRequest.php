<?php

namespace App\Http\Requests\Admin\Invoice;

use App\Rules\CustomUniqueTitle;
use Illuminate\Foundation\Http\FormRequest;

class AddProductRequest extends FormRequest
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
        parse_str(request()->input('content'),$values);
            $this->request->add($values);


        return [
            'title'=>['required','min:3',new CustomUniqueTitle],
            'product-price'=>'required|numeric:min:10000',
            'category_id'=>'required|exists:categories,id',
            'brand_id'=>'required|exists:brands,id',
            'status'=>'required|in:active,inactive',
            'type'=>'required|in:goods,service',
            'description'=>'required|min:3',
            'file' => [
                 'required',
                'file',
                'mimes:jpg,png,jpeg',
                'max:'.env('FILE_SIZE')],
        ];
    }
    public function attributes()
    {
        return ['type'=>'نوع محصول'];
    }
}
