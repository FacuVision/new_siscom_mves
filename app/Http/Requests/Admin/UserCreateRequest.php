<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UserCreateRequest extends FormRequest
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
            "lastname" => "required",
            'email' => 'required|email:rfc,dns', // Especifica la tabla y la columna
            'document_type' => 'required',
            'n_document' => 'required|unique:users,n_document', // Especifica la tabla y la columna
            'creation_document' => 'required|unique:user',
            'select_roles' => 'required'
        ];
    }

    public function messages(): array
    {
        return [
            "name.required" => "El nombre es obligatorio.",
            "lastname.required" => "El apellido es obligatorio.",
            'email.required' => 'El correo es obligatorio.',
            'email.email' => 'El formato del correo no es válido (example@gmail.com) o no existe',
            'document_type.required' => 'El tipo de documento es obligatorio.',
            'n_document.required' => 'El número de documento es obligatorio.',
            'n_document.unique' => 'Este número de documento ya ha sido registrado.',
            'creation_document.required' => 'El documento de creación es obligatorio.',
            'creation_document.unique' => 'El documento de creacion ha sido utilzado anteriormente para otro usuario.',
            'select_roles.required' => 'El rol de usuario es obligatorio.'
        ];
    }

}
