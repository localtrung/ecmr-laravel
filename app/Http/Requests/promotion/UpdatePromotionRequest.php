<?php

namespace App\Http\Requests\promotion;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePromotionRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required',
            'keyword' => 'required|unique:promotions,keyword,'.$this->id.'',
            'short_code' => 'required|unique:promotions,short_code,'.$this->id.''
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Bạn chưa nhập tên của widget',
            'keyword.required' => 'Bạn chưa nhập từ khóa',
            'keyword.unique' => 'Từ khóa đã tồn tại',
        ];
    }
}