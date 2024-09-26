<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProviderUpdateRequest extends FormRequest
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
    public function rules()
    {
        $id = $this->route('provider'); // Obtén el ID del registro actual desde la ruta

        return [
            "bussiness_name" => "required|unique:providers,bussiness_name,". $id
        ];
    }
    public function messages()
    {
        return [
            "bussiness_name.required" => "El nombre o razon social es obligatorio.",
            "bussiness_name.unique" => "El nombre o razon social ya está en uso.",
        ];
    }

    public function response(array $errors)
    {
        return response()->json(['errors' => $errors], 422);
    }
}
