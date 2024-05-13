<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AreaCreateRequest extends FormRequest
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
            "name" => "required",
            "sigla" => "required"
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
