<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SendPackageRequest extends FormRequest
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
            'customer_name' => 'required|string|max:255',
            'phone_number' => 'required|string|max:15',
            'email' => 'required|email|max:255',
            'address' => 'required|string|max:255',
            'width' => 'required|numeric|min:1',
            'height' => 'required|numeric|min:1',
            'length' => 'required|numeric|min:1',
            'weight' => 'required|numeric|min:0.1',
            'courier' => 'required|string',
        ];
    }
}
