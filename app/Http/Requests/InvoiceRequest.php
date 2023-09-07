<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class InvoiceRequest extends FormRequest
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
            'name' => 'required|string|min:3',
            'email' => 'required|email',
            'phone' => 'required|string',
            'company_name' => 'nullable|string',
            'address' => 'required|string',
            'country' => 'required|string',
            'city' => 'required|string',
            'district' => 'required|string',
            'zip_code' => 'required|string',
            'note' => 'nullable|string',
        ];
    }
}
