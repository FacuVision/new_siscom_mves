<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContractTypeCreateRequest extends FormRequest
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
            "name" => "required|unique:contract_types"
        ];
    }

    public function messages(): array
    {
        return [
            "name.required" => "El nombre es obligatorio.",
            "name.unique" => "El nombre del tipo de contrato ya está en uso."];
    }
}
