<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;


class AreaUpdateRequest extends FormRequest
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
        $id = $this->route('area'); // Obtén el ID del registro actual desde la ruta

        return [
            "name" => "required|unique:areas,name,". $id,
            "siglas_edit" => "required"
        ];
    }

    public function messages(): array
    {
        return [
            "name.required" => "El nombre es obligatorio.",
            "name.unique" => "El nombre de la Unidad Orgánica ya está en uso.",
            "siglas_edit.required" => "La sigla es obligatoria."
        ];
    }


    /**
     * Customize the response for failed validation.
     *
     * @param  \Illuminate\Contracts\Validation\Validator  $validator
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function response(array $errors)
    {
        return response()->json(['errors' => $errors], 422);
    }
}
