<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class CreateUserRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|max:255|string',
            'surname' => 'required|max:255|string',
            'email' => 'required|email|max:255|unique:users,deleted_at,NULL',
        ];
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'name.required'=>'Meno musi byt vyplnene.',
            'name.max'=>'Meno moze mat najviac 255 znakov.',
            'name.string'=>'Meno musi byt postupnost znakov.',
            'surname.string'=>'Priezvisko musi byt postupnost znakov.',
            'surname.required'=>'Priezvisko musi byt vyplnene.',
            'surname.max'=>'Priezvisko moze mat najviac 255 znakov.',
            'email.required'=>'Email musi byt vyplneny.',
            'email.email'=>'Email musi byt platna emailova adresa.',
            'email.unique'=>'Zadany email uz je registrovany.',
            'email.max'=>'Email moze mat najviac 255 znakov.',
        ];
    }
}
