<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FindLeadsRequest extends FormRequest
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
        if (isset($this->keyword)) {
            return [
                'category_name' => 'required',
                'keyword' => 'required'
            ];
        } else {
            return [
                'category_name' => 'required',
            ];
        }
    }
}
