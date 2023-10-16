<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class ProjectUpsertRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool {
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
            "title"=>["required","string","max:100"],
            "description"=>["required","string","max:255"],
            "image"=>["nullable","image"],
            "type_id"=>"nullable|exists:types,id",
        ];
    }

    public function messages(): array {
        return [
            'title.required' => 'Inserisci il titolo.',
            'title.max' => 'Titolo troppo lungo.',
            'description.required' => 'Inserisci una descrizione.',
            'image.required' => 'Inserisci un\' immagine.',
        ];
    }
}
